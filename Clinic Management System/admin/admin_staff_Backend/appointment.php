<?php
/**
 * Copyright 2025 GavinHemsada
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at:
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
include "../../Connection.php";
$appointment = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM appointment"),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $appID =isset($_GET['appointmentID'])?$_GET['appointmentID']:"";
    if($appID != ""){
        $appointmentForEdit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM appointment WHERE Appointment_id='$appID'"));
        echo json_encode($appointmentForEdit);
    }else{
        if($appointment){
            echo json_encode($appointment);
        }else{
            echo json_encode(['states' => 'error']);
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