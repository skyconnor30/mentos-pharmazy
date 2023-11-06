<?php 
    include('functions.php');
    session_start();
    // if(!isset($_SESSION['user_login'])){//check session user login
    //     echo "Not found";
    // }
?>
<head>
    <link rel="stylesheet" href="style/navbar/navbar.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https:////cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">  <!-- Datatable CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php"><img class="logo" src="assets/images/mentos.png" style="width: 250px;height:80px;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars text-white fa-lg"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">หน้าหลัก</a>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="store.php">รายการสินค้า</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-item nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    ประเภทสินค้า
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item drop" href="store.php?ptype=home-medicine">ยาสามัญประจำบ้าน</a></li>
                    <li><a class="dropdown-item drop" href="store.php?ptype=medical-supply">อุปกรณ์การเเพทย์</a></li>
                    <li><a class="dropdown-item drop" href="store.php?ptype=supplementary-food">อาหารเสริม</a></li>
                    <li><a class="dropdown-item drop" href="store.php?ptype=skin-care">สกินแคร์</a></li>
                </ul>
                </li>
                <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="about.php">เกี่ยวกับ</a>
                </li>
            </ul>
            <form class="d-flex p-3" action="store.php" method="post">
                <input class="form-control me-2" type="search" placeholder="ค้นหา" name="search" id="search" aria-label="Search" style="width: 30rem;">
                <button class="btn-search" type="submit">ค้นหา</button>
            </form>
            <?php if(!isset($_COOKIE['user_login'])):?>
                <?php session_destroy();?>
            <?php endif;?>
            <?php if(!isset($_SESSION['user_login'])):?>
                    <a class="btn btn-outline-info" style="margin-right: 15px;" href="login.php">เข้าสู่ระบบ</a>
                    <a class="btn btn-outline-info" style="margin-right: 15px;" href="register.php">สมัครสมาชิก</a>
            <?php endif;?>
            <?php if(isset($_SESSION['user_login'])):?>
                <a href="cartAdd.php"><i class="fa-solid fa-cart-shopping" style="color: white;margin-right: 0.5rem;"></i></a>
                <?php
                    $user_id = $_SESSION['user_login'];
                    $showName = $pdo->prepare("SELECT * FROM users WHERE uid = :user_id"); //search uid cuz session user_login use to uid
                    $showName->bindParam(":user_id", $user_id);
                    $showName->execute();
                    $row = $showName->fetch(PDO::FETCH_ASSOC);

                ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php if(isset($_SESSION['updated_path'])):?>
                        <img src="<?=$row['avatar']?>" class="rounded-circle" height="50" alt="Avatar" loading="lazy" />
                        <?php else:?>
                            <?php
                            $relativeAvatarPath = str_replace('../', '', $row['avatar']);
                            ?>
                            <img src="<?=$relativeAvatarPath?>" class="rounded-circle" height="50" width="50" alt="Avatar" loading="lazy" />
                        <?php endif;?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><span class="dropdown-item drop">ยินดีต้อนรับ, <?=$row['u_name']?></span></li>
                            <li><a class="dropdown-item drop" href="edituser.php?u_username=<?=$row['u_username']?>">โปรไฟล์</a></li>
                            <li><a class="dropdown-item drop" href="cartAdd.php">ตะกร้า</a></li>
                            <li><a class="dropdown-item drop" href="history.php">ประวัติการซื้อ</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item drop" href="changePass.php?u_username=<?=$row['u_username']?>">เปลี่ยนรหัสผ่าน</a></li>
                            <li><a class="dropdown-item drop" href="logout.php">ออกจากระบบ</a></li>
                        </ul>
                    </li>
                </ul>     
            <?php endif;?>
            </div>
        </div>
    </nav>
</body>