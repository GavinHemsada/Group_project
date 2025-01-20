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
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mail = $_POST['mail'];
    $pnumber = $_POST['pnumber'];
    $snumber = $_POST['snumber'];
    $sname = $_POST['sname'];
    $city = $_POST['city'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $stmt = $con->prepare("SELECT * FROM staff_details WHERE Email = ?");
    $stmt->bind_param('s', $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        echo json_encode(["status"=> "fail"]);
    } else {
        $stmt->close();
        $stmt3 = $con->prepare("SELECT COUNT(*) FROM staff_details");
        $stmt3->execute();
        $stmt3->bind_result($count);
        $stmt3->fetch();
        $count++;
        $staff_id = "S_EV$count";
        $stmt3->close();

        $stmt2 = $con->prepare("INSERT INTO staff_details (Staff_id, Fisrt_name,Last_name,Email,Age,Role, Gender,Phone_Number,Street_Number,Street_Name,City,Password) VALUES (?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,? ,?)");
        $stmt2->bind_param('ssssisssssss',$staff_id,$fname,$lname, $mail,$age,$role,$gender,$pnumber,$snumber,$sname,$city,$password);
        if($stmt2->execute()){
            echo json_encode(['status' => 'success']);
        }else{
            echo json_encode(["status"=> "error"]);
        }
    }
}