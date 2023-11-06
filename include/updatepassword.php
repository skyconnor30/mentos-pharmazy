<?php
    session_start();
    include('functions.php');

    if(isset($_POST['u_updatepassword'])){
        $Uid = $_POST['uid'];
        $Password = $_POST['u_password'];
        $Npassword = $_POST['n_password'];
        $CNpassword = $_POST['cn_password'];

        $check_user = $pdo->prepare("SELECT * FROM users WHERE uid = :uid");
        $check_user->bindParam(":uid",$Uid);
        $check_user->execute();
        $row = $check_user->fetch(PDO::FETCH_ASSOC);
        $Username = $row['u_username'];

        //change $_SESSION to JS validation

        // if(empty($Password)){
        //     $_SESSION['warning_password'] = 'Please enter your current password';
        //     header("location: ../changePass.php?uid=$Uid");
        // }
        // else if(empty($Npassword)){
        //     $_SESSION['warning_newpass'] = 'Please enter your new password';
        //     header("location: ../changePass.php?uid=$Uid");
        // }
        // else if(empty($CNpassword)){
        //     $_SESSION['warning_cnewpass'] = 'Please enter your confirm new password';
        //     header("location: ../changePass.php?uid=$Uid");
        // }
        // else if($Npassword != $CNpassword){
        //     $_SESSION['warning_innewpass'] = 'New pass word not match!';
        //     header("location: ../changePass.php?uid=$Uid");
        // }else{
             
            try{
                $stmt = $pdo->prepare("SELECT * FROM users WHERE uid = :uid");
                $stmt->bindParam(":uid",$Uid);
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                $passwordHash = password_hash($Npassword, PASSWORD_DEFAULT); // hash new password
                if(password_verify($Password,$row['u_password'])){ //check password input and password hash in database if return true just update new password hash
                    $update_pass = $pdo->prepare("UPDATE users SET u_password = :u_password WHERE uid = :uid");
                    $update_pass->bindParam(":u_password",$passwordHash);
                    $update_pass->bindParam(":uid",$Uid);
                    // $update_pass->execute();
                    if($update_pass->execute()){
                        $_SESSION['success_updated_pass']="Update Password Successfully.";
                        // var_dump(password_verify($Password,$row['u_password']));
                        // var_dump($passwordHash);
                        // echo "true";
                        header("location: ../changePass.php?u_username=$Username");
                        exit;
                    }else{
                        $_SESSION['error_updated_pass'] = "Failed to update password.";
                        header("location: ../changePass.php?u_username=$Username");
                        exit;
                    }
                }else{
                    $_SESSION['error_currentpass'] = 'Current password not match in data!';
                    // var_dump(password_verify($Password,$row['u_password']));
                    // var_dump($passwordHash);
                    header("location: ../changePass.php?u_username=$Username");
                    // echo "false";
                    exit;
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
    // }
?>