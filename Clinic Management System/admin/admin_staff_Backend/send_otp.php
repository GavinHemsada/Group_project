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
use PHPMailer\PHPMailer\PHPMailer;

require '../../../Clinic Management System/vendor/phpmailer/phpmailer/src/Exception.php';
require '../../../Clinic Management System/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../../../Clinic Management System/vendor/phpmailer/phpmailer/src/SMTP.php';

session_start();
$usermail = $_SESSION['mail'];
$otp = rand(10000, 99999); 
$_SESSION['otp'] = $otp;

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Port = 587;
    $mail->Username = 'exampel@gmail.com';
    $mail->Password = 'youer-password';

    $mail->setFrom('exampel@gmail.com', 'Healing Hands');
    $mail->addAddress($usermail);
    $mail->addReplyTo('exampel@gmail.com', 'Information');

    $mail->isHTML(true);
    $mail->Subject = "Your OTP code";
    $mail->Body    = "Your OTP code is: $otp";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
        echo json_encode(['status' => 'success']);
    }else{
        echo json_encode(['status' => 'error']);
    }
