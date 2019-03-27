<?php
    date_default_timezone_set('Asia/Manila');
    session_start();

    require_once('connection.php');
    require_once('control_panel_settings.php');
    require_once('functions.php');

    $connection = new Connection();
    $connection->open();

    $connection2 = new Connection();
    $connection2->open();

    $settings = new ControlPanelSettings('../../');

	
	
    $id = $connection->escape_string($_POST['id']);
    $datetime = date('Y-m-d H:i:s');

	
	
    $connection->query("SELECT * FROM borrow_details INNER JOIN borrow ON borrow_details.Borrow_ID=borrow.Borrow_ID INNER JOIN barcodes ON borrow_details.Barcode_Number=barcodes.Barcode_Number INNER JOIN accounts ON borrow.Borrowers_ID=accounts.Account_ID WHERE borrow_details.Borrow_Details_ID='$id'");
    $row = $connection->fetch_assoc();

    if($row['Account_Type'] == 'College Student' || $row['Account_Type'] == 'Senior High School Student') {
        $days = $settings->getSetting('studentLoanPeriod');
    } else {
        $days = $settings->getSetting('facultyLoanPeriod');
    }

	$Borrowers_ID = $row['Borrowers_ID'];
    $Accession_Number = $row['Accession_Number'];
	
    $connection->query("SELECT * FROM borrow INNER JOIN borrow_details ON borrow.Borrow_ID=borrow_details.Borrow_ID WHERE borrow_details.Borrow_Details_ID='$id'");
    $row = $connection->fetch_assoc();

    $dueDate = date('F d, Y', strtotime('+' . $days . ' days', strtotime($row['Date_Borrowed'])));
    $dueDays = ceil((strtotime($dueDate) - strtotime($row['Date_Borrowed'])) / 86400);
    $i = 1;

    while($i <= $dueDays) {
        $currentDate = date('Y-m-d', strtotime('+' . $i . ' days', strtotime($row['Date_Borrowed'])));

        if(isWeekend($currentDate)) {
            $dueDays++;
            $dueDate = nextDay($dueDate);
        } else {
            if(isHoliday($connection2, $currentDate)) {
                $dueDays++;
                $dueDate = nextDay($dueDate);
            }
        }

        $i++;
    }

    $duedueDate = $dueDate;
    $duedueDays = ceil(strtotime(date('Y-m-d')) - strtotime($duedueDate)) / 86400;
    $j = 1;

    while($j <= $duedueDays) {
        $currentDate = date('Y-m-d', strtotime('+' . $j . ' day', strtotime($duedueDate)));

        if(isWeekend($currentDate)) {
            $duedueDays++;
            $duedueDate = nextDay($duedueDate);
        } else {
            if(isHoliday($connection2, $currentDate)) {
                $duedueDays++;
                $duedueDate = nextDay($duedueDate);
            }
        }

        $j++;
    }

    $penalty = ceil((strtotime(date('Y-m-d')) - strtotime($duedueDate)) / 86400) * (double) $settings->getSetting('penalty');

    if($penalty < 0) {
        $penalty = 0;
    }

    $dued = date('Y-m-d', strtotime($dueDate));

	#Changed from Transaction_Status to Status to match column names
	$query = "UPDATE borrow_details SET Final_Due_Date='$dued', Status='inactive' WHERE Borrow_Details_ID='$id'";
    $connection->query($query);

    if($connection->affected_rows() == 1) {
        $flag = false;
        $receiptNumber = '';

        do {
            $receiptNumber = mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9);
            $query = "SELECT * FROM `return` WHERE Official_Receipt_Number='$receiptNumber'";
            $connection->query($query);

            if($connection->num_rows() == 0) {
                $flag = true;
            }
        } while(!$flag);

		#Changed from Borrow_Details_ID to Borrower_Details_ID to match column names
		$query = "INSERT INTO `return` (Borrower_Details_ID, Date_Returned, Transaction_Status, Borrowers_ID, Accession_Number, Official_Receipt_Number) VALUES ('$id', '$datetime', 'Inactive', '$Borrowers_ID', '$Accession_Number', '$receiptNumber')";
        $connection->query($query);

        if($connection->affected_rows() == 1) {
			$query = "SELECT * FROM borrow_details WHERE Borrow_Details_ID='$id'";
            $connection->query($query);
            $rowDetails = $connection->fetch_assoc();
            $barcode = $rowDetails['Barcode_Number'];

			$query = "UPDATE barcodes SET Availability='true' WHERE Barcode_Number='$barcode'";
            $connection->query($query);
			
			#added:
			$query = "UPDATE book SET Quantity = Quantity + 1 WHERE Book_ID=".$id;
			$connection->query($query);

			$query = "SELECT * FROM `return` WHERE Borrower_Details_ID='$id'";
            $connection->query($query);
            $row = $connection->fetch_assoc();
            $returnID = $row['Return_ID'];

            $connection->query("INSERT INTO penalties (Return_ID, Penalty, Date_of_Payment, Status) VALUES ('$returnID', '$penalty', '$datetime', 'inactive')");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'You successfully returned a book.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to settle penalty.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Oops! Something went wrong... ' . $connection->show_error()));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Failed to return book.'));
    }

    $connection2->close();
    $connection->close();
?>
