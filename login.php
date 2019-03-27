<?php
    session_start();

    if(isset($_SESSION['account_username'])) {
        if($_SESSION['account_type'] == 'Administrator' || $_SESSION['account_type'] == 'Staff' || $_SESSION['account_type'] == 'Librarian' || $_SESSION['account_type'] == 'Assistant Librarian' || $_SESSION['account_type'] == 'Faculty') {
            header('Location: ./control_panel');
        } else {
            header('Location: ./');
        }
    }

    include_once('assets/system/header.php');
?>

<div class="app-bar fixed-top shadow" data-role="appbar" style="background-color:#493867;">
    <div class="container">
        <a class="app-bar-element branding" href="./"><img class="app-logo" src="assets/image/Southeast Asian College.png">&nbsp;&nbsp;Southeast Asian College Inc.</a>
        <?php
            if(isset($_SESSION['account_username'])) {
                $name = $_SESSION['account_first_name'] . ' ' . $_SESSION['account_last_name'];

                echo '<ul class="app-bar-menu place-right" style="background-color:#493867;">';
                echo '<li><a class="app-bar-element dropdown-toggle" style="background-color:#493867;">' . $name . '&nbsp;&nbsp;<img class="app-logo" src="user_images/' . $_SESSION['account_image'] . '"></a>';
                echo '<ul class="d-menu place-right" data-role="dropdown">';

                if($_SESSION['account_type'] == 'Administrator' || $_SESSION['account_type'] == 'Staff' || $_SESSION['account_type'] == 'Librarian' || $_SESSION['account_type'] == 'Assistant Librarian') {
                    echo '<li><a href="./control_panel">Control Panel</a></li>';
                }

                echo '<li><a href="reservations.php">My Reservations</a></li>';
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
    <h1>Login</h1>
    <hr style="background-color:#493867;"><br>
    <div class="grid">
        <div class="row cells3">
            <div class="cell offset1 padding20 shadow">
                <form data-form="login-form">
                    <label>Account Number:</label>
                    <div class="input-control text full-size" data-role="input">
                        <span class="mif-user prepend-icon"></span>
                        <input type="text" name="username" autofocus>
                    </div>
                    <br><br>
                    <label>Password:</label>
                    <div class="input-control password full-size" data-role="input">
                        <span class="mif-lock prepend-icon"></span>
                        <input type="password" name="password">
                    </div>
                    <div class="align-right">
                        <input type="submit" class="button primary" value="Login">
                    </div>
                </form>
                <div id="login-response"></div>
            </div>
        </div>
    </div>
</div>
<div id="dialog" class="dialog" data-overlay="true" data-overlay-color="op-dark" data-width="50%" data-role="dialog">
    <div id="dialog-inner" class="container-fluid"></div>
</div>
<script src="assets/js/opac.js"></script>

<?php
    include_once('assets/system/footer.php');
?>