<?php
	session_start();
	
	if(!isset($_SESSION['user'])){
		header("location: index.php");
		exit(0);
	}
	
	include('mysql_connect_init.php');

	if (isset($_POST['recipient']) and isset($_POST['send_msg']) and isset($_POST['message']) and isset($_POST['title_msg'])) {

		date_default_timezone_set("Asia/Manila");
		$date = date("m/d/Y h:i:sa");

		$recipient = str_replace("'", "", $_POST['recipient']);

		$query = "
			INSERT INTO message (`title`,`content`,`date_created`,`receiver`,`sender`) VALUES
			('".$_POST['title_msg']."','".$_POST['message']."','".$date."','".$_POST['recipient']."', '".$_SESSION['email']."')
		";

		mysqli_query($conn, $query);

		header("Location: view_messages.php?success=1");
		exit(0);
	}
?>



<!DOCTYPE HTML>

<html>

<head>
	<title>Student Assistant and Graduate Assistant Program</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/semantic.min.css">
	<link rel="stylesheet" href="styles.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.0/semantic.min.js"></script>
	<meta charset="utf-8">
	<script>
		$(document).ready(function() {
			$('#login').click(function() {  <!--palitan ng #login-->
				$('.ui.modal').modal('show');
				$('.ui.embed').embed();
			});
		});
	</script>
	<style>
		h1 {
			color: black;
		}

		h3 {
			color: black;
		}

		#welcome-header {
			font-size: 50px;
			text-align: center;
		}

		#welcome-details {
			font-size: 20px;
			text-align: center;
		}

		.container1 {
			margin: 10px;
		}

		#fixed-column {
			width: 80px;
		}

		#col1 {
			padding: 0;
		}

		#description-column {
			margin: 0;

		}

		#description-table {
			padding: 0;
		}
	</style>
</head>

<body>
	<!----------------------------------------------------Header----------------------------------------------------------->
	<header class="main-header">
		<div class="main-header logos">
			<a href="https://www.up.edu.ph/"><img class="up-logo" src="../assets/images/up-logo.png" height="100" alt="University of the Philippines"></a>
			<a href="http://osss.up.edu.ph/"><img class="osss-logo" src="../assets/images/osss-logo.png" height="100" alt="Office of Scholarships and Student Services"></a>
		</div>
		<div class="main-header title">
			<div class="title small">
				<a href="https://www.up.edu.ph/"><h3 class="up-name">University of the Philippines</h3></a>
				<a href="http://osss.up.edu.ph/"><h3 class="osss-name">Office of Scholarships and Student Services</h3></a>
			</div>
			<div class="title large">
				<a href="http://osss.up.edu.ph/"><h1 class="saga-name">Student Assistant and Graduate Assistant Program</h1></a>
			</div>
		</div>
	</header>
	<header class="nav">
		<div class="ui large menu" id="menu">
			<a class="item" href="home_student.html" id="link1">
				Home
			</a>
			<a class="item" href="program-goals.html" id="link1">
				Program Goals
			</a>
			<a class="item" href="job-vacancy.html" id="link1">
				Job Vacancies
			</a>
			<a class="item" href="flowchart.html" id="link1">
				Flowchart
			</a>
			<div class="right item">
				<form method="POST" action="logout.php">
					<input type="submit" value="Log out"  id="login" class="ui button primary">
				</form>
			</div>
		</div>
	</header>
	<!------------------------------------------------------End of Header------------------------------------------------------>

	<!----------------------------------------------------Send Message Body---------------------------------------------------->
	<div class="container1" style="position: relative;">
		<div class="container" style="position: absolute; left: 0; top: 0">
			<i class="big angle left icon" onclick="window.history.back()"></i>
		</div>
		<div class="welcome">
			<form id="post_job" method="POST" action="post_job_receiver.php" class="form">
				<h2 id="welcome-header">Send Message</h1>
				<h4 class="ui horizontal divider header"><!--Details--></h4>
				<div class="ui two column padded grid">
					<div class="column" id="col1">
						<div class="ui labeled input" style="width: 100%;">
							<div class="ui label">
								Title/Subject
							</div>
							<input type="text" placeholder="e.g. Student Assistant" name="title_msg" required>
						</div>
					</div>
						<div class="column" id="col1">
							<div class="ui labeled input" style="width: 100%;">
								<div class="ui label">
									Send to 
								</div>
								<input type="text" name="recipient" placeholder="recipient: e.g example@upd.edu.ph" required>
							</div>
						</div>
				</div>


				<h4 class="ui top attached header" style="background-color: #e8e8e8; color: rgba(0,0,0,.6); margin-top: 20px; ">
					Message
				</h4>
				<div class="ui attached segment" style="padding: 0;">
					<div class="ui form">
						<div class="field">
							<textarea name="message" form="message_form" required> </textarea>
						</div>
					</div>
				</div>
				<br>
				<div class="apply-button-container" style="text-align: center;">
					<input type="submit" name="send_msg" value="Send Message" class="huge ui button primary" id="login">
				</div>
			</form>
		</div>
	</div>
	
	<!--FROM OLD SEND_MESSAGE FILE-->
	<!--<div class="container" style="text-align: center">
		<h1>Send Message</h1>
		<input type="text" class="form-control" form="message_form" style="display: inline-block; width: 50%;" name="title_msg" placeholder="Title" required>
		<br><br>
		<textarea class="form-control" rows="4" cols="50" name="message" form="message_form"></textarea>

		<br>
		<br>
		<form class="form-group" style="display: inline-block; tex-align: center; width: 100%" id="message_form" method="post" enctype="multipart/form-data">
			<input type="text" class="form-control" style="width: 50%; display: inline-block;" name="recipient" value="" placeholder="recipient: e.g example@upd.edu.ph" required>
			<br>
			<br>
			<input type="submit" name="send_msg" class="btn btn-navbar" value="Send Message">
		</form>
	</div>-->
	<!-------------------------------------------------End of Send Message Body------------------------------------------------->

	<!---------------------------------------------------------Footer----------------------------------------------------------->
	<div class="ui vertical footer segment" style="background-color: #7B1113">
			<div class="ui center aligned container">
				<div class="ui stackable inverted divided grid">
					<div class="eight wide column">
						<h4 class="ui inverted header" style="text-decoration: underline">Quick Links</h4>
						<div class="ui inverted link list">
							<a href="#" class="item" id = "link2">About Us</a>
							<a href="#" class="item" id = "link2">Contact Us</a>
							<a href="#" class="item" id = "link2">Donate</a>
							<a href="#" class="item" id = "link2" >FAQs</a>
							<a href="#" class="item" id = "link2">Feedback</a>
							<a href="#" class="item" id = "link2">Forms</a>
						</div>
					</div>
					<div class="eight wide column">
						<h4 class="ui inverted header" style="text-decoration: underline">Office of Scholarships and Student Services</h4>
						<p style="color: #FFFFFF">Address<br />Contact Number<br/>Operating Hours<br/></p>
					</div>
			</div>
		</div>
	</div>
	<!------------------------------------------------------End of Footer------------------------------------------------------->


</body>

</html>