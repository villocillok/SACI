<?php
	session_start();

	if(!isset($_SESSION['user'])){
		header("location: index.php");
		exit(0);
	}
	include("mysql_connect_init.php");
?>


<DOCTYPE! HTML>

<html>
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
	<script>
		$(document).ready(function(){
			$('.ui.tabular .item').click(function() {
				$('.ui .item').removeClass('active');
				$(this).addClass('active');
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
			font-size: 60px;
			text-align: center;
		}

		.container1 {
			margin: 10px;
		}

		.ui.vertical.menu {
			width: auto;
		}

		#job {
			display: inline-block;
		}

		.job-details {
			color: #808080;
		}

		#x {
			position: absolute;
			top: 0;
			right: 0;
		}

		.ui.cards {
			margin: 0;
		}

		.ui.card {
			margin: 0;
		}

		h2:first-child {
			margin-bottom: 0;
		}

		#green-button {
			background-color: #014421;
		}
	</style>
<head>

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
				<form method="POST" action="logout.php">
					<input type="submit" value="Log out"  id="login" class="ui button primary">
				</form>
				<!--<div class="ui button primary" >Log Out</div>-->
			</div>
		</div>
	</header>
	<!------------------------END_OF_HEADER------------------------>


	<!--------------------------BODY------------------------------>


	<div class= "container1">
		<div class="welcome">
      <h1 id="welcome-header"><?php echo "Welcome, ".$_SESSION['name']."!"; ?></h1>
    </div>
		<div class="ui divider"></div>

		<!-------------------STUDENT_ACCOUNT------------------------->
		<?php
			if(strcmp($_SESSION['privilege'],'student')==0) {
				##########CURRENT AND WAITLISTED APPLICATION##############
				echo "
				<!---------CURRENT AND WAITLISTED APPLICATION------------>
				<div class=\"apps\">
					<h2>Applications</h2>
					<div class=\"ui top attached tabular menu\">
						<a class=\"active item\">
							Current
						</a>
						<a class=\"item\">
							Waitlisted
						</a>
					</div>
					<div class=\"ui bottom attached segment\">
						<div class=\"ui vertical menu\">
							<div class=\"container\">
								<div style=\"position:relative\">
										<i class=\"remove icon\" id = \"x\" style=\"right:0; z-index: 1;\"></i>
								</div>
								<a href=\"job1.html\" class=\"item\">
									<div class=\"inline field\">
										<h3>Job 1</h3>
										<p>Hello.</p>
									</div>
								</a>
							</div>
							<div class=\"container\">
								<div style=\"position:relative\">
										<i class=\"remove icon\" id = \"x\" style=\"right:0; z-index: 1;\"></i>
								</div>
								<a href=\"job2.html\" class=\"item\">
									<div class=\"inline field\">
										<h3>Job 2</h3>
										<p>Hello.</p>
									</div>
								</a>
							</div>
							<div class=\"container\">
								<div style=\"position:relative\">
										<i class=\"remove icon\" id = \"x\" style=\"right:0; z-index: 1;\"></i>
								</div>
								<a href=\"job2.html\" class=\"item\">
									<div class=\"inline field\">
										<h3>Job 3</h3>
										<p>Hello.</p>
									</div>
								</a>
							</div>
							<div class=\"container\">
								<div style=\"position:relative\">
										<i class=\"remove icon\" id = \"x\" style=\"right:0; z-index: 1;\"></i>
								</div>
								<a href=\"job4.html\" class=\"item\">
									<div class=\"inline field\">
										<h3>Job 4</h3>
										<p>Hello.</p>
									</div>
								</a>
							</div>
						</div>
						<!--<div class=\"ui vertical menu\" id=\"vertical-menu\">
							<div class=\"item\" id=\"job\">
								<a href=\"hello.html\" class=\"job-details\">
									<h3>Job 1</h3>
									<p>Hello.</p>
								</a>
								<div class=\"remove-job\">
									<i class=\"remove icon\"></i>
								</div>
							</div>
						</div>-->
					</div>
				</div>
				<div class=\"ui divider\"></div>
				<!--------END OF APPLICATION AND WAITLISTED---------->
				";
			######END OF CURRENT AND WAITLISTED APPLICATION#######

			##################JOB VACANCY POST####################
			$query = 'SELECT jobs.*,
				faculty.fname as fname,
				faculty.lname as lname
				FROM jobs
				INNER JOIN faculty
				ON faculty.FN = jobs.faculty_no
			';

			$res = mysqli_query($conn, $query);

			echo "
				<div class=\"job-vacancies\">
					<h2>Job Vacancies</h2>
					<div class=\"ui four cards\">

			";
			while($row=mysqli_fetch_assoc($res)) {
				echo "
				<a class=\"ui card\" href=view_jobs.php?id=".$row['jobID'].">
					<div class=\"image\">
						<img src=\"https:\/\/scontent.fmnl4-2.fna.fbcdn.net/v/t1.0-9/28055884_1561194627263832_6514717213170390806_n.png?_nc_cat=101&_nc_ht=scontent.fmnl4-2.fna&oh=e64ebfd1821dbb386cffdfafd25b0628&oe=5CB85DC5\">
					</div>
					<div class=\"content\">
						<div class=\"header\">".$row['title']."</div>
						<div class=\"meta\">
							".$row['office_college']."
						</div>
						<div class=\"description\">
							".$row['description']."
						</div>
					</div>
					<div class=\"extra content\">
						<span class=\"right floated\">
							".$row['date_created']."
						</span>
						<span>
							<i class=\"user icon\"></i>
							".$row['slot_alotted']."
						</span>
					</div>
				</a>
				";
			}

			echo "
					</div>
				</div>
			";




			}
		?>

		<!----------------------FACULTY_ACCOUNT------------------------>

		<?php
			if(strcmp($_SESSION['privilege'],'faculty')==0) {
				echo "<div class=\"jobs-posted\" style=\"position: relative; margin-bottom: 15px;\">
								<h2>Jobs Posted</h2>
								<a href=\"post_job.php\" class=\"ui button primary\" id=\"green-button\" style=\"position: absolute; top: 0; right: 0;\">
					        <i class=\"edit icon\"></i>
					        Post Job Vacancy
					      </a>
								<br>
								<div class=\"container\">
									<div class=\"ui vertical menu\">";
				}
						$query = 'SELECT * FROM jobs WHERE faculty_no = "'.$_SESSION['user'].'"';

						$res = mysqli_query($conn, $query);

						while($row = mysqli_fetch_assoc($res)) {
							echo "
							<div class=\"container\" style=\"position:relative\">
								<div class=\"ui basic buttons\" style=\"position: absolute; bottom: 5px; right: 5px; z-index: 1;\">
									<a href=\"view_applicants.php?id=".$row['jobID']."\"><!--<form action=\"view_applicants.php?id=".$row['jobID']."\">-->
										<button class=\"ui button\">
											<i class=\"icon user\"></i>
											View Applicants
										</button>
									</a><--</form>-->

									<button class=\"ui button\">
										<i class=\"remove icon\"></i>
										Delete Post
									</button>
								</div>
								<a href=\"job2.html\" class=\"item\">
									<div class=\"inline field\">
										<h3>".$row['title']."</h3>
										<p>".$row['date_created']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Job ID: ".$row['jobID']." &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Number of Slots: ".$row['slot_alotted']."<p>
										<p>".$row['description']."</p>
									</div>
								</a>
							</div>
							";
						}
					?>
				</div> <!--END OF UI VERTICAL MENU-->
			</div> <!--END OF CONTAINER-->
		</div> <!--END OF JOBS POSTED-->
		<!---------------------END_OF_FACULTY_ACCOUNT------------------>

	</div> <!--END OF DIV CONTAINER1-->


	<!--------------------------END_OF_BODY------------------------------>


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
