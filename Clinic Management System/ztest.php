<?php
include "Connection.php";
$appointments_check = mysqli_query($con, "SELECT * FROM appointment WHERE Patient_id = 'P_EV1' and Date = '2024-09-30'and  Treatment_type = 'Eye Care'");
if(mysqli_num_rows($appointments_check)>0){
    echo mysqli_num_rows($appointments_check);
}else{
    echo "ba";
}