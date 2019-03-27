<?php
    session_start();
?>
<form data-form="add-faculty-form" data-role=>
    <label>Librarian ID:</label>
    <div class="input-control text full-size">
        <input type="text" name="librarianID" placeholder="Type the ID number here..." autofocus>
    </div>
    <label>Password:</label>
    <div class="input-control password full-size">
        <input type="password" name="librarianPassword" placeholder="Type your password here...">
    </div>
   <!--  <label>Input Password Again:</label>
    <div class="input-control password full-size">
        <input type="password" data-validate="required compare=pass1" name="pass2">
        <span class="invalid_feedback">
            Pass1 and Pass2 must be equal.
        </span>
    </div>  -->
    <br><br>
    <label>First Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="librarianFirstName" placeholder="Type your first name here... ">
    </div>
    <label>Middle Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="librarianMiddleName" placeholder="Type your middle name here...">
    </div>
    <label>Last Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="librarianLastName" placeholder="Type your last name here...">
    </div>
    <label>Type:</label>
    <div class="input-control select full-size">
        <select name="librarianType">
            <option value="" selected disabled>Choose an option...</option>
            <?php
                if(isset($_SESSION['account_username']) && $_SESSION['account_type'] == 'Administrator') {
                    echo '<option value="Administrator">Administrator</option>';
                }
            ?>
            <!-- <option value="Administrator">Administrator</option> -->
            <option value="Librarian">Librarian</option>
            <option value="Assistant Librarian">Assistant Librarian</option>
            <option value="Staff">Staff</option>
            <option value="Faculty">Faculty</option>
            
        </select>
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Add">
    </div>
</form>