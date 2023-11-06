<?php
    include('functions.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stmt = $pdo->prepare("DELETE FROM users WHERE uid = ? ");
        $stmt->bindParam(1,$_POST['uid']);
        // echo $_POST['uid'];
        if($stmt->execute()){
            echo "deleted";
            // var_dump($stmt->execute());
        }else{
            echo "error";
        }
    }
?>