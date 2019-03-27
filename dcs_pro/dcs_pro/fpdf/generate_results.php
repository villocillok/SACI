<?php
	session_start();
	require('pdf_mc_table.php');
	include('../sql_connect.php');
	
	$query = $_SESSION['current_query'];
	$res = mysqli_query($conn, $query);
	
	$pdf = new PDF_MC_Table('L','mm','Letter');
	$pdf->AddPage();
	$pdf->SetFont('Arial','',10);
	
	$pdf->SetWidths(array(30,30,25,35,25,25,35,15,35));
	
	$pdf->Row(array("Title","Author","Classification","Data Published","ISBN","ISSN","Local/International","DOI","Venue"));
	while($row = mysqli_fetch_assoc($res)){
		$pdf->Row(array(
			$row['title'],
			$row['lname'].', '.$row['fname'].' '.$row['mname'],
			$row['classification'],
			$row['date_published'],
			$row['isbn'],
			$row['issn'],
			$row['inter'],
			$row['doi'],
			$row['venue_publication']
		));
	}
	$pdf->Output();
?>	