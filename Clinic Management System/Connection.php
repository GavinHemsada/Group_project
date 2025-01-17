<?php
$con = new mysqli("localhost", "root", "", "eagel_eye_care");
if ($con->connect_error) {
   echo "error";
    exit();
}

