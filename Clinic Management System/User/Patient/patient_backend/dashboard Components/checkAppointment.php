<?php
header('Content-Type: application/json');
include "../../../../../Clinic Management System/Connection.php";
session_start();
$mail = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patient WHERE email = '$mail'"));
$id = $user['Patient_id'];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $treatment_type = $_POST['treatment_type'];
    $date = $_POST['date'];
    $appointments_check = mysqli_query($con, "SELECT * FROM appointment WHERE Patient_id='$id' and Date = '$date' and  Treatment_type = '$treatment_type' ");
    if(mysqli_num_rows($appointments_check)>0){
        echo json_encode(['states' => 'have_app','message'=> mysqli_fetch_assoc($appointments_check)]);
    }else{
        echo json_encode(['states' => 'error','message'=> mysqli_fetch_assoc($appointments_check)]);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents("php://input"), $_PUT);
    $appointmentID = $_PUT['appointmentID'];
    $appoint = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM appointment WHERE Appointment_id='$appointmentID' "));
    if($appoint){
        echo json_encode(['states' => $appoint]);
    }
}