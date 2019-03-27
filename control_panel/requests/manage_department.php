<?php
    
    date_default_timezone_set('Asia/Manila');
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $departments = $connection->escape_string($_POST['departments']);

        $connection->query("SELECT * FROM department WHERE Department_Name='$departments'");

        if($connection->num_rows() == 0) {
            $connection->query("INSERT INTO department (Department_Name) VALUES ('$departments')");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The department has been added.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add department.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This department already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $departments = $connection->escape_string($_POST['departments']);

        $connection->query("SELECT * FROM department WHERE Department_Name='$departments'");

        if($connection->num_rows() == 0) {
            $connection->query("UPDATE department SET Department_Name='$departments' WHERE Department_ID='$id'");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The department has been updated.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This department already exists.'));
        }
    } else if($action == 'Delete') {
        $id = $connection->escape_string($_POST['id']);

        $connection->query("DELETE FROM department WHERE Department_ID='$id'");

        if($connection->affected_rows() == 1) {
            echo json_encode(array('status' => 'Success', 'message' => 'The department has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete department.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>