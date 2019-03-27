<?php
	session_start();
	
	if(!isset($_SESSION['user']) ){
		header("Location: index.php");
		exit(0);
	}
	
	if(!(strcmp($_SESSION['privilege'],'faculty')==0)){
		header("Location: home.php");
		exit(0);
	}
	
	if (!preg_match('/20[0-1][0-9]-\d{5}/', $_GET['sn'])){
		header("Location: home.php");
		exit(0);
	}
?>