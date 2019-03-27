<?php
    function isHoliday($connection, $date) {
        $date = date('Y-m-d', strtotime($date));

        $connection->query("SELECT * FROM holidays");
        
        if($connection->num_rows() > 0) {
            while($row = $connection->fetch_assoc()) {
                if($row['Holiday_Type'] == 'Suspension') {
                    $holiday = date('Y-m-d', strtotime($row['Year'] . '-' . $row['Month'] . '-' . $row['Day']));
                
                    if($holiday == $date) {
                        return true;
                    }
                } else {
                    $holiday = date('Y-m-d', strtotime($row['Year'] . '-' . $row['Month'] . '-' . $row['Day']));
                
                    if(date('m-d', strtotime($holiday)) == date('m-d', strtotime($date))) {
                        return true;
                    }
                }
            }

            return false;
        } else {
            return false;
        }
    }

    function isWeekend($date) {
        $date = date('l', strtotime($date));

        if($date == 'Sunday') {
            return true;
        } else if($date == 'Saturday') {
            return true;
        } else {
            return false;
        }
    }

    function nextDay($date) {
        return date('Y-m-d', strtotime('+1 day', strtotime($date)));
    }
?>