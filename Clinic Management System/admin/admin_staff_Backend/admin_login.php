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
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];
    $_SESSION['email'] = $mail;
    $password = $_POST['password'];
    $sql = " SELECT Email, Password FROM staff_details WHERE Email = ? UNION SELECT Email, Password FROM admine WHERE Email = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $mail, $mail);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Password'])) { 
            echo json_encode(['status' => 'success' , "role" => "staff"]);
        } elseif($user['Password'] == $password){
            echo json_encode(['status' => 'success',"role" => "admin"]);
        }
        else {
            echo json_encode(["status" => "pass_error"]);
        }
    } else {
        echo json_encode(["status" => "email_error"]);
    }
}
?>

