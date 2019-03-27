<?php
    date_default_timezone_set('Asia/Manila');
	
    function generateBarcode($bookID, $quantity) {
        global $connection;

        $i = 0;
        $avail=true;
        $rand = mt_rand(0, 9) . ' ' . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . ' ' . mt_rand(0, 9) . mt_rand(0, 9) . mt_rand(0, 9) . ' ' . mt_rand(0, 9);

        while($i <= $quantity) {
            $connection->query("SELECT * FROM barcodes WHERE Book_ID='$bookID' ORDER BY Accession_Number DESC");

            if($connection->num_rows() > 0) {
                $row = $connection->fetch_assoc();
                $i = $row['Accession_Number'] + 1;
            } else {
                $i = 1;
            }

            $connection->query("SELECT * FROM barcodes WHERE Barcode_Number='$rand'");

            if($connection->num_rows() == 1) {
                generateBarcode($bookID, $quantity - $i);
            } else {
                $connection->query("INSERT INTO barcodes (Book_ID, Barcode_Number, Accession_Number, Availability) VALUES ('$bookID', '$rand', '$i', '$avail')");

                $i++;
            }
        }
    }

    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $action = $connection->escape_string($_POST['action']);

    if($action == 'Add') {
        $authors = $_POST['authors']; //naka array ito
        $publisher = $connection->escape_string($_POST['publisher']);
        $section = $_POST['section'];
        $bookTitle = $connection->escape_string($_POST['bookTitle']);
        $callNumber = $connection->escape_string($_POST['callNumber']);
        $edition = $connection->escape_string($_POST['edition']);
        // $yearPublished = $connection->escape_string($_POST['yearPublished']);
        $quantity = $connection->escape_string($_POST['quantity']);
        $unitOfPrice = $connection->escape_string($_POST['unitOfPrice']);
        // $datePublishedMonth = $connection->escape_string($_POST['datePublishedMonth']);
        // $datePublishedDay = $connection->escape_string($_POST['datePublishedDay']);
        // $datePublishedYear = $connection->escape_string($_POST['datePublishedYear']);
        $category = $connection->escape_string($_POST['category']);
        // $datePublished = $datePublishedYear . '-' . $datePublishedMonth . '-' . $datePublishedDay;
        $yearPublished = $connection->escape_string($_POST['yearPublished']);
        //$datetime = date('Y-m-d');
        $year = date('Y');
        $datetime = date('Y-m-d');
        //$image="sacinean.png";
        $status="active";

        $connection->query("SELECT * FROM book WHERE Book_Title='$bookTitle'");

        if($connection->num_rows() == 0) {
            // $connection->query("INSERT INTO book (Author_ID, Publisher_ID, Section_ID, Book_Title, Call_Number, Edition, Year_Published, Quantity, Unit_Of_Price, Category_ID) VALUES ('$authors', '$publisher', '$section', '$bookTitle', '$callNumber', '$edition', '$yearPublished', '$quantity', '$unitOfPrice', '$category')");
            $connection->query("INSERT INTO book (Publisher_ID, Section_ID, Book_Title, Call_Number, Edition, Year_Published, Quantity, Unit_Of_Price, Status, Category_ID, Date_Added) VALUES ('$publisher', '$section', '$bookTitle', '$callNumber', '$edition', '$yearPublished', '$quantity', '$unitOfPrice', '$status', '$category', '$datetime')");

            if($connection->affected_rows() == 1) {
                $connection->query("SELECT * FROM book WHERE Book_Title='$bookTitle'");
                $bookID = $connection->fetch_assoc()['Book_ID'];

                foreach($authors as $authorID) {
                    $authorID = $connection->escape_string($authorID);

                    $connection->query("INSERT INTO works (Book_ID, Author_ID) VALUES ('$bookID', '$authorID')");
                }

                generateBarcode($bookID, $quantity);

                echo json_encode(array('status' =>  'Success', 'message' => 'The book has been added.'));
            } else {
                echo json_encode(array('status' => 'Failed', 'message' => 'Failed to add book.'));
            }
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'This book already exists.'));
        }
    } else if($action == 'Edit') {
        $id = $connection->escape_string($_POST['id']);
        $authors = $_POST['authors'];
        $publisher = $connection->escape_string($_POST['publisher']);
        $section = $_POST['section'];
        $bookTitle = $connection->escape_string($_POST['bookTitle']);
        $callNumber = $connection->escape_string($_POST['callNumber']);
        $edition = $connection->escape_string($_POST['edition']);
        // $yearPublished = $connection->escape_string($_POST['yearPublished']);
        $quantity = $connection->escape_string($_POST['quantity']);
        $unitOfPrice = $connection->escape_string($_POST['unitOfPrice']);
        // $datePublishedMonth = $connection->escape_string($_POST['datePublishedMonth']);
        // $datePublishedDay = $connection->escape_string($_POST['datePublishedDay']);
		
        $datePublishedYear = $connection->escape_string($_POST['yearPublished']);
        $category = $connection->escape_string($_POST['category']);
        // $datePublished = $datePublishedYear . '-' . $datePublishedMonth . '-' . $datePublishedDay;
        $yearPublished = $datePublishedYear;
        //$datetime = date('Y-m-d');
        $year = date('Y');
        $ctr = 0;
        $datetime = date('Y-m-d');	
        
        
        //$connection->query("UPDATE book SET Publisher_ID='$publisher', Section_ID='$section', Book_Title='$bookTitle', Call_Number='$callNumber', Edition='$edition', Year_Published='$yearPublished', Unit_Of_Price='$unitOfPrice', Category_ID='$category', Date_Added='$datetime' WHERE Book_ID='$id' GROUP BY book.Book_Title");
        
		$query = "UPDATE book SET Publisher_ID='$publisher', Section_ID='$section', Book_Title='$bookTitle', Call_Number='$callNumber', Edition='$edition', Year_Published='$yearPublished', Unit_Of_Price='$unitOfPrice', Category_ID='$category', Date_Added='$datetime' WHERE Book_ID='$id'";
	#	echo json_encode(array('status' => 'Failed', 'message' => $query));
	#	exit(0);
	   $connection->query($query);
        
         

        if($connection->affected_rows() == 1) {
            $ctr++;
        }

        $connection->query("DELETE FROM works WHERE Book_ID='$id'");

        foreach($authors as $authorID) {
            $authorID = $connection->escape_string($authorID);

            $connection->query("INSERT INTO works (Book_ID, Author_ID) VALUES ($id, $authorID)");

            if($connection->affected_rows() == 1) {
                $ctr++;
            }
        }

        if($ctr > 0) {
            echo json_encode(array('status' =>  'Success', 'message' => 'The book has been updated.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'No changes has been made.'));
        }
    } else if($action == 'Delete') {
        $id = $connection->escape_string($_POST['id']);
        $datetime = date('Y-m-d');

        $connection->query("UPDATE book SET Status='inactive' WHERE Book_ID='$id'");

        if($connection->affected_rows() == 1) {
            $connection->query("INSERT INTO weeding (Book_ID, Reason, Date_Weeded) VALUES ('$id', '', '$datetime')");

            echo json_encode(array('status' => 'Success', 'message' => 'The book has been deleted.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to delete book.'));
        }
    } else if($action == 'Restore') {
        $id = $connection->escape_string($_POST['id']);

        $connection->query("UPDATE book SET Status='active' WHERE Book_ID='$id'");

        if($connection->affected_rows() == 1) {
            $connection->query("DELETE FROM weeding WHERE Book_ID='$id'");

            echo json_encode(array('status' => 'Success', 'message' => 'The book has been restored.'));
        } else {
            echo json_encode(array('status' => 'Failed', 'message' => 'Failed to restore book.'));
        }
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }

    $connection->close();
?>