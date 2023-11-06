<?php
include('..\include\head.php');
include('include\functions.php');
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("location: ../index.php");
}
?>

<head>
    <link rel="stylesheet" href="style/admin/product_detail.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"> <!-- Datatable CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="style/admin/update_product.js"></script>
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
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#pages"
                            aria-expanded="false" aria-controls="pages">
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
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#auth"
                            aria-expanded="false" aria-controls="auth">
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
            <?php
            $stmt = $pdo->prepare("SELECT * FROM `product` WHERE pid = ?;");
            $stmt->bindParam(1, $_POST['pid']);
            $stmt->execute();
            $product = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
                <div class="d-flex align-items-center">
                    <!-- icon bar -->
                    <i class="fas fa-align-left primary-text fs-4 me-3" id="menu-toggle"></i>
                    <h2 class="fs-2 m-0"><a href="admin.php" style="text-decoration: none;color: #24252A;">Store</a> / <a href="product.php" style="text-decoration: none;color: #24252A;">Products</a> / <?= $product['pname'] ?></h2>
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
                <form class="card login-card-custom border-info" method="post" enctype="multipart/form-data" id="formProduct">
                    <div class="title">รายละเอียดสินค้า</div>
                    <div class="img-center">
                            <?php
                            // Remove the '../' part from the stored avatar path
                            $relativePhotoPath = str_replace('../', '', $product['pimg']);
                            // echo $relativeAvatarPath;
                            // var_dump($relativeAvatarPath); //check path
                            ?>
                            <img src="../<?= $relativePhotoPath ?>" class="rounded-circle" height="150" width="150" alt="product" loading="lazy" />
                    </div>
                    <div class="user-details">
                        <div class="form-outline mb-3 inputbox" style="display: none;">
                            <label for="pidup" class="form-label">ID สินค้า</label>
                            <input type="text" class="form-control" name="pid" id="pidup" aria-describedby="pidup" readonly value="<?= $product['pid'] ?>">
                        </div>
                        <div class="form-outline mb-3 inputbox">
                            <label for="pname" class="form-label">ชื่อสินค้า</label>
                            <input type="text" class="form-control" name="pname" id="pnameup" aria-describedby="pname" placeholder="กรอกชื่อสินค้า" value="<?= $product['pname'] ?>">
                        </div>
                        <div class="form-outline mb-3 inputbox">
                            <label for="price" class="form-label">ราคาสินค้า</label>
                            <input type="number" class="form-control" name="price" id="priceup" aria-describedby="price" placeholder="กรอกราคาสินค้า" value="<?= $product['price'] ?>">
                        </div>
                        <div class="form-outline inputbox textbox" style="margin-bottom: 30px;">
                            <label for="pdetail" class="form-label">รายละเอียดสินค้า</label>
                            <textarea class="form-control" name="pdetail" id="pdetailup" aria-describedby="pdetail" placeholder="กรอกรายละเอิยดสินค้า" style="height: 5rem;"><?= $product['pdetail'] ?></textarea>
                        </div>
                        <div class="form-outline mb-3 inputbox">
                            <label for="ptype" class="form-label">ประเภทสินค้า</label>
                            <select class="form-control" name="ptype" id="ptypeup">
                                <?php if($product['ptype']=='supplementary-food'):?>
                                    <option value="supplementary-food">อาหารเสริม</option>
                                    <option value="home-medicine">ยาสามัญประจำบ้าน</option>
                                    <option value="skin-care">สกินแคร์</option>
                                <?php elseif($product['ptype']=='home-medicine'):?>
                                    <option value="home-medicine">ยาสามัญประจำบ้าน</option>
                                    <option value="supplementary-food">อาหารเสริม</option>
                                    <option value="skin-care">สกินแคร์</option>
                                <?php elseif($product['ptype']=='skin-care'):?>
                                    <option value="skin-care">สกินแคร์</option>
                                    <option value="supplementary-food">อาหารเสริม</option>
                                    <option value="home-medicine">ยาสามัญประจำบ้าน</option>
                                <?php endif;?>
                                
                            </select>
                        </div>
                        <div class="form-outline mb-3 inputbox">
                            <label for="pquan_stock" class="form-label">จำนวนสินค้าในสต็อก</label>
                            <input type="number" class="form-control" name="pquan_stock" id="pquan_stockup" aria-describedby="pquan_stock" placeholder="จำนวนสินค้าในสต็อก" value="<?= $product['pquan_stock'] ?>">
                        </div>
                        <div class="form-outline mb-3 inputbox">
                            <label for="plike" class="form-label">ความนิยม</label>
                            <input type="number" class="form-control" name="plike" id="plikeup" aria-describedby="plike" placeholder="กรอกความนิยมของสินค้า" value="<?= $product['plike'] ?>">
                        </div>
                        <div class="form-outline mb-3 inputbox">
                            <label for="pimg" class="form-label">รูปสินค้า</label>
                            <input class="form-control" type="file" id="pimg" name="pimg" accept="image/gif, image/jpeg, image/jpg, image/png">
                        </div>
                    </div>
                    <button type="submit" name="product_update" id="product_update" class="btn btn-primary btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">ยืนยัน</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="style/sidebar/sidebar.js"></script>
</body>

</html>