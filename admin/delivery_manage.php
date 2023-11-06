<?php
include('..\include\head.php');
include('include\functions.php');
session_start();
if (!isset($_SESSION['admin_login'])) {
    header("location: ../index.php");
}
?>

<head>
    <link rel="stylesheet" href="style/admin/product.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link href="https:////cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet"> <!-- Datatable CSS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="style/admin/delivery_manage.js"></script>
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
                    <h2 class="fs-2 m-0"><a href="admin.php" style="text-decoration: none;color: #24252A;">ร้านค้า</a> / การจัดส่ง</h2>
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
                <div id="notification" style="display: none;"></div>
                <div class="row my-5">
                    <h3 class="fs-4 mb-3">รายการคำสั่งซื้อทั้งหมด</h3>
                    <div class="col">
                        <?php
                        $stmt = $pdo->prepare("SELECT DISTINCT DATE_FORMAT(orders.date + INTERVAL 543 YEAR, '%d/%m/%Y %H:%i:%s') AS order_at ,orders.ordName,delivery.delivery_id,users.u_username,orders.amount,delivery.delivery_type,orders.status,delivery.delivery_status FROM orders JOIN delivery ON orders.ordID= delivery.ordID JOIN users ON delivery.uid = users.uid WHERE delivery.delivery_status IN ('prepare','shipping','shipped') AND orders.status IN ('paid') ORDER BY orders.ordName;");
                        $stmt->execute();
                        ?>
                        <table id="ProductTable" class="table table-responsive-md">
                            <thead class="table-info">
                                <tr>
                                    <th style="text-align: center;">ลำดับที่</th>
                                    <th style="text-align: center;">วันที่สั่งซื้อ</th>
                                    <th style="text-align: center;">เลขคำสั่งซื้อ</th>
                                    <th style="text-align: center;">เจ้าของคำสั่งซื้อ</th>
                                    <th style="text-align: center;">ราคาสุทธิ</th>
                                    <th style="text-align: center;">สถานะ</th>
                                    <th style="text-align: center;">บริษัทขนส่ง</th>
                                    <th style="text-align: center;">สถานะการจัดส่ง</th>
                                    <th style="text-align: center;">การดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 1;
                                while ($order = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <tr style="text-align: center;margin: 2rem auto;">
                                        <td><?= $count ?></td>
                                        <td><?= $order['order_at'] ?></td>
                                        <td><?= $order['ordName'] ?></td>
                                        <td><?= $order['u_username'] ?></td>
                                        <td><?= number_format($order['amount'], 2) ?> ฿</td>
                                        <td>
                                            <?php if ($order['status'] === 'paid') : ?>
                                                <span class="text-success">ชำระเงินแล้ว</span>
                                            <?php elseif ($order['status'] === 'wait') : ?>
                                                <span class="text-danger">ยังไม่ได้ชำระเงิน</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if ($order['delivery_type'] === 'flash') : ?>
                                                Flash Express
                                            <?php elseif($order['delivery_type'] === 'kerry'):?>
                                                Kerry Express
                                            <?php elseif($order['delivery_type'] === 'thaipost'):?>
                                                Thailand Post : EMS
                                            <?php elseif($order['delivery_type'] === 'jt'):?>
                                                J&T Express
                                            <?php elseif($order['delivery_type'] === 'dhl'):?>
                                                DHL Express
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <aside style="display: flex;justify-content: center;align-items: center;;">
                                                <?php if ($order['delivery_status'] === 'prepare') : ?>
                                                    <span class="text-secondary">กำลังจัดเตรียมสินค้า</span>
                                                <?php elseif ($order['delivery_status'] === 'shipping') : ?>
                                                    <span class="text-warning">กำลังจัดส่งสินค้า</span>
                                                <?php elseif ($order['delivery_status'] === 'shipped') : ?>
                                                    <span class="text-success">จัดส่งสำเร็จแล้ว</span>
                                                <?php endif; ?>
                                            </aside>
                                        </td>
                                        <td>
                                            <aside style="display: flex;justify-content: center;align-items: center;">
                                                <?php if ($order['status'] === 'paid') : ?>
                                                    <?php if($order['delivery_status'] === 'prepare'):?>
                                                        <section style="margin: auto 0.5rem;">
                                                            <form>
                                                                <button class="btn btn-warning" id="shipping" data-deliID="<?= $order['delivery_id'] ?>"><i class="fa-solid fa-box" id="shipping" data-deliID="<?= $order['delivery_id'] ?>"></i> นำส่ง</button>
                                                            </form>
                                                        </section>
                                                        <section style="margin: auto 0.5rem;">
                                                            <form>
                                                                <button class="btn btn-danger" id="denied" data-deliID="<?= $order['delivery_id'] ?>"><i class="fa-solid fa-rectangle-xmark" id="denied" data-deliID="<?= $order['delivery_id'] ?>"></i> ยกเลิก</button>
                                                            </form>
                                                        </section>
                                                    <?php elseif($order['delivery_status'] === 'shipping'):?>
                                                        <section style="margin: auto 0.5rem;">
                                                        <form>
                                                            <button class="btn btn-secondary" id="prepare" data-deliID="<?= $order['delivery_id'] ?>"><i class="fa-solid fa-box-open" id="prepare" data-deliID="<?= $order['delivery_id'] ?>"></i> จัดเตรียม</button>
                                                        </form>
                                                        </section>
                                                        <section style="margin: auto 0.5rem;">
                                                            <form>
                                                                <button class="btn btn-success" id="shipped" data-deliID="<?= $order['delivery_id'] ?>"><i class="fa-solid fa-people-carry-box" id="shipped" data-deliID="<?= $order['delivery_id'] ?>"></i> จัดส่ง</button>
                                                            </form>
                                                        </section>
                                                    <?php elseif($order['delivery_status'] === 'shipped'):?>
                                                        <section style="margin: auto 0.5rem;">
                                                        <form>
                                                        <button class="btn btn-warning" id="shipping" data-deliID="<?= $order['delivery_id'] ?>"><i class="fa-solid fa-box" id="shipping" data-deliID="<?= $order['delivery_id'] ?>"></i> นำส่ง</button>
                                                        </form>
                                                        </section>
                                                        <section style="margin: auto 0.5rem;">
                                                            <form>
                                                                <button class="btn btn-danger" id="denied" data-deliID="<?= $order['delivery_id'] ?>"><i class="fa-solid fa-rectangle-xmark"></i> ยกเลิก</button>
                                                            </form>
                                                        </section>
                                                    <?php endif;?>
                                                <?php endif; ?>
                                            </aside>
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
        let table = new DataTable('#ProductTable');
    </script>
</body>

</html>