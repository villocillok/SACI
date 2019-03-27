<?php
	session_start();

	if(!isset($_SESSION['user'])){
		header("location: index.php");
		exit(0);
	}

	include('mysql_connect_init.php');
?>

<!DOCTYPE HTML>

<html>

<head>

</head>

<body>

	<form method="post" action="basic_paper_input_receiver.php">
	<table>
		<tbody>
			<?php

			if (strcmp($_SESSION['privilege'],'student' ) == 0 ) {

				echo '
					<tr>
						<th>Birthdate: </th>
						<td><input type="text" name="birthdate"></td>
					</tr>
					<tr>
						<th>Citizenship: </th>
						<td><input type="text" name="citizenship"></td>
					</tr>
					<tr>
						<th>Year Level: </th>
						<td><input type="text" name="yr_lvl"></td>
					</tr>
				';
			}
			else if (strcmp($_SESSION['privilege'],'faculty') == 0){

				echo '
					<tr>
						<th>Term: </th>
						<td><input type="text" name="term"></td>
					</tr>
					<tr>
						<th>Academic Year: </th>
						<td><input type="text" name="acad_year"></td>
					</tr>
					<tr>
						<th>Work Office: </th>
						<td><input type="text" name="work_office"></td>
					</tr>
					<tr>
						<th>Fund Source: </th>
						<td>
							<select name="fund_source" onchange="fund_source_in(this.value)">
								<option value="ps_lupsum">PS Lupsum</option>
								<option value="others">Others</option>
							</select>

							<input type="text" name="fund_source_other" id="prop_desig" style="display: none;">
						</td>

					</tr>
					<tr>
						<th>Fund Code: </th>
						<td><input type="text" name="fund_code"></td>
					</tr>
					<tr>
						<th>Condition/s of appointment: </th>
						<td><input type="text" name="cond_app"></td>
					</tr>
					<tr>
						<th>Start Date: </th>
						<td><input type="text" name="start_date"></td>
					</tr>
					<tr>
						<th>End Date: </th>
						<td><input type="text" name="end_date"></td>
					</tr>
					<tr>
						<th>Primary Role: </th>
						<td><input type="text" name="primary_role" style="width:500px"></td>
					</tr>
				';

			}

			?>
		</tbody>
	</table>
	<input type="submit" value="Submit">
	</form>

	<script>
		function fund_source_in(val){
			var curr_f_source = document.getElementById('prop_desig');
			if(val == "others"){
				curr_f_source.style.display="block";
			}
			else {
				curr_f_source.style.display="none";
			}
		}
	</script>
</body>

</html>
