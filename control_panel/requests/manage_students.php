<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $borrowerID = $connection->escape_string($_POST['borrowerID']);
        $borrowerPassword = md5($connection->escape_string($_POST['borrowerPassword']));
        $borrowerFirstName = $connection->escape_string($_POST['borrowerFirstName']);
        $borrowerMiddleName = $connection->escape_string($_POST['borrowerMiddleName']);
        $borrowerLastName = $connection->escape_string($_POST['borrowerLastName']);
        $contactNumber = $connection->escape_string($_POST['contactNumber']);
        $gender = $connection->escape_string($_POST['gender']);
        $borrowerType = $connection->escape_string($_POST['borrowerType']);
        $course = $connection->escape_string($_POST['course']);
        $onHand="0";
        $department = $connection->escape_string($_POST['department']);
        $image="sacinean.png";
        $status="Active";

        $connection->query("SELECT * FROM borrower WHERE Borrower_ID='$borrowerID'");
                
        if($connection->num_rows() == 0) {
            $connection->query("SELECT * FROM borrower WHERE Borrower_First_Name='$borrowerFirstName' AND Borrower_Last_Name='$borrowerLastName'");

            if($connection->num_rows() == 0) {
                $connection->query("INSERT INTO borrower (Borrower_ID, Borrower_Password, Borrower_First_Name, Borrower_Middle_Name, Borrower_Last_Name, Contact_Number, Gender, Borrower_Type, Status, Department_ID, Course, Image) VALUES ('$borrowerID', '$borrowerPassword', '$borrowerFirstName', '$borrowerMiddleName', '$borrowerLastName', '$contactNumber', '$gender', '$borrowerType', '$status', '$department', '$course', '$image')");

                if($connection->affected_rows() == 1) {
                    $connection->query("INSERT INTO accounts (Account_ID, Account_Type, On_Hand) VALUES ('$borrowerID', '$borrowerType' ,'$onHand')");

                    echo json_encode(array('status' => 'Success', 'message' => 'The borrower has been added.'));
                } else {
                    echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add borrower. ' . $connection->check_error()));
                }
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'This borrower already exists.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This borrower id already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $borrowerID = $connection->escape_string($_POST['borrowerID']);
        #BUG 2c
        #$borrowerPassword = md5($connection->escape_string($_POST['borrowerPassword']));-->also caused error
        #$borrowerFirstName = $connection->escape_string($_POST['studentFirstName']); -->caused error
        #"Fixed" code:
        $borrowerFirstName = $connection->escape_string($_POST['borrowerFirstName']);
        
        $borrowerMiddleName = $connection->escape_string($_POST['borrowerMiddleName']);
        $borrowerLastName = $connection->escape_string($_POST['borrowerLastName']);
        $contactNumber = $connection->escape_string($_POST['contactNumber']);
        $gender = $connection->escape_string($_POST['gender']);
        $borrowerType = $connection->escape_string($_POST['borrowerType']);
        $course = $connection->escape_string($_POST['course']);
        $department = $connection->escape_string($_POST['department']);

        $connection->query("SELECT * FROM borrower WHERE Borrower_ID='$id'");

        if($connection->num_rows() == 1) {
            $ctr = 0;
            $loc_query = "UPDATE borrower SET Borrower_ID='$borrowerID', Borrower_First_Name='$borrowerFirstName', Borrower_Middle_Name='$borrowerMiddleName', Borrower_Last_Name='$borrowerLastName', Contact_Number='$contactNumber', Gender='$gender', Borrower_Type='$borrowerType', Department_ID='$department', Course='$course' WHERE Borrower_ID='$id'";
            #BUG 2c
            #$connection->query("UPDATE borrower SET Borrower_ID='$borrowerID', Borrower_First_Name='$borrowerFirstName', Borrower_Middle_Name='$borrowerMiddleName', Borrower_Last_Name='$borrowerLastName', Contact_Number='$contactNumber', Gender='$gender', Borrower_Type='$borrowerType', Department='$department', Course='$course' WHERE Borrower_ID='$id'");
            $connection->query($loc_query);
            if($connection->affected_rows() == 1) {
                $ctr++;
            }

            $connection->query("UPDATE accounts SET Account_ID='$borrowerID', Account_Type='$borrowerType' WHERE Account_ID='$id'");

            if($connection->affected_rows() == 1) {
                $ctr++;
            }

            if($ctr > 0) {
                echo json_encode(array('status' => 'Success', 'message' => 'The borrower has been updated.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Borrower not found.'));
        }
    } else if($action == 'Delete') {
        $ctr = 0;
        $id = $connection->escape_string($_POST['id']);

        $connection->query("DELETE FROM borrower WHERE Borrower_ID='$id'");

        if($connection->affected_rows() == 1) {
            $ctr++;
        }

        $connection->query("DELETE FROM accounts WHERE Account_ID='$id'");

        if($connection->affected_rows() == 1) {
            $ctr++;
        }

        if($ctr == 2) {
            echo json_encode(array('status' => 'Success', 'message' => 'The borrower has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete borrower.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>
