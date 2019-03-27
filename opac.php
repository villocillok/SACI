<?php
    session_start();

    include_once('assets/system/header.php');
?>

<div class="app-bar fixed-top shadow" data-role="appbar" style="background-color:#493867;>
    <div class="container">
        <a class="app-bar-element branding" href="./"><img class="app-logo" src="assets/image/Southeast Asian College.png">&nbsp;&nbsp;Southeast Asian College Inc.</a>
        <?php
            if(isset($_SESSION['account_username'])) {
                $name = $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];

                echo '<ul class="app-bar-menu place-right" style="background-color:#493867;">';
                echo '<li><a class="app-bar-element dropdown-toggle" style="background-color:#493867;">' . $name . '&nbsp;&nbsp;<img class="app-logo" src="user_images/' . $_SESSION['account_image'] . '"></a>';
                echo '<ul class="d-menu place-right" data-role="dropdown">';
                echo '<li><a href="opac.php"><strong>O</strong>nline <strong>P</strong>ublic <strong>A</strong>ccess <strong>C</strong>atalog</a></li>';


                if($_SESSION['account_type'] == 'Administrator' || $_SESSION['account_type'] == 'Staff' || $_SESSION['account_type'] == 'Librarian' || $_SESSION['account_type'] == 'Assistant Librarian' || $_SESSION['account_type'] == 'Faculty') {
                    echo '<li><a href="./control_panel">Control Panel</a></li>';
                }

                echo '<li><a href="reservations.php">My Reservations</a></li>';
                echo '<li><a href="index.php">Home</a></li>';
                echo '<li class="divider"></li>';
                //echo '<li><a href="">Change Account Picture</a></li>';
                echo '<li><a href="logout.php">Logout</a></li>';
                echo '</ul>';
                echo '</li>';
                echo '</ul>';
            } else {
                echo '<div class="place-right">';
                echo '<a class="app-bar-element" href="login.php"><span class="mif-switch"></span>&nbsp;&nbsp;Login</a>';
                echo '</div>';
            }
        ?>
    </div>
</div>
<div id="main-container" class="container">
    <h1> <strong>O</strong>nline <strong>P</strong>ublic <strong>A</strong>ccess <strong>C</strong>atalog</h1>
    <hr style="background-color:#493867;"><br>
    <!-- sdf -->
     <br>
    <table id="materials-table" class="table striped border bordered">
        <thead class="table-header">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <!-- <th>Category </th> -->
                <th>Location </th>
                <!-- <th>Accession Number</th> -->
                <th>Call Number</th>
                <th>Edition</th>
                <th>Section</th>
                <th>Year Published</th>
                <th>Copies Available</th>
                <!-- <th width="15%"></th> -->
                <!--not sure  -->

                <?php
                    if(isset($_SESSION['account_username'])) {
                        echo '<th></th>';
                    }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once('requests/connection.php');

                $connection = new Connection();
                $connection->open();

                $connection2 = new Connection();
                $connection2->open();

                $connection3 = new Connection();
                $connection3->open();

                $connection4 = new Connection();
                $connection4->open();

                $connection->query("SELECT * FROM works
                    INNER JOIN authors ON works.Author_ID=authors.Author_ID
                    INNER JOIN book ON works.Book_ID=book.Book_ID
                    INNER JOIN publishers ON book.Publisher_ID=publishers.Publisher_ID
                    INNER JOIN categories ON book.Category_ID=categories.Category_ID
                    INNER JOIN section ON book.Section_ID=section.Section_ID
                    WHERE book.Status='active' GROUP BY book.Book_Title");

                while($row = $connection->fetch_assoc()) {
                    $bookID = $row['Book_ID'];

                    $connection2->query("SELECT * FROM barcodes WHERE Book_ID='$bookID' AND Availability='true'");
                    //$quantity = $connection2->num_rows();
                    $quantity = $row['Quantity'];

                    $connection3->query("SELECT * FROM reservations WHERE Book_ID='$bookID' AND Status='active'");
                    $reserveCount = $connection3->num_rows();

                    $connection4->query("SELECT * FROM `return` INNER JOIN barcodes WHERE barcodes.Book_ID='$bookID'");
                    $returnCount = $connection4->num_rows();

                    //di pa okay
                    echo '<tr>';
                    echo '<td>' . $row['Book_Title'] . '</td>';
                    echo '<td>' . $row['Author_First_Name'] . $row['Author_Last_Name'] . '</td>';
                    // echo '<td>' . $row['Accession_Number'].'</td>';
                    echo '<td>' . $row['Category_Name'] . ' Shelf</td>'; 
                    echo '<td>' . $row['Call_Number'] . '</td>';
                    echo '<td>' . $row['Edition'].'</td>';
                    echo '<td>' . $row['Section_Type'].'</td>';
                    // echo '<td>' . date('F d, Y', strtotime($row['Date_Published'])) . '</td>';
                    // echo '<td>' . date('Y', strtotime($row['Year_Published'])) . '</td>';
                    echo '<td>' . $row['Year_Published'] . '</td>';
                    echo '<td>' . ($quantity - $reserveCount) . '</td>';
                    

                    if(isset($_SESSION['account_username'])) {
                        if(($quantity - $reserveCount) != 0) {
                            //echo '<td class="align-center"><a class="button primary mini-button beautify" data-button="reserve-button" data-var-id="' . $bookID . '" data-var-action="Add" data-role="hint" data-hint="Reserve book" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-plus"></span></a></td>';
                            echo '<td class="align-center"><a class="button primary mini-button beautify" data-button="reserve-button" data-var-id="' . $bookID . '" data-var-action="Add" data-role="hint" data-hint="Reserve book" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span>RESERVE</span></a></td>';
                            
                        } else {
                            echo '<td class="align-center"><button class="button danger mini-button beautify" data-role="hint" data-hint="Not Available" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-blocked"></span></button></td>';
                        }
                    }
                    echo '</tr>';
                }

                $connection4->close();
                $connection3->close();
                $connection2->close();
                $connection->close();
            ?>
        </tbody>
    </table>
</div>
<div id="dialog" class="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>
<script src="assets/js/opac.js"></script>

<?php
    include_once('assets/system/footer.php');
?> 
<br>
<!-- <?php
    //date_default_timezone_set('Asia/Manila');
    //print(date('Y-m-d H:iA:s'));
    //print(date('Y-m-d h:iA'));
?> -->
