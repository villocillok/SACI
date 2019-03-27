<?php
	session_start();
	include('sql_connect.php');
	if(isset($_POST['submit'])){
		echo $_POST['date'];
	}
?>

<!DOCTYPE HTML>

<html>
	<?php
		include("includes/header.php");
	?>	
<head>
</head>

<body>

DCS Published Papers
<br>
<br>

Toggle Advanced Search
<input type="checkbox" data-toggle="advanced-search">

<br>
<br>

<div id="s_normal">
Search
<br>
<br>
<input type="text" name="title" placeholder="Title" data-input="normal-search">
<input class="btn btn-primary" type="submit" name="search" value="Submit" data-submit="normal-search">
</div>

<div id="s_advance" method="post" style="display: none">
	Advanced Search
	<br>
	<br>
	<table class="table table-border">
	<tbody>
	<tr>
	<td>
	Title:
	</td>
	<td> 
	<input type="text" name="title" placeholder="Title">
	</td>
	</tr>
	<tr>
	<td>
	Author:
	</td>
	<td>
	<select name="author">
	<option value="0">None</option>
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
	</td>
	</tr>
	<tr>
	<td>
	Date Published:
	</td>
	<td>
	<input type="date" name="date">
	</td>
	</tr>
	<tr>
	<td>
	</td>
	<td>
	<input data-submit="submit-button" type="submit" name="adv_search" value="Submit">
	</td>
	</tr>
	</tbody>
	</table>
</div>

<br>
</br>
<table border=1 class="table table-border">
	<thead>
		<th>Title</th>
		<th>Author</th>
		<th>Classification</th>
		<th>Date Published</th>
		<th>ISBN</th>
		<th>ISSN</th>
		<th>Local/International</th>
		<th>DOI</th>
		<th>Venue</th>
	</thead>
	<tbody  data-receiver="some-table">
	</tbody>

</table>

<?php
	if (isset($_GET['search'])){
		if (isset($_POST['adv_search'])){
			$query = '
				SELECT * FROM paper WHERE 
			';
		}
	}
?>

<br>
<a href="add_paper.php" class="btn btn-primary">
	Add paper
</a>

<br>
<br>

<form>

</form>

<script>
	document.getElementById("s_check_box").checked=false;
</script>

</body>


</html>