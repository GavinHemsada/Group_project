
<?php
header('Content-Type: application/json');
include "../../../../../Clinic Management System/Connection.php";
session_start();
$mail = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patient WHERE email = '$mail'"));
$id = $user['Patient_id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $rateID = $_POST['rateID'];
    $rate = $_POST['rate'];
    $msg = $_POST['msg'];

        $send = mysqli_query($con,"INSERT INTO rate (Appointment_id ,ratings, Message, Patient_ID) value ('$rateID', '$rate', '$msg', '$id')");
        if($send){
            echo json_encode(['states' => 'senData']);
        }
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $rate = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM rate"),MYSQLI_ASSOC);
    if($rate){
        echo json_encode([$rate]);
    }else{
        echo json_encode(['states' => 'error_app']);
    }
}