<?php
    date_default_timezone_set('Asia/Manila');
    session_start();
	

    require_once('connection.php');
    require_once('control_panel_settings.php');

	
	
    $connection = new Connection();
    $connection->open();

    $settings = new ControlPanelSettings('../../');
	
    $username = $_SESSION['account_username'];
	
	
    $borrower = $connection->escape_string($_POST['borrower']);
	$book = $_POST['book'];
	
	#echo json_encode(array('status' => 'Failed', 'message' => $borrower));
	#exit(0);
    $datetime = date('Y-m-d H:i:s');
    $ctr = 0;
    $gracePeriod = 0;
	
	

    $connection->query("SELECT * FROM accounts WHERE Account_ID='$borrower'");
    $row = $connection->fetch_assoc();
	
    if($row['Account_Type'] == 'Student') {
        $gracePeriod = $settings->getSetting('studentLoanPeriod');
    } else {
        $gracePeriod = $settings->getSetting('facultyLoanPeriod');
    }

    $dueDate = date('Y-m-d H:i:s', strtotime('+ ' . $gracePeriod . ' days'));

    $connection->query("INSERT INTO borrow (Borrowers_ID, Librarian_ID, Date_Borrowed, Borrow_Due_Date) VALUES ('$borrower', '$username', '$datetime', '$dueDate')");

	
    if($connection->affected_rows() == 1) {
        $connection->query("SELECT * FROM borrow WHERE Borrowers_ID='$borrower' AND Librarian_ID='$username' AND Date_Borrowed='$datetime'");
        $row = $connection->fetch_assoc();
        $borrowID = $row['Borrow_ID'];

        foreach($book as $bookID) {
            $id = $connection->escape_string($bookID);

            $connection->query("SELECT * FROM barcodes WHERE Book_ID='$id' AND (Availability='1' OR Availability='true')");
            $row = $connection->fetch_assoc();
            $barcode = $row['Barcode_Number'];

            $connection->query("UPDATE barcodes SET Availability='false' WHERE Barcode_Number='$barcode'");

            if($connection->affected_rows() == 1) {
                $connection->query("INSERT INTO borrow_details (Borrow_ID, Barcode_Number, Status) VALUES ('$borrowID', '$barcode','active')");

                if($connection->affected_rows() == 1) {
                    $ctr++;

					#changed
					$query = "UPDATE reservations SET Status='inactive' WHERE Book_ID='$bookID' AND Borrowers_ID='$borrower'";
                    $connection->query($query);

					#added
					$query = 'UPDATE book SET Quantity = Quantity - 1 WHERE Book_ID='.$bookID;
					$connection->query($query);
				}
            }
        }

        if($ctr > 0) {
            $connection->query("UPDATE accounts SET On_Hand+=$ctr WHERE Account_ID='$borrower'");

            if(count($book) == 1) {#changed from $materials to $book
                echo json_encode(array('status' => 'Success', 'message' => 'You successfully borrowed a book.<br><br><div class="align-right"><button class="button primary" data-button="print-button">Print Receipt</button></div>', 'data' => $borrowID));
            } else {
                echo json_encode(array('status' => 'Success', 'message' => 'You successfully borrowed some books.<br><br><div class="align-right"><button class="button primary" data-button="print-button">Print Receipt</button></div>', 'data' => $borrowID));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Oops! Something went wrong...'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Failed to borrow book(s).'));
    }

    $connection->close();
?>