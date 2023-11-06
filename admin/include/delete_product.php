<?php
    include('functions.php');
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $stmt = $pdo->prepare("DELETE FROM product WHERE pid = ?");
        $stmt->bindParam(1,$_POST['pid']);
        $stmt->execute();
        echo "deleted";
    }
?>