<?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    include('include/functions.php');
    include('include/head.php');
    if(!isset($_GET['u_username'])) { //check session user login if don't have redirect to index
        header("location: index.php");
    }
?>

<head>
    <link rel="stylesheet" href="style/user/edituser.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="style/user/edituser.js"></script>
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
        <form class="card login-card-custom" action="include/updateinfo.php" method="post" enctype="multipart/form-data">
            <div class="title">Mentos Info</div>
            <?php if(isset($_SESSION['error_type'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'พบข้อผิดพลาด!',
                            text: 'ประเภทไฟล์ผิด โปรดอัพโหลดรูปภาพในนามสกุล PNG,JPG,JPEG,GIF เท่านั้น',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        // echo $_SESSION['error_type'];
                        unset($_SESSION['error_type']); // unset session when refresh
                    ?>
            <?php endif?>
            <?php if(isset($_SESSION['error_upload'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'พบข้อผิดพลาด!',
                            text: 'อัพโหลดรูปโปรไฟล์ไม่สำเร็จ',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        
                        // echo $_SESSION['error_upload'];
                        unset($_SESSION['error_upload']); // unset session when refresh
                    ?>
            <?php endif?>
            <?php if(isset($_SESSION['error_updated'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            icon: 'error',
                            title: 'พบข้อผิดพลาด!',
                            text: 'อัพเดทข้อมูลผู้ใช้ไม่สำเร็จ.',
                            confirmButtonColor: '#3085d6'
                        })";
                        echo "</script>";
                        // echo $_SESSION['error_updated'];
                        unset($_SESSION['error_updated']); // unset session when refresh
                    ?>
            <?php endif?>  
            <?php if(isset($_SESSION['success_updated'])):?>
                    <?php
                        echo "<script>";
                        echo "Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'อัพเดทข้อมูลสำเร็จ',
                            showConfirmButton: false,
                            timer: 2000
                        })";
                        echo "</script>";
                        // echo $_SESSION['success_updated'];
                        unset($_SESSION['success_updated']); // unset session when refresh
                    ?>
            <?php endif?>
            <div class="img-center">
                    <?php if(isset($_SESSION['updated_path'])):?>
                    <img src="<?=$row['avatar'] ?>" class="rounded-circle" height="100" alt="Avatar" loading="lazy" />
                    <?php else:?>
                        <?php
                        // Remove the '../' part from the stored avatar path
                        $relativeAvatarPath = str_replace('../', '', $row['avatar']);
                        // echo $relativeAvatarPath;
                        // var_dump($relativeAvatarPath); //check path
                        ?>
                        <img src="<?=$relativeAvatarPath ?>" class="rounded-circle" height="130" width="130" alt="Avatar" loading="lazy" />
                    <?php endif;?>
            </div>
            <div class="user-details">
                <div class="form-outline mb-3 inputbox" style="display: none;">
                    <label for="uid" class="form-label">ID ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" name="uid" aria-describedby="uid" readonly value="<?= $row['uid'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="u_username" class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" name="u_username" aria-describedby="u_username" disabled readonly value="<?= $row['u_username'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="u_name" class="form-label">ชื่อ - นามสกุล</label>
                    <input type="text" class="form-control" name="u_name" id="u_nameup" aria-describedby="u_name" placeholder="กรอกชื่อ - นามสกุล" value="<?= $row['u_name'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="email" class="form-label">อีเมล์</label>
                    <input type="text" class="form-control" name="email" id="emailup" aria-describedby="email" placeholder="กรอกอีเมล์" value="<?= $row['email'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="address" class="form-label">ที่อยู่</label>
                    <textarea class="form-control" name="address" id="addressup" aria-describedby="address" placeholder="กรอกที่อยู่"><?= $row['address'] ?></textarea>
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" name="phone" id="phoneup" aria-describedby="phone" placeholder="กรอกเบอร์โทรศัพท์" value="<?= $row['phone'] ?>">
                </div>
                <div class="form-outline mb-3 inputbox">
                    <label label class="form-label">รูปโปรไฟล์</label>
                    <input class="form-control" type="file" id="formFile" name="avatar" accept="images/gif, image/jpeg, image/jpg, image/png">
                </div>
                <!-- <div class="form-outline mb-3 inputbox">
                    <label for="u_password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="u_password" placeholder="Enter your password">
                </div> -->
            </div>
            <button type="submit" name="u_updateinfo" id="updateinfo" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">ยืนยัน</button>
        </form>
    </div>
</body>

</html>