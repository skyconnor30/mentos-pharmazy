<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    include('include/functions.php');
    include('include/head.php');
    if (!isset($_GET['u_username'])) { //check session user login
        header("location: index.php");
    }
?>
<head>
    <link rel="stylesheet" href="style/user/changePass.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="style/user/changePass.js"></script>
</head>
<body>
    <header>
        <?php
        include('include\header.php');
        ?>
    </header>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM users WHERE u_username = :u_username");
    $stmt->bindParam(":u_username", $_GET['u_username']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <form class="card login-card-custom" action="include/updatepassword.php" method="post">
            <div class="title">Mentos Change Password</div>
            <?php if(isset($_SESSION['success_updated_pass'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'อัพเดทรหัสผ่านสำเร็จ',
                            showConfirmButton: false,
                            timer: 2000
                        })";
                        echo "</script>";
                        // echo $_SESSION['success_updated_pass'];
                        unset($_SESSION['success_updated_pass']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['error_updated_pass'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'พบข้อผิดพลาด!',
                            text: 'ไม่สามารถเปลี่ยนรหัสผ่านได้!',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['error_updated_pass'];
                        unset($_SESSION['error_updated_pass']); // unset session when refresh
                    ?>
            <?php endif?> 
            <?php if(isset($_SESSION['error_currentpass'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'พบข้อผิดพลาด!',
                            text: 'รหัสผ่านไม่ตรงกันกับรหัสผ่านปัจจุบันที่กรอกมา',
                            confirmButtonColor: '#3085d6'
                          })";
                        echo "</script>";
                        // echo $_SESSION['error_currentpass'];
                        unset($_SESSION['error_currentpass']); // unset session when refresh
                    ?>
            <?php endif?> 
            <div class="user-details">
                <div class="form-outline mb-3 inputbox" style="display: none;">
                    <label for="uid" class="form-label">Username ID</label>
                    <input type="text" class="form-control" name="uid" aria-describedby="uid" readonly value="<?= $row['uid'] ?>">
                </div>
                <div class="form-outline mb-3 currentpass">
                    <label for="u_password" class="form-label">รหัสผ่านปัจจุบัน</label>
                    <div id="showPass">
                        <input type="password" class="form-control" name="u_password" id="u_password" placeholder="กรอกรหัสผ่านปัจจุบัน">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="n_password" class="form-label">รหัสผ่านใหม่</label>
                    <div id="showNewPass">
                        <input type="password" class="form-control" name="n_password" id="n_password" placeholder="กรอกรหัสผ่านใหม่">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="c_password" class="form-label">ยืนยันรหัสผ่านใหม่</label>
                    <div id="showNewCPass">
                        <input type="password" class="form-control" name="n_password" id="c_password" placeholder="ยืนยันรหัสผ่านใหม่">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" name="u_updatepassword" id="updatepass" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">ยืนยัน</button>
        </form>
    </div>
</body>

</html>