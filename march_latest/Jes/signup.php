

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
		<h1 class="ui header">Sign up as</h1>
	</div>
	<div class="login-body">
		<a href="signup_student.php"><button class="huge ui button">
			Student
		</button></a>
		<br><br>
		<a href="signup_faculty.php"><button class="huge ui button">
			Unit Admin
		</button></a>
		<h4>
			Existing account? <a href="login.php" class="signup-color">Log in</a>
		</h4>
	</div>

</body>


</html>
