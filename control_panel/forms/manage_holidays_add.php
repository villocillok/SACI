<form data-form="add-holiday-form">
    <label>Holiday:</label>
    <div class="input-control text full-size">
        <input type="text" name="holiday" placeholder="Type the holiday name here..." autofocus>
    </div>
    <label>Type of Holiday:</label>
    <div class="input-control select full-size">
        <select name="holidayType">
            <option value="" selected disabled>Choose an option...</option>
            <option value="Suspension">Class Suspension</option>
            <option value="Regular Holiday">Regular Holiday</option>
            <option value="Special Holiday">Special Holiday</option>
        </select>
    </div>
    <label>Date Published:</label>
    <div class="grid condensed no-margin">
        <div class="row cells12">
            <div class="cell colspan4">
                <div class="input-control select full-size">
                    <select name="month" data-input="month">
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
                    <select name="day" data-input="day">
                        <?php
                            for($i = 1; $i <= 31; $i++) {
                                echo '<option value="' . sprintf('%02d', $i) . '">' . sprintf('%02d', $i) . '</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
            <div class="cell colspan4">
                <div class="input-control select full-size">
                    <select name="year" data-input="year">
                        <?php
                            for($i = (date('Y') + 10); $i >= 1970; $i--) {
                                echo '<option value="' . sprintf('%2d', $i) . '">' . sprintf('%02d', $i) . '</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Add">
    </div>
</form>