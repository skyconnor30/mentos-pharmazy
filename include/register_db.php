<?php 
    session_start();
    include('functions.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //when hit button sighup
        $Fullname = $_POST['u_name'];
        $Username = $_POST['u_username'];
        $Email = $_POST['email'];
        $Address = $_POST['address'];
        $PhoneNum = $_POST['phone'];
        $Password = $_POST['u_password'];
        $Gender = $_POST['gender'];
        $Urole = 'user';
        $defaultAvatars = [ //set default avatar url
            'male' => 'assets/avatar/male.png',
            'female' => 'assets/avatar/female.png',
        ];

        if(isset($Gender) && array_key_exists($Gender,$defaultAvatars)){//check if $Gender equal $defaultAvatars take url avatar to new var
            $Avatar = $defaultAvatars[$Gender];
        } 
            try{
                $check_user = $pdo->prepare("SELECT u_username FROM users WHERE u_username = :u_username"); // search username
                $check_user->bindParam(":u_username", $Username);
                $check_user->execute();
                $row = $check_user->fetch(PDO::FETCH_ASSOC);

                if($row !== false && $row !== null){
                    echo 'username already exist';
                }else{
                    $passwordHash = password_hash($Password, PASSWORD_DEFAULT);
                    $stmt = $pdo->prepare("INSERT INTO users(u_name, u_username, email, address, phone, u_password, gender, urole, avatar) 
                                            VALUES(:u_name, :u_username, :email, :address, :phone, :u_password, :gender, :urole, :avatar)");
                    $stmt->bindParam(":u_name", $Fullname);
                    $stmt->bindParam(":u_username", $Username);
                    $stmt->bindParam(":email", $Email);
                    $stmt->bindParam(":address", $Address);
                    $stmt->bindParam(":phone", $PhoneNum);
                    $stmt->bindParam(":u_password", $passwordHash);
                    $stmt->bindParam(":gender", $Gender);
                    $stmt->bindParam(":urole", $Urole);
                    $stmt->bindParam(":avatar", $Avatar);
                    if($stmt->execute()){
                        echo 'registered';
                    }else{
                        echo 'registered failed';
                    } 
                }

            }catch(PDOException $e) {
                echo $e->getMessage();
            }
    }
    // }
?>