<?php 
    require './vendor/autoload.php';

    date_default_timezone_set("Asia/Tokyo");
    
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
?>