<?php
    session_start();

    if(!isset($_SESSION['account_username'])) {
        header('Location: ./../');
    }

    include_once('assets/system/header.php');
?>

<div class="app-bar fixed-top shadow" data-role="appbar" style="background-color:#493867;">
    <a class="app-bar-element branding" href="./"><img class="app-logo" src="assets/image/Southeast Asian College.png">&nbsp;&nbsp;Southeast Asian College Inc.</a>
    <?php
        if(isset($_SESSION['account_username'])) {
            $name = $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];

            echo '<ul class="app-bar-menu place-right" style="background-color:#493867;">';
            echo '<li><a class="app-bar-element dropdown-toggle" style="background-color:#493867;">' . $name . '&nbsp;&nbsp;<img class="app-logo" src="./../user_images/' . $_SESSION['account_image'] . '"></a>';
            echo '<ul class="d-menu place-right" data-role="dropdown">';
            echo '<li><a href="./../opac.php"><strong>O</strong>nline <strong>P</strong>ublic <strong>A</strong>ccess <strong>C</strong>atalog</a></li>';
            echo '<li><a href="./../reservations.php">My Reservations</a></li>';
            echo '<li><a href="./../index.php">Home</li>';
            echo '<li><a href="index.php">Dashboard</li>'; 
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
<div id="main-block">
    <div class="flex-grid" style="height: 100%;">
        <div class="row" style="height: 100%;">
            <div id="cell-sidebar" class="cell bg-lightDark size-x300" style="overflow-y: scroll; height: 100%;">
                <ul class="sidebar2 dark">
                    <li><a href="./"><span class="mif-meter mif-ani-shuttle icon"></span><span class="title">Dashboard</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./reserved_materials.php"><span class="mif-history icon"></span><span class="title">Reserve Books</span></a></li>
                    <li><a href="./loan_materials.php"><span class="mif-exit icon"></span><span class="title">Borrowing</span></a></li>
                    <li><a href="./receive_materials.php"><span class="mif-enter icon"></span><span class="title">Returning</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li class="active"><a href="./manage_materials.php"><span class="mif-books icon"></span><span class="title">Books</span></a></li>
                    <li><a href="./manage_authors.php"><span class="mif-users icon"></span><span class="title">Manage Authors</span></a></li>
                    <li><a href="./manage_publishers.php"><span class="mif-printer icon"></span><span class="title">Manage Publishers</span></a></li>
                    <li><a href="./manage_categories.php"><span class="mif-list2 icon"></span><span class="title">Manage Categories</span></a></li>
                    <li><a href="./manage_department.php"><span class="mif-list2 icon"></span><span class="title">Manage Department</span></a></li>
                    <li><a href="./manage_section.php"><span class="mif-list2 icon"></span><span class="title">Manage Section</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./manage_faculties.php"><span class="mif-users icon"></span><span class="title">Librarian Information</span></a></li>
                    <li><a href="./manage_students.php"><span class="mif-users icon"></span><span class="title">Borrower Information</span></a></li>
                    <li><a href="./manage_weeding.php"><span class="mif-books icon"></span><span class="title">Book Weeding</span></a></li>
                    <li><a href="./manage_holidays.php"><span class="mif-calendar icon"></span><span class="title">Manage Holidays</span></a></li>
                    <li><a href="./settled_penalties.php"><span class="mif-dollars icon"></span><span class="title">Penalty Settlement</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./view_logs.php"><span class="mif-clipboard icon"></span><span class="title">View Logs</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./generate_reports.php"><span class="mif-printer icon"></span><span class="title">Reports</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./settings.php"><span class="mif-cogs icon"></span><span class="title">Settings</span></a></li>
                </ul>
            </div>
            <div id="cell-content" class="cell auto-size padding30 pane-scroll">
                <h1 class="text-light">Manage Books</h1>
                <hr style="background-color:#493867;"><br>
                <div class="align-right">
                    <a class="button primary beautify beautify-mif" data-button="add-material-button" data-role="hint" data-hint="Add Book" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-plus"></span>&nbsp;&nbsp;Add</a>
                </div>
                <table id="materials-table" class="table striped border bordered">
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <!-- <th>Accession Number</th>
                            <th>Barcode Number</th> -->
                            <th>Book Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Section</th>
                            
                            <th>Call Number</th>
                            <th>Edition</th>
                            <th>Year Published</th>
                            <th>Quantity</th>
                            
                            <th>Unit of price</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once('requests/connection.php');

                            $connection = new Connection();
                            $connection->open();

                            $connection2 = new Connection();
                            $connection2->open();

                            // $connection->query("SELECT * FROM works INNER JOIN authors ON works.Author_ID=authors.Author_ID INNER JOIN book ON works.Book_ID=book.Book_ID INNER JOIN barcodes ON book.Book_ID=barcodes.Book_ID INNER JOIN publishers ON book.Publisher_ID=publishers.Publisher_ID INNER JOIN section ON book.Section_ID=section.Section_ID WHERE book.Status='active' GROUP BY book.Book_Title");
                             $connection->query("SELECT * FROM works INNER JOIN authors ON works.Author_ID=authors.Author_ID INNER JOIN book ON works.Book_ID=book.Book_ID INNER JOIN publishers ON book.Publisher_ID=publishers.Publisher_ID INNER JOIN section ON book.Section_ID=section.Section_ID WHERE book.Status='active' GROUP BY book.Book_ID");



                            while($row = $connection->fetch_assoc()) {
                                $bookID = $row['Book_ID'];
                                $isFirst = true;

                                echo '<tr>';
                                echo '<td class="align-center">' . $row['Book_ID'] . '</td>';
                                
                               // echo '<td>' . $row['Accession_Number'] . '</td>';
                              //  echo '<td>' . $row['Barcode_Number'] . '</td>';
                                echo '<td>' . $row['Book_Title'] . '</td>';
                                echo '<td>';

                                $connection2->query("SELECT * FROM works INNER JOIN authors ON works.Author_ID=authors.Author_ID WHERE works.Book_ID='$bookID'");

                                while($row2 = $connection2->fetch_assoc()) {
                                    if($isFirst) {
                                        $isFirst = false;
                                    } else {
                                        echo '<br>';
                                    }

                                    echo $row2['Author_First_Name'] . ' ' . $row2['Author_Last_Name'];
                                }

                                echo '</td>';
                                echo '<td>' . $row['Publisher_Name'] . '</td>';
                                echo '<td>' . $row['Section_Type'] . '</td>'; 
                                
                                echo '<td>' . $row['Call_Number'] . '</td>';
                                echo '<td>' . $row['Edition'] . '</td>';
                                echo '<td>' . $row['Year_Published'] . '</td>';
                                echo '<td>' . $row['Quantity'] . '</td>';
                                echo '<td>' . $row['Unit_Of_Price'] . '</td>';
                                echo '<td>' . $row['Status'] . '</td>';


                                echo '<td class="align-center"><a class="button success mini-button beautify" data-button="edit-material-button" data-var-id="' . $row['Book_ID'] . '" data-role="hint" data-hint="Edit Book" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-pencil"></span></a><a class="button danger mini-button beautify" data-button="delete-material-button" data-var-id="' . $row['Book_ID'] . '" data-role="hint" data-hint="Delete Book" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-cross"></span></a></td>';
                                echo '</tr>';
                            }

                            $connection2->close();
                            $connection->close();
                        ?>
                    </tbody>
                </table>
                <?php
    include_once('assets/system/footer.php');
?>
            </div>

        </div>
    </div>
</div>
<div id="dialog" class="dialog" data-overlay-click-close="true" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>
<script src="assets/js/manage_materials.js"></script>

