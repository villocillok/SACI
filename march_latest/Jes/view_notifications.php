<?php
	session_start();
	
	if(!isset($_SESSION['user'])){
		header("location: index.php");
		exit(0);
	}
	
	include('mysql_connect_init.php');

	if (isset($_POST['notif_id']) and isset($_POST['delete_notif'])) {
		$query = '
			DELETE FROM `notification` WHERE receiver = "'.$_SESSION['user'].'" AND notif_id = "'.$_POST['notif_id'].'"
		';

		mysqli_query($conn, $query);
	}
?>

<style media="screen">
	.home {
		text-align: center;
		margin-top: 20px;
	}
	.button {
		background-color: #ffe1e1;
		border-color: #ffe1e1;
		color: #440000;
	}
	.title {
		color: #800000;
	}
	.header {
		text-align: center;
	}
	.header2 {
		background-color: #800000;
		color: white;
		height: 30px;
	}
	.saga {
		text-align: center;
	}
</style>

<!DOCTYPE HTML>

<html>

<head>
	<link rel="stylesheet" href="bootstrap_3.3.7/css/bootstrap.min.css">
	<link href="pt_srif.css" rel="stylesheet">

</head>

<body>
	<div class="header">
		<h2> <img src="ossslogo.png" width=50 height=50>  Office of Scholarships and Student Affairs</h2>
	</div>
	<div class="header2">
		<h3>Home&nbsp;&nbsp; 	Programs&nbsp;&nbsp;  About OSSS</h3>
	</div>
	<div class="saga">
		<h1 class="title"><strong>SA/GA Application</strong></h1>

	</div>

	<h1>Viewing Your Notifications</h1>

</body>

	<table border=1>
	
	<thead>
		<tr>
			<td>Content</td>
			<td>Date Created</td>
			<td>Action</td>
		</tr>
	</thead>
	<tbody>

<?php
	
	$query = "SELECT * FROM notification WHERE receiver = '".$_SESSION['user']."'";
	
	$res= mysqli_query($conn, $query);
	
	while($row = mysqli_fetch_assoc($res)){
		echo "
			<tr>
				<td>".$row['content']."</td>
				<td>".$row['date_created']."</td>
				<td><form method='post'><input type='hidden' name='notif_id' value='".$row['notif_id']."'> </input><input type='submit' name='delete_notif' value='Delete'></form></td>
			</tr>
		";
	}
?>
	</tbody>
	</table>

</html>