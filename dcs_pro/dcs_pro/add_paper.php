<?php
	session_start();
	include('sql_connect.php');
?>

<!DOCTYPE HTML>

<html>

<head>
	<?php
		include('includes/header.php');
	?>
</head>

<body>
<br>
<h3>Add paper</h3>

<form action="add_paper_receiver.php" method="POST">
	<table class="table table-border">
		<tbody>
			<tr>
				<th>Title</th>
				<td>
					<input type="text" name="title" required>
				</td>
			</tr>
			<tr>
				<th>Author <input type="checkbox" id="na_box" name="new_author_box" onchange="author_box()">(Toggle For New Author)</th>
				<td>
					<div id="auth_sel" style="display: block;">
						<select name="authors" required>
						<option value="None" selected>None</option>
						<?php
							$query = 'SELECT * FROM authors';

							$res = mysqli_query($conn, $query);

							while($row = mysqli_fetch_assoc($res)){
								echo '
									<option value='.$row['author_id'].'>'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</option>
								';
							}	
						?>
						</select>
					</div>
					<div id="new_author_info" style="display: none">
						<label>First Name: </label>
						<input type="text" name="na_fname">
						<label>Last Name: </label>
						<input type="text" name="na_lname">
						<label>Middle Name: </label>
						<input type="text" name="na_mname">
					</div>
				</td>
			</tr>
			<tr>
				<th>Classification</th>
				<td>
					<select name="classification" required>
					<option value=1>Conference Paper</option>
					<option value=2>Journal</option>
					<option value=3>Book Chapter</option>
					<option value=4>Book</option>
				</select>
				</td>
			</tr>
			<tr>
				<th>Date Published</th>
				<td>
					<input type="date" name="date" required>
				</td>
			</tr>
			<tr>
				<th>ISBN: </th>
				<td><input type="text" name="isbn"></td>
			</tr>
			<tr>
				<th>ISSN: </th>
				<td><input type="text" name="issn"></td>
			</tr>
			<tr>
				<th>Local/International</th>
				<td>
					<select name="inter" required>
						<option value=1>Local</option>
						<option value=2>International</option>
					</select>
				</td>
			</tr>
			<tr>
				<th>DOI</th>
				<td><input type="text" name="doi" required></td>
			</tr>
			<tr>
				<th>Venue Publication: </th>
				<td><input type="text" name="ven_pub" required></td>
			</tr>
		</tbody>
	</table>
	<input type="submit" name="add_paper" class="btn btn-primary" value="Submit">
</form>
<script>
	document.getElementById("na_box").checked=false;
</script>


</body>

</html>