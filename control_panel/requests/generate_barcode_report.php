<?php
    date_default_timezone_set('Asia/Manila');

    require_once('pdf.php');
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();
    $connection2 = new Connection();
    $connection2->open();

    $pdf = new PDF('L', 'mm', 'Letter');
    //$pdf->sub = 'Web-based Library Management System for Southeast Asian College, Inc. ';
    $pdf->sub = 'Barcode Report';
    //$pdf->sub = 'Date: ';//date of report

    $pdf->dateRange = $from . " up to " . $to;
    $pdf->printedBy= $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];
    
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8);

    $previousMaterialID = '';
    $isFirst = true;
    $ctr = 0;

    $connection->query("SELECT * FROM book");

    while($row = $connection->fetch_assoc()) {
        //$ctr = 0;

        //$pdf->Cell(196, 10, $row['Material_Title'], 0, 1, 'L');

        $connection2->query("SELECT * FROM barcodes WHERE Book_ID='$row[Book_ID]'");

        while($row2 = $connection2->fetch_assoc()) {
            $barcode = str_replace(' ', '%20', $row2['Barcode_Number']);
            $ctr++;

            //$pdf->Cell(39.2, 25, $pdf->Image("http://localhost/SACI-CAPS A upload/control_panel/requests/barcode_generator.php?data=$barcode", $pdf->GetX() + 4.6, $pdf->GetY() + 4.6, 30, 16, 'PNG'), 1, 0, 'C');
            $pdf->Cell(39.2, 25, $pdf->Image("http://library-saciqc.com/control_panel/requests/barcode_generator.php?data=$barcode", $pdf->GetX() + 4.6, $pdf->GetY() + 4.6, 30, 16, 'PNG'), 1, 0, 'C');

            if($ctr % 5 == 0) {
                $pdf->Ln();
            }
        }

        //$pdf->Ln();
    }

    $pdf->Output();

    $connection2->close();
    $connection->close();
?>