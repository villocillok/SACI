<?php
    date_default_timezone_set('Asia/Manila');
    session_start();
    require_once('pdf.php');
    require_once('connection.php');
    require_once('individual_barcode.php');
    require_once('pdf_generate_book_barcode_report.php');

    $connection = new Connection();
    $connection->open();
    $connection2 = new Connection();
    $connection2->open();

    $pdf = new PDF_Generate_Book_Barcode_Report('P', 'mm', 'Letter');
    $pdfbarcode = new PDF_BARCODE();

    //$pdf->dateRange = $from . " up to " . $to;
    $pdf->printedBy = $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8);

    $connection->query("SELECT * FROM book");

    while($row = $connection->fetch_assoc()) 
    {
        

        $connection2->query("SELECT * FROM barcodes WHERE Book_ID='$row[Book_ID]'");

        while($row2 = $connection2->fetch_assoc()) 
        {
            //$barcode = str_replace(' ', '%20', $row2['Barcode_Number']);
           // $ctr++;

            $barcode = urlencode($row2['Barcode_Number']);

         $pdf->Row(array($row['Book_ID'], $row2['Barcode_Number'], $row['Book_Title'], $pdfbarcode->EAN13($pdf->GetX(), $pdf->GetY(), (int) $row2['Barcode_Number'])));
        //$pdf->Ln();
        }
    }

    $pdf->Output();

    $connection2->close();
    $connection->close();
?>