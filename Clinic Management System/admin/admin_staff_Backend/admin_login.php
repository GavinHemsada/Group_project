<?php
include "../../Connection.php";
header('Content-Type: application/json');
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];
    $_SESSION['email'] = $mail;
    $password = $_POST['password'];
    $sql = " SELECT Email, Password FROM staff_details WHERE Email = ? UNION SELECT Email, Password FROM admine WHERE Email = ? ";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ss', $mail, $mail);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['Password'])) { 
            echo json_encode(['status' => 'success' , "role" => "staff"]);
        } elseif($user['Password'] == $password){
            echo json_encode(['status' => 'success',"role" => "admin"]);
        }
        else {
            echo json_encode(["status" => "pass_error"]);
        }
    } else {
        echo json_encode(["status" => "email_error"]);
    }
}
?>

