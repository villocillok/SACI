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
                    <li class="active"><a href="./settled_penalties.php"><span class="mif-dollars icon"></span><span class="title">Penalty Settlement</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./view_logs.php"><span class="mif-clipboard icon"></span><span class="title">View Logs</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./generate_reports.php"><span class="mif-printer icon"></span><span class="title">Reports</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./settings.php"><span class="mif-cogs icon"></span><span class="title">Settings</span></a></li>
                </ul>
            </div>
            <div id="cell-content" class="cell auto-size padding20 pane-scroll">
                <h1 class="text-light">Penalty Settlement</h1>
                <hr style="background-color:#493867;"><br>
                <table id="settled-penalties-table" class="table striped border bordered">
                    <thead>
                        <tr>
                            <th>Borrower</th>
                            <th>Book Borrowed</th>
                            <th>Date Borrowed</th>
                            <th>Due Date</th>
                            <th>Date Returned</th>
                            <th>Penalty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            require_once('requests/connection.php');

                            $connection = new Connection();
                            $connection->open();

                            $connection2 = new Connection();
                            $connection2->open();

                            // $connection->query("SELECT * FROM borrow INNER JOIN barcodes ON borrow.Barcode_Number=barcodes.Barcode_Number INNER JOIN book ON barcodes.Book_ID=Book.Book_ID INNER JOIN borrow ON borrow.Borrow_ID=borrow.Borrow_ID INNER JOIN `return` ON borrow.Borrow_ID=return.Borrow_ID INNER JOIN penalties ON return.Return_ID=penalties.Return_ID");

                            $connection->query("SELECT * FROM borrow_details
                                INNER JOIN barcodes ON borrow_details.Barcode_Number=barcodes.Barcode_Number
                                INNER JOIN book ON barcodes.Book_ID=book.Book_ID
                                INNER JOIN borrow ON borrow_details.Borrow_ID=borrow.Borrow_ID
                                INNER JOIN `return` ON borrow_details.Borrow_Details_ID=`return`.Borrower_Details_ID
                                INNER JOIN penalties ON `return`.Return_ID=penalties.Return_ID");



                            //DI PA SURE

                            if($connection->num_rows() > 0) {
                                while($row = $connection->fetch_assoc()) {
                                    $connection2->query("SELECT * FROM accounts LEFT JOIN librarian ON accounts.Account_ID=librarian.Librarian_ID LEFT JOIN borrower ON accounts.Account_ID=Borrower.Borrower_ID");
                                    $row2 = $connection2->fetch_assoc();

                                    if($row2['Account_Type'] == 'College Student' || $row2['Account_Type'] == 'Senior High School Student') {
                                        $type = 'Borrower';
                                    } else {
                                        $type = 'Librarian';
                                    }

                                    if(strlen($row2[$type . '_Middle_Name']) > 1) {
                                        $name = $row2[$type . '_First_Name'] . ' ' . substr($row2[$type . '_Middle_Name'], 0, 1) . '. ' . $row2[$type . '_Last_Name'];
                                    } else {
                                        $name = $row2[$type . '_First_Name'] . ' ' . $row2[$type . '_Last_Name'];
                                    }
                                    
                                    echo '<tr>';
                                    echo '<td>' . $name . '</td>';
                                    echo '<td>' . $row['Book_Title'] . '</td>';
                                    echo '<td>' . date('F d, Y', strtotime($row['Date_Borrowed'])) . '</td>';
                                    echo '<td>' . date('F d, Y', strtotime($row['Final_Due_Date'])) . '</td>';
                                    echo '<td>' . date('F d, Y', strtotime($row['Date_Returned'])) . '</td>';
                                    echo '<td>' . $row['Penalty'] . '</td>';
                                    echo '</tr>';
                                }
                            }

                            $connection2->close();
                            $connection->close();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="dialog" class="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>
<script src="assets/js/settled_penalties.js"></script>

<?php
    include_once('assets/system/footer.php');
?>
