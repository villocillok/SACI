<?php
    date_default_timezone_set('Asia/Manila');
    session_start();

    require_once('pdf_generate_reserved_materials_report.php');
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();
   // $connection2 = new Connection();
   // $connection2->open();

    //$date = $connection->escape_string($_GET['date']);
    $from = $connection->escape_string($_GET['from']);
    $to = $connection->escape_string($_GET['to']);

    $pdf = new PDF_Generate_Reserved_Materials_Report('P', 'mm', 'Letter');

    $pdf->dateRange = $from . " up to " . $to;
    $pdf->printedBy= $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];

    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8);

    // $connection->query("SELECT * FROM book INNER JOIN publishers ON book.Publisher_ID=publishers.Publisher_ID INNER JOIN categories ON book.Category_ID=categories.Category_ID INNER JOIN section ON book.Section_ID=section.Section_ID WHERE book.Date_Added LIKE '$date%'");
    $connection->query("SELECT * FROM reservations INNER JOIN book ON reservations.Book_ID=book.Book_ID INNER JOIN barcodes ON book.Book_ID=barcodes.Book_ID WHERE Date_Reserved BETWEEN '$from' AND '$to'");

    while($row = $connection->fetch_assoc()) {
       // $authors = '';
       // $isFirst = true;

        //$connection2->query("SELECT * FROM works INNER JOIN authors ON works.Author_ID=authors.Author_ID WHERE works.Book_ID='$row[Book_ID]'");

       // while($row2 = $connection2->fetch_assoc()) {
         //   if($isFirst) {
           //     $authors .= $row2['Author_First_Name'] . ' ' . $row2['Author_Last_Name'];
             //   $isFirst = false;
            //} else {
              //  $authors .= ', ' . $row2['Author_First_Name'] . ' ' . $row2['Author_Last_Name'];
           // }
        //}

        $pdf->Row(array($row['Reservation_ID'],$row['Borrowers_ID'], $row['Book_ID'], $row['Accession_Number'], $row['Barcode_Number'], $row['Book_Title'], $row['Date_Reserved'], $row['Status']));
    }

    $pdf->Output();

    //$connection2->close();
    $connection->close();
?>