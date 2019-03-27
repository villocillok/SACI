<?php
    session_start();

    if(!isset($_SESSION['account_username'])) {
        header('Location: ./../');
    }

    include_once('assets/system/header.php');

    require_once('requests/control_panel_settings.php');

    $settings = new ControlPanelSettings('../');
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
                    <li><a href="./settled_penalties.php"><span class="mif-dollars icon"></span><span class="title">Penalty Settlement</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./view_logs.php"><span class="mif-clipboard icon"></span><span class="title">View Logs</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li><a href="./generate_reports.php"><span class="mif-printer icon"></span><span class="title">Reports</span></a></li>
                    <li class="divider"></li><li class="divider"></li>
                    <li class="active"><a href="./settings.php"><span class="mif-cogs icon"></span><span class="title">Settings</span></a></li>
                </ul>
            </div>
            <div id="cell-content" class="cell auto-size padding20 pane-scroll">
                <h1 class="text-light">Manage Settings</h1>
                <hr style="background-color:#493867;"><br>
                <div class="grid condensed">
                    <div class="row cells12">
                        <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading bg-violet">
                                    <span class="title">Penalty Settings</span>
                                </div>
                                <div class="content padding10">
                                    <form data-form="penalty-settings-form">
                                        <label>Penalty Amount (&#8369;):</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="penalty" placeholder="Type the penalty amount here..." value="<?php echo $settings->getSetting('penalty'); ?>">
                                        </div>
                                        <div class="align-right">
                                            <input type="submit" class="button primary" value="Save Changes">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading bg-violet">
                                    <span class="title">Borrower Settings</span>
                                </div>
                                <div class="content padding10">
                                    <form data-form="student-settings-form">
                                        <label>Grace Period of Reservation (Days):</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="studentReservationPeriod" placeholder="Type the reservation day/s here..." value="<?php echo $settings->getSetting('studentReservationPeriod'); ?>">
                                        </div>
                                        <br><br>
                                        <label>Reservation Limit (Book):</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="studentReservationLimit" placeholder="Type the reservation limit here..." value="<?php echo $settings->getSetting('studentReservationLimit'); ?>">
                                        </div>
                                        <br><br>
                                        <label>Grace Period of Borrowing (Days):</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="studentLoanPeriod" placeholder="Type the grace period here..." value="<?php echo $settings->getSetting('studentLoanPeriod'); ?>">
                                        </div>
                                        <br><br>
                                        <label>Borrow Limit: (Books)</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="studentLoanLimit" placeholder="Type the borrow limit here..." value="<?php echo $settings->getSetting('studentLoanLimit'); ?>">
                                        </div>
                                        <div class="align-right">
                                            <input type="submit" class="button primary" value="Save Changes">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="cell colspan4 padding10">
                            <div class="panel">
                                <div class="heading bg-violet">
                                    <span class="title">Librarian Settings</span>
                                </div>
                                <div class="content padding10">
                                    <form data-form="faculty-settings-form">
                                        <label>Grace Period of Reservation (Days):</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="facultyReservationPeriod" placeholder="Type the reservation day/s here..." value="<?php echo $settings->getSetting('facultyReservationPeriod'); ?>">
                                        </div>
                                        <br><br>
                                        <label>Reservation Limit (Books):</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="facultyReservationLimit" placeholder="Type the resevation limit here..." value="<?php echo $settings->getSetting('facultyReservationLimit'); ?>">
                                        </div>
                                        <br><br>
                                        <label>Grace Period of Borrowing (Days):</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="facultyLoanPeriod" placeholder="Type the grace period here..." value="<?php echo $settings->getSetting('facultyLoanPeriod'); ?>">
                                        </div>
                                        <br><br>
                                        <label>Borrow Limit (Books):</label>
                                        <div class="input-control text full-size">
                                            <input type="text" name="facultyLoanLimit" placeholder="Type the borrow limit here..." value="<?php echo $settings->getSetting('facultyLoanLimit'); ?>">
                                        </div>
                                        <div class="align-right">
                                            <input type="submit" class="button primary" value="Save Changes">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dialog" class="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>
<script src="assets/js/settings.js"></script>
<script>
    $('#cell-sidebar').scrollTop(9999);
</script>

<?php
    include_once('assets/system/footer.php');
?>