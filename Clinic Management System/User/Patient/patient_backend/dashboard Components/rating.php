
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