<?php
include "../../Connection.php";
header('Content-Type: application/json');
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $mail = $_POST['otp_email'];
    
    $stmt = $con->prepare("SELECT * FROM staff_details WHERE Email = ?");
    if (!$stmt) {
        echo json_encode(['status' => 'error']);
        exit();
    }
    $stmt->bind_param('s', $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        $_SESSION['mail'] = $mail;
        echo json_encode(["status"=> "success"]);
    } else {
        echo json_encode(['status' => 'fail']);
    }
    
    $stmt->close();
    $con->close();
    exit();
}

