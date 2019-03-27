<?php
    date_default_timezone_set('Asia/Manila');
    
    require_once('control_panel_settings.php');

    $settings = new ControlPanelSettings('../../');
    $action = $_POST['action'];

    if($action == 'penalty') {
        $settings->setSetting('penalty', $_POST['penalty']);

        echo json_encode(array('status' => 'Success', 'message' => 'Saved changes.'));
    } else if($action == 'student') {
        $settings->setSetting('studentReservationPeriod', $_POST['studentReservationPeriod']);
        $settings->setSetting('studentReservationLimit', $_POST['studentReservationLimit']);
        $settings->setSetting('studentLoanPeriod', $_POST['studentLoanPeriod']);
        $settings->setSetting('studentLoanLimit', $_POST['studentLoanLimit']);

        echo json_encode(array('status' => 'Success', 'message' => 'Saved changes.'));
    } else if($action == 'faculty') {
        $settings->setSetting('facultyReservationPeriod', $_POST['facultyReservationPeriod']);
        $settings->setSetting('facultyReservationLimit', $_POST['facultyReservationLimit']);
        $settings->setSetting('facultyLoanPeriod', $_POST['facultyLoanPeriod']);
        $settings->setSetting('facultyLoanLimit', $_POST['facultyLoanLimit']);

        echo json_encode(array('status' => 'Success', 'message' => 'Saved changes.'));
    } else {
        echo json_encode(array('status' => 'Failed', 'message' => 'Please specify a valid action.'));
    }
?>