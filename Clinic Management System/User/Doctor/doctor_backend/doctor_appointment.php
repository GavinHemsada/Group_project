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