<?php
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
    $mail->Username = 'gavinhemsada@gmail.com';
    $mail->Password = 'tlve xuxt hpeb texo';

    $mail->setFrom('gavinhemsada@gmail.com', 'Healing Hands');
    $mail->addAddress($usermail);
    $mail->addReplyTo('gavinhemsada@gmail.com', 'Information');

    $mail->isHTML(true);
    $mail->Subject = "Your OTP code";
    $mail->Body    = "Your OTP code is: $otp";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if($mail->send()){
        echo json_encode(['status' => 'success']);
    }else{
        echo json_encode(['status' => 'error']);
    }
