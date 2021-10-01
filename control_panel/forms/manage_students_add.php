<div style="max-height: 400px; overflow-y: scroll; padding-right: 10px;">
    <form data-form="add-student-form">
        <label>Borrower ID:</label>
        <div class="input-control text full-size">
            <input type="text" name="borrowerID" maxlength="11" placeholder="Type your borrower number here..." autofocus>
        </div><br><br>
        <label>Password:</label>
        <div class="input-control password full-size">
            <input type="password" name="borrowerPassword" data-validate="required" placeholder="Type your password here...">
        </div>
        <!-- <label>Input Password Again:</label>
        <div class="input-control password full-size">
            <input type="password" data-validate="required compare=pass1" name="pass2">
            <span class="invalid_feedback">
                Pass1 and Pass2 must be equal.
            </span> 
        </div> -->
        <br><br>
        <label>First Name:</label>
        <div class="input-control text full-size">
            <input type="text" name="borrowerFirstName" placeholder="Type your first name here...">
        </div>  <br><br>
        <label>Middle Name:</label>
        <div class="input-control text full-size">
            <input type="text" name="borrowerMiddleName" placeholder="Type your middle name here...">
        </div> <br><br>
        <label>Last Name:</label>
        <div class="input-control text full-size">
            <input type="text" name="borrowerLastName" placeholder="Type your last name here...">
        </div> <br><br>
        <label>Contact Number:</label>
        <div class="input-control text full-size">
            <input type="text" name="contactNumber"  maxlength="11" placeholder="Type your contact number here...">
        </div> <br><br>
        <label>Gender:</label>
        <div class="input-control text full-size">
            <select name="gender">
                <option value="" selected disabled>Choose a gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
        </div> <br><br>
        <label>Borrower Type:</label>
        <div class="input-control select full-size">
            <select name="borrowerType">
                <option value="" selected disabled>Choose an option...</option>
                <!-- <?php
  //                  if(isset($_SESSION['account_username']) && $_SESSION['account_type'] == 'Administrator') {
//                        echo '<option value="Administrator">Administrator</option>';
                    //}
                ?> -->
                <option value="College Student">College Student</option>
                <option value="Senior High School Student">Senior High School Student</option>
                <!-- <option value="Assistant Librarian">Assistant Librarian</option>
                <option value="Staff">Staff</option> -->
            </select>
        </div><br><br>

        <label>Department:</label>
            <div class="input-control select full-size">
                <select name="department">
                    <option value="" selected disabled>Choose a department...</option>
                    <?php
                        require_once('../requests/connection.php');
                        $connection = new Connection();
                        $connection->open();
                        
                        $connection->query("SELECT * FROM department");

                        while($row = $connection->fetch_assoc()) {
                            echo '<option value="' . $row['Department_ID'] . '">' . $row['Department_Name'] . '</option>';
                        }
                        $connection->close(); 
                    ?>
                </select>
            </div><br><br>

        <label>Course:</label>
        <div class="input-control select full-size">
            <select name="course">
                <option value="" selected disabled>Choose an option...</option>
                <option value="Bachelor of Science in Nursing">Bachelor of Science in Nursing</option>
                <option value="Bachelor of Science in Radiologic Technology">Bachelor of Science in Radiologic Technology</option>
                <option value="Bachelor of Science in Physical Therapy">Bachelor of Science in Physical Therapy</option>
                <option value="Bachelor of Science in Midwifery">Bachelor of Science in Midwifery</option>
                <option value="Bachelor of Science in Tourism">Bachelor of Science in Tourism</option>
                <option value="Bachelor of Science in Hotel and Restaurant Management">Bachelor of Science in Hotel and Restaurant Management</option>
                <option value="SHS">SHS</option>
            </select>
        </div>

        

        <div class="align-right">
            <input type="submit" class="button primary" value="Add">
        </div>
    </form>
</div>