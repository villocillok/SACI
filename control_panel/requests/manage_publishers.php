<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $publisher = $connection->escape_string($_POST['publisher']);
        $publisherAddress = $connection->escape_string($_POST['publisherAddress']);
        $contactNumber = $connection->escape_string($_POST['contactNumber']);

        $connection->query("SELECT * FROM publishers WHERE Publisher_Name='$publisher'");

        if($connection->num_rows() == 0) {
            $connection->query("INSERT INTO publishers (Publisher_Name, Publisher_Address, Contact_Number) VALUES ('$publisher', '$publisherAddress', '$contactNumber')");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The publisher has been added.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add publisher.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This publisher already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $publisher = $connection->escape_string($_POST['publisher']);
        $publisherAddress = $connection->escape_string($_POST['publisherAddress']);
        $contactNumber = $connection->escape_string($_POST['contactNumber']);

        $connection->query("SELECT * FROM publishers WHERE Publisher_Name='$publisher'");

        if($connection->num_rows() == 0) {
            $connection->query("UPDATE publishers SET Publisher_Name='$publisher', Publisher_Address='$publisherAddress', Contact_Number='$contactNumber' WHERE Publisher_ID='$id'");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The publisher has been updated.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This publisher already exists.'));
        }
    } else if($action == 'Delete') {
        $id = $connection->escape_string($_POST['id']);

        $connection->query("DELETE FROM publishers WHERE Publisher_ID='$id'");

        if($connection->affected_rows() == 1) {
            echo json_encode(array('status' => 'Success', 'message' => 'The publisher has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete publisher.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>