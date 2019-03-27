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
?>



<DOCTYPE! HTML>

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
	<!-------------------------------Header----------------------------->
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
				<!--<div class="ui button primary" >Log Out</div>-->
			</div>
		</div>
	</header>
	<!-------------------------------End of Header----------------------------->

	<!-------------------------------Body----------------------------->
	<div class="container1" style="position: relative;">
		<div class="container" style="position: absolute; left: 0; top: 0">
			<i class="big angle left icon" onclick="window.history.back()"></i>
		</div>
		<div class="welcome">
			<form id="post_job" method="POST" action="post_job_receiver.php" class="form">
				<h2 id="welcome-header">Post Job Vacancy</h1>
				<h4 class="ui horizontal divider header">Details</h4>
				<div class="ui two column padded grid">
					<div class="column" id="col1">
						<div class="ui labeled input" style="width: 100%;">
							<div class="ui label">
								Job Title
							</div>
							<input type="text" placeholder="e.g. Student Assistant" name="title" required>
						</div>
					</div>
					<!--<div class="column" id="col1">
						<div class="ui labeled input" style="width: 100%;">
							<div class="ui label">
								Office
							</div>
							<input type="text" placeholder="e.g. College of Engineering">
						</div>
					</div>-->
					<!--<div class="ui two column padded grid">-->
						<div class="column" id="col1">
							<div class="ui labeled input" style="width: 100%;">
								<div class="ui label">
									Slots
								</div>
								<input type="text" placeholder="e.g. 2">
							</div>
						</div>
					<!--</div>-->
				</div>
				<!--<br>-->


				<h4 class="ui top attached header" style="background-color: #e8e8e8; color: rgba(0,0,0,.6); margin-top: 20px; ">
					Description
				</h4>
				<div class="ui attached segment" style="padding: 0;">
					<div class="ui form">
						<div class="field">
							<textarea name="job_description" form="post_job" required> </textarea>
						</div>
					</div>
				</div>
				<br>
				<div class="apply-button-container" style="text-align: center;">
					<!--<div class="huge ui button primary" id="login">Apply</div>-->
					<input type="submit" value="Submit Post job" class="huge ui button primary" id="login">
				</div>
			</form>
		</div>
	</div>
	<!-------------------------------End of Body----------------------------->



	<!--------------------------------Footer--------------------------------->
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
	<!-------------------------------End of Footer-----------------------------><!-------------------------------End of Footer----------------------------->

</body>


</html>
