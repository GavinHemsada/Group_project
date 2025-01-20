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
include "../../Clinic Management System/Connection.php";
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mail = $_POST['mail'];
    $pnumber = $_POST['pnumber'];
    $snumber = $_POST['snumber'];
    $sname = $_POST['sname'];
    $city = $_POST['city'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $usertype = $_POST['userType'];
    $age = '';
    $role = '';
    $photo ='';
    $hospital_name = '';
    $hospital_id = '';
    if($usertype == 'patient'){
        $stmt = $con->prepare("SELECT * FROM patient WHERE email = ?");
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            echo json_encode(["status"=> "fail"]);
        } else {
            $stmt->close();
            $stmt3 = $con->prepare("SELECT COUNT(*) FROM patient");
            $stmt3->execute();
            $stmt3->bind_result($count);
            $stmt3->fetch();
            $count++;
            $patient_id = "P_EV$count";
            $stmt3->close();
    
            $stmt2 = $con->prepare("INSERT INTO patient (Patient_id, Fisrt_name,Last_name,email,Gender,password,Phone_Number,Street_Number,Street_Name,City,Profile_photo) VALUES (?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,?)");
            $stmt2->bind_param('sssssssssss',$patient_id,$fname,$lname, $mail,$gender,$password,$pnumber,$snumber,$sname,$city,$photo);
            if($stmt2->execute()){
                echo json_encode(['status' => 'success']);
            }else{
                echo json_encode(["status"=> "error"]);
            }
        }
    }elseif($usertype =='doctor'){
        $stmt = $con->prepare("SELECT * FROM doctor WHERE email = ?");
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if($result->num_rows > 0){
            echo json_encode(["status"=> "fail"]);
        } else {
            $stmt->close();
            $stmt3 = $con->prepare("SELECT COUNT(*) FROM doctor");
            $stmt3->execute();
            $stmt3->bind_result($count);
            $stmt3->fetch();
            $count++;
            $doctor_id = "D_EV$count";
            $stmt3->close();
  
            $stmt2 = $con->prepare("INSERT INTO doctor (Doctor_id, Fisrt_name,Last_name,email,Gender,Age,Role,Phone_Number,Street_Number,Street_Name,City,Password,Profile_photo,Hospital_Name,Hospital_ID) VALUES (?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,? ,? ,? ,? ,?)");
            $stmt2->bind_param('sssssisssssssss',$doctor_id,$fname,$lname, $mail,$gender,$age,$role,$pnumber,$snumber,$sname,$city,$password,$photo,$hospital_name,$hospital_id);
            if($stmt2->execute()){
                echo json_encode(['status' => 'success']);
            }else{
                echo json_encode(["status"=> "error"]);
            }
        }
    }
}