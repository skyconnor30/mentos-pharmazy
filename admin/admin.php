<?php
include('..\include\head.php');
include('include\functions.php');
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("location: ../index.php");
}
?>

<head>
    <link rel="stylesheet" href="style/admin/admin.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https:////cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    $stmt = $pdo->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->bindParam(1, $_SESSION['admin_login']);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <div class="d-flex" id="wrapper">
        <?php if (isset($_SESSION['success_login'])) : ?>
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: 'ยินดีต้อนรับ เข้าสู่ระบบเสร็จสิ้น'
                }).then(function() {
                    <?php
                    unset($_SESSION['success_login']);
                    ?>
                })
            </script>
        <?php endif; ?>
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
                        <a href="#" class="sidebar-link collapsed" data-bs-toggle="collapse" data-bs-target="#order" aria-expanded="false" aria-controls="order">
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
                    <h2 class="fs-2 m-0">ภาพรวม</h2>
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
            <div class="container-fluid px-4">
                <div class="row g-3 my-2">
                    <div class="col-md-3">
                        <a href="product.php" style="text-decoration: none;color:black">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div class="text-center mt-3">
                                    <?php
                                    $stmt = $pdo->prepare("SELECT SUM(product.pquan_stock) AS total_product FROM product;");
                                    $stmt->execute();
                                    $total_product = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <h3 class="fs-2 ">
                                        <?php if ($total_product['total_product'] == '') : ?>
                                            <?= 0 ?>
                                        <?php else : ?>
                                            <?= $total_product['total_product'] ?>
                                        <?php endif; ?>
                                    </h3>
                                    <p class="fs-5">สินค้าทั้งหมด</p>
                                </div>
                                <i class="fas fa-gift fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                            <div class="text-center mt-3">
                                <?php
                                $stmt = $pdo->prepare("SELECT SUM(orders.amount-delivery.delivery_price) AS total_income FROM orders JOIN delivery ON orders.ordID = delivery.ordID WHERE orders.status IN('paid');");
                                $stmt->execute();
                                $total_income = $stmt->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <h3 class="fs-2">
                                    <?php if ($total_income['total_income'] == '') : ?>
                                        <?= 0 ?>
                                    <?php else : ?>
                                        <?= $total_income['total_income'] ?>
                                    <?php endif ?>

                                </h3>
                                <p class="fs-5">รายได้ทั้งหมด</p>
                            </div>
                            <i class="fas fa-hand-holding-usd fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <a href="user_manage.php" style="text-decoration: none;color:black">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div class="text-center mt-3">
                                    <?php
                                    $stmt = $pdo->prepare("SELECT COUNT(users.uid) AS total_user FROM users WHERE users.urole = 'user';");
                                    $stmt->execute();
                                    $total_users = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <h3 class="fs-2"><?= $total_users['total_user'] ?></h3>
                                    <p class="fs-5">สมาชิกทั้งหมด</p>
                                </div>
                                <i class="fas fa-users fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3">
                        <a href="order_manage.php" style="text-decoration: none;color:black">
                            <div class="p-3 bg-white shadow-sm d-flex justify-content-around align-items-center rounded">
                                <div class="text-center mt-3">
                                    <?php
                                    $stmt = $pdo->prepare("SELECT COUNT(orders.ordID) AS total_orders FROM orders;");
                                    $stmt->execute();
                                    $total_orders = $stmt->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <h3 class="fs-2"><?= $total_orders['total_orders'] ?></h3>
                                    <p class="fs-5">คำสั่งซื้อทั้งหมด</p>
                                </div>
                                <i class="fas fa-chart-line fs-1 primary-text border rounded-full secondary-bg p-3"></i>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row my-5">
                    <h3 class="fs-4 mb-3">การสั่งซื้อล่าสุด</h3>
                    <div class="col">
                        <table id="OrderTable" class="table table-responsive-md">
                            <thead class="table-info">
                                <tr>
                                    <th style="text-align: center;">ลำดับที่</th>
                                    <th style="text-align: center;">วันและเวลา</th>
                                    <th style="text-align: center;">เลขที่คำสั่งซื้อ</th>
                                    <th style="text-align: center;">ชื่อผู้ใช้</th>
                                    <th style="text-align: center;">จำนวน</th>
                                    <th style="text-align: center;">ราคารวม</th>
                                    <th style="text-align: center;">สถานะ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $stmt = $pdo->prepare("SELECT DISTINCT DATE_FORMAT(orders.date + INTERVAL 543 YEAR, '%d/%m/%Y %H:%i:%s') AS order_at,orders.ordName,users.u_username,SUM(order_detail.qty) AS total_quantity,orders.amount,orders.status FROM orders JOIN order_detail ON orders.ordID = order_detail.ordID JOIN users ON order_detail.uid = users.uid GROUP BY orders.ordName ORDER BY order_at DESC;");
                                $stmt->execute();
                                ?>
                                <?php $count = 1;
                                while ($lastest_order = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr>
                                        <td style="text-align: center;"><?= $count ?></td>
                                        <td style="text-align: center;"><?= $lastest_order['order_at'] ?></td>
                                        <td style="text-align: center;"><?= $lastest_order['ordName'] ?></td>
                                        <td style="text-align: center;"><?= $lastest_order['u_username'] ?></td>
                                        <td style="text-align: center;"><?= $lastest_order['total_quantity'] ?></td>
                                        <td style="text-align: center;"><?= number_format($lastest_order['amount'], 2) ?> บาท</td>
                                        <td style="text-align: center;">
                                            <?php if ($lastest_order['status'] === 'paid') : ?>
                                                <span class="text-success">ชำระเงินแล้ว</span>
                                            <?php elseif ($lastest_order['status'] === 'wait') : ?>
                                                <span class="text-danger">ยังไม่ได้ชำระเงิน</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php $count++;
                                endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
    </div>
    </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="style/sidebar/sidebar.js"></script>
    <script>
        let table = new DataTable('#OrderTable');
    </script>
</body>

</html>