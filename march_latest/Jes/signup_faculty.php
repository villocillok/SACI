<?php

include("mysql_connect_init.php");


//header("location: index.php");

$faculty_number = "";
$first_name = "";
$middle_name = "";
$last_name = "";
$suffix = "";
$email = "";
$college_or_office = "";
$position = "";
$contact_number = "";
$password = "";

$faculty_numberErr = "";
$first_nameErr = "";
$middle_nameErr = "";
$last_nameErr = "";
$emailErr = "";
$college_or_officeErr = "";
$positionErr = "";
$contact_numberErr = "";
$passwordErr = "";


$faculty_numberErr = "";

if (isset($_POST["signup"])) {

	if (empty($_POST["faculty_number"])) {
		$faculty_numberErr = "Faculty number is required";
	} else {
		$faculty_number = $_POST["faculty_number"];
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

	if (empty($_POST["college_or_office"])) {
		$college_or_officeErr = "College of Office is required";
	} else {
		$college_or_office = $_POST["college_or_office"];
	}

	if (empty($_POST["position"])) {
		$positionErr = "Position is required";
	} else {
		$position = $_POST["position"];
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

if ($faculty_number && $first_name && $middle_name && $last_name && $email && $college_or_office && $position && $contact_number && $password || $suffix) {
	mysqli_query($conn, "INSERT INTO Faculty(FN, fname, mname, lname, suffix, email, college, position, contact, password) VALUES('$faculty_number', '$first_name', '$middle_name', '$last_name', '$suffix', '$email', '$college_or_office', '$position', '$contact_number', '$password')");
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
		<h1 class="ui header">Sign Up Form for Unit Admin</h1>
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
						<input type="text" name="suffix" placeholder="Suffix (e.g. SR, JR, III)" value="<?php echo $suffix; ?>"> <span class="error"><?php echo $suffixErr; ?></span>
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
						<label>Faculty Number</label>
						<input type="text" name="faculty_number" placeholder="Faculty Number" value="<?php echo $faculty_number; ?>"> <span class="error"><?php echo $faculty_numberErr; ?></span>
					</div>
					<div class="field">
						<label>Contact Number</label>
						<input type="text" name="contact_number" placeholder="Contact number" value="<?php echo $contact_number; ?>"> <span class="error"><?php echo $contact_numberErr; ?></span>
					</div>
				</div>
				<div class="two fields">
					<div class="field">
						<label>College or Office</label>
						<input type="text" name="college_or_office" placeholder="College or Office" value="<?php echo $college_or_office; ?>"> <span class="error"><?php echo $college_or_officeErr; ?></span>
					</div>
					<div class="field">
						<label>Position</label>
						<input type="text" name="position" placeholder="Position" value="<?php echo $position; ?>"> <span class="error"><?php echo $positionErr; ?></span>
					</div>
				</div>
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
