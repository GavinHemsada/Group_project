<?php
header('Content-Type: application/json');
include "../../../../../Clinic Management System/Connection.php";
session_start();
$mail = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patient WHERE email = '$mail'"));
$id = $user['Patient_id'];
$currentDate = date('Y-m-d');
$service = mysqli_fetch_all(mysqli_query($con, "SELECT Service_Name,Price FROM service"),MYSQLI_ASSOC);
$doctor = mysqli_fetch_all(mysqli_query($con, "SELECT Doctor_id,Fisrt_name,Last_name,Role FROM doctor"),MYSQLI_ASSOC);
$appointments_his =  mysqli_fetch_all(mysqli_query($con, "SELECT Appointment_id,Fisrt_name,Last_name,Treatment_type,Doctor_Name,Price,Date FROM appointment WHERE Patient_id='$id'"),MYSQLI_ASSOC);
$appointments =  mysqli_fetch_all(mysqli_query($con, "SELECT Appointment_id,Fisrt_name,Last_name,Treatment_type,Doctor_Name,Price,Date FROM appointment WHERE Patient_id='$id' and Date > '$currentDate' "),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if($service){
        echo json_encode([$service,$doctor,$appointments_his,$appointments]);
    }else{
        echo json_encode(['states' => 'error_app']);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $result = mysqli_query($con, "SELECT COUNT(*) FROM appointment");
    $row = mysqli_fetch_array($result);
    $count = $row[0];
    $count++;
    $appointmentID = "EV_A$count";
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $treatment_type = $_POST['treatment_type'];
    $date = $_POST['date'];
    $doc_name = $_POST['doc_name'];
    $price = $_POST['price'];
    $docid = $_POST['docid'];
    $age = $_POST['age'];

    if(!empty($fname)&&!empty($lname)){
        $send = mysqli_query($con,"INSERT INTO appointment (Appointment_id,Fisrt_name, Last_name, Treatment_type, Age, Date, Doctor_Name, Price, Patient_id, Doctor_id) value ('$appointmentID', '$fname', '$lname', '$treatment_type', '$age', '$date', '$doc_name', '$price', '$id', '$docid')");
        if($send){
            echo json_encode(['states' => 'senData']);
        } 
    }  
}

if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents("php://input"), $_PUT);
    $appointmentID = $_PUT['appointmentID'];
    $fname = $_PUT['fname'];
    $lname = $_PUT['lname'];
    $age = $_PUT['age'];
    $date = $_PUT['date'];
    $update = mysqli_query($con,"UPDATE appointment SET Fisrt_name = '$fname' , Last_name = '$lname', Age ='$age',Date = '$date' WHERE Appointment_id = '$appointmentID' ");
    if($update){
        echo json_encode(['states' => 'update']);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    parse_str(file_get_contents("php://input"), $_DELETE);
    $appointmentID = $_DELETE['appointmentID'];
    $appointDelete = mysqli_query($con, "DELETE FROM appointment WHERE Appointment_id='$appointmentID' ");
    if($appointDelete){
        echo json_encode(['states' => 'delete']);
    }
}