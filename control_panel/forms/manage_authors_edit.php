<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

    $connection->query("SELECT * FROM authors WHERE Author_ID='$id'");
    $row = $connection->fetch_assoc();

    $connection->close();
?>
<form data-form="edit-author-form">
    <input type="hidden" name="id" value="<?php echo $row['Author_ID']; ?>">
    <label>Author's First Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="authorFirstName" value="<?php echo $row['Author_First_Name']; ?>" autofocus>
    </div>
    <label>Author's Last Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="authorLastName" value="<?php echo $row['Author_Last_Name']; ?>">
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Save">
    </div>
</form>