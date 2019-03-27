<?php
	session_start();

	$loggedin = true;

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


	include('mysql_connect_init.php');
	$query = '
		SELECT * FROM jobs WHERE jobID = '.$_SESSION['jobID'].'
	';

	$res = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($res);
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
			$('.ui.button').click(function() {
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
			width: 50px;
		}

		.apply-button-container {
			margin: 30px;
			text-align: center;
		}
	</style>
</head>

<body>
	<!--------------------------HEADER--------------------------->
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
			<a class="item" href="home.html" id="link1">
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
				<?php
					if ($loggedin) {
						#ssecho "logged in";
					}

				?>
				<form method="POST" action="logout.php">
					<input type="submit" value="Log out"  id="login" class="ui button primary">
				</form>
			</div>
		</div>
	</header>
	<!------------------------END_OF_HEADER------------------------>



	<!---------------------------Body------------------------------>
	<div class="container1">
		<div class="ui segment">
			<div class="container">
				<i class="big angle left icon" onclick="window.history.back()"></i>
			</div>
			<h3 class="ui block top attached header">Requirements</h3>
			<div class="ui attached segment">
				<div class="ui grid">
					<div class="five wide column">
						<img class="ui fluid image" src="https://scontent.fmnl4-2.fna.fbcdn.net/v/t1.0-9/28055884_1561194627263832_6514717213170390806_n.png?_nc_cat=101&_nc_ht=scontent.fmnl4-2.fna&oh=e64ebfd1821dbb386cffdfafd25b0628&oe=5CB85DC5">
					</div>
						<div class="eleven wide column">
							<div class="job-details">
								<table class="ui definition table">
									<tbody>
										<tr>
											<!--<td id="fixed-column">Requirements</td>-->
											<td>
												Please bring the following at <?php echo $row['office_college']; ?> office: <br>
												- Copy of Form 5 <br>
												- Copy of CRS grades last semester
											</td>
										</tr>
										<tr>
											<td></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="apply-button-container">
								<!--<form method="POST" action="apply_job.php">
									<input type="submit" value="Go To Application Form" class="huge ui button primary" id="login"> <div class=\"huge ui button primary\" id=\"login\">Apply</div>
								</form>-->
								<form action="apply_job_receiver.php" method="POST" enctype="multpart/form-data">
									<input type="submit" name="apply" value="Apply" class="huge ui button primary" id="login">
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
	</div>
	<!-----------------------End of Body------------------------------>




	<!---------------------------------Footer-------------------------------->
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
	<!-------------------------------End of Footer----------------------------->

</body>

</html>
