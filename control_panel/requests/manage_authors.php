<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $authorFirstName = $connection->escape_string($_POST['authorFirstName']);
        $authorLastName = $connection->escape_string($_POST['authorLastName']);

        $connection->query("SELECT * FROM authors WHERE Author_First_Name='$authorFirstName' AND Author_Last_Name='$authorLastName'");

        if($connection->num_rows() == 0) {
            $connection->query("INSERT INTO authors (Author_Last_Name, Author_First_Name) VALUES ('$authorLastName', '$authorFirstName')");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The author has been added.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add author.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This author already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $authorFirstName = $connection->escape_string($_POST['authorFirstName']);
        $authorLastName = $connection->escape_string($_POST['authorLastName']);

        $connection->query("SELECT * FROM authors WHERE Author_First_Name='$authorFirstName' AND Author_Last_Name='$authorLastName'");

        if($connection->num_rows() == 0) {
            $connection->query("UPDATE authors SET Author_Last_Name='$authorLastName', Author_First_Name='$authorFirstName' WHERE Author_ID='$id'");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The author has been updated.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This author already exists.'));
        }
    } else if($action == 'Delete') {
        $id = $connection->escape_string($_POST['id']);

        $connection->query("DELETE FROM authors WHERE Author_ID='$id'");

        if($connection->affected_rows() == 1) {
            echo json_encode(array('status' => 'Success', 'message' => 'The author has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete author.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>