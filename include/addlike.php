<?php
    include('functions.php');
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        try{
            if(isset($_GET['plike'])){
                // Get the current 'plike' value from the database
                $stmt = $pdo->prepare("SELECT plike FROM product WHERE pid = ?");
                $stmt->bindParam(1, $_GET['pid']);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $newPlike = intval($row['plike']) + 1; //method intval is return int from var

                // Update the 'plike' value in the database
                $updateStmt = $pdo->prepare("UPDATE product SET plike = ? WHERE pid = ?");
                $updateStmt->bindParam(1, $newPlike);
                $updateStmt->bindParam(2, $_GET['pid']);
                if($updateStmt->execute()){
                    echo "like plus updated";
                }else{
                    echo "failed to update like plus";
                }
            }
            elseif(isset($_GET['plikeminus'])){
                // Get the current 'plike' value from the database
                $stmt = $pdo->prepare("SELECT plike FROM product WHERE pid = ?");
                $stmt->bindParam(1, $_GET['pid']);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $newPlike = intval($row['plike']) - 1; //method intval is return int from var

                // Update the 'plike' value in the database
                $updateStmt = $pdo->prepare("UPDATE product SET plike = ? WHERE pid = ?");
                $updateStmt->bindParam(1, $newPlike);
                $updateStmt->bindParam(2, $_GET['pid']);
                if($updateStmt->execute()){
                    echo "like minus updated";
                }else{
                    echo "failed to update like minus";
                }
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }
?>