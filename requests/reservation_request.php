<?php
	
    date_default_timezone_set('Asia/Manila');
    session_start();

    require_once('connection.php');
	
	
	require_once('../control_panel/requests/control_panel_settings.php');
	
	$settings = new ControlPanelSettings('../');
    $connection = new Connection();
    $connection->open();

	
    $username = $_SESSION['account_username'];
    $id = $connection->escape_string($_POST['id']);
    $action = $connection->escape_string($_POST['action']);
    $status="active";
	
    if(isset($username)) {
        if($action == 'Add') {
            // TODO: INSERT Query
            $dateReserved = date('Y-m-d H:i:s');
			$account_type = '';
			
			if (strpos('Student', $_SESSION['account_type']) !==false){
				$account_type = 'student';
			}
			else {
				$account_type = 'faculty';
			}

			$connection->query("SELECT * FROM reservations WHERE Borrowers_ID='$username' AND Status='active'");
			$currentReservations = $connection->num_rows();

			if($currentReservations < $settings->getSetting($account_type . "ReservationLimit")) {
				$query = "SELECT * FROM reservations WHERE Book_ID='$id' AND Borrowers_ID='$username' AND Status='active'";
				$connection->query($query);

				if($connection->num_rows() == 0) {
					$connection->query("INSERT INTO reservations (Book_ID, Borrowers_ID, Date_Reserved, Status) VALUES ('$id', '$username', '$dateReserved', 'active')");

					if($connection->affected_rows() == 1) {
						echo json_encode(array('status' => 'Success', 'message' => 'Reservation has been added.'));
					} else {
						echo json_encode(array('status' => 'Failed', 'message' => 'Failed to reserve book.'));
					}
				} else {
					echo json_encode(array('status' => 'Failed', 'message' => 'A copy of this book has already been reserved Or reservation limit has been reached'));
				}
			} else {
				echo json_encode(array('status' => 'Failed', 'message' => 'Reservation limit has been reached. Limit: ' . $settings->getSetting($account_type . "ReservationLimit")));
			}
        } else if($action == 'Delete') {
            // TODO: DELETE Query
            $connection->query("UPDATE reservations SET Status='inactive' WHERE Reservation_ID='$id' AND Borrowers_ID='$username'");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'Reservation has been deleted.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete reservation.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please login first.'));
    }

    $connection->close();
?>
