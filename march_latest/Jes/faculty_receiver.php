<?php
	session_start();

	if(isset($_SESSION['user'])){
		header('Location: home.php');
		exit(0);
	}

	include("mysql_connect_init.php");

	$query = 'SELECT * FROM faculty WHERE email = "'.$_POST['email'].'"';

	$res = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($res);
	$salt = $row['salt'];
	$saved_pass = $row['password'];
	$hashed_pass = hash("sha256",$_POST['password'].$salt);

	if(strcmp($hashed_pass, $saved_pass)==0){
		$_SESSION['user'] = $row['FN'];
		$_SESSION['name'] = $row['fname'];
		$_SESSION['privilege'] = 'faculty';
		$_SESSION['email'] = $row['email'];
		header("Location: home.php");
	}
	else {
		echo "<h1>login failed</h1>";
		header("Location: index.php");
	}
	exit(0);
?>
