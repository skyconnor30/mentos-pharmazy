<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    session_start();
    include('functions.php');
    if(isset($_POST['u_updateinfo'])){//when hit button confirm
        $Uid = $_POST['uid'];
        // $Username = $_POST['u_username'];
        $Fullname = $_POST['u_name'];  
        $Email = $_POST['email'];
        $Address = $_POST['address'];
        $PhoneNum = $_POST['phone'];
   
        // Check if a file is uploaded for avatar
        $avatarPath = null; // Initialize avatar path as null

        $check_user = $pdo->prepare("SELECT * FROM users WHERE uid = :uid");
        $check_user->bindParam(":uid",$Uid);
        $check_user->execute();
        $row = $check_user->fetch(PDO::FETCH_ASSOC);
        $Username = $row['u_username'];

        //change $_SESSION to JS validation
        
        // if(empty($Fullname)) {
        //     $_SESSION['warning_name'] = 'Please enter your Full Name!';
        //     header("location: ../edituser.php?uid=$Uid");
        // }else if(empty($Email)) {
        //     $_SESSION['warning_email'] = 'Please enter your Email!';
        //     header("location: ../edituser.php?uid=$Uid");
        // }else if(empty($Address)){
        //     $_SESSION['warning_address'] = 'Please enter your Address!';
        //     header("location: ../edituser.php?uid=$Uid");
        // }else if(empty($PhoneNum)){
        //     $_SESSION['warning_phone'] = 'Please enter your Phone Number!';
        //     header("location: ../edituser.php?uid=$Uid");
        // }else{
            try{
                if($_FILES['avatar']['error'] === UPLOAD_ERR_OK){
                    var_dump($_FILES);
                    $tempName = $_FILES['avatar']['tmp_name'];
                    $fileName = $_FILES['avatar']['name'];
                    $uploadDir = '../assets/avatar/'; 
                    // Set permissions on the target directory
                    chmod($uploadDir . $fileName, 0644);

                    // Check file extension (allow png,jpg,jpeg,gif)
                    $allowType = ['png','jpg','jpeg','gif'];
                    $fileType = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
                    

                    if(in_array($fileType,$allowType)){
                        // Move the uploaded file to the directory
                        if(move_uploaded_file($tempName,$uploadDir.$fileName)){
                            $avatarPath = $uploadDir.$fileName;
                            // Update the avatar path in the database
                            $stmt = $pdo->prepare("UPDATE users SET avatar = :avatar WHERE uid = :uid");
                            $stmt->bindParam(":avatar",$avatarPath);
                            // var_dump($tempName);
                            $stmt->bindParam(":uid",$Uid);
                            if($stmt->execute()){
                                $_SESSION['updated_path'];//for replace new path on edituser.php
                                $_SESSION['success_updated'] = "Update Information Successfully.";
                                header("location: ../edituser.php?u_username=$Username");
                                exit;
                            }else{
                                $_SESSION['error_updated'] = "Failed to update user information.";
                                header("location: ../edituser.php?u_username=$Username");
                                exit;
                            }
                        }else{
                            $_SESSION['error_upload'] = "Failed to upload the avatar.";
                            header("location: ../edituser.php?u_username=$Username");
                            exit;
                        }
                    }else{
                        $_SESSION['error_type'] = "Invalid file type. Please upload a PNG,JPG,JPEG,GIF file.";
                        header("location: ../edituser.php?u_username=$Username");
                        exit;
                    }
                }

                //update user info
                $stmt = $pdo->prepare("UPDATE users SET u_name = :u_name, email = :email, address = :address, phone = :phone WHERE uid = :uid");
                $stmt->bindParam(":u_name",$Fullname);
                $stmt->bindParam(":email",$Email);
                $stmt->bindParam(":address",$Address);
                $stmt->bindParam(":phone",$PhoneNum);
                $stmt->bindParam(":uid",$Uid);
                $stmt->execute();
                if ($stmt->execute()){
                    $_SESSION['success_updated']="Update Information Successfully.";
                    header("location: ../edituser.php?u_username=$Username");
                    exit;
                }else{
                    $_SESSION['error_updated'] = "Failed to update user information.";
                    header("location: ../edituser.php?u_username=$Username");
                    exit;
                }

            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        
    // }
?>
