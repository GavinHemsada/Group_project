<?php
header('Content-Type: application/json');
include "../../Connection.php";
session_start();
$mail = $_SESSION['email'];
$user = "";
$role_in = $_GET['role'];
if($role_in != 'admin'){
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM staff_details WHERE email = '$mail'"));
    $id = $user['Staff_id'];
}
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_FILES['upload_img'])){
        $fileTmpPath = $_FILES['upload_img']['tmp_name'];
        $fileExtension = pathinfo($_FILES['upload_img']['name'], PATHINFO_EXTENSION);
        $fileName = 'Staff'.'-'.$id.'.'.$fileExtension;
        $uploadFileDir = '../../images/Profile_img/Staff/';
        $dest_path = $uploadFileDir . $fileName;
        if (file_exists($dest_path)) {
            unlink($dest_path);
        }
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
          $query = "UPDATE staff_details SET Profile_photo = '$fileName' WHERE Staff_id = '$id' ";
          if (mysqli_query($con, $query)) {
            echo json_encode(['status' => 'success']);
          } else {
            echo json_encode(['status' => 'error']);
          }
        }
    }else{
        echo json_encode(['status' => 'type_error']);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'PUT'){
    parse_str(file_get_contents("php://input"), $_PUT);
    $fname = $_PUT['fname'];
    $lname = $_PUT['lname'];
    $email = $_PUT['email'];
    $age = $_PUT['age'];
    $role = $_PUT['role'];
    $gender = $_PUT['gender'];
    $phone = $_PUT['phone'];
    $snumber = $_PUT['snumber'];
    $sname = $_PUT['sname'];
    $city = $_PUT['city'];

    $query1 = "UPDATE staff_details SET 
            Fisrt_name = '$fname', 
            Last_name = '$lname', 
            Email = '$email',
            Age = '$age',
            Role = '$role', 
            Gender = '$gender', 
            Phone_Number = '$phone', 
            Street_Number = '$snumber', 
            Street_Name = '$sname', 
            City = '$city' 
            WHERE Staff_id = '$id'";
    if (mysqli_query($con, $query1)) {
        echo json_encode(['status' => 'details_add']);
    } else {
        echo json_encode(['status' => 'detals_notadd']);
    }
}
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if($user){
        echo json_encode($user);
    }else{
        echo json_encode(['states' => 'error']);
    }
}