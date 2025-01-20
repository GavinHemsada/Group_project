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
    if(isset($_FILES['upload_img'])){
        $fileTmpPath = $_FILES['upload_img']['tmp_name'];
        $fileExtension = pathinfo($_FILES['upload_img']['name'], PATHINFO_EXTENSION);
        $fileName = 'Patient'.'-'.$id.'.'.$fileExtension;
        $uploadFileDir = '../../../../../Clinic Management System/images/Profile_img/Patient/';
        $dest_path = $uploadFileDir . $fileName;
        if (file_exists($dest_path)) {
            unlink($dest_path);
        }
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          $query = "UPDATE patient SET Profile_photo = '$fileName' WHERE Patient_id = '$id' ";
          if (mysqli_query($con, $query)) {
            echo json_encode(['status' => 'success']);
          } else {
            echo json_encode(['status' => 'error']);
          }
        }
    }else{
        echo json_encode(['status' => 'type_error']);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents("php://input"), $_PUT);
    $fname = $_PUT['fname'];
    $lname = $_PUT['lname'];
    $email = $_PUT['email'];
    $gender = $_PUT['gender'];
    $phone = $_PUT['phone'];
    $snumber = $_PUT['snumber'];
    $sname = $_PUT['sname'];
    $city = $_PUT['city'];

    $query1 = "UPDATE patient SET 
            Fisrt_name = '$fname', 
            Last_name = '$lname', 
            email = '$email', 
            Gender = '$gender', 
            Phone_Number = '$phone', 
            Street_Number = '$snumber', 
            Street_Name = '$sname', 
            City = '$city' 
            WHERE Patient_id = '$id'";
    if (mysqli_query($con, $query1)) {
        echo json_encode(['status' => 'details_add']);
    } else {
        echo json_encode(['status' => 'detals_notadd']);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if($user){
        echo json_encode($user);
    }else{
        echo json_encode(['states' => 'error']);
    }
}