<?php
	session_start();

	if(!isset($_SESSION['user'])){
		header("location: index.php");
		exit(0);
	}

	include('mysql_connect_init.php');
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

	<div class="container">
		<?php
			if(isset($_GET['success']) and isset($_GET['success']) == "1"){
				echo "
					<div class='alert alert-success alert-dismissible'>
						<strong>Success!</strong> Your message has been sent!
					</div>
				";
			}
		?>
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Title</th>
					<th>Sender</th>
					<th>Receiver</th>
					<th>Date Sent</th>
					<th colspan="2">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$query = "
						SELECT * FROM message WHERE receiver = '".$_SESSION['email']."' OR
						sender = '".$_SESSION['email']."'
					";
					
					$res = mysqli_query($conn, $query);

					while($row = mysqli_fetch_assoc($res)){
						echo "
							<tr>
								<td>".htmlspecialchars($row['title'])."</td>
								<td>".htmlspecialchars($row['sender']).(preg_match('/\d{4}-\d{5}/', $row['sender']) ? " (STUDENT)" : " (STAFF)")."</td>
								<td>".htmlspecialchars($row['receiver']).(preg_match('/\d{4}-\d{5}/', $row['sender']) ? " (STUDENT)" : " (STAFF)")."</td>
								<td>".htmlspecialchars($row['date_created'])."</td>
								<td><a href='read_message.php?message=".$row['message_id']."'>View</a></td>
								<td><form method='post'><input type='hidden' name='msg_id' value='".$row['message_id']."'><input type='submit' name='delete_msg' value='Delete'></form></td>
							</tr>
						";
					}
				?>
			</tbody>
		</table>
	</div>

</body>

</html>