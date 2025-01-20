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
$service = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM service"),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $serviceID =isset($_GET['serviceID'])?$_GET['serviceID']:"";
    if($serviceID != ""){
        $serviceForEdit = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM service WHERE Service_id='$serviceID'"));
        echo json_encode($serviceForEdit);
    }else{
        if($service){
            echo json_encode($service);
        }else{
            echo json_encode(['states' => 'error']);
        }
    }
}
if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents("php://input"), $_PUT);
    $serviceID = $_PUT['serviceID'];
    $sname = $_PUT['sname'];
    $photo = $_PUT['photo'];
    $discription =  mysqli_real_escape_string($con, $_PUT['discription']);
    $price = $_PUT['price'];
    $update = mysqli_query($con,"UPDATE service SET Service_Name = '$sname' , Photo = '$photo', Description ='$discription', Price = '$price' WHERE Service_id = '$serviceID' ");
    if($update){
        echo json_encode(['states' => 'update']);
    }else{
        echo json_encode(['states' => mysqli_error($con)]);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE'){
    parse_str(file_get_contents("php://input"), $_DELETE);
    $serviceID = $_DELETE['serviceID'];
    $serviceDelete = mysqli_query($con, "DELETE FROM service WHERE Service_id='$serviceID' ");
    if($serviceDelete){
        echo json_encode(['states' => 'delete']);
    }
}