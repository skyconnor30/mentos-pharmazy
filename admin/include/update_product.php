<?php
include('functions.php');
session_start();
$photoPath = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') { //send request from ajax 
    try {
        if (isset($_FILES['pimg']) && $_FILES['pimg']['error'] === UPLOAD_ERR_OK) {
            // var_dump($_FILES);
            $tempName = $_FILES['pimg']['tmp_name'];
            $fileName = $_FILES['pimg']['name'];
            $uploadDir = '../../assets/product/';
            // Set permissions on the target directory
            // chmod($uploadDir . $fileName, 0644);

            // Check file extension (allow png,jpg,jpeg,gif)
            $allowType = ['png','jpg','jpeg','gif'];
            $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

            if(in_array($fileType,$allowType)){
                // Move the uploaded file to the directory
                if(move_uploaded_file($tempName,$uploadDir.$fileName)){
                    $photoPath = $uploadDir.$fileName;
                    // Update the avatar path in the database
                    $stmt = $pdo->prepare("UPDATE product SET pimg = ? WHERE pid = ?");
                    $stmt->bindParam(1,$photoPath);
                    // var_dump($tempName);
                    $stmt->bindParam(2,$_POST['pid']);
                    if($stmt->execute()){
                        echo "Updated-photo";
                        exit;
                    }else{
                        echo "Failed to update.";
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
        } else {
            // Handle the case where no file was uploaded
            $stmt = $pdo->prepare("UPDATE `product` SET `pname`=?, `pdetail`=?, `price`=?, `ptype`=?, `plike`=?, `pquan_stock`=? WHERE pid = ?");
            $stmt->bindParam(1, $_POST['pname']);
            $stmt->bindParam(2, $_POST['pdetail']);
            $stmt->bindParam(3, $_POST['price']);
            $stmt->bindParam(4, $_POST['ptype']);
            $stmt->bindParam(5, $_POST['plike']);
            $stmt->bindParam(6, $_POST['pquan_stock']);
            $stmt->bindParam(7, $_POST['pid']);
            $stmt->execute();
            // Output success message
            echo "Updated.";
            exit;
        }
    } catch (PDOException $e) {
        // Handle any database update errors
        echo "Database update error: " . $e->getMessage();
    }
}
?>