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
session_start();
include "../../../../../Clinic Management System/Connection.php";
$mail = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patient WHERE email = '$mail'"));
$id = $user['Patient_id'];
$subscriptions = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM subscriptions"),MYSQLI_ASSOC);
$patinet_subscriptions = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM patinet_subscriptions where Patient_ID ='$id' and States = 'active' "),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if($subscriptions){
        echo json_encode([$subscriptions,$patinet_subscriptions]);
    }else{
        echo json_encode(['states' => 'error_sub']);
    }
}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    $transaction_id = $data['transaction_id'];
    $amount = '$'.$data['amount'];
    $item_name = $data['item_name'];
    $item_type = $data['item_type'];
    $payment_date = $data['payment_date'];
    $states = 'active';
    
    if($item_type == 'Appointment'){
        $appointment = mysqli_query($con,"INSERT INTO payment (Payment_id,Date,Payment_type,Price,Patinet_id) value ('$transaction_id', '$payment_date','$item_name','$amount','$id')");
        if($appointment){
            echo json_encode(['states' => 'success_app']);
        }else{
            echo json_encode(['states' => 'error_app']);
        }
    }else{
        $send = mysqli_query($con,"INSERT INTO patinet_subscriptions (Patient_Sub_ID,Patient_ID,Sub_Type,Sub_name,Date,Sub_Price,States) value ('$transaction_id', '$id', '$item_type', '$item_name', '$payment_date', '$amount','$states')");
        if($send){
            echo json_encode(['states' => 'success_sub']);
        }else{
            echo json_encode(['states' => 'error_sub']);
        }
    }
    
}elseif($_SERVER['REQUEST_METHOD'] === 'PUT'){
    $subdate = $patinet_subscriptions[0]['Date'];
    $Sub_Type = $patinet_subscriptions[0]['Sub_Type'];
    $currentDate = date('Y-m-d');
    $subDateTime = new DateTime($subdate);
    $currentDateTime = new DateTime($currentDate);
    $sub_id =  $patinet_subscriptions[0]['Patient_Sub_ID'];

    $dateDifference = $currentDateTime->diff($subDateTime);

    $daysDifference = $dateDifference->days;

    if($Sub_Type == 'Monthly'){
        if($daysDifference >= 30){
            $query = "UPDATE patinet_subscriptions SET States = 'Expired' WHERE Patient_Sub_ID = '$sub_id' ";
            if(mysqli_query($con, $query)){
                echo json_encode(['states' => 'expired']);
            }
        }else{
            echo json_encode(['states' => 'active','message' =>$patinet_subscriptions]);
        }
    }elseif($Sub_Type == 'Annual'){
        if($daysDifference >= 365){
            $query = "UPDATE patinet_subscriptions SET States = 'Expired' WHERE Patient_Sub_ID = '$sub_id' ";
            if(mysqli_query($con, $query)){
                echo json_encode(['states' => 'expired']);
            }
        }else{
            echo json_encode(['states' => 'active','message' =>$patinet_subscriptions]);
        }
    }
    
}
