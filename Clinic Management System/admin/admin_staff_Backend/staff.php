<?php
include "../../Connection.php";
$staff = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM staff_details"),MYSQLI_ASSOC);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if($staff){
        echo json_encode($staff);
    }else{
        echo json_encode(['states' => 'error']);
    }
}