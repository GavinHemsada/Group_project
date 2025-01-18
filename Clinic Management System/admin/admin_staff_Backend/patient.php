<?php
include "../../Connection.php";
$patient = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM patient"),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $patientID =isset($_GET['patientID'])?$_GET['patientID']:"";
    if($patientID != ""){
        $patientForEdit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patient WHERE Patient_id='$patientID'"));
        echo json_encode($patientForEdit);
    }else{
        if($patient){
            echo json_encode($patient);
        }else{
            echo json_encode(['states' => 'error']);
        }
    }
}
if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents("php://input"), $_PUT);
    $patientID = $_PUT['patientID'];
    $fname = $_PUT['fname'];
    $lname = $_PUT['lname'];
    $email = $_PUT['email'];
    $gender = $_PUT['gender'];
    $pnumber = $_PUT['pnumber'];
    $snumber = $_PUT['snumber'];
    $sname = $_PUT['sname'];
    $city = $_PUT['city'];
    $update = mysqli_query($con,"UPDATE patient SET Fisrt_name = '$fname' , Last_name = '$lname', email ='$email',Gender = '$gender',Phone_Number ='$pnumber',Street_Number='$snumber',Street_Name='$sname',City='$city' WHERE Patient_id = '$patientID' ");
    if($update){
        echo json_encode(['states' => 'update']);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    parse_str(file_get_contents("php://input"), $_DELETE);
    $patientID = $_DELETE['patientID'];
    $patientDelete = mysqli_query($con, "DELETE FROM patient WHERE Patient_id='$patientID' ");
    if($patientDelete){
        echo json_encode(['states' => 'delete']);
    }
}