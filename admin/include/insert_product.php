<?php
include("functions.php");
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){//send request from ajax 
    try{
        if (isset($_FILES['pimg']) && $_FILES['pimg']['error'] === UPLOAD_ERR_OK) {
            $tempName = $_FILES['pimg']['tmp_name'];
            $fileName = $_FILES['pimg']['name'];
            $uploadDir = '../../assets/product/';

            // Check file extension (allow png,jpg,jpeg,gif)
            $allowType = ['png','jpg','jpeg','gif'];
            $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
            if(in_array($fileType,$allowType)){
                // Move the uploaded file to the directory
                if(move_uploaded_file($tempName,$uploadDir.$fileName)){
                    $photoPath = $uploadDir.$fileName;
                    // Update the avatar path in the database
                    $stmt = $pdo->prepare("INSERT INTO product(pname,pdetail,price,ptype,plike,pimg,pquan_stock) VALUES(?,?,?,?,?,?,?);");
                    $stmt->bindParam(1,$_POST['pname']);
                    $stmt->bindParam(2,$_POST['pdetail']);
                    $stmt->bindParam(3,$_POST['price']);
                    $stmt->bindParam(4,$_POST['ptype']);
                    $stmt->bindParam(5,$_POST['plike']);
                    $stmt->bindParam(6,$photoPath);
                    $stmt->bindParam(7,$_POST['pquan_stock']);
                    if($stmt->execute()){
                        // echo "inserted";
                        echo "inserted";
                        exit;
                    }else{
                        echo "failed insert";
                        exit;
                    }
                }else{
                    echo "Failed to upload the photo.";
                    exit;
                }
            }else{
                echo "Invalid file type. Please upload a PNG,JPG,JPEG,GIF file.";
                exit;
            }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>