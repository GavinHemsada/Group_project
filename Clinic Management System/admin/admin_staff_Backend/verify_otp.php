<?php
header('Content-Type: application/json');
session_start(); 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $enteredOtp = $_POST['otp']; 
    $storedOtp = $_SESSION['otp']; 

    if ($enteredOtp == $storedOtp) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
}

