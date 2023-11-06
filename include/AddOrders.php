<?php include("functions.php"); 
session_start();
    if(!isset($_SESSION['user_login'])){
        $_SESSION['buyfailed'] = 'not login';
        header("location: ../store.php");
    }else{
        if(isset($_POST['Orders'])){
            $countOrders = $pdo->prepare("SELECT COUNT(*) as order_count FROM orders");
            $countOrders->execute();
            $orderCount = $countOrders->fetchColumn();
            $orderNo = $orderCount + 1;
            $firstPid = 'Order#'.$orderNo;
            $ship = 'wait for payment';
            $addOrder = $pdo->prepare("INSERT INTO orders (ordName,status,amount) VALUES (?,?,?)");
            $addOrder->bindParam(1,$firstPid);
            $status = "wait";
            $amount = $_POST['total_sum'];
            // echo $_POST['quan_dummy'];
            $addOrder->bindParam(2,$status);
            $addOrder->bindParam(3,$amount);
            $addOrder->execute();
            $orderId = $pdo->lastInsertId();
            $insertDelivery = $pdo->prepare("INSERT INTO delivery (uid, ordID, delivery_type, delivery_price, delivery_status) VALUES(?, ?, ?, ?, ?)");
            $insertDelivery->bindParam(1,$_SESSION['user_login']);
            $insertDelivery->bindParam(2,$orderId);
            $insertDelivery->bindParam(3,$_POST['delivery_type']);
            $insertDelivery->bindParam(4,$_POST['delivery_price']);
            $insertDelivery->bindParam(5,$ship);
            $insertDelivery->execute();
            $insertOrderDetail = $pdo->prepare("INSERT INTO order_detail (uid, qty, ordID, pid) VALUES (?, ?, ?, ?)");
            $insertOrderDetail->bindParam(1,$_SESSION['user_login']);
            $insertOrderDetail->bindParam(2,$_POST['quan_dummy']);
            $insertOrderDetail->bindParam(3,$orderId);
            $insertOrderDetail->bindParam(4,$_POST['pid']);
            $qty = $_POST['quan_dummy'];
            $pid = $_POST['pid'];
            if($insertOrderDetail->execute()){
                $stmt = $pdo->prepare("SELECT pquan_stock FROM product WHERE pid = ?");
                $stmt->bindParam(1,$pid);
                $stmt->execute();
                $stock = $stmt->fetch(PDO::FETCH_ASSOC);
                $update_stock = $stock['pquan_stock'] - $qty;
                $new_stock = $pdo->prepare("UPDATE product SET pquan_stock = ? WHERE pid = ?");
                $new_stock->bindParam(1,$update_stock);
                $new_stock->bindParam(2,$pid);
                $new_stock->execute();
                // echo $pid;
                // echo $qty;
            }
    
            header("location: ../history.php");
        }else{
            header("location: ../history.php");
        }
    }
    
?>