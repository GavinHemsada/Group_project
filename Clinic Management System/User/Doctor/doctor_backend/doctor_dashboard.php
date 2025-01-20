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
include "../../../../Clinic Management System/Connection.php";
session_start();
$currentDate = date('Y-m-d');
$mail = $_SESSION['email'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM doctor WHERE email = '$mail'"));
$id = $user['Doctor_id'];
$upcommingapp = mysqli_fetch_all(mysqli_query($con, "SELECT COUNT(*) AS upcount FROM appointment WHERE Doctor_id = '$id' and Date >= '$currentDate' "),MYSQLI_ASSOC);
$completeapp = mysqli_fetch_all(mysqli_query($con, "SELECT COUNT(*) AS comcount FROM appointment WHERE Doctor_id = '$id' and Date < '$currentDate' "),MYSQLI_ASSOC);
$appointment_his = mysqli_fetch_all(mysqli_query($con, "SELECT * FROM appointment WHERE Doctor_id = '$id'"),MYSQLI_ASSOC);
$appcount = mysqli_fetch_all(mysqli_query($con,"SELECT months.month AS appointment_month, 
       COALESCE(appointment_data.total_appointments, 0) AS total_appointments
FROM (
    SELECT 'Jan' AS month UNION ALL
    SELECT 'Feb' UNION ALL
    SELECT 'Mar' UNION ALL
    SELECT 'Apr' UNION ALL
    SELECT 'May' UNION ALL
    SELECT 'Jun' UNION ALL
    SELECT 'Jul' UNION ALL
    SELECT 'Aug' UNION ALL
    SELECT 'Sep' UNION ALL
    SELECT 'Oct' UNION ALL
    SELECT 'Nov' UNION ALL
    SELECT 'Dec'
) AS months
LEFT JOIN (
    SELECT DATE_FORMAT(Date, '%b') AS appointment_month, 
           COUNT(*) AS total_appointments
    FROM appointment
    WHERE Doctor_id = '$id'
    GROUP BY appointment_month
) AS appointment_data
ON months.month = appointment_data.appointment_month"),MYSQLI_ASSOC);

$payment = mysqli_fetch_all(mysqli_query($con,"SELECT months.month AS appointment_month, 
       COALESCE(SUM(appointment_data.total_cost), 0) AS total_cost
FROM (
    SELECT 'Jan' AS month, 1 AS month_number UNION ALL
    SELECT 'Feb', 2 UNION ALL
    SELECT 'Mar', 3 UNION ALL
    SELECT 'Apr', 4 UNION ALL
    SELECT 'May', 5 UNION ALL
    SELECT 'Jun', 6 UNION ALL
    SELECT 'Jul', 7 UNION ALL
    SELECT 'Aug', 8 UNION ALL
    SELECT 'Sep', 9 UNION ALL
    SELECT 'Oct', 10 UNION ALL
    SELECT 'Nov', 11 UNION ALL
    SELECT 'Dec', 12
) AS months
LEFT JOIN (
    SELECT DATE_FORMAT(Date, '%b') AS appointment_month, 
           SUM(CAST(REPLACE(Price, '$', '') AS DECIMAL(10, 2))) AS total_cost
    FROM appointment
    WHERE Doctor_id = '$id'
    GROUP BY appointment_month
) AS appointment_data
ON months.month = appointment_data.appointment_month
GROUP BY months.month
ORDER BY months.month_number
"),MYSQLI_ASSOC);

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if($user){
        echo json_encode([$upcommingapp,$completeapp,$appcount,$payment]);
    }else{
        echo json_encode(['states' => 'error']);
    }
}