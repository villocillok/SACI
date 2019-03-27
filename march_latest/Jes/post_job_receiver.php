<?php
	session_start();
	
	if(!isset($_SESSION['user']) ){
		header("Location: index.php");
		exit(0);
	}
	
	if(strcmp($_SESSION['privilege'],'student')==0){
		header("Location: home.php");
		exit(0);
	}
	
	include("mysql_connect_init.php");
	
	$query = '
		SELECT * FROM faculty WHERE FN = "'.$_SESSION['user'].'"		
	';
	
	$res = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($res);
	
	date_default_timezone_set('Asia/Manila');
	$date = date('d/m/y');
	
	$query = '
		INSERT INTO jobs
		(title, description, slot_alotted, date_created, office_college, faculty_no)
		VALUES(
			"'.$_POST['title'].'",
			"'.$_POST['job_description'].'",
			1,
			"'.$date.'",
			"'.$row['college'].'",
			"'.$row['FN'].'"
		)
	';
	
	mysqli_query($conn, $query);
	header('Location: home.php');
	
?>