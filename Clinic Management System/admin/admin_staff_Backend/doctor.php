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
$doctor = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM doctor"),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $doctorID =isset($_GET['doctorID'])?$_GET['doctorID']:"";
    if($doctorID != ""){
        $doctorForEdit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM doctor WHERE Doctor_id='$doctorID'"));
        echo json_encode($doctorForEdit);
    }else{
        if($doctor){
            echo json_encode($doctor);
        }else{
            echo json_encode(['states' => 'error']);
        }
    }
}
if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents("php://input"), $_PUT);
    $doctorID = $_PUT['doctorID'];
    $fname = $_PUT['fname'];
    $lname = $_PUT['lname'];
    $email = $_PUT['email'];
    $gender = $_PUT['gender'];
    $age = $_PUT['age'];
    $role = $_PUT['role'];
    $pnumber = $_PUT['pnumber'];
    $snumber = $_PUT['snumber'];
    $sname = $_PUT['sname'];
    $city = $_PUT['city'];
    $hname = $_PUT['hname'];
    $hid = $_PUT['hid'];
    $update = mysqli_query($con,"UPDATE doctor SET Fisrt_name = '$fname' , Last_name = '$lname', email ='$email',Gender = '$gender',Age ='$age',Role ='$role',Phone_Number ='$pnumber',Street_Number='$snumber',Street_Name='$sname',City='$city',Hospital_Name ='$hname',	Hospital_ID='$hid' WHERE Doctor_id = '$doctorID' ");
    if($update){
        echo json_encode(['states' => 'update']);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    parse_str(file_get_contents("php://input"), $_DELETE);
    $doctorID = $_DELETE['doctorID'];
    $docDelete = mysqli_query($con, "DELETE FROM doctor WHERE Doctor_id='$doctorID' ");
    if($docDelete){
        echo json_encode(['states' => 'delete']);
    }
}