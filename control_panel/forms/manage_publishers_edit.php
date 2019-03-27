<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

    $connection->query("SELECT * FROM publishers WHERE Publisher_ID='$id'");
    $row = $connection->fetch_assoc();

    $connection->close();
?>
<form data-form="edit-publisher-form">
    <input type="hidden" name="id" value="<?php echo $row['Publisher_ID']; ?>">
    <label>Publisher Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="publisher" value="<?php echo $row['Publisher_Name']; ?>" autofocus>
    </div>
    <label>Publisher Address:</label>
    <div class="input-control text full-size">
        <input type="text" name="publisherAddress" value="<?php echo $row['Publisher_Address']; ?>">
    </div>
    <label>Contact Number:</label>
    <div class="input-control text full-size">
        <input type="text" name="contactNumber" value="<?php echo $row['Contact_Number']; ?>">
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Edit">
    </div>
</form>