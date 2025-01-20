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
$sub_payments = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM patinet_subscriptions"),MYSQLI_ASSOC);
$payments = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM payment"),MYSQLI_ASSOC);
$sub_plane = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM subscriptions"),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $paymentID =isset($_GET['paymentID'])?$_GET['paymentID']:null;
    $subPlanID = isset($_GET['subPlanID'])?$_GET['subPlanID']:null;
    if(!empty($paymentID)){
        $spaymentForEdit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patinet_subscriptions WHERE Patient_Sub_ID='$paymentID'"));
        echo json_encode($spaymentForEdit);
        exit();
    }
    if(!empty($subPlanID)){
        $sub = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM subscriptions WHERE Sub_ID='$subPlanID'"));
        echo json_encode($sub);
        exit();
    }
    if($sub_payments){
        echo json_encode([$sub_payments,$payments,$sub_plane]);
        exit();
    }else{
        echo json_encode(['states' => 'error']);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents("php://input"), $_PUT);
    $paymentID = isset($_PUT['paymentID']) ? $_PUT['paymentID'] : null;
    $subPlanID = isset($_PUT['subPlanID']) ? $_PUT['subPlanID'] : null;
    if(!empty($paymentID)){
        $id = $_PUT['id'];
        $type = $_PUT['type'];
        $name =  $_PUT['name'];
        $date = $_PUT['date'];
        $price = $_PUT['price'];
        $states = $_PUT['states'];
        $update = mysqli_query($con,"UPDATE patinet_subscriptions SET Patient_ID = '$id' , Sub_Type = '$type', Sub_name ='$name', Date = '$date',Sub_Price='$price',States='$states' WHERE Patient_Sub_ID = '$paymentID' ");
        if($update){
            echo json_encode(['states' => 'update']);
            exit();
        }
    }
    if (!empty($subPlanID)) {
        $type = $_PUT['type'];
        $price = $_PUT['price'];
        $usage = mysqli_real_escape_string($con, $_PUT['usage']);

        $query = "UPDATE subscriptions SET Type = '$type', Price = '$price', `Usage` = '$usage' WHERE Sub_ID = '$subPlanID'";
        $update = mysqli_query($con, $query);
    
        if ($update) {
            echo json_encode(['states' => 'update']);
            exit();
        } else {
            echo json_encode(['states' => 'sub', 'message' => mysqli_error($con), 'query' => $query]);
        }
    }
    
   
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    parse_str(file_get_contents("php://input"), $_DELETE);
    $paymentID = $_DELETE['paymentID'];
    $paymentDelete = mysqli_query($con, "DELETE FROM patinet_subscriptions WHERE Patient_Sub_ID='$paymentID' ");
    if($paymentDelete){
        echo json_encode(['states' => 'delete']);
        exit();
    }
}