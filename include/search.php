<?php
include('functions.php');
$search = $_POST['search'];
$stmt = $pdo->prepare("SELECT * FROM product WHERE pname LIKE '%$search%'");
$stmt->execute();
?>
<head>
    <link rel="stylesheet" href="style/store/store.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
    </script>
</head>

<body>
    <main>
        
        <article>
            <form action="../product.php" method="post">
                <div class="container" style="margin: 3rem auto;">
                    <div class="row">
                        <?php while ($row = $stmt->fetch()) : ?>
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
            </form>
        </article>
    </main>
</body>

</html>