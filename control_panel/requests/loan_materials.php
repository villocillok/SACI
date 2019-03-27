<?php
    date_default_timezone_set('Asia/Manila');
    session_start();

	#echo json_encode(array('status' => 'Failed', 'message' => $_POST));
	
    require_once('connection.php');
    require_once('control_panel_settings.php');

    $connection = new Connection();
    $connection->open();


    $settings = new ControlPanelSettings('../../');


    $username = $_SESSION['account_username'];
    $borrower = $connection->escape_string($_POST['borrower']);
    $book = $_POST['book'];
    $datetime = date('Y-m-d H:i:s');
    $ctr = 0;
    $gracePeriod = 0;



    $connection->query("SELECT * FROM accounts WHERE Account_ID='$borrower'");
    $row = $connection->fetch_assoc();

    #echo json_encode(array('status' => 'Failed', 'message' => 'Failed to borrow book(s). ' . $connection->check_error()));
    #exit(0);

    if($row['Account_Type'] == 'College Student' || $row['Account_Type'] == 'Senior High School Student') {
        $gracePeriod = $settings->getSetting('studentLoanPeriod');
    } else {
        $gracePeriod = $settings->getSetting('facultyLoanPeriod');
    }

    $dueDate = date('Y-m-d H:i:s', strtotime('+ ' . $gracePeriod . ' days'));

	$query = "INSERT INTO borrow (Borrowers_ID, Librarian_ID, Date_Borrowed, Borrow_Due_Date) VALUES ('$borrower', '$username', '$datetime', '$dueDate')";
    $connection->query($query);
	
	
    if($connection->affected_rows() == 1) {
		
		$query = "SELECT * FROM borrow WHERE Borrowers_ID='$borrower' AND Librarian_ID='$username' AND Date_Borrowed='$datetime'";
        #echo json_encode(array('status' => 'Failed', 'message' => $query));
		$connection->query($query);
        $row = $connection->fetch_assoc();
        $borrowID = $row['Borrow_ID'];

        foreach($book as $bookID) {
            $id = $connection->escape_string($bookID);

			#$query = "SELECT * FROM barcodes WHERE Book_ID='$id' AND Availability='true'";
            $query = "SELECT * FROM barcodes WHERE Book_ID='$id' AND (Availability='1' OR Availability='true')";
			$connection->query($query);
			
			
            $row = $connection->fetch_assoc();
            $barcode = $row['Barcode_Number'];

			$query = "UPDATE barcodes SET Availability='false' WHERE Barcode_Number='$barcode'";
			$connection->query($query);
			#echo json_encode(array('status' => 'Failed', 'message' => $query));
			

            if($connection->affected_rows() == 1) {
				#added Status column in the query and set it to "active"
				$query = "INSERT INTO borrow_details (Borrow_ID, Barcode_Number, Status) VALUES ('$borrowID', '$barcode','active')";
                $connection->query($query);
				
				#Added:
				$query = 'UPDATE book SET Quantity = Quantity - 1 WHERE Book_ID='.$id;
				$connection->query($query);
				#echo json_encode(array('status' => 'Failed', 'message' => $query));
				
                if($connection->affected_rows() == 1) {
                    $ctr++;
                }
            }
        }

        if($ctr > 0) {
            $connection->query("UPDATE accounts SET On_Hand+=$ctr WHERE Account_ID='$borrower'");

            if(count($book) == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'You successfully borrowed a book.<br><br><div class="align-right"><button class="button primary" data-button="print-button">Print Receipt</button></div>', 'data' => $borrowID));
            } else {
                echo json_encode(array('status' => 'Success', 'message' => 'You successfully borrowed some books.<br><br><div class="align-right"><button class="button primary" data-button="print-button">Print Receipt</button></div>', 'data' => $borrowID));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Oops! Something went wrong... ' . $connection->check_error()));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Failed to borrow book(s). ' . $connection->check_error()));
    }
	
	

    $connection->close();
?>