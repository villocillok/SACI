<?php
    date_default_timezone_set('Asia/Manila');
    session_start();

    require_once('connection.php');
    require_once('control_panel_settings.php');

	
	$connection = new Connection();
    $connection->open();

    $settings = new ControlPanelSettings('../../');
    
	#hidni kasama librarians sa query
	#$query = "SELECT * FROM borrower WHERE Borrower_ID = {$_POST['id']}";
    
	#kasama dito.
	$query = "
		SELECT Borrower_ID, 
		Borrower_First_Name, 
		Borrower_Last_Name, 
		Borrower_Middle_Name, 
		Contact_Number, 
		Gender, 
		Borrower_Type,
		Course
		FROM borrower 
		WHERE Borrower_ID = {$_POST['id']}
		UNION
		(
		SELECT Librarian_ID as Borrower_ID,
		Librarian_First_Name as Borrower_First_Name,
		Librarian_Last_Name as Borrower_Last_Name,
		Librarian_Middle_Name as Borrower_Middle_Name,
		'' as Contact_Number,
		'' as Gender,
		Librarian_Type as Borrower_Type,
		'' as Course
		FROM librarian
		WHERE Librarian_ID = {$_POST['id']}
		)
	";
	$connection->query($query);
    $data = $connection->fetch_assoc();
   
    echo json_encode($data);

    $connection->close();
?>