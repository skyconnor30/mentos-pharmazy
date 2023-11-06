<?php
include('functions.php');

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    try{
        if(isset($_POST['shipping'])){
            $stmt = $pdo->prepare("UPDATE delivery SET delivery_status = ? WHERE delivery_id = ?");
            $stmt->bindParam(1,$_POST['delivery_status']);
            $stmt->bindParam(2,$_POST['shipping']);
            if($stmt->execute()){
                echo "shipping";
            }else{
                echo "error";
            }
        }else if(isset($_POST['prepare'])){
            $stmt = $pdo->prepare("UPDATE delivery SET delivery_status = ? WHERE delivery_id = ?");
            $stmt->bindParam(1,$_POST['delivery_status']);
            $stmt->bindParam(2,$_POST['prepare']);
            if($stmt->execute()){
                echo "prepare";
            }else{
                echo "error";
            }
        }else if(isset($_POST['shipped'])){
            $stmt = $pdo->prepare("UPDATE delivery SET delivery_status = ? WHERE delivery_id = ?");
            $stmt->bindParam(1,$_POST['delivery_status']);
            $stmt->bindParam(2,$_POST['shipped']);
            if($stmt->execute()){
                echo "shipped";
            }else{
                echo "error";
            }
        }else if(isset($_POST['denied'])){
            $stmt = $pdo->prepare("DELETE FROM orders WHERE ordID = ?");
            $stmt->bindParam(1,$_POST['denied']);
            if($stmt->execute()){
                echo "denied";
            }else{
                echo "error";
            }
        }
    }catch(PDOException $e){
        $e->getMessage();
    }
}
?>