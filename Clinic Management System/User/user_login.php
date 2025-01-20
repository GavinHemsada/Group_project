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
    session_start();
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $usertype = $_POST['userType'];
    $_SESSION['email'] = $mail;
    if($usertype == 'patient'){
        $stmt = $con->prepare("SELECT * FROM patient WHERE email = ?");
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])){
                echo json_encode(['status' => 'success_p']);
            }else{
                echo json_encode(["status"=> "pass_error"]);
            }
        } else {
            echo json_encode(["status"=> "email_error"]);
        }
    }elseif($usertype =='doctor'){
        $stmt = $con->prepare("SELECT * FROM doctor WHERE email = ?");
        $stmt->bind_param('s', $mail);
        $stmt->execute();
        $result = $stmt->get_result(); 
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])){
                echo json_encode(['status' => 'success_d']);
            }else{
                echo json_encode(["status"=> "pass_error"]);
            }
        } else {
            echo json_encode(["status"=> "email_error"]);
        }
    }
}