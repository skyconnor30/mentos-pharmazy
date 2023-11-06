<?php
    include('functions.php');
    session_start();
    $photoPath = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //send request from ajax 
        try{
            if(isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK){
                $tempName = $_FILES['avatar']['tmp_name'];
                $fileName = $_FILES['avatar']['name'];
                $uploadDir = '../../assets/avatar/';

                // Check file extension (allow png,jpg,jpeg,gif)
                $allowType = ['png','jpg','jpeg','gif'];
                $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
                if(in_array($fileType,$allowType)){
                    // Move the uploaded file to the directory
                    if(move_uploaded_file($tempName,$uploadDir.$fileName)){
                        $photoPath = $uploadDir.$fileName;
                        // Update the avatar path in the database
                        $stmt = $pdo->prepare("UPDATE users SET avatar = ? WHERE uid = ?");
                        $stmt->bindParam(1,$photoPath);
                        $stmt->bindParam(2,$_POST['uid']);
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
            }else{
                // Handle the case where no file was uploaded
                $stmt = $pdo->prepare("UPDATE users SET u_username = ?, u_name = ?, email = ?, address = ?, phone = ?, gender = ? WHERE uid = ?");
                $stmt->bindParam(1,$_POST['u_username']);
                $stmt->bindParam(2,$_POST['u_name']);
                $stmt->bindParam(3,$_POST['email']);
                $stmt->bindParam(4,$_POST['address']);
                $stmt->bindParam(5,$_POST['phone']);
                $stmt->bindParam(6,$_POST['gender']);
                $stmt->bindParam(7,$_POST['uid']);
                $stmt->execute();
                echo "Updated.";
                exit;
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
?>