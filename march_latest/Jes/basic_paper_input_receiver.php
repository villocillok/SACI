<?php
	session_start();

	if(!isset($_SESSION['user'])){
		header("location: index.php");
		exit(0);
	}

	include('mysql_connect_init.php');

	if ($_SESSION['user'] == "student"){
		$query = '
			SELECT jobID FROM Accepted WHERE SN = "'.$_SESSION['user'].'"
		'
		$res = mysqli_query($conn, $query);

		if ($row = mysqli_fetch_assoc($res)){
			$query = '
				INSERT INTO basic_paper_student VALUES
				(
					'.$row['jobID'].',
					"'.$_SESSION['user'].'",
					"'.$_POST['birthdate'].'",
					"'.$_POST['citizenship'].'",
					"'.$_POST['yr_lvl'].'"
				)
			';
		}
	}
	else if ($_SESSION['user'] == "faculty"){
		$fund_source = $_POST['fund_source'];

		if ($_POST['fund_source'] == "others"){
			$fund_source = $_POST['fund_source_other'];
		}

		$query = '
			INSERT INTO basic_paper_faculty VALUES(
				'.$_SESSION['jobID'].',
				"'.$_SESSION['user'].'",
				"'.$_POST['term'].'",
				"'.$_POST['acad_year'].'",
				"'.$_POST['work_office'].'",
				"'.$fund_source.'",
				"'.$_POST['fund_code'].'",
				"'.$_POST['cond_app'].'",
				"'.$_POST['start_date'].'",
				"'.$_POST['end_date'].'"
				"'.$_POST['primary_role'].'"
			)
		';

		mysqli_query($conn, $query);

	}

	header("Location: home.php");
?>
