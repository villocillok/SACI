<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

    $connection->query("SELECT * FROM department WHERE Department_ID='$id'");
    $row = $connection->fetch_assoc();

    $connection->close();
?>
<form data-form="edit-department-form">
    <input type="hidden" name="id" value="<?php echo $row['Department_ID']; ?>">
    <label>Department Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="departments" value="<?php echo $row['Department_Name']; ?>" autofocus>
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Edit">
    </div>
</form>