<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $holiday = $connection->escape_string($_POST['holiday']);
        $holidayType = $connection->escape_string($_POST['holidayType']);
        $month = $connection->escape_string($_POST['month']);
        $day = $connection->escape_string($_POST['day']);
        $year = $connection->escape_string($_POST['year']);

        $connection->query("SELECT * FROM holidays WHERE Holiday='$holiday'");

        if($connection->num_rows() == 0) {
            $connection->query("INSERT INTO holidays (Holiday, Holiday_Type, Month, Day, Year) VALUES ('$holiday', '$holidayType', '$month', '$day', '$year')");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The holiday has been added.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add holiday.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This holiday already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $holiday = $connection->escape_string($_POST['holiday']);
        $holidayType = $connection->escape_string($_POST['holidayType']);
        $month = $connection->escape_string($_POST['month']);
        $day = $connection->escape_string($_POST['day']);
        $year = $connection->escape_string($_POST['year']);

        $connection->query("SELECT * FROM holidays WHERE Holiday='$holiday' AND Holiday_ID!='$id'");

        if($connection->num_rows() == 0) {
            $connection->query("UPDATE holidays SET Holiday='$holiday', Holiday_Type='$holidayType', Month='$month', Day='$day', Year='$year' WHERE Holiday_ID='$id'");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The holiday has been updated.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This holiday already exists.'));
        }
    } else if($action == 'Delete') {
        $id = $connection->escape_string($_POST['id']);

        $connection->query("DELETE FROM holidays WHERE Holiday_ID='$id'");

        if($connection->affected_rows() == 1) {
            echo json_encode(array('status' => 'Success', 'message' => 'The holiday has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete holiday.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>