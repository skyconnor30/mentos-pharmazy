<?php 

include('functions.php');
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    try{
        if(isset($_FILES) && $_FILES['avatar']['error'] == UPLOAD_ERR_OK){
            $tempName = $_FILES['avatar']['tmp_name'];
            $fileName = $_FILES['avatar']['name'];
            $uploadDir = '../../assets/avatar/';
            $Hash_Password = password_hash($_POST['u_password'],PASSWORD_DEFAULT);

            // Check file extension (allow png,jpg,jpeg,gif)
            $allowType = ['png','jpg','jpeg','gif'];
            $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));

            if(in_array($fileType,$allowType)){
                // Move the uploaded file to the directory
                if(move_uploaded_file($tempName,$uploadDir.$fileName)){
                    $photoPath = $uploadDir.$fileName;
                    $stmt = $pdo->prepare("INSERT INTO users(u_username, u_name, email, address, phone, u_password, urole, avatar, gender) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bindParam(1,$_POST['u_username']);
                    $stmt->bindParam(2,$_POST['u_name']);
                    $stmt->bindParam(3,$_POST['email']);
                    $stmt->bindParam(4,$_POST['address']);
                    $stmt->bindParam(5,$_POST['phone']);
                    $stmt->bindParam(6,$Hash_Password);
                    $stmt->bindParam(7,$_POST['urole']);
                    $stmt->bindParam(8,$photoPath);
                    $stmt->bindParam(9,$_POST['gender']);
                    if($stmt->execute()){
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