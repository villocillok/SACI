<?php
    session_start();

    if(!isset($_SESSION['account_username'])) {
        header('Location: ./../');
    }

    include_once('assets/system/header.php');
?>
<strong></strong>
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


<!-- <ul class="sidenav-m3">
    <li class="title">Title 1</li>
    <li class="active"><a href="#"><span class="mif-home icon"></span>Dashboard</a></li>
    <li class="stick-right bg-red"><a href="#"><span class="mif-cog icon"></span>Layouts</a></li>
    <li class="stick-left bg-green">
        <a class="dropdown-toggle" href="#"><span class="mif-tree icon"></span>Sub menu</a>
        <ul class="d-menu" data-role="dropdown" style="display: none;">
            <li><a href=""><span class="mif-vpn-lock icon"></span> Subitem 1</a></li>
            <li><a href="">Subitem 2</a></li>
            <li><a href="">Subitem 3</a></li>
            <li><a href="">Subitem 4</a></li>
            <li class="disabled"><a href="">Subitem 5</a></li>
        </ul>
    </li>
    <li class=""><a href="#">Thread item</a></li>
    <li class="disabled"><a href="#">Disabled item</a></li>

    <li class="title">Title 2</li>
    <li><a href="#">Other Item 1</a></li>
    <li><a href="#">Other item 2</a></li>
    <li><a href="#">Other item 3</a></li>
</ul> -->


<div id="main-block">
    <div class="flex-grid" style="height: 100%;">
        <div class="row" style="height: 100%;">
            <div id="cell-sidebar" class="cell bg-lightDark size-x300" style="overflow-y: scroll; height: 100%;">
                <ul class="sidebar2 dark">
                    <li class="active"><a href="./"><span class="mif-meter mif-ani-shuttle icon"></span><span class="title">Dashboard</span></a></li>
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
                    <li><a href="./settled_penalties.php"><span class="mif-dollars icon"></span><span class="title">Penalty Settlement</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./view_logs.php"><span class="mif-clipboard icon"></span><span class="title">View Logs</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./generate_reports.php"><span class="mif-printer icon"></span><span class="title">Reports</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./settings.php"><span class="mif-cogs icon"></span><span class="title">Settings</span></a></li>
                </ul>
            </div>
            <div id="cell-content" class="cell auto-size padding20 pane-scroll">
                <h1 class="text-light">Dashboard</h1>
                <hr style="background-color:#493867;"><br>
                <div class="grid condensed" >
                    <div class="row cells12" >
                        <div class="cell colspan4 padding10">
                            <div class="panel" >
                                <div class="heading" style="background-color:#493867;">
                                   <li style="list-style:none;padding-left:10px;font-color:none;"><a href="manage_materials.php" style='color:#FFFFFF;'><span class="title mif-books icon" style="background-color:#493867"></span> <span class="title" style="font-color:#FFFFFF;"> Total Books</span></a></li>
                                </div>
                                <div class="content padding10">
                                    <?php 
                                    require_once('requests/connection.php');
                                         $connection = new Connection();
                                         $connection->open();
                                         $rows = $connection->query("SELECT SUM(Quantity) AS sum FROM book")->fetch_assoc();
                                        echo $rows['sum'];
                                        ?> 
                                </div>
                            </div>
                        </div>

                        <div class="cell colspan4 padding10">
                            <div class="panel" >
                                <div class="heading" style="background-color:#493867;">
                                   <li style="list-style:none;padding-left:10px;font-color:none;"><a href="manage_materials.php" style='color:#FFFFFF;'><span class="title mif-books icon" style="background-color:#493867"></span> <span class="title" style="font-color:#FFFFFF;"> Total Title Books</span></a></li>
                                </div>
                                <div class="content padding10">
                                    <?php 
                                   // require_once('requests/connection.php');
                                         $connection6 = new Connection();
                                         $connection6->open();
                                         $rows = $connection->query("SELECT COUNT(Book_ID) AS total FROM book")->fetch_assoc();
                                        echo $rows['total'];
                                        ?> 
                                </div>
                            </div>
                        </div>

                        <div class="cell colspan4 padding10">
                            <div class="panel" >
                                <div class="heading" style="background-color:#493867;">
                                   <li style="list-style:none;padding-left:10px;font-color:none;"><a href="manage_weeding.php" style='color:#FFFFFF;'><span class="title mif-books icon" style="background-color:#493867"></span> <span class="title" style="font-color:#FFFFFF;"> Weeding Books</span></a></li>
                                </div>
                                <div class="content padding10">
                                    <?php 
                                    //require_once('requests/connection.php');
                                         $connection7 = new Connection();
                                         $connection7->open();
                                         $rows = $connection->query("SELECT COUNT(Weeding_ID) AS total FROM weeding")->fetch_assoc();
                                        echo $rows['total'];
                                        ?> 
                                </div>
                            </div>
                        </div>

                        <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading" style="background-color:#493867;">
                                     <li style="list-style:none;padding-left:10px;"><a href="reserved_materials.php" style='color:#FFFFFF;'> <span class="title mif-history icon" style="background-color:#493867;"> <span> Reserve Books</span></span></a></li>
                                </div>
                                <div class="content padding10">
                                     <?php 
                                    //require_once('requests/connection.php');
                                         $connection3 = new Connection();
                                         $connection3->open();
                                         $rows = $connection->query("SELECT COUNT(Reservation_ID) AS total FROM reservations")->fetch_assoc();
                                        echo $rows['total'];
                                        ?> 
                                    
                                </div>
                            </div>
                        </div>

                        <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading" style="background-color:#493867;">
                                     <li style="list-style:none;padding-left:10px;"><a href="loan_materials.php" style='color:#FFFFFF;'> <span class="title mif-exit icon" style="background-color:#493867;"> <span> Books in transaction </span></span></a></li>
                                </div>
                                <div class="content padding10">
                                     <?php 
                                    //require_once('requests/connection.php');
                                         $connection4 = new Connection();
                                         $connection4->open();
                                         $rows = $connection->query("SELECT COUNT(Borrow_ID) AS total FROM borrow")->fetch_assoc();
                                        echo $rows['total'];
                                        ?> 
                                </div>
                            </div>
                        </div>

                        <!--   <div class="cell colspan4 padding10">
                            <div class="panel" >
                                <div class="heading" style="background-color:#493867;">
                                   <li style="list-style:none;padding-left:10px;font-color:none;"><a href="receive_materials.php" style='color:#FFFFFF;'><span class="title mif-books icon" style="background-color:#493867"></span> <span class="title" style="font-color:#FFFFFF;"> Return Books</span></a></li>
                                </div>
                                <div class="content padding10">
                                    <?php 
                                     //require_once('requests/connection.php');
                                        // $connection8 = new Connection();
                                         //$connection8->open();
                                       //  $rows = $connection->query("SELECT COUNT(Return_ID) AS total FROM return")->fetch_assoc();
                                        //echo $rows['total'];
                                        ?> 
                                </div>
                            </div>
                        </div>  --> 

                        <!-- <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading" style="background-color:#493867;">
                                     <li style="list-style:none;padding-left:10px;"><a href="manage_students.php" style='color:#FFFFFF;'> <span class="title mif-users icon" style="background-color:#493867;"> <span> Borrower's Account </span></span></a></li>
                                </div>
                                <div class="content padding10">
                                     <?php 
                                    //require_once('requests/connection.php');
   //                                      $connection1 = new Connection();
     //                                    $connection1->open();
//$rows = $connection->query("SELECT COUNT(Borrower_ID) AS total FROM borrower")->fetch_assoc();
  //                                      echo $rows['total'];
                                        ?> 
                                </div>
                            </div>
                        </div> -->

                        <!-- <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading" style="background-color:#493867;">
                                     <li style="list-style:none;padding-left:10px;"><a href="manage_faculties.php" style='color:#FFFFFF;'> <span class="title mif-users icon" style="background-color:#493867;"> <span> Librarian's Account </span></span></a></li>
                                </div>
                                <div class="content padding10">
                                    <?php 
                                    //require_once('requests/connection.php');
                                         //$connection2 = new Connection();
                                         //$connection2->open();
                                         //$rows = $connection->query("SELECT COUNT(Librarian_ID) AS total FROM librarian")->fetch_assoc();
                                        //echo $rows['total'];
                                        ?> 
                                </div>
                            </div>
                        </div> -->

                        <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading" style="background-color:#493867;">
                                     <li style="list-style:none;padding-left:10px;"><a href="settled_penalties.php" style='color:#FFFFFF;'> <span class="title mif-dollars icon" style="background-color:#493867;"> <span> Penalty Settlement </span></span></a></li>
                                </div>
                                <div class="content padding10">
                                     <!--count query-->
                                      <?php 
                                    //require_once('requests/connection.php');
                                         $connection5 = new Connection();
                                         $connection5->open();
                                         $rows = $connection->query("SELECT COUNT(Penalty_ID) AS total FROM penalty")->fetch_assoc();
                                        echo $rows['total'];
                                        ?> 
                                </div>
                            </div>
                        </div>

                        <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading" style="background-color:#493867;">
                                     <li style="list-style:none;padding-left:10px;"><a href="view_logs.php" style='color:#FFFFFF;'> <span class="title mif-clipboard icon" style="background-color:#493867;"> <span> View Logs </span></span></a></li>
                                </div>
                                 <div class="content padding10">
                                    <!-- Lorem Ipsum -->  
                                    <?php 
                                    //require_once('requests/connection.php');
                                         $connection8 = new Connection();
                                         $connection8->open();
                                         $rows = $connection->query("SELECT COUNT(Attendance_ID) AS total FROM attendance")->fetch_assoc();
                                        echo $rows['total'];
                                        ?> 
                                </div> 
                            </div>
                        </div>

                        <!-- <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading" style="background-color:#493867;">
                                     <li style="list-style:none;padding-left:10px;"><a href="generate_reports.php" style='color:#FFFFFF;'> <span class="title mif-printer icon" style="background-color:#493867;"> <span> Reports </span></span></a></li>
                                </div>
                                <div class="content padding10">
                                    <!-- Lorem Ipsum -->
                             <!--    </div>
                            </div>
                        </div>
 -->
                       <!-- <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading" style="background-color:#493867;">
                                     <li style="list-style:none;padding-left:10px;"><a href="settings.php" style='color:#FFFFFF;'> <span class="title mif-cog icon" style="background-color:#493867;"> <span> Settings </span></span></a></li>
                                </div>
                                <div class="content padding10">
                                    <!-- Lorem Ipsum -->
                               <!--  </div> 
                            </div>
                        </div>  -->



                        <?php 
                        $connection->close();
                       // $connection1->close();
                        //$connection2->close();
                        $connection3->close();
                        $connection4->close();
                        $connection5->close();
                        $connection6->close();
                        $connection7->close();
                        //$connection8->close();
                         ?>




                    </div>
                </div>
            </div>


          <!--    <div id="cell-content" class="cell auto-size padding20 "> 
                <hr><br>
                <div class="grid condensed" >
                    <div class="row cells" >
                        <div class="cell colspan4 padding10" >
                            <div class="heading">
                                <span class="title" >Lorem Ipsudtyfugyfdtrmefas dgthfgkjhdfsafhg</span>
                            </div>
                        </div>
                    </div>
                 </div>         
 -->

        </div>
    </div>
</div>



<div id="dialog" class="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>

<?php
    include_once('assets/system/footer.php');
?>