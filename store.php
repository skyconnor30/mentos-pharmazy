<?php
include('include\functions.php');
include('include\head.php');
$selectType = ''; //set type default to null
$itemPerPage = 9; // set item per 1 page
if (isset($_GET['ptype'])) {
    $selectType = $_GET['ptype']; //ptype from js
    // echo $selectType;

}
if(isset($_GET['plike'])){
    $selectLiked = $_GET['plike'];
    // echo $selectLiked;
}

// Calculate the offset based on the current page
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $itemPerPage;

if (!empty($selectType) && $selectType !== "all") { //show protype from choosen type
    $stmtt = $pdo->prepare("SELECT * FROM product WHERE ptype = :ptype ORDER BY pname ASC LIMIT $offset, $itemPerPage");
    $stmtt->bindParam(":ptype", $selectType);
} else { //value = all let ramdom product
    $stmtt = $pdo->prepare("SELECT * FROM product ORDER BY RAND() LIMIT $offset, $itemPerPage");
}
if(!empty($selectLiked) && $selectLiked !== "allLiked"){
    if($selectLiked === 'most-liked'){
        $stmtt = $pdo->prepare("SELECT * FROM product ORDER BY plike DESC,pname ASC LIMIT $offset, $itemPerPage");
        
    }else if($selectLiked === 'less-liked'){
        $stmtt = $pdo->prepare("SELECT * FROM product ORDER BY plike ASC,pname ASC LIMIT $offset, $itemPerPage");
    }
}
$stmtt->execute();
// $stmttt->execute();
$totalProducts = $pdo->prepare("SELECT COUNT(*) FROM product");
$totalProducts->execute();
$allProduct = $totalProducts->fetchColumn();
$totalProductsType = $pdo->prepare("SELECT COUNT(*) FROM product WHERE ptype = ?");
$totalProductsType->bindParam(1,$selectType);
$totalProductsType->execute();
$allProductsType = $totalProductsType->fetchColumn();
$totalPages = ceil($allProduct / $itemPerPage);
$totalPagesType = ceil($allProductsType / $itemPerPage);
?>

<head>
    <link rel="stylesheet" href="style/store/store.css">
    <script>
        function filterProduct() {
            let selected = document.getElementById("productTypeDropdown"); //id select
            let selectedType = selected.value; //get value from select attribute
            let filterForm = document.getElementById("filterForm"); // id form
            if (selectedType === 'all') { //if value = all
                window.location.href = `store.php?ptype=all`;
            } else {
                window.location.href = `store.php?ptype=${selectedType}`;
            }
        }
        function filterLiked(){
            let selectliked = document.getElementById('LikedTypeDropdown');
            let likedType = selectliked.value;
            let Likedform = document.getElementById('filterLiked');
            if (likedType === 'allLiked') {
                window.location.href = `store.php?plike=allLiked`;
            } else if (likedType === 'most-liked') {
                window.location.href = `store.php?plike=most-liked`;
            } else if (likedType === 'less-liked') {
                window.location.href = `store.php?plike=less-liked`;
            }
        }
    </script>
</head>

<body>
    <?php

    ?>
    <header>
        <?php include("include/header.php"); ?>
    </header>
    <main>
        <section>
            <div class="bg-light py-3">
                <?php if (isset($_SESSION['buyfailed'])) : ?>
                    <script>
                        Swal.fire({
                            title: 'ล้มเหลว',
                            icon: 'error',
                            text: 'กรุณาเข้าสู่ระบบก่อน',
                            timer: 3500,
                            showConfirmButton: false,
                            timerProgressBar: true
                        }).then(function() {
                            location.href = 'login.php';
                            <?php unset($_SESSION['buyfailed']);?>
                        })
                    </script>
                <?php endif;?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-0 color1">
                            <article style="display: flex;justify-content: center;align-items: center;"><a href="index.php" class="changec">หน้าหลัก</a> <span class="mx-2 mb-0">/</span>
                                <?php if ($selectType == 'skin-care') : ?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ สกินแคร์
                                <?php elseif ($selectType == 'supplementary-food') : ?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ อาหารเสริม
                                <?php elseif ($selectType == 'medical-supply') : ?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ อุปกรณ์การแพทย์
                                <?php elseif ($selectType == 'home-medicine') : ?><a href="store.php" class="changec" style="margin-right: 0.5rem;">รายการสินค้า</a>/ ยาสามัญประจำบ้าน
                                <?php else : ?>
                                    <strong>รายการสินค้า</strong>
                                <?php endif; ?>
                            </article>
                            <aside class="dropdown-type">
                                <form id="filterForm">
                                    <select id="productTypeDropdown" class="form-select" name="ptype" onchange="filterProduct()">
                                        <option value="">เลือกประเภทสินค้า</option>
                                        <option value="all">สินค้าทั้งหมด</option>
                                        <option value="home-medicine">ยาสามัญประจำบ้าน</option>
                                        <option value="medical-supply">อุปกรณ์การเเพทย์</option>
                                        <option value="supplementary-food">อาหารเสริม</option>
                                        <option value="skin-care">สกินแคร์</option>
                                    </select>
                                </form>
                                <form id="filterLiked">
                                    <select id="LikedTypeDropdown" class="form-select" name="plike" onchange="filterLiked()">
                                        <option value="">เรียงลำดับสินค้า</option>
                                        <option value="allLiked">สินค้าทั้งหมด</option>
                                        <option value="most-liked">ชื่นชอบมากที่สุด</option>
                                        <option value="less-liked">ชื่นชอบน้อยที่สุด</option>
                                    </select>
                                </form>
                            </aside>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <article>
            <form action="product.php" method="post">
                <?php if(isset($_POST['search'])):?>
                    <div class="container" style="margin: 3rem auto;">
                        <div class="row">
                            <?php
                                $search = $_POST['search'];
                                $stmt = $pdo->prepare("SELECT * FROM product WHERE pname LIKE '%$search%'");
                                $stmt->execute();
                            ?>
                            <?php while ($search = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                <div class="col-md-4 mb-4">
                                    <?php if($search === null):?>
                                        not found
                                    <?php endif;?>
                                        <div class="card">
                                            <!-- Add a hidden input to store the product id -->
                                            <input type="hidden" name="pid" value="<?= $search['pid']; ?>">
                                            <?php
                                            // Remove the '../' part from the stored avatar path
                                            $relativePhotoPath = str_replace('../', '', $search['pimg']);
                                            // echo $relativeAvatarPath;
                                            // var_dump($relativeAvatarPath); //check path
                                            ?>
                                            <img class="img-custom" src="<?=$relativePhotoPath?>">
                                            <div class="card-body-custom">
                                                <p class="card-title-custom"><?= $search['pname']; ?></p>
                                            </div>
                                            <div class="card-detail-custom">
                                                <p class="card-text"><?= number_format($search['price'], 2); ?> ฿</p>
                                            </div>
                                            <!-- <a href="#" class="card-btn-custom">ดูสินค้าเพิ่มเติม</a> -->
                                            <button type="submit" name="product" class="card-btn-custom" value="<?=$search['pid']?>">ดูสินค้าเพิ่มเติม</button>
                                        </div>
                                    </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                    <?php elseif(!isset($_POST['search'])):?>
                        <div class="container" style="margin: 3rem auto;">
                            <div class="row">
                                <?php while ($row = $stmtt->fetch()) : ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <!-- Add a hidden input to store the product id -->
                                            <input type="hidden" name="pid" value="<?= $row['pid']; ?>">
                                            <?php
                                            // Remove the '../' part from the stored avatar path
                                            $relativePhotoPath = str_replace('../', '', $row['pimg']);
                                            // echo $relativeAvatarPath;
                                            // var_dump($relativeAvatarPath); //check path
                                            ?>
                                            <img class="img-custom" src="<?=$relativePhotoPath?>">
                                            <div class="card-body-custom">
                                                <p class="card-title-custom"><?= $row['pname']; ?></p>
                                            </div>
                                            <div class="card-detail-custom">
                                                <p class="card-text"><?= number_format($row['price'], 2); ?> ฿</p>
                                            </div>
                                            <!-- <a href="#" class="card-btn-custom">ดูสินค้าเพิ่มเติม</a> -->
                                            <button type="submit" name="product" class="card-btn-custom" value="<?=$row['pid']?>">ดูสินค้าเพิ่มเติม</button>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                <?php endif;?>
            </form>
        </article>
        <?php if(!isset($_POST['search'])):?>
            <section class="page-custom">
                <?php if ($page == 1) : ?> <!-- อยู่หน้าแรกกดปุ่ม prev ไม่ได้ -->
                    <a class="btn btn-secondary">Previous</a>
                <?php endif; ?>
                <!-- ยังไม่ได้กดเลือก type กับ like -->
                <?php if(!isset($_GET['ptype']) && !isset($_GET['plike'])):?>
                    <?php if ($page > 1) : ?> <!-- ไม่ได้อยู่หน้าเเรกกดปุ่ม prev ได้ -->
                        <a href="store.php?page=<?= $page - 1 ?>" class="btn btn-primary">Previous</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?> <!-- loop number of page to button -->
                        <a href="store.php?page=<?= $i ?>" class="btn btn-primary <?= ($i == $page) ? 'active' : ''; ?>" style="margin-left: 20px;"><?= $i ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages)  : ?> <!-- อยู่หน้าแรกกดปุ่ม next ได้ -->
                        <a href="store.php?page=<?= $page + 1 ?>" class="btn btn-primary" style="margin-left: 20px;">Next</a>
                    <?php else: ?>
                        <a class="btn btn-secondary" style="margin-left: 20px;">Next</a>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- กดเลือก type -->
                <?php if(isset($_GET['ptype']) && $_GET['ptype'] == 'all'):?>
                    <?php if ($page > 1) : ?> <!-- ไม่ได้อยู่หน้าเเรกกดปุ่ม prev ได้ -->
                        <a href="store.php?ptype=<?= $selectType ?>&page=<?= $page - 1 ?>" class="btn btn-primary">Previous</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?> <!-- loop number of page to button -->
                        <a href="store.php?ptype=<?= $selectType ?>&page=<?= $i ?>" class="btn btn-primary <?= ($i == $page) ? 'active' : ''; ?>" style="margin-left: 20px;"><?= $i ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages)  : ?> <!-- อยู่หน้าแรกกดปุ่ม next ได้ -->
                        <a href="store.php?ptype=<?= $selectType ?>&page=<?= $page + 1 ?>" class="btn btn-primary" style="margin-left: 20px;">Next</a>
                    <?php else: ?>
                        <a class="btn btn-secondary" style="margin-left: 20px;">Next</a>
                    <?php endif; ?>
                <?php elseif(isset($_GET['ptype']) && $_GET['ptype'] != 'all'):?>
                    <?php if ($page > 1) : ?> <!-- ไม่ได้อยู่หน้าเเรกกดปุ่ม prev ได้ -->
                        <a href="store.php?ptype=<?= $selectType ?>&page=<?= $page - 1 ?>" class="btn btn-primary">Previous</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPagesType; $i++) : ?> <!-- loop number of page to button -->
                        <a href="store.php?ptype=<?= $selectType ?>&page=<?= $i ?>" class="btn btn-primary <?= ($i == $page) ? 'active' : ''; ?>" style="margin-left: 20px;"><?= $i ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $totalPagesType)  : ?> <!-- อยู่หน้าแรกกดปุ่ม next ได้ -->
                        <a href="store.php?ptype=<?= $selectType ?>&page=<?= $page + 1 ?>" class="btn btn-primary" style="margin-left: 20px;">Next</a>
                    <?php else: ?>
                        <a class="btn btn-secondary" style="margin-left: 20px;">Next</a>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- กดเลือก like -->
                <?php if(isset($_GET['plike'])):?>
                    <?php if ($page > 1) : ?> <!-- ไม่ได้อยู่หน้าเเรกกดปุ่ม prev ได้ -->
                        <a href="store.php?plike=<?= $selectLiked ?>&page=<?= $page - 1 ?>" class="btn btn-primary">Previous</a>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?> <!-- loop number of page to button -->
                        <a href="store.php?plike=<?= $selectLiked ?>&page=<?= $i ?>" class="btn btn-primary <?= ($i == $page) ? 'active' : ''; ?>" style="margin-left: 20px;"><?= $i ?></a>
                    <?php endfor; ?>
                    <?php if ($page < $totalPages)  : ?> <!-- อยู่หน้าแรกกดปุ่ม next ได้ -->
                        <a href="store.php?plike=<?= $selectLiked ?>&page=<?= $page + 1 ?>" class="btn btn-primary" style="margin-left: 20px;">Next</a>
                    <?php else: ?>
                        <a class="btn btn-secondary" style="margin-left: 20px;">Next</a>
                    <?php endif; ?>
                <?php endif; ?>
            </section>
        <?php endif;?>
    </main>
</body>

</html>