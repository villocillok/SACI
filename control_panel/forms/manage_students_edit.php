<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

	#FROM bug 2a
	#This is the orginal query
    #$connection->query("SELECT * FROM accounts INNER JOIN students ON accounts.Account_ID=borrower.Borrower_ID WHERE accounts.Account_ID='$id'");
   
	#This is the new "fixed" query
	$connection->query("SELECT * FROM accounts INNER JOIN borrower ON accounts.Account_ID=borrower.Borrower_ID WHERE accounts.Account_ID='$id'");
   
   $row = $connection->fetch_assoc();

    $connection->close();
?>

<form data-form="edit-student-form">
    <input type="hidden" name="id" value="<?php echo $row['Borrower_ID']; ?>">
    <label>Borrower ID:</label>
    <div class="input-control text full-size">
        <input type="text" name="borrowerID" value="<?php echo $row['Borrower_ID']; ?>" autofocus>
    </div><br><br>
    <br><br>
    <label>First Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="borrowerFirstName" value="<?php echo $row['Borrower_First_Name']; ?>">
    </div><br><br>
    <label>Middle Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="borrowerMiddleName" value="<?php echo $row['Borrower_Middle_Name']; ?>">
    </div><br><br>
    <label>Last Name:</label>
    <div class="input-control text full-size">
        <input type="text" name="borrowerLastName" value="<?php echo $row['Borrower_Last_Name']; ?>">
    </div><br><br>
    <label>Contact Number:</label>
    <div class="input-control text full-size">
        <input type="text" name="contactNumber" maxlength="11" value="<?php echo $row['Contact_Number']; ?>">
    </div><br><br>
    <label>Gender:</label>
    <div class="input-control text full-size">
        <select name="gender">
            <?php 
                echo '<option value="" disabled>Choose a gender...</option>';
                echo '<option value="Male"' . ($row['Gender'] == 'Male' ? ' selected' : '') . '>Male</option>';
                echo '<option value="Female"' . ($row['Gender'] == 'Female' ? ' selected' : '') . '>Female</option>';
            ?>
         </select>
    </div>  <br><br>
    <label>Borrower Type:</label>
    <div class="input-control select full-size">
        <select name="borrowerType">
            <?php  
                echo '<option value="" disabled>Choose an option...</option>';
                echo '<option value="Student"' . ($row['Borrower_Type'] == 'Student' ? ' selected' : '') . '>Student</option>';
                echo '<option value="Senior High School"' . ($row['Borrower_Type'] == 'Senior High School' ? ' selected' : '') . '>Senior High School</option>';
            ?>
        </select>
    </div><br><br>

    <label>Department:</label>
            <br>
            <div class="input-control select full-size" data-role="select">
			
				<!-- Added name="department" BUG 2c -->
                <select data-input="department" name="department" multiple>
					<option value="0" selected>None</option>
					<!-- also added ^^^ -->	
                    <?php
						$connection1 = new Connection();
						$connection1->open();
						$connection1->query("SELECT * FROM department");
                        #$connection->query("SELECT * FROM department");--> This seems not to be working. New connection needed.
                        while($rowDepartment = $connection1->fetch_assoc()) {
                            echo '<option value="' . $rowDepartment['Department_ID'] . '">' . $rowDepartment['Department_Name'] . '</option>';
                        }
                    ?>
                </select>
            </div><br><br>


    <label>Course:</label>
    <div class="input-control select full-size">
        <select name="course">
            <?php  
                echo '<option value="" disabled>Choose an option...</option>';
                echo '<option value="Bachelor of Science in Nursing"' . ($row['Course'] == 'Bachelor of Science in Nursing' ? ' selected' : '') . '>Bachelor of Science in Nursing</option>';
                
                echo '<option value="Bachelor of Science in Radiologic Technology"' . ($row['Course'] == 'Bachelor of Science in Radiologic Technology' ? ' selected' : '') . '>Bachelor of Science in Radiologic Technology</option>';
               
                echo '<option value="Bachelor of Science in Physical Therapy"' . ($row['Course'] == 'Bachelor of Science in Physical Therapy' ? ' selected' : '') . '>Bachelor of Science in Physical Therapy</option>';
               
                echo '<option value="Bachelor of Science in Midwifery"' . ($row['Course'] == 'Bachelor of Science in Midwifery' ? ' selected' : '') . '>Bachelor of Science in Midwifery</option>';
               
                echo '<option value="Bachelor of Science in Tourism"' . ($row['Course'] == 'Bachelor of Science in Tourism' ? ' selected' : '') . '>Bachelor of Science in Tourism</option>';
               
                echo '<option value="Bachelor of Science in Hotel and Restaurant Management"' . ($row['Course'] == 'Bachelor of Science in Hotel and Restaurant Management' ? ' selected' : '') . '>Bachelor of Science in Hotel and Restaurant Management</option>';
                
            ?>
        </select>
    </div>

    

    <div class="align-right">
        <input type="submit" class="button primary" value="Edit">
    </div>
</form>