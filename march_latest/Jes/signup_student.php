<?php
include("mysql_connect_init.php");
session_start();
$student_number = "";
$first_name = "";
$middle_name = "";
$last_name = "";
$suffix = "";
$email = "";
$college = "";
$course = "";
$contact_number = "";
$password = "";

$student_numberErr = "";
$first_nameErr = "";
$middle_nameErr = "";
$last_nameErr = "";
$emailErr = "";
$collegeErr = "";
$courseErr = "";
$contact_numberErr = "";
$passwordErr = "";

if (isset($_POST["signup"])) {
	if (empty($_POST["student_number"])) {
		$student_numberErr = "Student number is required";
	} else {
		$student_number = $_POST["student_number"];
	}

	if (empty($_POST["first_name"])) {
		$first_nameErr = "First name is required";
	} else {
		$first_name = $_POST["first_name"];
	}

	if (empty($_POST["middle_name"])) {
		$middle_nameErr = "Middle name is required";
	} else {
		$middle_name = $_POST["middle_name"];
	}

	if (empty($_POST["last_name"])) {
		$last_nameErr = "Last name is required";
	} else {
		$last_name = $_POST["last_name"];
	}

	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = $_POST["email"];
	}

	if (empty($_POST["college"])) {
		$collegeErr = "College is required";
	} else {
		$college = $_POST["college"];
	}

	if (empty($_POST["course"])) {
		$courseErr = "Course is required";
	} else {
		$course = $_POST["course"];
	}

	if (empty($_POST["contact_number"])) {
		$contact_numberErr = "Contact number is required";
	} else {
		$contact_number = $_POST["contact_number"];
	}

	if (empty($_POST["password"])) {
		$passwordErr = "Password is required";
	} else {
		$password = $_POST["password"];
	}
}

if ($student_number && $first_name && $middle_name && $last_name && $email && $college && $course && $contact_number && $password || $suffix) {
	$salt = substr(hash("md5",date("d/m/Y h:i:sa")), 0, 10);
	//concatenating salt and actual string password then hashing it
	$password = hash("sha256", $password.$salt);
	$query = "INSERT INTO students(SN, fname, mname, lname, suffix, email, college, course, contact, password, salt) VALUES('$student_number', '$first_name', '$middle_name', '$last_name', '$suffix', '$email', '$college', '$course', '$contact_number', '$password', '$salt')";
	#echo $query;);
	mysqli_query($conn, $query);
	header("location: index.php");
}

?>


<!DOCTYPE html>

<html>
<head>
	<title>Student Assistant and Graduate Assistant Program</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
	<script src="https://code.jquery.com/jquery-2.1.4.js"></script>
	<script src="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.js"></script>
	<meta charset="utf-8">
	<style>
		html, body {
			height: 100%;
		}

		html {
			display: table;
			margin: auto;
			text-align: center;
		}

		body {
			display: table-cell;
			vertical-align: middle;
		}

		.login-header {
			margin: 10px;
		}

		.ui.header {
			color: #7B1113;
		}

		.huge.ui.button {
			width: 250px;
			background-color: #014421;
			color: white;
		}

		.signup-color {
			color: #7B1113;
		}
	</style>

</head>

<body style="vertical-align: middle">
	<div class="login-header">
		<h1 class="ui header">Sign Up Form for Student</h1>
	</div>
	<div class="login-body">
		<form method="POST" class="ui form">
			<div class="field">
				<label>Name</label>
				<div class="two fields">
					<div class="field">
						<input type="text" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>"> <span class="error"><?php echo $first_nameErr; ?></span>
					</div>
					<div class="field">
						<input type="text" name="middle_name" placeholder="Middle Name" value="<?php echo $middle_name; ?>"> <span class="error"><?php echo $middle_nameErr; ?></span>
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<input type="text" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>"> <span class="error"><?php echo $last_nameErr; ?></span>
					</div>
					<div class="field">
						<input type="text" name="suffix" placeholder="Suffix (e.g. SR, JR, III)" value="<?php echo $suffix; ?>">
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label>Email Address</label>
						<input type="text" name="email" placeholder="e.g. jmagbanua@up.edu.ph" value="<?php echo $email; ?>"> <span class="error"><?php echo $emailErr; ?></span>
					</div>
					<div class="field">
						<label>Password</label>
						<input type="password" name="password" placeholder="Password" value> <span class="error"><?php echo $passwordErr; ?></span>
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label>Student Number</label>
						<input type="text" name="student_number" placeholder="e.g. 2018-00000" value="<?php echo $student_number; ?>"> <span class="error"><?php echo $student_numberErr; ?></span>
					</div>
					<div class="field">
						<label>Contact Number</label>
						<input type="text" name="contact_number" placeholder="Contact number" value="<?php echo $contact_number; ?>"> <span class="error"><?php echo $contact_numberErr; ?></span>
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label>College</label>
						<select class="ui fluid search dropdown" id="college" name="college" value="<?php echo $college; ?>"> <?php echo $collegeErr; ?></span>
							<option value="">College</option>
							<option value="College of Architecture">College of Architecture</option>
							<option value="College of Arts and Letters">College of Arts and Letters</option>
							<option value="Asian Center">Asian Center</option>
							<option value="3">Asian Institute of Tourism</option>
							<option value="4">College of Business Administration</option>
							<option value="5">School of Economics</option>
							<option value="6">College of Education</option>
							<option value="7">College of Engineering</option>
							<option value="8">College of Fine Arts</option>
							<option value="9">College of Home Economics</option>
							<option value="10">College of Human Kinetics</option>
							<option value="11">Institute of Islamic Studies</option>
							<option value="12">School of Labor and Industrial Relations</option>
							<option value="13">College of Law</option>
							<option value="14">School of Library and Information Studies</option>
							<option value="15">College of Mass Communication</option>
							<option value="16">College of Music</option>
							<option value="17">National College of Public Administration and Governance</option>
							<option value="18">College of Science</option>
							<option value="19">College of Social Sciences and Philosophy</option>
							<option value="20">College of Social Work and Community Development</option>
							<option value="21">School of Statistics</option>
							<option value="22">School of Urban and Regional Planning</option>
							<option value="23">UP Diliman Extension Program in Pampanga</option>
							<option value="24">UP Diliman Extension Program in Olongapo</option>
							<option value="25">Archaeological Studies Program</option>
							<option value="26">Technology Management Center</option>
						</select>
						<!--<input type="text" name="college" placeholder="College" value="<?php #echo $college; ?>"> <span class="error"><?php #echo $collegeErr; ?></span>-->
					</div>
					<div class="field">
						<label>Degree Program</label>
						<select class="ui dropdown" id="degree-program" name="course" value="<?php echo $course; ?>"> <?php echo $courseErr; ?></span>
							<option value="">Degree Program</option>
						</select>
						<!--<input type="text" name="course" placeholder="Degree Program" value="<?php #echo $course; ?>"> <span class="error"><?php #echo $courseErr; ?></span>-->
					</div>
				</div>
				<script>
					$('.ui.dropdown')
						.dropdown();
				</script>
				<script>
					$(document).ready(function () {
						$("#college").change(function () {
							 switch($(this).val()) {
									case 'College of Architecture':
											$("#degree-program").html("<option value='Certificate in Building Technology'>Certificate in Building Technology</option><option value='Bachelor of Landscape Architecture'>Bachelor of Landscape Architecture</option><option value='Bachelor of Science in Architecture'>Bachelor of Science in Architecture</option><option value='Master of Architecture'>Master of Architecture</option><option value='Master of Tropical Landscape Architecture'>Master of Tropical Landscape Architecture</option>");
											break;
									case 'College of Arts and Letters':
											$("#degree-program").html("<option value='Bachelor of Arts (Araling Pilipino)'>Bachelor of Arts (Araling Pilipino)</option><option value='Bachelor of Arts (Art Studies)'>Bachelor of Arts (Art Studies)</option><option value='Bachelor of Arts (Comparative Literature)'>Bachelor of Arts (Comparative Literature)</option><option value='Bachelor of Arts (Creative Writing)'>Bachelor of Arts (Creative Writing)</option><option value='Bachelor of Arts (English Studies)'>Bachelor of Arts (English Studies)</option><option value='Bachelor of Arts (European Languages)'>Bachelor of Arts (European Languages)</option><option value='Bachelor of Arts (Filipino)'>Bachelor of Arts (Filipino)</option><option value='Bachelor of Arts (Malikhaing Pagsulat sa Filipino)'>Bachelor of Arts (Malikhaing Pagsulat sa Filipino)</option><option value='Bachelor of Arts (Speech Communication)'>Bachelor of Arts (Speech Communication) </option><option value='Bachelor of Arts (Theatre Arts)'>Bachelor of Arts (Theatre Arts)</option><option value='Certificate in Theatre Arts'>Certificate in Theatre Arts</option><option value='Doctor of Philosophy (Comparative Literature)'>Doctor of Philosophy (Comparative Literature)</option><option value='Doctor of Philosophy (Creative Writing)'>Doctor of Philosophy (Creative Writing)</option><option value='Doctor of Philosophy (English Studies)'>Doctor of Philosophy (English Studies)</option><option value='Doctor of Philosophy (Filipino)'>Doctor of Philosophy (Filipino)</option><option value='Doctor of Philosophy (Hispanic Literature)'>Doctor of Philosophy (Hispanic Literature)</option><option value='Master of Arts (Araling Pilipino)'>Master of Arts (Araling Pilipino)</option><option value='Master of Arts (Art Studies)'>Master of Arts (Art Studies)</option><option value='Master of Arts (Comparative Literature)'>Master of Arts (Comparative Literature)</option><option value='Master of Arts (Creative Writing)'>Master of Arts (Creative Writing)</option><option value='Master of Arts (English Studies)'>Master of Arts (English Studies)</option><option value='Master of Arts (Filipino)'>Master of Arts (Filipino)</option><option value='Master of Arts (French Language)'>Master of Arts (French Language)</option><option value='Master of Arts (German)'>Master of Arts (German)</option><option value='Master of Arts (Spanish)'>Master of Arts (Spanish)</option><option value='Master of Arts (Speech Communication)'>Master of Arts (Speech Communication)</option><option value='Master of Arts (Theatre Arts)'>Master of Arts (Theatre Arts)</option><option value='Sertipiko sa Malikhaing Pagsulat sa Filipino'>Sertipiko sa Malikhaing Pagsulat sa Filipino</option>");
											break;
									case 'Asian Center':
											$("#degree-program").html("<option value='Doctor of Philosophy (Philippine Studies)'>Doctor of Philosophy (Philippine Studies)</option><option value='Master in Asian Studies'>Master in Asian Studies</option><option value='Master in Philippine Studies'>Master in Philippine Studies</option><option value='Master of Arts in Asian Studies'>Master of Arts in Asian Studies</option><option value='Master of Arts in Asian Studies'>Master of Arts in Asian Studies</option><option value='Master of Arts in Philippine Studies'>Master of Arts in Philippine Studies</option>");
											break;
									default:
											break;
							 }
						});
					});
				</script>
				<div>
					<input type="submit" class="ui button"  name="signup" value="Sign up" tabindex="0">
				<!--<input type="submit" name="signup" value="Sign up" class="button">-->
				</div>
		</form>
		<h4>
			Existing account? <a href="login.php" class="signup-color">Log in</a>
		</h4>
	</div>


</body>


</html>
