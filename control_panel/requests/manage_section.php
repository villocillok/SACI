<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $sections = $connection->escape_string($_POST['sections']);

        $connection->query("SELECT * FROM section WHERE Section_Type='$sections'");

        if($connection->num_rows() == 0) {
            $connection->query("INSERT INTO section (Section_Type) VALUES ('$sections')");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The section has been added.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add section.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This section already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $sections = $connection->escape_string($_POST['sections']);

        $connection->query("SELECT * FROM section WHERE Section_Type='$sections'");

        if($connection->num_rows() == 0) {
            $connection->query("UPDATE section SET Section_Type='$sections' WHERE Section_ID='$id'");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The section has been updated.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This section already exists.'));
        }
    } else if($action == 'Delete') {
        $id = $connection->escape_string($_POST['id']);

        $connection->query("DELETE FROM section WHERE Section_ID='$id'");

        if($connection->affected_rows() == 1) {
            echo json_encode(array('status' => 'Success', 'message' => 'The section has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete section.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>