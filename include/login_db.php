<?php
    session_start();
    include('functions.php');
    // header('Content-Type: application/json');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
        $Username = $_POST['u_username'];
        $Password = $_POST['u_password'];

        //change $_SESSION to JS validation

        // if(empty($Username)) {
        //     $_SESSION['warning_username'] = 'Please enter your username.';
        //     header("location: ../login.php");
        // }else if(empty($Password)) {
        //     $_SESSION['warning_password'] = 'Please enter your password.';
        //     header("location: ../login.php");
        // }else{
            try{
                $check_data = $pdo->prepare("SELECT * FROM users WHERE u_username = :u_username");
                $check_data->bindParam(":u_username", $Username);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if($check_data->rowCount() > 0) {
                    if($Username == $row['u_username']){
                        if(password_verify($Password,$row['u_password'])){
                            if($row['urole'] == 'admin'){//role admin
                                $_SESSION['admin_login'] = $row['uid'];//take session login from uid
                                // Set the cookie to expire 
                                setcookie('admin_login',$row['uid'],time()+ 3600*24,'/');
                                $_SESSION['success_login'] = 'success login';
                                echo "admin login";
                            }else{
                                $_SESSION['user_login'] = $row['uid'];//take session login from uid
                                // Set the cookie to expire 
                                setcookie('user_login',$row['uid'],time()+ 3600*24,'/');
                                $_SESSION['success_login'] = 'success login';
                                echo "user login";
                            }
                        }else{
                            echo "wrong password";
                        }
                    }else{
                        echo "wrong username";
                    }
                } else {
                    echo "no result found";
                }

            }catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    // }
?>