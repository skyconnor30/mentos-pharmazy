<?php
include('functions.php');
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    try{
        if(isset($_POST['approve'])){
            $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE ordID = ?");
            $stmt->bindParam(1,$_POST['status']);
            $stmt->bindParam(2,$_POST['approve']);
            $status = 'prepare';
            if($stmt->execute()){
                $delivery = $pdo->prepare("UPDATE delivery SET delivery_status = ? WHERE ordID = ?");
                $delivery->bindParam(1,$status);
                $delivery->bindParam(2,$_POST['approve']);
                if($delivery->execute()){
                    echo 'approved';
                }else{
                    echo 'error';
                }
                
            }else{
                echo 'error';
            }
        }elseif(isset($_POST['reapprove'])){
            $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE ordID = ?");
            $stmt->bindParam(1,$_POST['status']);
            $stmt->bindParam(2,$_POST['reapprove']);
            $status = 'wait for payment';
            if($stmt->execute()){
                $delivery = $pdo->prepare("UPDATE delivery SET delivery_status = ? WHERE ordID = ?");
                $delivery->bindParam(1,$status);
                $delivery->bindParam(2,$_POST['reapprove']);
                if($delivery->execute()){
                    echo 'reapproved';
                }else{
                    echo 'error';
                }
            }else{
                echo 'error';
            }
        }else if(isset($_POST['denied'])){
            $stmt = $pdo->prepare("DELETE FROM orders WHERE ordID = ?");
            $stmt->bindParam(1,$_POST['denied']);
            if($stmt->execute()){
                echo 'denied';
            }else{
                echo 'error';
            }
        }
    }catch(PDOException $e){
        $e->getMessage();
    }
}
?>