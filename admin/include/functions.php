<?php
    $servername = "localhost";
    $userdb = "root";
    $passdb = "";
    $dbname = "pharmazy";

    try{
        $pdo = new PDO("mysql:host=localhost; dbname=pharmazy; charset=utf8","root","");
        //set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo "Connection Failed".$e->getMessage();
    }
?>