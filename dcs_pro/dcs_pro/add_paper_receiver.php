<?php
	session_start();
	$VAL_MAPS = array(
			"classification" => array(
					"Conference Paper",
					"Journal",
					"Book Chapter",
					"Book"	
				),
		);
	include("sql_connect.php");
	
	$INTER = array('Local','International');
	
	if(isset($_POST['add_paper'])){
		

		$auth_id = $_POST['authors'];

		if (isset($_POST['new_author_box'])){
		
			$query = '
				INSERT INTO authors (fname, lname, mname) VALUES
				("'.$_POST['na_fname'].'","'.$_POST['na_lname'].'","'.$_POST['na_mname'].'")
			';	

			mysqli_query($conn, $query);
		
			$query = '
				SELECT author_id FROM authors WHERE 
				fname = "'.$_POST['na_fname'].'" AND
				lname = "'.$_POST['na_lname'].'" AND
				mname = "'.$_POST['na_mname'].'"
			';

			$res = mysqli_query($conn, $query);

			$auth_id = mysqli_fetch_assoc($res)['author_id'];
		}

		$query = '
			INSERT INTO papers (
				author_id, 
				title, 
				classification,
				date_published,
				isbn,
				issn,
				inter,
				doi,
				venue_publication)
			VALUES 
			('.$auth_id.', 
			"'.$_POST['title'].'",
			"'.$VAL_MAPS['classification'][$_POST['classification']-1].'",
			"'.$_POST['date'].'",
			"'.$_POST['isbn'].'",
			"'.$_POST['issn'].'",
			"'.$INTER[(int)$_POST['inter']-1].'",
			"'.$_POST['doi'].'",
			"'.$_POST['ven_pub'].'"
			)
		';
		mysqli_query($conn, $query);

	}
	header("Location: index.php");
?>