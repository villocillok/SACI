<?php

	function get_notif_string($sql_conn, $notif_name){
		
		$query = "
			SELECT * FROM notif_type WHERE notif_type_name = '".$notif_name."'
		";
		
		$res = mysqli_query($sql_conn, $query);
		$row = mysqli_fetch_assoc($res);
		
		return $row['content'];
		
	}

	function send_notif($sql_conn, $receiver_id, $content){
		
		date_default_timezone_set('Asia/Manila');
		
		$date = date("m/d/Y h:i:sa");
		$query = "
			INSERT INTO notification (`content`, `receiver`,`date_created`) VALUES
			('".$content."','".$receiver_id."', '".$date."')
		";
		
		mysqli_query($sql_conn, $query);
		
	}
?>