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

	include('mysql_connect_init.php');

	/*$_SESSION['jobID'] = $_GET['id'];*/
	$_SESSION['SN'] = $_GET['SN'];
	$_SESSION['jobID'] = $_GET['jobID'];

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
		mysqli_query($conn, $query);

		$query = "
			SELECT jobs.title,
			jobs.office_college,
			faculty.fname,
			faculty.lname
			FROM jobs
			INNER JOIN faculty
			ON jobID = '".$_SESSION['jobID']."'
			AND jobs.faculty_no = '".$_SESSION['user']."'
			AND faculty.FN = '".$_SESSION['user']."'
		";

		$res = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($res);

		require('send_notification.php');

		$content = sprintf(get_notif_string($conn, 'job_decline'), $row['title'], $row['office_college'], implode(" ",array($row['fname'], $row['lname'])));

		send_notif($conn, $_POST['sn'], $content);

		header('Location: view_applicants.php');
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
			width: 150px;
		}

		.apply-button-container {
			margin: 30px;
			text-align: center;
		}
	</style>
</head>

<body>
	<!---------------------------------------------------------Header----------------------------------------------------------->
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
	<!------------------------------------------------------End of Header------------------------------------------------------->



	<!--------------------------------------------------View_Application body--------------------------------------------------->
	<?php
		$query = '
			SELECT * FROM
			(SELECT application.jobID, application.SN FROM application
			WHERE application.SN = "'.$_GET['sn'].'"
			UNION
			SELECT accepted.jobID, accepted.SN FROM accepted
			WHERE accepted.SN = "'.$_GET['sn'].'") as union_app
			INNER JOIN students
			ON students.SN = union_app.SN
		';

		$res = mysqli_query($conn, $query);

		$row = mysqli_fetch_assoc($res);
	?>


	<div class="container1">
		<div class="ui segment">
			<div class="container">
				<i class="big angle left icon" onclick="window.history.back()"></i>
			</div>
			<h3 class="ui block top attached header"><?php echo $row['fname']." ".$row['lname']." ".$row['suffix']; ?></h3>
			<div class="ui attached segment">
				<div class="ui grid">
					<div class="four wide column">
						<img class="ui fluid image" src="https://scontent.fmnl4-2.fna.fbcdn.net/v/t1.0-9/28055884_1561194627263832_6514717213170390806_n.png?_nc_cat=101&_nc_ht=scontent.fmnl4-2.fna&oh=e64ebfd1821dbb386cffdfafd25b0628&oe=5CB85DC5">
					</div>
					<div class="twelve wide column">
						<div class="job-details">
							<table class="ui definition table">
								<tbody>
									<tr>
										<td id="fixed-column">Student Number</td>
										<td><?php echo $row['SN']; ?></td>
									</tr>
									<tr>
										<td id="fixed-column">College</td>
										<td><?php echo $row['college']; ?></td>
									</tr>
									<tr>
										<td id="fixed-column">Degree</td>
										<td><?php echo $row['course']; ?></td>
									</tr>
									<tr>
										<td id="fixed-column">Email</td>
										<td><?php echo $row['email']; ?></td>
									</tr>
									<tr>
										<td id="fixed-column">Contact Number</td>
										<td><?php echo $row['contact']; ?></td>
									</tr>
									<tr>
										<td id="fixed-column">Other Details</td>
										<td>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas cursus mauris sit amet posuere interdum. Sed et urna nisl. Sed velit justo, porta at lobortis a, malesuada a ipsum. Praesent congue odio eu augue tempus, nec sodales leo luctus. Donec non bibendum felis, ac lacinia erat. Nulla non diam ut ex faucibus cursus eget vel est. Vivamus congue leo quis augue euismod sollicitudin.</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="apply-button-container">
							<div class="big ui basic buttons" style="border-color: none;">
								<?php
									$student_number = $_GET['sn'];
									$jobid = $_SESSION['jobID'];
									echo "<h1>Here<br> </h1>";
									echo "<h1>".$jobid."huhuhu<br></h1>";
									$query = '
										SELECT * FROM application, students WHERE application.SN = '.$student_number.' AND jobID = '.$_SESSION['jobID'].'
									';

									$res = mysqli_query($conn, $query);
									$result = $res;
									echo "result: ".$result."<br>";
									$row=mysqli_fetch_assoc($res);
									echo "row:";
									echo $row;

									#while($row=mysqli_fetch_assoc($res)) {
									#	echo "<h1>YSS</h1>";
									#}
									
									if($_SESSION['status'] == 'applicants') { #if student is in applications table (not yet waitlisted, accepted or declined)
										echo "
											<form method=\"POST\">
												<button class=\"ui yellow basic button\" name=\"waitlist\" value=\"Waitlist\">
													<input type=\"hidden\" name=\"sn\" value=\"".$row['SN']."\">
													<i class=\"users icon\"></i>
													Waitlist
												</button>
											</form>
											<form>
												<button class=\"ui red basic button\">
													<input type=\"hidden\" name=\"sn\" value=\"".$row['SN']."\">
													<i class=\"user times icon\"></i>
													Decline
												</button>
											</form>

										";
									} /*elseif ($_SESSION['status'] == 'waitlisted') { #if student is in waitlisted table (not yet accepted)
										echo "
											<form method=\"POST\">
												<button class=\"ui blue basic button\" name=\"message\" value=\"Message\">
													<input type=\"hidden\" name=\"sn\" value=\"".$row['SN']."\">
													<i class=\"envelope outline icon\"></i>
													Message
												</button>
											</form>
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
										";
									}*/
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	
	<!----------------------------------------------End of View_Application body------------------------------------------------>

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
