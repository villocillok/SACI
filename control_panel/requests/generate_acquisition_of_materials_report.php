<?php
    date_default_timezone_set('Asia/Manila');
    session_start();
    require_once('pdf_generate_acquisition_of_materials_report.php');
    require_once('connection.php');
	require_once('control_panel_settings.php');
	require_once('functions.php');

    $connection = new Connection();
    $connection->open();
    $connection2 = new Connection();
    $connection2->open();

	
    $from = $connection->escape_string($_GET['from']);
    $to = $connection->escape_string($_GET['to']);

	$settings = new ControlPanelSettings('../../');
    $pdf = new PDF_Generate_Acquisition_Of_Materials_Report('L', 'mm', 'Letter');

    $pdf->dateRange = $from . " up to " . $to;
    $pdf->printedBy= $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];
    $pdf->AliasNbPages();
	
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 8);

	$query = "SELECT * FROM book INNER JOIN publishers ON book.Publisher_ID=publishers.Publisher_ID INNER JOIN categories ON book.Category_ID=categories.Category_ID INNER JOIN section ON book.Section_ID=section.Section_ID WHERE book.Date_Added BETWEEN '$from' AND '$to'";
	$connection->query($query);

    while($row = $connection->fetch_assoc()) {
        $authors = '';
        $isFirst = true;

        $connection2->query("SELECT * FROM works INNER JOIN authors ON `works`.`Author_ID`=authors.Author_ID WHERE works.Book_ID='$row[Book_ID]'");

        while($row2 = $connection2->fetch_assoc()) {
            if($isFirst) {
                $authors .= $row2['Author_First_Name'] . ' ' . $row2['Author_Last_Name'];
                $isFirst = false;
            } else {
                $authors .= ', ' . $row2['Author_First_Name'] . ' ' . $row2['Author_Last_Name'];
            }
        }

        $pdf->Row(array($row['Publisher_Name'], $row['Section_Type'], $row['Book_Title'], $row['Call_Number'], $row['Edition'], $row['Year_Published'], $row['Quantity'], $row['Unit_Of_Price'], $authors, $row['Category_Name']));
    }

    $pdf->Output();

    $connection2->close();
    $connection->close();
?>