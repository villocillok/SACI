<?php
    session_start();

    if(!isset($_SESSION['account_username'])) {
        header('Location: ./');
    }

    include_once('assets/system/header.php');
?>

<div class="app-bar fixed-top shadow" data-role="appbar" style="background-color:#493867;">
    <div class="container">
        <a class="app-bar-element branding" href="./opac.php"><img class="app-logo" src="assets/image/Southeast Asian College.png">&nbsp;&nbsp;Southeast Asian College Inc.</a>
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
    <h1>My Reservations</h1>
    <hr style="background-color:#493867;"><br>
    <table id="reservations-table" class="table striped border bordered">
        <thead class="table-header">
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Barcode Number</th>
                <th>Accession Number</th>
                <th>Call Number</th>
                <th>Edition</th>
                <th>Section</th>
                <th>Year Published</th>
                <th>Date Reserved</th>
                <th>Category </th><!--not sure  -->
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
                require_once('requests/connection.php');

                $username = (int) $_SESSION['account_username'];

                $connection = new Connection();
                $connection->open();

                $connection->query("SELECT * FROM reservations 
                    INNER JOIN book ON reservations.Book_ID=book.Book_ID 
                    INNER JOIN categories ON book.Category_ID=categories.Category_ID 
                    INNER JOIN section ON book.Section_ID=section.Section_ID 
                    INNER JOIN works ON book.Book_ID=works.Book_ID 
                    INNER JOIN authors ON works.Author_ID=authors.Author_ID 
                    INNER JOIN barcodes ON book.Book_ID=barcodes.Book_ID
                    WHERE reservations.Borrowers_ID='$username' AND reservations.Status='active'
                    GROUP BY book.Book_ID");

                while($row = $connection->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['Book_Title'] . '</td>';
                    echo '<td>' . $row['Author_First_Name'] . $row['Author_Last_Name'] . '</td>';
                    echo '<td>' . $row['Barcode_Number'] . '</td>';
                    echo '<td>' . $row['Accession_Number'].'</td>';
                    echo '<td>' . $row['Call_Number'] . '</td>';
                    echo '<td>' . $row['Edition'].'</td>';
                    echo '<td>' . $row['Section_Type'].'</td>';//di pa natatawag sa query
                    // echo '<td>' . date('F d, Y', strtotime($row['Date_Published'])) . '</td>';
                    //echo '<td>' . date('Y', strtotime($row['Year_Published'])) . '</td>';
                    echo '<td>' . $row['Year_Published'] . '</td>';
                    echo '<td>' . date('F d, Y', strtotime($row['Date_Reserved'])) . '</td>';
                    echo '<td>' . $row['Category_Name'].'</td>';
                    echo '<td class="align-center"><a class="button primary mini-button beautify" data-button="delete-reserve-button" data-var-id="' . $row['Reservation_ID'] . '" data-var-action="Delete" data-role="hint" data-hint="Cancel Reservation" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-cross"></span></a></td>';
                    echo '</tr>';
                }

                $connection->close();
            ?>
        </tbody>
    </table>
</div>
<div id="dialog" class="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>
<script src="assets/js/opac.js"></script>

<!-- <?php
   // include_once('assets/system/footer.php');
?> -->
<br>

<?php
    date_default_timezone_set('Asia/Manila');
    // print(date('Y-m-d H:iA:s'));
    print(date('Y-m-d h:iA'));
?>
