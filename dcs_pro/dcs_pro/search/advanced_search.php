<?php
	session_start();
	include('../sql_connect.php');
	
	$search_key = mysqli_real_escape_string($conn, $_POST['title']);
	$author_key = mysqli_real_escape_string($conn, $_POST['author']);
	$date_key = mysqli_real_escape_string($conn, $_POST['date_published']);
	
	$query = 'SELECT *, authors.* FROM papers INNER JOIN authors ON authors.author_id = papers.author_id WHERE papers.title LIKE "%'.$search_key.'%"'.($author_key == 0 ? '' : 'AND papers.author_id = '.$author_key).' AND date_published LIKE "%'.$date_key.'%"';
	$res = mysqli_query($conn, $query);
	$_SESSION['current_query'] = $query;
	
	if (mysqli_num_rows($res) > 0){
		while($row = mysqli_fetch_assoc($res)){
			echo '
				<tr>
					<td>'.$row['title'].'</td>
					<td>'.$row['lname'].', '.$row['fname'].' '.$row['mname'].'</td>
					<td>'.$row['classification'].'</td>
					<td>'.$row['date_published'].'</td>
					<td>'.$row['isbn'].'</td>
					<td>'.$row['issn'].'</td>
					<td>'.$row['inter'].'</td>
					<td>'.$row['doi'].'</td>
					<td>'.$row['venue_publication'].'</td>
				</tr>	
			';
		}
		echo '
			<tr>
				<td colspan=9><a class="btn btn-primary" href="fpdf/generate_results.php" target="_blank">Generate Report</a></td>
			</tr>
		';
	}
	else {
		echo '
			<tr>
				<td colspan=9>No results</td>
			</tr>
		';
	}
	
?>