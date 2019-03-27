<?php
	 date_default_timezone_set('Asia/Manila');
    session_start();

    require_once('connection.php');
    require_once('control_panel_settings.php');
    require_once('functions.php');
	
	$connection = new Connection();
	$connection->open();
	$id = $connection->escape_string($_POST['id']); //Book id
	
	$query = "DELETE FROM weeding WHERE Book_ID = $id";
	$connection->query($query);
	
	$query = "UPDATE book SET Status = 'active'";
	$connection->query($query);
	
	 if($connection->affected_rows() == 1) {
		echo json_encode(array('status' => 'Success', 'message' => 'The book has been restored.'));
	} else {
		echo json_encode(array('status' => 'Failed', 'message' => 'Failed to restore book.'));
	}
?>