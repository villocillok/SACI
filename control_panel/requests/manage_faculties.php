<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $librarianID = $connection->escape_string($_POST['librarianID']);
        $librarianPassword = md5($connection->escape_string($_POST['librarianPassword']));
        $librarianFirstName = $connection->escape_string($_POST['librarianFirstName']);
        $librarianMiddleName = $connection->escape_string($_POST['librarianMiddleName']);
        $librarianLastName = $connection->escape_string($_POST['librarianLastName']);
        $librarianType = $connection->escape_string($_POST['librarianType']);
        $onHand="0";
        $image="sacinean.png";

        $connection->query("SELECT * FROM librarian WHERE Librarian_ID='$librarianID'");

        if($connection->num_rows() == 0) {
            $connection->query("SELECT * FROM librarian WHERE Librarian_First_Name='$librarianFirstName' AND Librarian_Last_Name='$librarianLastName'");

            if($connection->num_rows() == 0) {
                $connection->query("INSERT INTO librarian (Librarian_ID, Librarian_Password, Librarian_First_Name, Librarian_Middle_Name, Librarian_Last_Name, Librarian_Type, Image) VALUES ('$librarianID', '$librarianPassword', '$librarianFirstName', '$librarianMiddleName', '$librarianLastName', '$librarianType', '$image')");

                if($connection->affected_rows() == 1) {
                    $connection->query("INSERT INTO accounts (Account_ID, Account_Type, On_Hand) VALUES ('$librarianID', '$librarianType', '$onHand')");

                    echo json_encode(array('status' => 'Success', 'message' => 'The librarian has been added.'));
                } else {
                    echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add librarian. ' . $connection->check_error()));
                }
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'This librarian already exists.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This librarian id already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $librarianID = $connection->escape_string($_POST['librarianID']);
        $librarianFirstName = $connection->escape_string($_POST['librarianFirstName']);
        $librarianMiddleName = $connection->escape_string($_POST['librarianMiddleName']);
        $librarianLastName = $connection->escape_string($_POST['librarianLastName']);
        $librarianType = $connection->escape_string($_POST['librarianType']);

        $connection->query("SELECT * FROM librarian WHERE Librarian_ID='$id'");

        if($connection->num_rows() == 1) {
            $ctr = 0;

            $connection->query("UPDATE librarian SET Librarian_ID='$librarianID', Librarian_First_Name='$librarianFirstName', Librarian_Middle_Name='$librarianMiddleName', Librarian_Last_Name='$librarianLastName', Librarian_Type='$librarianType' WHERE Librarian_ID='$id'");

            if($connection->affected_rows() == 1) {
                $ctr++;
            }

            $connection->query("UPDATE accounts SET Account_ID='$librarianID', Account_Type='$librarianType' WHERE Account_ID='$id'");

            if($connection->affected_rows() == 1) {
                $ctr++;
            }

            if($ctr > 0) {
                echo json_encode(array('status' => 'Success', 'message' => 'The librarian has been updated.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'librarian not found.'));
        }
    } else if($action == 'Delete') {
        $ctr = 0;
        $id = $connection->escape_string($_POST['id']);

        $connection->query("DELETE FROM librarian WHERE Librarian_ID='$id'");

        if($connection->affected_rows() == 1) {
            $ctr++;
        }

        $connection->query("DELETE FROM accounts WHERE Account_ID='$id'");

        if($connection->affected_rows() == 1) {
            $ctr++;
        }

        if($ctr == 2) {
            echo json_encode(array('status' => 'Success', 'message' => 'The librarian has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete librarian.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>