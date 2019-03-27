<?php
    date_default_timezone_set('Asia/Manila');
    session_start();

    require_once('connection.php');
    $connection = new Connection();
    $connection->open();

    $username = $connection->escape_string($_POST['username']);
    $password = $connection->escape_string($_POST['password']);

    if($username != '' && $password != '') {
        $password = md5($password);
        $connection->query("SELECT * FROM accounts WHERE Account_ID='$username'"); 

        if($connection->num_rows() == 1) {
            $accountType = $connection->fetch_assoc()['Account_Type'];

            if($accountType == 'College Student' || $accountType == 'Senior High School') {
				$query = "SELECT * FROM borrower WHERE Borrower_ID='$username' AND Borrower_Password='$password'";
				
                $connection->query($query);

                if($connection->num_rows() == 1) {
                    $row = $connection->fetch_assoc();

					
					
                    $_SESSION['account_username'] = $row['Borrower_ID'];
                    $_SESSION['account_first_name'] = $row['Borrower_First_Name'];
                    $_SESSION['account_middle_name'] = $row['Borrower_Middle_Name'];
                    $_SESSION['account_last_name'] = $row['Borrower_Last_Name'];
					
                    $_SESSION['account_image'] = $row['Image'];
                    $_SESSION['account_type'] = $accountType;
					
                    $dateStamp = date('Y-m-d');
                    $timeStamp = date('H:i:s');
					
					$query = "SELECT * FROM attendance WHERE Borrower_ID='$row[Borrower_ID]' AND Date_Entered='$dateStamp'";
                    $connection->query($query);
					
					
                    if($connection->num_rows() == 0) {
						$query = "INSERT INTO attendance (Borrower_ID, Date_Entered, Time_Entered, Borrower_Type) VALUES ('$row[Borrower_ID]', '$dateStamp', '$timeStamp', '$accountType')";
                        
						$connection->query($query);
                    }

					
					
                    echo json_encode(array('status' => 'Success', 'message' => 'Login Successful. Please Wait...', 'redirect' => './opac.php'));
                } else {
                    echo json_encode(array('status' => 'Failed', 'message' => 'Invalid Username and/or Password.'));
                }
            } else {
                $connection->query("SELECT * FROM librarian WHERE Librarian_ID='$username' AND Librarian_Password='$password'");

                if($connection->num_rows() == 1) {
                    $row = $connection->fetch_assoc();
                    
                    $_SESSION['account_username'] = $row['Librarian_ID'];
                    $_SESSION['account_first_name'] = $row['Librarian_First_Name'];
                    $_SESSION['account_middle_name'] = $row['Librarian_Middle_Name'];
                    $_SESSION['account_last_name'] = $row['Librarian_Last_Name'];
                    $_SESSION['account_image'] = $row['Image'];
                    $_SESSION['account_type'] = $accountType;
                    $dateStamp = date('Y-m-d');
                    $timeStamp = date('H:i:s');

                    $connection->query("SELECT * FROM attendance WHERE Borrower_ID='$row[Librarian_ID]' AND Date_Entered='$dateStamp'");

                    if($connection->num_rows() == 0) {
                        $connection->query("INSERT INTO attendance (Borrower_ID, Date_Entered, Time_Entered, Borrower_Type) VALUES ('$row[Librarian_ID]', '$dateStamp', '$timeStamp', '$accountType')");
                    }

                    echo json_encode(array('status' => 'Success', 'message' => 'Login Successful. Please Wait...', 'redirect' => './control_panel'));
                } else {
                    echo json_encode(array('status' => 'Failed', 'message' => 'Invalid Username and/or Password.'));
                }
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Account doesn\'t exist.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Both username and password is required.'));
    }

    $connection->close();
?>
