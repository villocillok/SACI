<?php
    session_start();

    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

    $connection->query("SELECT * FROM accounts INNER JOIN librarian ON accounts.Account_ID=librarian.Librarian_ID WHERE accounts.Account_ID='$id'");
    $row = $connection->fetch_assoc();

    $connection->close();
?>
<form data-form="edit-faculty-form">
    <input type="hidden" name="id" value="<?php echo $row['Librarian_ID']; ?>">
    <label>Librarian ID:</label>
    <div class="input-control text full-size">
        <input type="text" name="librarianID" value="<?php echo $row['Librarian_ID']; ?>" autofocus>
    </div>
    <br><br>
    <label>First Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="librarianFirstName" value="<?php echo $row['Librarian_First_Name']; ?>" autofocus>
    </div>
    <label>Middle Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="librarianMiddleName" value="<?php echo $row['Librarian_Middle_Name']; ?>">
    </div>
    <label>Last Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="librarianLastName" value="<?php echo $row['Librarian_Last_Name']; ?>">
    </div>
    <label>Type:</label>
    <div class="input-control select full-size">
        <select name="librarianType">
            <?php
                echo '<option value="" disabled>Choose an option...</option>';

                if(isset($_SESSION['account_username']) && $_SESSION['account_type'] == 'Administrator') {
                    echo '<option value="Administrator"' . ($row['Account_Type'] == 'Administrator' ? ' selected' : '') . '>Administrator</option>';
                }

                echo '<option value="Staff"' . ($row['Account_Type'] == 'Staff' ? ' selected' : '') . '>Staff</option>';
                echo '<option value="Librarian"' . ($row['Account_Type'] == 'Librarian' ? ' selected' : '') . '>Librarian</option>';
                echo '<option value="Assistant Librarian"' . ($row['Account_Type'] == 'Assistant Librarian' ? ' selected' : '') . '>Assistant Librarian</option>';
                echo '<option value="Faculty"' . ($row['Account_Type'] == 'Faculty' ? ' selected' : '') . '>Faculty</option>';
            ?>
        </select>
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Edit">
    </div>
</form>