<?php
    date_default_timezone_set('Asia/Manila');
    session_start();

    require_once('connection.php');

    $connection = new Connection();
    $connection->open();

    $connection2 = new Connection();
    $connection2->open();

    $connection3 = new Connection();
    $connection3->open();

    $connection4 = new Connection();
    $connection4->open();

    $id = $connection->escape_string($_POST['id']);
	
    //$connection->query("SELECT * FROM reservations INNER JOIN book ON reservations.Book_ID=book.Book_ID WHERE reservations.Borrowers_ID='$id' AND reservations.Status='active' AND book.Status='active'");

    $connection2->query("SELECT * FROM authors INNER JOIN book ON authors.Book_ID = book.Book_ID ");
    $connection3->query("SELECT * FROM publishers INNER JOIN book ON publishers.Book_ID = book.Book_ID");
    $connection4->query("SELECT * FROM section INNER JOIN book ON section.Book_ID = book.Book_ID");
    
    $connection->query("SELECT * FROM reservations 
                    INNER JOIN book ON reservations.Book_ID=book.Book_ID 
                    INNER JOIN categories ON book.Category_ID=categories.Category_ID 
                    INNER JOIN section ON book.Section_ID=section.Section_ID 
                    INNER JOIN works ON book.Book_ID=works.Book_ID 
                    INNER JOIN authors ON works.Author_ID=authors.Author_ID 
                    INNER JOIN barcodes ON book.Book_ID=barcodes.Book_ID
                    INNER JOIN publishers ON publishers.Publisher_ID=book.Publisher_ID
                    WHERE reservations.Borrowers_ID='$id' AND reservations.Status='active'
                    GROUP BY book.Book_ID");


    while($row = $connection->fetch_assoc()) {
         $authorName = $row['Author_Last_Name'] . ', ' . $row['Author_First_Name'];
         $publisher = $row['Publisher_Name'];
         $section = $row['Section_Type'];
        echo '<tr>';
        echo '<td>' . $row['Accession_Number'] . '</td>';
        echo '<td>' . $row['Barcode_Number'] . '</td>';
        echo '<td>' . $row['Book_Title'] . '</td>';
        echo '<td>' . $authorName . '</td>';
        echo '<td>' . $publisher . '</td>';
        echo '<td>' . $section . '</td>';
        echo '<td>' . $row['Call_Number'] . '</td>';
        echo '<td>' . $row['Edition'] . '</td>';
        echo '<td>' . $row['Year_Published'] . '</td>';
        echo '<td>' . date('F d, Y', strtotime($row['Date_Reserved'])) . '</td>';

        if(isset($_SESSION['account_username'])) {
            echo '<td class="align-center">';
            echo '<label class="input-control checkbox small-check">';
            echo '<input data-input="loan-checkbox" data-var-id="' . $row['Book_ID'] . '" type="checkbox">';
            echo '<span class="check"></span><span class="caption"></span>';
            echo '</label>';
            echo '</td>';
        }

        echo '</tr>';
    }

	
	
    $connection->close();
?>