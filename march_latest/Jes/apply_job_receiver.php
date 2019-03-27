<?php
	session_start();
	
	if(!isset($_SESSION['jobID'])){
		header('Location: view_jobs.php');
		exit(0);
	}
	
	if(!isset($_SESSION['user'])){
		header("Location: index.php");
		exit(0);
	}
	
	if(!(strcmp($_SESSION['privilege'],'student')==0)){
		header("Location: home.php");
		exit(0);
	}
	
	include("mysql_connect_init.php");
	
	date_default_timezone_set('Asia/Manila');
	$date = date('d/m/Y');
	
	
	$query = '
		INSERT INTO application VALUES (
			'.$_SESSION['jobID'].', "'.$_SESSION['user'].'", "'.$date.'"
		)
	';
	
	mysqli_query($conn, $query);
	
	header("Location: home.php");
?>