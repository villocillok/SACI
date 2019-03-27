<?php
    date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Control Panel - Southeast Asian College, Inc.</title>
    <link rel="shortcut icon" href="assets/image/Southeast Asian College.png">
    <link rel="stylesheet" href="../assets/css/receipt.css">
</head>
<body>
    <div class="box font-4">
        <div class="align-center font-3">SOUTHEAST ASIAN COLLEGE, Inc.</div>
        <div class="align-center"> 290 E.Rodriquez Avenue Corner N. Ramirez Street</div>
        <div class="align-center">Rotonda, Quezon City</div>
        <!-- <div class="align-center">Library System</div> -->
        <br>
        <?php
            //date_default_timezone_set('Asia/Manila');
            print(date('m-d-Y h:iA'));
        ?>
        <br>
        <div class="align-center">Quezon City</div>
        <br>
        <?php
            require_once('connection.php');
            require_once('control_panel_settings.php');
            require_once('functions.php');

            $connection = new Connection();
            $connection->open();

            $settings = new ControlPanelSettings('../../');

            $borrowID = $connection->escape_string($_GET['data']);

            $connection->query("SELECT * FROM borrow WHERE Borrow_ID='$borrowID'");
            $rowLoan = $connection->fetch_assoc();

            $borrower = $rowLoan['Borrowers_ID'];
            $librarian = $rowLoan['Librarian_ID'];

            #$connection->query("SELECT * FROM accounts LEFT JOIN librarian ON accounts.Account_ID=librarian.Librarian_ID LEFT JOIN borrower ON accounts.Account_ID=borrower.Student_ID WHERE accounts.Account_ID='$borrower'");
            $connection->query("SELECT * FROM accounts LEFT JOIN librarian ON accounts.Account_ID=librarian.Librarian_ID LEFT JOIN borrower ON accounts.Account_ID=borrower.Borrower_ID WHERE accounts.Account_ID='$borrower'");
            $row = $connection->fetch_assoc();

           # if($row['Account_Type'] == 'Student') {
            if(strpos('Student',$row['Account_Type']) !== false){
				$type = 'Borrower';
                $days = $settings->getSetting('studentLoanPeriod');
            } else {
                $type = 'Librarian';
                $days = $settings->getSetting('facultyLoanPeriod');
            }

			$name = '';
            if(strlen($row[$type . '_Middle_Name']) > 1) {
                $name = $row[$type . '_First_Name'] . ' ' . substr($row[$type . '_Middle_Name'], 0, 1) . '. ' . $row[$type . '_Last_Name'];
            } else {
                $name = $row[$type . '_First_Name'] . ' ' . $row[$type . '_Last_Name'];
            }

            echo '<div>Borrower: <span class="typewriter">' . $name . '</span></div>';

         





         //   echo '<div> <span class="typewriter">' .$ '</div>'; //account id
            echo '<div>Date Borrowed: ' . date('F d, Y', strtotime($rowLoan['Date_Borrowed'])) . '</div>';

            $dueDate = date('F d, Y', strtotime('+' . $days . ' days', strtotime($rowLoan['Date_Borrowed'])));
            $dueDays = ceil((strtotime($dueDate) - strtotime($rowLoan['Date_Borrowed'])) / 86400);
            $i = 1;

            while($i <= $dueDays) {
                $currentDate = date('Y-m-d', strtotime('+' . $i . ' days', strtotime($rowLoan['Date_Borrowed'])));

                if(isWeekend($currentDate)) {
                    $dueDays++;
                    $dueDate = nextDay($dueDate);
                } else {
                    if(isHoliday($connection, $currentDate)) {
                        $dueDays++;
                        $dueDate = nextDay($dueDate);
                    }
                }

                $i++;
            }

            
            echo '<br>';
            echo "Today's checkouts";
            echo '------------------------------';
            echo '<ul class="typewriter beautify">';

            $connection->query("SELECT * FROM borrow_details INNER JOIN borrow ON borrow_details.Borrow_ID=borrow.Borrow_ID INNER JOIN barcodes ON borrow_details.Barcode_Number=barcodes.Barcode_Number INNER JOIN book ON barcodes.Book_ID=book.Book_ID WHERE borrow.Borrow_ID='$borrowID'");

            while($row = $connection->fetch_assoc()) {
                echo '<li>' . $row['Book_Title'] . '</li>';
                echo '<li>Barcode'. $row['Barcode_Number'] .'</li>';

            }

            echo '</ul>';
            echo '<br><br><br>';
            echo '<div class="align-center">';

            $connection->query("SELECT * FROM librarian WHERE Librarian_ID='$librarian'");
            $row = $connection->fetch_assoc();

            if(strlen($row['Librarian_Middle_Name']) > 1) {
                $name = $row['Librarian_First_Name'] . ' ' . substr($row['Librarian_Middle_Name'], 0, 1) . '. ' . $row['Librarian_Last_Name'];
            } else {
                $name = $row['Librarian_First_Name'] . ' ' . $row['Librarian_Last_Name'];
            }
            echo '<div>Due Date: ' . date('m d, Y', strtotime($dueDate)) . '</div>';
            echo '<br>';

            echo '<div class="underscore typewriter">' . $name . '</div>';
            echo '<div>Librarian\'s Signature over printed name.</div>';
            echo '</div>';

            $connection->close();
        ?>
    </div>
</body>
</html>