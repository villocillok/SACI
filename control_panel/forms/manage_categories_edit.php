<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

    $connection->query("SELECT * FROM categories WHERE Category_ID='$id'");
    $row = $connection->fetch_assoc();

    $connection->close();
?>
<form data-form="edit-category-form">
    <input type="hidden" name="id" value="<?php echo $row['Category_ID']; ?>">
    <label>Category Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="category" value="<?php echo $row['Category_Name']; ?>" autofocus>
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Edit">
    </div>
</form>