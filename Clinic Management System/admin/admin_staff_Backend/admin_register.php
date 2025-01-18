<?php
include "../../Connection.php";
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mail = $_POST['mail'];
    $pnumber = $_POST['pnumber'];
    $snumber = $_POST['snumber'];
    $sname = $_POST['sname'];
    $city = $_POST['city'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    $stmt = $con->prepare("SELECT * FROM staff_details WHERE Email = ?");
    $stmt->bind_param('s', $mail);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0){
        echo json_encode(["status"=> "fail"]);
    } else {
        $stmt->close();
        $stmt3 = $con->prepare("SELECT COUNT(*) FROM staff_details");
        $stmt3->execute();
        $stmt3->bind_result($count);
        $stmt3->fetch();
        $count++;
        $staff_id = "S_EV$count";
        $stmt3->close();

        $stmt2 = $con->prepare("INSERT INTO staff_details (Staff_id, Fisrt_name,Last_name,Email,Age,Role, Gender,Phone_Number,Street_Number,Street_Name,City,Password) VALUES (?, ?, ?, ?, ?, ?, ? ,? ,? ,? ,? ,?)");
        $stmt2->bind_param('ssssisssssss',$staff_id,$fname,$lname, $mail,$age,$role,$gender,$pnumber,$snumber,$sname,$city,$password);
        if($stmt2->execute()){
            echo json_encode(['status' => 'success']);
        }else{
            echo json_encode(["status"=> "error"]);
        }
    }
}