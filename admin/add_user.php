<?php
include('..\include\head.php');
include('include\functions.php');
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("location: ../index.php");
}
?>

<head>
    <link rel="stylesheet" href="style/admin/add_user.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="style/admin/add_user.js"></script>
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->bindParam(1, $_SESSION['admin_login']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar Starts here -->
        <div class="bg-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase">
                <i class="fa-solid fa-house-medical fa-xs"></i> Admin Mentos <!-- Sidebar Header -->
            </div>
            <div class="list-group list-group-flush my-3">
                <ul class="sidebar-nav">
                    <li class="sidebar-item">
                        <a href="admin.php" class="sidebar-link">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            <span style="margin-left: .1rem;">ภาพรวม</span>
                        </a>
                        <hr>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages" aria-expanded="false" aria-controls="pages">
                            <i class="fa-solid fa-store"></i>
                            <span style="margin-left: .5rem;">ร้านค้า</span>
                        </a>
                        <ul id="pages" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="product.php" class="sidebar-link">คลังสินค้า</a>
                            </li>
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="add_product.php" class="sidebar-link">เพิ่มสินค้า</a>
                            </li>
                        </ul>
                        <hr>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth" aria-expanded="false" aria-controls="auth">
                            <i class="fa-solid fa-user pe-2"></i>
                            สมาชิก
                        </a>
                        <ul id="auth" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="user_manage.php" class="sidebar-link">จัดการผู้ใช้</a>
                            </li>
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="admin_manage.php" class="sidebar-link">จัดการแอดมิน</a>
                            </li>
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="add_user.php" class="sidebar-link">เพิ่มสมาชิก</a>
                            </li>
                        </ul>
                        <hr>
                    </li>
                    <li class="sidebar-item">
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#order"
                            aria-expanded="false" aria-controls="order">
                            <i class="fa-solid fa-capsules"></i>
                            คำสั่งซื้อ
                        </a>
                        <ul id="order" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="order_manage.php" class="sidebar-link">การชำระเงิน</a>
                            </li>
                            <li class="sidebar-item" style="margin-top: 1.1rem;">
                                <a href="delivery_manage.php" class="sidebar-link">การจัดส่ง</a>
                            </li>
                        </ul>
                        <hr>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Sidebar Ends here -->

        <div class="page-content-wrapper" style="width: 100%;">
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <!-- icon bar -->
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0"><a href="admin.php" style="text-decoration: none;color: #24252A;">สมาชิก</a> / เพิ่มสมาชิก</h2>
                </div>
                <!-- button for dropdown admin info -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle second-text fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user me-2"></i><?= $row['u_username'] ?>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><span class="dropdown-item">ยินดีต้อนรับ, <?= $row['u_name'] ?></span></li>
                                <li><a class="dropdown-item" href="user_detail.php?uid=<?=$row['uid']?>">โปรไฟล์</a></li>
                                <li><a class="dropdown-item" href="include/logout_admin.php">ออกจากระบบ</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <hr>
            <div class="container-custom">
                <div id="notification" style="display: none;"></div>
                <form class="card login-card-custom border-info" method="post" enctype="multipart/form-data" id="formaddUser">
                    <div class="title">เพิ่มข้อมูลสมาชิก</div>
                    <div class="user-details">
                        <div class="form-outline mb-3 inputbox">
                            <label for="u_name" class="form-label">ชื่อ - นามสกุล</label>
                            <input type="text" class="form-control" name="u_name" id="u_name" aria-describedby="u_name" placeholder="กรอกชื่อ - นามสกุล">
                        </div>
                        <div class="form-outline inputbox">
                            <label for="u_username" class="form-label">ชื่อผู้ใช้</label>
                            <input type="text" class="form-control" name="u_username" id="u_username" aria-describedby="u_username" placeholder="กรอกชื่อผู้ใช้">
                        </div>
                        <div class="form-outline inputbox">
                            <label for="email" class="form-label">อีเมล์</label>
                            <input type="text" class="form-control" name="email" id="email" aria-describedby="email" placeholder="กรอกอีเมล์">
                        </div>
                        <div class="form-outline inputbox">
                            <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phone" placeholder="กรอกเบอร์โทรศัพท์">
                        </div>
                        <div class="form-outline inputbox textbox" style="margin-bottom: 30px;">
                            <label for="address" class="form-label">ที่อยู่</label>
                            <textarea class="form-control" name="address" aria-describedby="address" id="address" placeholder="กรอกที่อยู่"></textarea>
                        </div>
                        <div class="form-outline inputbox">
                            <label for="u_password" class="form-label">รหัสผ่าน</label>
                            <div id="showPass">
                                <input type="password" class="form-control" name="u_password" id="u_password" placeholder="กรอกรหัสผ่าน">
                                <div class="field-icon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-outline inputbox">
                            <label for="c_password" class="form-label">ยืนยันรหัสผ่าน</label>
                            <div id="showConfirmPass">
                                <input type="password" class="form-control" name="c_password" id="c_password" placeholder="ยืนยันรหัสผ่าน">
                                <div class="field-icon">
                                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="form-outline mb-3 inputbox">
                            <label for="urole" class="form-label">ประเภทผู้ใช้</label>
                            <select class="form-control" name="urole" id="urole">
                                <option value="">เลือกประเภทผู้ใช้งาน</option>
                                <option value="user">ผู้ใช้ทั่วไป</option>
                                <option value="admin">แอดมิน</option>
                            </select>
                        </div>
                        <div class="form-outline mb-3 inputbox">
                            <label class="form-label">รูปโปรไฟล์</label>
                            <input class="form-control" type="file" id="avatar" name="avatar" accept="image/gif, image/jpeg, image/jpg, image/png">
                        </div>
                        <div class="form-outline radio mb-3 inputbox inputgender">
                            <div class="mb-2">
                                <label for="gender">เพศ</label>
                            </div>
                            <div>
                                <label>
                                    <input type="radio" name="gender" value="male" aria-describedby="gender">
                                    ชาย
                                </label>
                                <label>
                                    <input type="radio" name="gender" value="female" aria-describedby="gender">
                                    หญิง
                                </label>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="user_add" id="user_add" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">ยืนยัน</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="style/sidebar/sidebar.js"></script>
</body>

</html>