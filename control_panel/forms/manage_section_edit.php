<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

    $connection->query("SELECT * FROM section WHERE Section_ID='$id'");
    $row = $connection->fetch_assoc();

    $connection->close();
?>
<form data-form="edit-section-form">
    <input type="hidden" name="id" value="<?php echo $row['Section_ID']; ?>">
    <label>Section Type:</label>
    <div class="input-control text full-size">
        <input type="text" name="sections" value="<?php echo $row['Section_Type']; ?>" autofocus>
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Edit">
    </div>
</form>