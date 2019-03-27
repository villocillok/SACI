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
                    <li class="active"><a href="./loan_materials.php"><span class="mif-exit icon"></span><span class="title">Borrowing</span></a></li>
                    <li><a href="./receive_materials.php"><span class="mif-enter icon"></span><span class="title">Returning</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./manage_materials.php"><span class="mif-books icon"></span><span class="title">Books</span></a></li>
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
            <div id="cell-content" class="pane-scroll cell auto-size padding20">
                <h1 class="text-light">Borrow Books / Walk-in</h1>
                <hr style="background-color:#493867;"><br>
                <div class="grid">
                    <div class="row cells12">
                        <div class="cell colspan10 offset1">
                            <h3 class="text-light">Select borrower</h3>
                            <hr style="background-color:#493867;"><br>
                            <div class="input-control select full-size" data-role="select">
                                <select name="borrower" data-input="borrower">
                                    <option value="" selected disabled>Please type here the name of the borrower...</option>
                                    <?php
                                        require_once('requests/connection.php');

                                        $connection = new Connection();
                                        $connection->open();

                                        $connection->query("SELECT * FROM accounts LEFT JOIN librarian ON accounts.Account_ID=librarian.Librarian_ID LEFT JOIN borrower ON accounts.Account_ID=borrower.Borrower_ID");

                                        while($row = $connection->fetch_assoc()) {
                                            if($row['Account_Type'] == 'College Student' || $row['Account_Type'] == 'Senior High School Student') {
                                                $type = 'Borrower';
                                            } else {
                                                $type = 'Librarian';
                                            }

                                            if(strlen($row[$type . '_Middle_Name']) > 1) {
                                                $name = $row[$type . '_First_Name'] . ' ' . substr($row[$type . '_Middle_Name'], 0, 1) . '. ' . $row[$type . '_Last_Name'];
                                            } else {
                                                $name = $row[$type . '_First_Name'] . ' ' . $row[$type . '_Last_Name'];
                                            }

                                            echo '<option value="' . $row['Account_ID'] . '">' . $name . '</option>';
                                        }

                                        $connection->close();
                                    ?>
                                </select>
                            </div>
                            <h3 class="text-light">Select book(s) to borrow</h3>
                            <hr style="background-color:#493867;"><br>
                            <table id="materials-table" class="table striped border bordered"> <!--pane-scroll-->
                                <thead>
                                    <tr>
<!--                                         <th>Accession Number</th>
                                        <th>Barcode Number</th> -->
                                        <th>Book ID</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>Section</th>
                                        <th>Call Number</th>
                                        <th>Edition</th>
                                        <th>Year Published</th>
                                        <!-- <th>Date Published</th> -->
                                        <th>Copies Available</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $connection = new Connection();
                                        $connection->open();

                                        $connection2 = new Connection();
                                        $connection2->open();

                                        // $connection3 = new Connection();
                                        // $connection3->open();

                                        // $connection4 = new Connection();
                                        // $connection4->open();

                                        //$connection5 = new Connection();
                                        //$connection5->open();

                                        $connection->query("SELECT * FROM works 
										INNER JOIN authors ON works.Author_ID=authors.Author_ID 
										INNER JOIN book ON works.Book_ID=book.Book_ID 
										INNER JOIN publishers ON book.Publisher_ID=publishers.Publisher_ID 
										INNER JOIN categories ON book.Category_ID=categories.Category_ID 
										INNER JOIN section ON book.Section_ID=section.Section_ID 
										WHERE book.Status='active' GROUP BY book.Book_Title");
                                        //$connection3->query("SELECT * FROM borrower");

                                        while($row = $connection->fetch_assoc()) {
                                            $connection2->query("SELECT * FROM barcodes WHERE Book_ID='$row[Book_ID]' AND (Availability='true' OR Availability = '1') ");
                                            //$quantity = $connection2->num_rows();
                                            $quantity = $row['Quantity'];

                                            $connection2->query("SELECT * FROM reservations WHERE Book_ID='$row[Book_ID]' AND Status='active'");
                                            $reserveCount = $connection2->num_rows();

                                           // $connection3->query("SELECT * FROM book INNER JOIN publishers ON book.Publisher_ID=publishers.Publisher_ID INNER JOIN section ON book.Section_ID=section.Section_ID");
                                            // $connection4->query("SELECT * FROM publishers INNER JOIN book ON publishers.Book_ID = book.Book_ID");
                                            //$connection5->query("SELECT * FROM section INNER JOIN book ON section.Book_ID = book.Book_ID");
                                            $name = $row['Author_Last_Name'] . ', ' . $row['Author_First_Name'];

                                            echo '<tr>';
                                            //echo '<td>' . $row['Accession_Number'] . '</td>';
                                            //echo '<td>' . $row['Barcode_Number'] . '</td>';
                                            echo '<td>' . $row['Book_ID'] . '</td>';
                                            echo '<td>' . $row['Book_Title'] . '</td>';
                                            echo '<td>' . $name . '</td>';
                                            echo '<td>' . $row['Publisher_Name'] . '</td>';
                                            echo '<td>' . $row['Section_Type'] . '</td>';
                                            echo '<td>' . $row['Call_Number'] . '</td>';
                                            echo '<td>' . $row['Edition'] . '</td>';
                                            // echo '<td>' . date('F d, Y', strtotime($row['Date_Published'])) . '</td>';
                                            echo '<td>' . $row['Year_Published'] . '</td>';
                                            echo '<td>' . ($quantity - $reserveCount) . '</td>';

                                            if(isset($_SESSION['account_username'])) {
                                                // echo '<td class="align-center"><a class="button primary mini-button beautify" data-button="add-basket-button" data-var-id="' . $row['Material_ID'] . '" data-var-action="Add" data-role="hint" data-hint="Add to Basket" data-hint-background="#dc4fad" data-hint-color="#ffffff" data-hint-mode="2" data-hint-position="top"><span class="mif mif-plus"></span></a></td>';
                                                if($quantity - $reserveCount > 0) {
                                                    echo '<td class="align-center">';
                                                    echo '<label class="input-control checkbox small-check">';
                                                    echo '<input data-input="loan-checkbox" data-var-id="' . $row['Book_ID'] . '" type="checkbox">';
                                                    echo '<span class="check"></span><span class="caption"></span>';
                                                    echo '</label>';
                                                    echo '</td>';
                                                } else {
                                                    echo '<td class="align-center"></td>';
                                                }
                                            }

                                            echo '</tr>';
                                        }

                                        $connection->close();
                                        $connection2->close();
                                        
                                    ?>
                                </tbody>
                            </table>
                            <br><br><br>
                            <div class="align-right">
                                <input type="textbox" name="barcode" autofocus>
                                <button class="button primary" data-button="borrow-button">Proceed</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="cell-content" class="cell auto-size padding20 "> <!--pane-scroll-->
                <h1 class="text-light">Borrower's Detail</h1>
                <hr style="background-color:#493867;"><br>
                    <div class="grid condensed" >
                        <div class="row cells" >
                            <div class="cell colspan4 padding10" >
                                <div class="heading">
                                    <span class="title" ></span>
                                    <!-- <table id="borrower-info-table"> -->
                                <!-- <table> 
                                <thead>
                                    <tr> -->
                                       
                                        <th>Borrower: </th><br>
                                        <th>Name: </th><br>
                                        <th>Contact Number: </th><br>
                                        <th>Gender: </th><br>
                                        <th>Borrower Type</th><br>
                                        <th>Course: </th><br>
                                         <!-- <?php 
                                            //$borrowerName= $row['Borrower_Last_Name'] . ', ' . $row['Borrower_First_Name'] . $row['Borrower_Middle_Name'];

                                            //echo '<td>' . $borrowerName . '</td>';
                                            //echo '<td>' . $row['Contact_Number'] . '</td>';
                                            //echo '<td>' . $row['Gender'] . '</td>';
                                            //echo '<td>' . $row['Borrower_Type'] . '</td>';
                                            //echo '<td>' . $row['Course'] . '</td>';
                                         //?> -->

 <!--                                    </tr>
                                </thead>
                                <tbody> 
                                    
                                </tbody>
                                </table> -->
                                </div>
                            </div>
                        </div>
                     </div>
                </div>
                <?php
                    include_once('assets/system/footer.php');
                    //$connection3->close();
                ?>

            
        </div>
    </div>
</div>
<div id="dialog" class="dialog" data-overlay-click-close="true" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>
<script src="assets/js/loan_materials.js"></script>

