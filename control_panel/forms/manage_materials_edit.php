<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

    $connection->query("SELECT * FROM book WHERE Book_ID='$id'");
    $row = $connection->fetch_assoc();
?>
<div id="material-wizard" class="wizard2">
    <div class="step">
        <div class="step-content">
            <input type="hidden" data-input="eID" value="<?php echo $row['Book_ID']; ?>">
            <label>Book Title:</label>
            <div class="input-control text full-size">
                <input data-input="eMaterialTitle" type="text" value="<?php echo $row['Book_Title']; ?>" autofocus>
            </div>
            <label>Author(s):</label>
            <br>
            <div class="input-control select full-size" data-role="select">
                <select data-input="eAuthors" name="authors" multiple>
                    <?php
                        $connection->query("SELECT * FROM authors");

                        while($rowAuthor = $connection->fetch_assoc()) {
                            echo '<option value="' . $rowAuthor['Author_ID'] . '">' . $rowAuthor['Author_First_Name'] . ' ' . $rowAuthor['Author_Last_Name'] . '</option>';
                        }
                    ?>
                </select>
            </div>
            
            <label>Publisher:</label>
            <div class="input-control select full-size">
                <select data-input="ePublisher">
                    <option value="" selected disabled>Choose an option...</option>
                    <?php
                        $connection->query("SELECT * FROM publishers");

                        while($rowPublisher = $connection->fetch_assoc()) {
                            echo '<option value="' . $rowPublisher['Publisher_ID'] . '"' . ($row['Publisher_ID'] == $rowPublisher['Publisher_ID'] ? ' selected' : '') . '>' . $rowPublisher['Publisher_Name'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <label>Section:</label>
            <div class="input-control select full-size">
                <select data-input="eSection">
                    <option value="" selected disabled>Choose an option...</option>
                    <?php
                        $connection->query("SELECT * FROM section");

						#Fixed Bug. Previous variable was $rowPublished not $rowSection
						#Refer to 4a
                        while($rowSection = $connection->fetch_assoc()) {
                            echo '<option value="' . $rowSection['Section_ID'] . '"' . ($row['Section_ID'] == $rowSection['Section_ID'] ? ' selected' : '') . '>' . $rowSection['Section_Type'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            
        </div>
    </div>
    <div class="step">
        <div class="step-content">
            <label>Call Number:</label>
            <div class="input-control text full-size">
                <input data-input="eCallNumber" value="<?php echo $row['Call_Number']; ?>" type="text"> 
                <!-- <select name="eCallNumber"> -->
                   <!--  <?php  
                        //echo '<option value="" disabled selected>Choose an option...</option>';

                        //echo '<option value="000 Generalities"' . ($row['Call_Number'] == '000 Generalities' ? ' selected' : '') . '>000 Generalities</option>';

                        //echo '<option value="100 Philosophy & psychology"' . ($row['Call_Number'] == '100 Philosophy & psychology' ? ' selected' : '') . '>100 Philosophy & psychology</option>';

                        //echo '<option value="200 Religion"' . ($row['Call_Number'] == '200 Religion' ? ' selected' : '') . '>200 Religion</option>';

                        //echo '<option value="300 Social sciences"' . ($row['Call_Number'] == '300 Social sciences' ? ' selected' : '') . '>300 Social sciences</option>';

                        //echo '<option value="400 Language"' . ($row['Call_Number'] == '400 Language' ? ' selected' : '') . '>400 Language</option>';

                        //echo '<option value="500 Natural sciences & mathematics"' . ($row['Call_Number'] == '500 Natural sciences & mathematics' ? ' selected' : '') . '>500 Natural sciences & mathematics</option>';

                        //echo '<option value="600 Technology (Applied sciences)"' . ($row['Call_Number'] == '600 Technology (Applied sciences)' ? ' selected' : '') . '>600 Technology (Applied sciences)</option>';

                        //echo '<option value="700 The arts"' . ($row['Call_Number'] == '700 The arts' ? ' selected' : '') . '>700 The arts</option>';

                        //echo '<option value="800 Literature & rhetoric"' . ($row['Call_Number'] == '800 Literature & rhetoric' ? ' selected' : '') . '>800 Literature & rhetoric</option>';

                        //echo '<option value="900 Geography & history"' . ($row['Call_Number'] == '900 Geography & history' ? ' selected' : '') . '>900 Geography & history</option>';
                    ?>
                </select>-->
            </div> 

            <label>Edition:</label>
            <div class="input-control text full-size">
                <input data-input="eEdition" value="<?php echo $row['Edition']; ?>" type="text">
            </div>
			
			<label>Quantity:</label>
            <div class="input-control text full-size">
                <input data-input="eQuantity" value="<?php echo $row['Quantity']; ?>" type="text">
            </div>


            <label>Year Published:</label>
            <div class="grid condensed no-margin">
                <div class="row cells12">
                    <!-- <div class="cell colspan4">
                        <div class="input-control select full-size">
                            <select data-input="eDatePublishedMonth">
                                <option value="01"<?php echo (date('m', strtotime($row['Date_Published'])) == '01' ? ' selected' : ''); ?>>January</option>
                                <option value="02"<?php echo (date('m', strtotime($row['Date_Published'])) == '02' ? ' selected' : ''); ?>>February</option>
                                <option value="03"<?php echo (date('m', strtotime($row['Date_Published'])) == '03' ? ' selected' : ''); ?>>March</option>
                                <option value="04"<?php echo (date('m', strtotime($row['Date_Published'])) == '04' ? ' selected' : ''); ?>>April</option>
                                <option value="05"<?php echo (date('m', strtotime($row['Date_Published'])) == '05' ? ' selected' : ''); ?>>May</option>
                                <option value="06"<?php echo (date('m', strtotime($row['Date_Published'])) == '06' ? ' selected' : ''); ?>>June</option>
                                <option value="07"<?php echo (date('m', strtotime($row['Date_Published'])) == '07' ? ' selected' : ''); ?>>July</option>
                                <option value="08"<?php echo (date('m', strtotime($row['Date_Published'])) == '08' ? ' selected' : ''); ?>>August</option>
                                <option value="09"<?php echo (date('m', strtotime($row['Date_Published'])) == '09' ? ' selected' : ''); ?>>September</option>
                                <option value="10"<?php echo (date('m', strtotime($row['Date_Published'])) == '10' ? ' selected' : ''); ?>>October</option>
                                <option value="11"<?php echo (date('m', strtotime($row['Date_Published'])) == '11' ? ' selected' : ''); ?>>November</option>
                                <option value="12"<?php echo (date('m', strtotime($row['Date_Published'])) == '12' ? ' selected' : ''); ?>>December</option>
                            </select>
                        </div>
                    </div>
                    <div class="cell colspan4">
                        <div class="input-control select full-size">
                            <select data-input="eDatePublishedDay">
                                <?php
                                    for($i = 1; $i <= 31; $i++) {
                                        echo '<option value="' . sprintf('%02d', $i) . '"' . (date('d', strtotime($row['Date_Published'])) == $i ? ' selected' : '') . '>' . sprintf('%02d', $i) . '</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div> -->


                    <div class="cell colspan4">
                        <div class="input-control select full-size">
                            <input type="text" data-input="eDatePublishedYear" value="<?php echo $row['Year_Published'];  ?>">
                            <!-- <select data-input="eDatePublishedYear">
                                <?php
                                    for($i = (date('Y') + 20); $i >= 1970; $i--) {
                                        echo '<option value="' . sprintf('%2d', $i) . '"' . (date('Y', strtotime($row['Date_Published'])) == $i ? ' selected' : '') . '>' . sprintf('%02d', $i) . '</option>';
                                    }
                                ?>
                            </select> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-content">
            <label>Unit of Price:</label>
            <div class="input-control text full-size">
                <input data-input="eUnitOfPrice" value="<?php echo $row['Unit_Of_Price']; ?>" type="text">
            </div>

            <label>Category:</label>
            <div class="input-control select full-size">
                <select data-input="eCategory">
                    <option value="" selected disabled>Choose an option...</option>
                    <?php
                        $connection->query("SELECT * FROM categories");

                        while($rowCategory = $connection->fetch_assoc()) {
                            echo '<option value="' . $rowCategory['Category_ID'] . '"' . ($row['Category_ID'] == $rowCategory['Category_ID'] ? ' selected' : '') . '>' . $rowCategory['Category_Name'] . '</option>';
                        }
                    ?>
                </select>
            </div>

           <!--  <label>Collection Type:</label>
            <div class="input-control select full-size">
                <select data-input="eCollectionType">
                    <option value="" selected disabled>Choose an option...</option>
                    <option value="Book"<?php echo ($row['Collection_Type'] == 'Book' ? ' selected' : ''); ?>>Book</option>
                    <option value="Newspaper"<?php echo ($row['Collection_Type'] == 'Newspaper' ? ' selected' : ''); ?>>Newspaper</option>
                    <option value="Magazine"<?php echo ($row['Collection_Type'] == 'Magazine' ? ' selected' : ''); ?>>Magazine</option>
                </select>
            </div> -->

            <!-- <label>ISBN:</label>
            <div class="input-control text full-size">
                <input data-input="eIsbn" value="<?php echo $row['ISBN']; ?>" type="text">
            </div> -->
            
        </div>
    </div>
</div>
<?php
    $connection->close();
?>