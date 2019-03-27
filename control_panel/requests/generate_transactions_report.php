<?php
    date_default_timezone_set('Asia/Manila');
    session_start();
    require_once('pdf_generate_transactions_report.php');
    require_once('connection.php');
    require_once('control_panel_settings.php');
    require_once('functions.php');

    $connection = new Connection();
    $connection->open();
    $connection2 = new Connection();
    $connection2->open();

    //ection->escape_string($_GET['date']);
    $from = $connection->escape_string($_GET['from']);
    $to = $connection->escape_string($_GET['to']);  

    $settings = new ControlPanelSettings('../../');
    $pdf = new PDF_Generate_Transactions_Report('L', 'mm', 'Letter');

    $pdf->dateRange = $from . " up to " . $to;
    $pdf->printedBy= $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8);
 
    $connection->query("SELECT * FROM borrow_details INNER JOIN barcodes ON borrow_details.Barcode_Number=barcodes.Barcode_Number INNER JOIN book ON barcodes.Book_ID=book.Book_ID INNER JOIN borrow ON borrow_details.Borrow_ID=borrow.Borrow_ID INNER JOIN accounts ON borrow.Borrowers_ID=accounts.Account_ID LEFT JOIN librarian ON accounts.Account_ID=librarian.Librarian_ID LEFT JOIN borrower ON accounts.Account_ID=borrower.Borrower_ID WHERE borrow_details.Final_Due_Date BETWEEN '$from' AND '$to'");

    while($row = $connection->fetch_assoc()) {
        if($row['Account_Type'] == 'College Student' || $row['Account_Type'] == 'Senior High School Student') {
            $type = 'Borrower';
            $days = $settings->getSetting('studentLoanPeriod');
        } else {
            $type = 'Librarian';
            $days = $settings->getSetting('facultyLoanPeriod');
        }

        if(strlen($row[$type . '_Middle_Name']) > 1) {
            $name = $row[$type . '_First_Name'] . ' ' . substr($row[$type . '_Middle_Name'], 0, 1) . '. ' . $row[$type . '_Last_Name'];
        } else {
            $name = $row[$type . '_First_Name'] . ' ' . $row[$type . '_Last_Name'];
        }

        $connection2->query("SELECT * FROM `return` LEFT JOIN penalties ON `return`.Return_ID=penalties.Return_ID WHERE `return`.Borrower_Details_ID='$row[Borrow_Details_ID]'");
        $scan2 = $connection2->num_rows();

        if($scan2 == 0) {
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

            $dateReturned = 'Not yet Returned';
            $pnt = ceil((strtotime(date('Y-m-d')) - strtotime($duedueDate)) / 86400) * (double) $settings->getSetting('penalty');

            if($pnt <= 0) {
                $penalty = 0;
            } else {
                $penalty = 'Php ' . ceil((strtotime(date('Y-m-d')) - strtotime($duedueDate)) / 86400) * (double) $settings->getSetting('penalty');
            }
            
            $status = 'On-Loan';
        } else {
            $row2 = $connection2->fetch_assoc();

            $dueDate = $row['Final_Due_Date'];
            $dateReturned = $row2['Date_Returned'];
            $penalty = 'Php ' . $row2['Penalty'];
            $status = 'Returned';
        }

        $pdf->Row(array($name, $row['Book_Title'], date('F d, Y', strtotime($row['Date_Borrowed'])), date('F d, Y', strtotime($dueDate)), $dateReturned, $penalty, $status));
    }

    $pdf->Output();

    $connection2->close();
    $connection->close();
?>
