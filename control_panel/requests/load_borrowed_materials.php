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
    $penalty = 0;

    $connection->query("SELECT * FROM accounts WHERE Account_ID='$id'");
    $rowAccounts = $connection->fetch_assoc();

    if($rowAccounts['Account_Type'] == 'College Student' || $rowAccounts['Account_Type'] == 'Senior High School Student') {
        $days = $settings->getSetting('studentLoanPeriod');
    } else {
        $days = $settings->getSetting('facultyLoanPeriod');
    }

	#Incomplete Query VVVV BUG 3a
    #$connection->query("SELECT *, borrow_details.Status AS Borrow_Details_Status FROM borrow_details INNER JOIN borrow ON borrow_details.Borrow_ID=borrow.Borrow_ID INNER JOIN barcodes ON borrow_details.Barcode_Number=barcodes.Barcode_Number INNER JOIN book ON barcodes.Book_ID=book.Book_ID WHERE borrow.Borrowers_ID='$id'");
	#"Fixed" Query VVVV
	$connection->query("SELECT *, borrow_details.Status AS Borrow_Details_Status FROM borrow_details INNER JOIN borrow ON borrow_details.Borrow_ID=borrow.Borrow_ID INNER JOIN barcodes ON borrow_details.Barcode_Number=barcodes.Barcode_Number INNER JOIN book ON barcodes.Book_ID=book.Book_ID INNER JOIN works ON works.Book_ID = book.Book_ID INNER JOIN authors ON authors.Author_ID = works.Author_ID WHERE borrow.Borrowers_ID='$id'");

    while($row = $connection->fetch_assoc()) {
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
        $duedueDays = ceil((strtotime(date('Y-m-d')) - strtotime($duedueDate)) / 86400);
        $j = 1;

        while($j <= $duedueDays) {
            $currentDate = date('Y-m-d', strtotime('+' . $j . ' days', strtotime($duedueDate)));

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
        $name = $row['Author_Last_Name'] . ', ' . $row['Author_First_Name'];

        echo '<tr>';
        echo '<td>' . $row['Barcode_Number'] . '</td>';
        echo '<td>' . $row['Book_Title'] . '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $row['Publisher_Name'] . '</td>';
        echo '<td>' . $row['Section_Type'] . '</td>';
        echo '<td>' . $row['Call_Number'] . '</td>';
        echo '<td>' . $row['Edition'] . '</td>';
        // echo '<td>' . date('F d, Y', strtotime($row['Date_Published'])) . '</td>';
        echo '<td>' . date('Y', strtotime($row['Year_Published'])) . '</td>';

        echo '<td>' . date('F d, Y', strtotime($row['Date_Borrowed'])) . '</td>';

        if($row['Borrow_Details_Status'] == 'active') {
            echo '<td>' . date('F d, Y', strtotime($dueDate)) . '</td>';
        } else {
            echo '<td>' . date('F d, Y', strtotime($row['Final_Due_Date'])) . '</td>';
        }

        echo '<td>' . ($penalty >= 0 ? $penalty : 0) . '</td>';
        
        if(isset($_SESSION['account_username'])) {
            if($row['Borrow_Details_Status'] == 'active') {
                echo '<td class="align-center"><a class="button primary mini-button beautify" data-button="return-material-button" data-var-id="' . $row['Borrow_Details_ID'] . '" data-role="hint" data-hint="Return Book" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-undo"></span></a></td>';
            } else {
				echo '<td class="align-center"><a href="javascript:void(0);" class="button mini-button beautify" data-role="hint" data-hint="Returned" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-checkmark"></span></a></td>';
				
			}
        } else {
            echo '<td></td>';
        }

        echo '</tr>';
    }

    $connection2->close();
    $connection->close();
?>