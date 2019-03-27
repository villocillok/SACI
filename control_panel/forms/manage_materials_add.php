<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();
?>
<div id="material-wizard" class="wizard2">
    <div class="step">
        <div class="step-content">
            <label>Book Title:</label>
            <div class="input-control text full-size">
                <input data-input="aMaterialTitle" type="text" placeholder="Type the book title here..." autofocus>
            </div>

            <label>Author(s):</label>
            <br>
            <div class="input-control select full-size" data-role="select">
                <select data-input="aAuthors" multiple>
                    <?php
                        $connection->query("SELECT * FROM authors");

                        while($row = $connection->fetch_assoc()) {
                            echo '<option value="' . $row['Author_ID'] . '">' . $row['Author_First_Name'] . ' ' . $row['Author_Last_Name'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <label>Publisher:</label>
            <div class="input-control select full-size">
                <select data-input="aPublisher">
                    <option value="" selected disabled>Choose an option...</option>
                    <?php
                        $connection->query("SELECT * FROM publishers");

                        while($row = $connection->fetch_assoc()) {
                            echo '<option value="' . $row['Publisher_ID'] . '">' . $row['Publisher_Name'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <label>Section:</label>
            <div class="input-control select full-size">
                <select data-input="aSection">
                    <option value="" selected disabled>Choose an option...</option>
                    <?php
                        $connection->query("SELECT * FROM section");

                        while($row = $connection->fetch_assoc()) {
                            echo '<option value="' . $row['Section_ID'] . '">' . $row['Section_Type'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <!-- <label>Collection Type:</label>
            <div class="input-control select full-size">
                <select data-input="aCollectionType">
                    <option value="" selected disabled>Choose an option...</option>
                    <option value="Book">Book</option>
                    <option value="Newspaper">Newspaper</option>
                    <option value="Magazine">Magazine</option>
                </select>
            </div> -->
            
        </div>
    </div>
    <div class="step">
        <div class="step-content">
            <!-- <label>Call Number:</label>
            <div class="input-control text full-size"> 
                
                <select name="aCallNumber">
                <option value="" selected disabled>Choose a Call number</option>
                <option value="000 Generalities">000 Generalities</option>
                <option value="100 Philosophy & psychology">100 Philosophy & psychology</option>
                <option value="200 Religion">200 Religion</option>
                <option value="300 Social sciences">300 Social sciences</option>
                <option value="400 Language">400 Language</option>
                <option value="500 Natural sciences & mathematics">500 Natural sciences & mathematics</option>
                <option value="600 Technology (Applied sciences)">600 Technology (Applied sciences)</option>
                <option value="700 The arts">700 The arts</option>
                <option value="800 Literature & rhetoric">800 Literature & rhetoric</option>
                <option value="900 Geography & history">900 Geography & history</option>
            </select>
            </div> -->
            <label>Call Number:</label>
            <div class="input-control text full-size">
                <input data-input="aCallNumber" type="text">
            </div>

            <br><br>
            <label>Edition:</label>
            <div class="input-control text full-size">
                <input data-input="aEdition" type="text" placeholder="Type the book edition here..." autofocus>
            </div>
            <label>Year Published:</label>
            <div class="grid condensed no-margin">
                <div class="row cells12">
                   <!--  <div class="cell colspan4">
                        <div class="input-control select full-size">
                            <select data-input="aDatePublishedMonth">
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                    </div>

                    <div class="cell colspan4">
                        <div class="input-control select full-size">
                            <select data-input="aDatePublishedDay">
                                <?php
                                //    for($i = 1; $i <= 31; $i++) {
                                  //      echo '<option value="' . sprintf('%02d', $i) . '">' . sprintf('%02d', $i) . '</option>';
                                  //  }
                                ?>
                            </select>
                        </div>
                    </div> -->
<!-- converted to int -->
                    <div class="cell colspan4">
                        <div class="input-control select full-size">
                            <input data-input="aDatePublishedYear" type="text" placeholder="Type the year here..." maxlength="4">
                                <!-- <?php
                                  //  for($i = (date('Y') + 20); $i >= 1970; $i--) {
                                    //    echo '<option value="' . sprintf('%2d', $i) . '">' . sprintf('%02d', $i) . '</option>';
                                //    }
                                ?> -->
                            <!-- </select> -->
                        </div>
                    </div>
                </div>
            </div>
            <label>Quantity:</label>
            <div class="input-control text full-size">
                <input data-input="aQuantity" type="text" placeholder="Type the quantity here...">
            </div>
        </div>
    </div>
    <div class="step">
        <div class="step-content">
            <label>Unit of price:</label>
            <div class="input-control text full-size">
                <input data-input="aUnitOfPrice" type="text" placeholder="Type the unit of price here...">
            </div>

            <label>Category:</label>
            <div class="input-control select full-size">
                <select data-input="aCategory">
                    <option value="" selected disabled>Choose an option...</option>
                    <?php
                        $connection->query("SELECT * FROM categories");

                        while($row = $connection->fetch_assoc()) {
                            echo '<option value="' . $row['Category_ID'] . '">' . $row['Category_Name'] . '</option>';
                        }
                    ?>
                </select>
            </div>

            <!-- <label>ISBN:</label>
            <div class="input-control text full-size">
                <input data-input="aIsbn" type="text">
            </div> -->
            
        </div>
    </div>
</div>
<?php
    $connection->close();
?>