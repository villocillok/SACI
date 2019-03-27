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
                    <li class="active"><a href="./reserved_materials.php"><span class="mif-history icon"></span><span class="title">Reserve Books</span></a></li>
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
                    <li><a href="./settled_penalties.php"><span class="mif-dollars icon"></span><span class="title">Penalty Settlement</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./view_logs.php"><span class="mif-clipboard icon"></span><span class="title">View Logs</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./generate_reports.php"><span class="mif-printer icon"></span><span class="title">Reports</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./settings.php"><span class="mif-cogs icon"></span><span class="title">Settings</span></a></li>
                </ul>
            </div>
            <div id="cell-content" class="pane-scroll cell auto-size padding20"> <!--pane-scroll-->
                <h1 class="text-light">Reserve Books</h1>
                <hr style="background-color:#493867;"><br>
                <div class="grid">
                    <div class="row cells12">
                        <div class="cell colspan10 offset1">
                            <h3 class="text-light">Select borrower</h3>
                            <hr style="background-color:#493867;"><br>
                            <div class="input-control select full-size" data-role="select">
                                <select name="borrower" data-input="borrower">
                                    <option value="" selected disabled>Type here the name of the borrower...</option>
                                    <?php
                                        require_once('requests/connection.php');

                                        $connection = new Connection();
                                        $connection->open();

                                        $connection1 = new Connection();
                                        $connection1->open();

                                        $connection->query("SELECT * FROM accounts LEFT JOIN librarian ON accounts.Account_ID=librarian.Librarian_ID LEFT JOIN borrower ON accounts.Account_ID=borrower.Borrower_ID");
                                        $connection1->query("SELECT * FROM works 
                                        INNER JOIN authors ON works.Author_ID=authors.Author_ID 
                                        INNER JOIN book ON works.Book_ID=book.Book_ID 
                                        INNER JOIN publishers ON book.Publisher_ID=publishers.Publisher_ID 
                                        INNER JOIN categories ON book.Category_ID=categories.Category_ID 
                                        INNER JOIN section ON book.Section_ID=section.Section_ID");


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
                            <table id="materials-table" class="table striped border bordered">
                                <thead>
                                    <tr>
                                        <th>Accession Number</th>
                                        <th>Barcode Number</th>
                                        <th>Book Title</th>
                                        <th>Author</th>
                                        <th>Publisher</th>
                                        <th>Section</th>
                                        <th>Call Number</th>
                                        <th>Edition</th>
                                        <th>Year Published</th>
                                        <th>Date Reserved</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                                <?php $connection1->close(); ?>

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
                                <table id="borrower-info-table">
                                <thead>
                                    <tr>
                                        <th>Borrower: </th>
                                        <th>Name: </th>
                                        <th>Contact Number: </th>
                                        <th>Gender: </th>
                                        <th>Borrower Type</th>
                                        <th>Course: </th>

                                    </tr>
                                </thead>
                                <tbody id="borrower_detail_tbody">
                                    
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
<?php
    include_once('assets/system/footer.php');
?>
           
        </div>
    </div>
</div>
<div id="dialog" class="dialog" data-overlay-click-close="true" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>
<script src="assets/js/reserved_materials.js"></script>
<script>
    $(document).ready(function() {
        $(function() {
            $('select[name="borrower"]').select2(); // needed
        });
    });
</script>
