<?php
    require_once "../vendor/autoload.php";
    \App\region::getInstance(json_decode(file_get_contents("php://input"), true))->getRegion();
    
?>