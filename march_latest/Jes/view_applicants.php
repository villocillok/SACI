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

	if (!preg_match('/\d+/', $_GET['id'])){
		header("Location: home.php");
		exit(0);
	}

	include('mysql_connect_init.php');

	$_SESSION['jobID'] = $_GET['id'];

	if(isset($_POST['waitlist'])){
		$query = '
			INSERT INTO waitlist VALUES (
				'.$_SESSION['jobID'].', "'.$_POST['sn'].'"
			)
		';

		mysqli_query($conn, $query);

		$query = '
			DELETE FROM application WHERE SN = "'.$_POST['sn'].'"
		';

		$header = 'Location: view_applicants.php?id=' . $_GET['id'];
		mysqli_query($conn, $query);
		header($header);
		#header('Location: view_applicants.php?id=1');
		exit(0);
	}

	if(isset($_POST['message'])){
		/*insert code*/
	}

	if(isset($_POST['accept'])){
		$query = '
			INSERT INTO accepted VALUES (
				'.$_SESSION['jobID'].', "'.$_POST['sn'].'"
			)
		';

		mysqli_query($conn, $query);

		$query = '
			DELETE FROM waitlist WHERE SN = "'.$_POST['sn'].'"
		';

		$header = 'Location: view_applicants.php?id=' . $_GET['id'];
		mysqli_query($conn, $query);
		header($header);
		#header('Location: view_applicants.php');
		exit(0);
	}

	if(isset($_POST['decline'])){
		$query = '
			DELETE FROM application WHERE SN = "'.$_POST['sn'].'"
			AND jobID = '.$_SESSION['jobID'].'
		';
		$header = 'Location: view_applicants.php?id=' . $_GET['id'];
		mysqli_query($conn, $query);
		header($header);
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
			width: 50px;
		}

		#col1 {
			padding: 0;
		}

		.apply-button-container {
			margin: 30px;
			text-align: center;
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

	<!----------------------------------------------------APPLICANTS TABLE----------------------------------------------------->
	<!--
		> Students who applied in the job post will be stored to Applicants Table
		> Actions:
			- Waitlist - student will be deleted from Applicants table and added to Waitlist table
			- Decline - student will be deleted from the Applicants table
	-->
	<?php
		$query = '
			SELECT * FROM jobs WHERE jobID = '.$_SESSION['jobID'].'
			AND faculty_no = "'.$_SESSION['user'].'";
		';

		$res = mysqli_query($conn, $query);

		$row = mysqli_fetch_assoc($res);
	?>

	<div class="container1" style="position: relative;">
		<div class="container" style="position: absolute; left: 0; top: 0">
			<i class="big angle left icon" onclick="window.history.back()"></i>
		</div>
		<div class="welcome">
			<h2 id="welcome-header"><?php echo $row['title']; ?></h1>
			<h1>Applicants</h1>
		</div>
		<div class="ui vertical menu" style="width: 100%">
			<?php
			$query = '
				SELECT * FROM application, students WHERE application.SN = students.SN AND jobID = '.$_SESSION['jobID'].'
			';

			$res = mysqli_query($conn, $query);
			$_SESSION['status'] = 'applicants';

			while($row=mysqli_fetch_assoc($res)) {
				echo "
					<div class=\"container\" style=\"position: relative\">
						<div class=\"ui basic buttons\" style=\"position: absolute; bottom: 5px; right: 5px; z-index: 1;\">
							<form method=\"POST\">
								<button class=\"ui yellow basic button\" name=\"waitlist\" value=\"Waitlist\">
									<input type=\"hidden\" name=\"sn\" value=\"".$row['SN']."\">
									<i class=\"users icon\"></i>
									Waitlist
								</button>
							</form>
							<form name=\"decline\" value=\"Decline\">
								<button class=\"ui red basic button\">
									<input type=\"hidden\" name=\"sn\" value=\"".$row['SN']."\">
									<i class=\"user times icon\" name=\"decline\" value=\"Decline\"></i>
									Decline
								</button>
							</form>
						</div>
						<a href=\"view_application.php?sn=".$row['SN']."\" class=\"item\">
							<div class=\"container\" style=\"float: left;\">
								<img class=\"ui medium circular image\" src=\"https://react.semantic-ui.com/images/avatar/large/chris.jpg\" style=\"height: 100px; width: 100px;\">
							</div>
							<div class=\"inline field\" style=\"float: left; margin-left: 20px;\">
							<!--<h3 style=\"margin-bottom: 0;\">\$row1['lname'].</h3>
							<p style=\"margin-bottom: 0;\">Bachelor of Science in Computer Science</p>
							<p style=\"margin-bottom: 0;\">College of Engineering</p>-->
								<h3 style=\"margin-bottom: 0;\">".$row['SN']." &nbsp;&nbsp;&nbsp; ".$row['fname']." ".$row['lname']."</h3>

								<p>Applied on ".$row['date_applied']."</p>
							</div>
						</a>
					</div>
				";
			}

			?>
		</div>
	</div>
	<!-------------------------------------------------END OF APPLICANTS TABLE-------------------------------------------------->

	<!----------------------------------------------------WAITLISTED TABLE------------------------------------------------------>
	<!--
		> Students who are waitlisted by the unit admin are stored in Waitlisted table
		> Actions:
			- Message - unit admin will send message to the student
			- Accept - student will be added to Accepted table and deleted from Waitlisted table
			- Decline - student will be deleted from the Waitlisted table
	-->
	<div class="container1" style="position: relative;">
		<div class="welcome">
			<h1>Waitlisted</h1>
		</div>
		<div class="ui vertical menu" style="width: 100%">
			<?php
			$query = '
				SELECT * FROM waitlist, students WHERE waitlist.SN = students.SN AND jobID = '.$_SESSION['jobID'].'
			';

			$res = mysqli_query($conn, $query);

			while($row=mysqli_fetch_assoc($res)) {
				//$_SESSION['status'] = 'waitlisted';
				echo "
					<div class=\"container\" style=\"position: relative\">
						<div class=\"ui basic buttons\" style=\"position: absolute; bottom: 5px; right: 5px; z-index: 1;\">
							<!--<form method=\"POST\">-->
							<a href=\"send_message.php\">
								<button class=\"ui blue basic button\" name=\"message\" value=\"Message\">
									
									<input type=\"hidden\" name=\"sn\" value=\"".$row['SN']."\">
									<i class=\"envelope outline icon\"></i>
									Message
									
								</button>
							</a>
							<!--</form>-->
							<form method=\"POST\">
								<button class=\"ui green basic button\" name=\"accept\" value=\"Accept\">
									<input type=\"hidden\" name=\"sn\" value=\"".$row['SN']."\">
									<i class=\"user plus icon\"></i>
									Accept
								</button>
							</form>
							<form>
								<button class=\"ui red basic button\">
									<input type=\"hidden\" name=\"sn\" value=\"".$row['SN']."\">
									<i class=\"user times icon\"></i>
									Decline
								</button>
							</form>
						</div>
						<a href=\"view_application.php?sn=".$row['SN']."\" class=\"item\">
							<div class=\"container\" style=\"float: left;\">
								<img class=\"ui medium circular image\" src=\"https://react.semantic-ui.com/images/avatar/large/chris.jpg\" style=\"height: 100px; width: 100px;\">
							</div>
							<div class=\"inline field\" style=\"float: left; margin-left: 20px;\">
							<!--<h3 style=\"margin-bottom: 0;\">\$row1['lname'].</h3>
							<p style=\"margin-bottom: 0;\">Bachelor of Science in Computer Science</p>
							<p style=\"margin-bottom: 0;\">College of Engineering</p>-->
								<h3 style=\"margin-bottom: 0;\">".$row['SN']." &nbsp;&nbsp;&nbsp; ".$row['fname']." ".$row['lname']."</h3>

							</div>
						</a>
					</div>
				";
			}

			?>
		</div>
	</div>
	<!-------------------------------------------------END OF WAITLISTED TABLE-------------------------------------------------->

	<!-----------------------------------------------------ACCEPTED TABLE------------------------------------------------------->
	<!--
		> Students who are accepted by the unit admin are stored in Accepted table
	-->
	<div class="container1" style="position: relative;">
		<div class="welcome">
			<h1>Accepted</h1>
		</div>
		<div class="ui vertical menu" style="width: 100%">
			<?php
			$query = '
				SELECT * FROM accepted, students WHERE accepted.SN = students.SN AND jobID = '.$_SESSION['jobID'].'
			';

			$res = mysqli_query($conn, $query);

			while($row=mysqli_fetch_assoc($res)) {
				echo "
					<div class=\"container\" style=\"position: relative\">
						<a href=\"view_application.php?sn=".$row['SN']."\" class=\"item\">
							<div class=\"container\" style=\"float: left;\">
								<img class=\"ui medium circular image\" src=\"https://react.semantic-ui.com/images/avatar/large/chris.jpg\" style=\"height: 100px; width: 100px;\">
							</div>
							<div class=\"inline field\" style=\"float: left; margin-left: 20px;\">
								<h3 style=\"margin-bottom: 0;\">".$row['SN']." &nbsp;&nbsp;&nbsp; ".$row['fname']." ".$row['lname']."</h3>
							</div>
						</a>
					</div>
				";
			}

			?>
		</div>
	</div>
	<!--------------------------------------------------END OF ACCEPTED TABLE--------------------------------------------------->

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
