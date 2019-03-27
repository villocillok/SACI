<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $category = $connection->escape_string($_POST['category']);

        $connection->query("SELECT * FROM categories WHERE Category_Name='$category'");

        if($connection->num_rows() == 0) {
            $connection->query("INSERT INTO categories (Category_Name) VALUES ('$category')");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The category has been added.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add category.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This category already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $category = $connection->escape_string($_POST['category']);

        $connection->query("SELECT * FROM categories WHERE Category_Name='$category'");

        if($connection->num_rows() == 0) {
            $connection->query("UPDATE categories SET Category_Name='$category' WHERE Category_ID='$id'");

            if($connection->affected_rows() == 1) {
                echo json_encode(array('status' => 'Success', 'message' => 'The category has been updated.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This category already exists.'));
        }
    } else if($action == 'Delete') {
        $id = $connection->escape_string($_POST['id']);

        $connection->query("DELETE FROM categories WHERE Category_ID='$id'");

        if($connection->affected_rows() == 1) {
            echo json_encode(array('status' => 'Success', 'message' => 'The category has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete category.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>