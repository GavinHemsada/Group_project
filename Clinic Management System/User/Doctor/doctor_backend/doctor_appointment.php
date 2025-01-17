<?php
header('Content-Type: application/json');
include "../../../../Clinic Management System/Connection.php";
session_start();
$currentDate = date('Y-m-d');
$mail = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM doctor WHERE email = '$mail'"));
$id = $user['Doctor_id'];
$appointment = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM appointment WHERE Doctor_id = '$id' and Date >= '$currentDate' "),MYSQLI_ASSOC);
$appointment_his = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM appointment WHERE Doctor_id = '$id'"),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if($user){
        echo json_encode([$appointment,$appointment_his]);
    }else{
        echo json_encode(['states' => 'error']);
    }
}