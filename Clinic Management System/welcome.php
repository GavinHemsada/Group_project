<?php
header('Content-Type: application/json');
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(empty($_SESSION)){
        echo json_encode(['status' => 'faile']);
    }else{
        echo json_encode(['status' => 'not']);
    }
}