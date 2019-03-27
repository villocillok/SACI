<?php
    require_once('../requests/connection.php');

    $connection = new Connection();
    $connection->open();

    $id = $connection->escape_string($_POST['id']);

    $connection->query("SELECT * FROM holidays WHERE Holiday_ID='$id'");
    $row = $connection->fetch_assoc();

    $connection->close();
?>
<form data-form="edit-holiday-form">
    <input type="hidden" name="id" value="<?php echo $row['Holiday_ID']; ?>">
    <label>Holiday:</label>
    <div class="input-control text full-size">
        <input type="text" name="holiday" value="<?php echo $row['Holiday']; ?>" autofocus>
    </div>
    <label>Type of Holiday:</label>
    <div class="input-control select full-size">
        <select name="holidayType">
            <option value="" selected disabled>Choose an option...</option>
            <option value="Suspension"<?php echo ($row['Holiday_Type'] == 'Suspension' ? ' selected' : ''); ?>>Class Suspension</option>
            <option value="Regular Holiday"<?php echo ($row['Holiday_Type'] == 'Regular Holiday' ? ' selected' : ''); ?>>Regular Holiday</option>
            <option value="Special Holiday"<?php echo ($row['Holiday_Type'] == 'Special Holiday' ? ' selected' : ''); ?>>Special Holiday</option>
        </select>
    </div>
    <label>Date Published:</label>
    <div class="grid condensed no-margin">
        <div class="row cells12">
            <div class="cell colspan4">
                <div class="input-control select full-size">
                    <select name="month" data-input="month">
                        <option value="01"<?php echo ($row['Month'] == '01' ? ' selected' : ''); ?>>January</option>
                        <option value="02"<?php echo ($row['Month'] == '02' ? ' selected' : ''); ?>>February</option>
                        <option value="03"<?php echo ($row['Month'] == '03' ? ' selected' : ''); ?>>March</option>
                        <option value="04"<?php echo ($row['Month'] == '04' ? ' selected' : ''); ?>>April</option>
                        <option value="05"<?php echo ($row['Month'] == '05' ? ' selected' : ''); ?>>May</option>
                        <option value="06"<?php echo ($row['Month'] == '06' ? ' selected' : ''); ?>>June</option>
                        <option value="07"<?php echo ($row['Month'] == '07' ? ' selected' : ''); ?>>July</option>
                        <option value="08"<?php echo ($row['Month'] == '08' ? ' selected' : ''); ?>>August</option>
                        <option value="09"<?php echo ($row['Month'] == '09' ? ' selected' : ''); ?>>September</option>
                        <option value="10"<?php echo ($row['Month'] == '10' ? ' selected' : ''); ?>>October</option>
                        <option value="11"<?php echo ($row['Month'] == '11' ? ' selected' : ''); ?>>November</option>
                        <option value="12"<?php echo ($row['Month'] == '12' ? ' selected' : ''); ?>>December</option>
                    </select>
                </div>
            </div>
            <div class="cell colspan4">
                <div class="input-control select full-size">
                    <select name="day" data-input="day">
                        <?php
                            for($i = 1; $i <= 31; $i++) {
                                echo '<option value="' . sprintf('%02d', $i) . '"' . ($row['Day'] == $i ? ' selected' : '') . '>' . sprintf('%02d', $i) . '</option>';
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
                                echo '<option value="' . sprintf('%2d', $i) . '"' . ($row['Year'] == $i ? ' selected' : '') . '>' . sprintf('%02d', $i) . '</option>';
                            }
                        ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="align-right">
        <input type="submit" class="button primary" value="Edit">
    </div>
</form>