<?php
    date_default_timezone_set('Asia/Manila');
    session_start();
    require_once('pdf_generate_students_report.php');
    require_once('connection.php');
    require_once('control_panel_settings.php');
    require_once('functions.php');

    $connection = new Connection();
    $connection->open();
    $connection2 = new Connection();
    $connection2->open();

    $settings = new ControlPanelSettings('../../');
    $pdf = new PDF_Generate_Students_Report('P', 'mm', 'Letter');

    $pdf->printedBy= $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8);

    $connection->query("SELECT * FROM borrower INNER JOIN department ON borrower.Department_ID=department.Department_ID");

    while($row = $connection->fetch_assoc()) {
        if(strlen($row['Borrower_Middle_Name']) > 1) {
            $name = $row['Borrower_First_Name'] . ' ' . substr($row['Borrower_Middle_Name'], 0, 1) . '. ' . $row['Borrower_Last_Name'];
        } else {
            $name = $row['Borrower_First_Name'] . ' ' . $row['Borrower_Last_Name'];
        }

        $pdf->Row(array($row['Borrower_ID'], $row['Department_Name'], $name, $row['Contact_Number'], $row['Gender'], $row['Borrower_Type'], $row['Course'], $row['Status'],));
    }

    $pdf->Output();

    $connection2->close();
    $connection->close();
?>