<?php
include("include/head.php");
include("include/header.php");
include("include/functions.php");

$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($pageWasRefreshed) {
} else if (isset($_GET["action"]) && $_GET["action"] == 'add') {


    $pid = $_GET["pid"];
    // echo $_GET["pname"];
    $item = array(
        'pid' => $pid,
        'pname' => $_GET['pname'],
        'price' => $_GET['price'],
        'quan' => $_GET['quan'],
        'pimg' => $_GET['pimg']
    );
    if (array_key_exists($pid, $_SESSION['cart'])) {
        $_SESSION['cart'][$pid]['quan'] += $_GET['quan'];
    } else {
        $_SESSION['cart'][$pid] = $item;
    }
} else if (isset($_GET["action"]) && $_GET["action"] == "update") {
    if ($_GET["quan"] == 0) {
        $pid = $_GET['pid'];
        unset($_SESSION['cart'][$pid]);
    } else {
        $pid = $_GET["pid"];
        $qty = $_GET["quan"];
        $_SESSION['cart'][$pid]['quan'] = $qty;
    }


    // ลบสินค้า
} else if (isset($_GET["action"]) && $_GET["action"] == "delete") {

    $pid = $_GET['pid'];
    unset($_SESSION['cart'][$pid]);
}

?>



<head>
    <link href="style/store/cart.css" rel="stylesheet">
</head>

<body>
    <main class="container" style="margin-top: 2rem;">
        <form method="post" action="include/confirmOrder.php" onsubmit="return confirmOrder()">
            <h1 class="cart-title">ตะกร้าสินค้า</h1>
            <table class="table table-bordered text-center">
                <thead class="table-dark text-center mx-auto">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>รูปสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>จำนวน</th>
                        <th>ราคาชิ้นละ</th>
                        <th>ราคาทั้งสิ้น</th>
                    </tr>
                </thead>
                <?php if (!isset($_SESSION['user_login'])) : ?>
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
                        })
                    </script>
                <?php else : ?>
                    <?php
                    $sum = 0;
                    $count = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $count += 1;
                        $sum += $item["price"] * $item["quan"];
                    ?>
                        <tbody>
                            <?php
                            // Remove the '../' part from the stored avatar path
                            $relativePhotoPath = str_replace('../', '', $item['pimg']);
                            ?>
                            <tr>
                                <td style="padding: 1rem;"><?= $count ?></td>
                                <td><img src="<?= $relativePhotoPath ?>" width="50" height="50"></td>
                                <td style="padding: 1rem;">
                                    <a href="product.php?pid=<?= $item["pid"] ?>"><?= $item["pname"] ?></a>
                                </td>
                                <td style="padding: 1rem;">
                                    <input type="number" class="form-control" style="width: 5rem;margin: 0 auto;text-align: center;" id="<?= $item["pid"] ?>" value="<?= $item["quan"] ?>" min="1" onblur="update(<?= $item['pid'] ?>,'<?= $relativePhotoPath ?>')">
                                </td>
                                <td style="padding: 1rem;"><?= number_format($item["price"], 2) ?> บาท</td>
                                <td style="padding: 1rem;">
                                    <?= number_format($item["price"] * $item["quan"], 2) ?> บาท
                                    <a href="?action=delete&pid=<?= $item["pid"] ?>"><i class="fa-solid fa-xmark text-danger"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    <?php } ?>
                    <tfoot>
                        <?php if (isset($item['pid'])) : ?>
                            <tr>
                                <td colspan="6" align="right">
                                    <article class="ship-type">
                                        <aside>
                                            การจัดส่ง :
                                        </aside>
                                        <section>
                                            <select class="form-control" id="delivery-type" name="delivery_type" onchange="Delivery()">
                                                <option value="">กรุณาเลือกการจัดส่ง</option>
                                                <option value="flash">Flash Express</option>
                                                <option value="kerry">Kerry Express</option>
                                                <option value="thaipost">Thailand Post : EMS</option>
                                                <option value="jt">J&T Express</option>
                                                <option value="dhl">DHL Express</option>
                                            </select>
                                        </section>
                                    </article>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td colspan="6" align="right">
                                <span class="firstprice">ยอดรวม : <span><?= number_format($sum, 2) ?></span> บาท (ยังไม่รวมค่าจัดส่ง) </span>
                                <span>
                                    <aside id="total_price">
                                        <input type="hidden" name="total_sum" id="total_sum" value="">
                                    </aside>
                                </span>
                            </td>
                            <input type="hidden" name="delivery_price" id="delivery_price" value="">
                        </tr>
                        <tr>
                            <td colspan="6">
                                <aside class="orderBTN">
                                    <a href="store.php" class="btn btn-warning">เลือกสินค้าต่อ</a>
                                    <input id="sum" type="hidden" value="<?= $sum ?>" name="sum">
                                    <input type="submit" name="submit_button" value="เพิ่มลงตะกร้า" class="btn btn-info" id="submitBTN">
                                </aside>

                            </td>
                        </tr>
                    </tfoot>
                <?php endif; ?>
            </table>

            <div id="addtext"></div>

        </form>


        <div id="getDeli"></div>
        <!-- <form method="post" action="cartAdd.php?action=orders">
        
    </form> -->

    </main>
</body>

</html>
<script>
    function Delivery() {
        let deliveryType = document.getElementById('delivery-type').value; //รับค่าจาก select id delivery-type
        let deliveryPrice = 0; //ตั้งราคา defualt = 0
        let total_sum = 0;
        if (deliveryType === 'flash') {
            deliveryPrice = 50;
        } else if (deliveryType === 'kerry') {
            deliveryPrice = 100;
        } else if (deliveryType === 'thaipost') {
            deliveryPrice = 45;
        } else if (deliveryType === 'jt') {
            deliveryPrice = 65;
        } else if (deliveryType === 'dhl') {
            deliveryPrice = 55;
        }
        document.getElementById('delivery_price').value = deliveryPrice; //ใส่ value ใน input id delivery-price เป็นค่าตามที่เลือก delivery
        console.log(document.getElementById('delivery_price').value);
        let sum = document.getElementById("sum").value; // ดึงค่าราคารวมมาใช้
        console.log(sum)
        total_sum = parseFloat(document.getElementById('delivery_price').value) + parseFloat(sum) //เอาราคารวมมา บวกเพื่มกับค่าจัดส่ง
        document.getElementById('total_sum').value = total_sum; // ใส่ value ใน input id total_sum
        console.log(total_sum)
        let asideTag = document.getElementById('total_price'); // เข้าถึง tag aside
        let h6Tag = document.querySelector('h6'); //เข้าถึง element ตัวแรกที่พบ ในที่นี้เลือกเป็น h6 ตามที่สร้าง
        if (h6Tag) {
            asideTag.removeChild(h6Tag) //ลบลูกใน aside h6 ตัวเเรกที่เจอ
        }

        if (document.getElementById('total_sum').value !== '') { // input id total_sum ไม่เป็นค่าว่าง
            let h6Tag = document.createElement('h6'); //สร้าง element h6
            let all_price = total_sum.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }); //ทศนิยม 2 ตำแหน่ง มี comma คั่น
            console.log(all_price)
            h6Tag.innerHTML = "ยอดรวมสุทธิ : " + all_price + " บาท";
            asideTag.appendChild(h6Tag);
        } else {
            let h6Tag = document.createElement('h6'); //สร้าง element h6
            let all_price = sum.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            }); //ทศนิยม 2 ตำแหน่ง มี comma คั่น
            console.log(all_price)
            h6Tag.innerHTML = "ยอดรวมสุทธิ : " + all_price + " บาท";
            asideTag.appendChild(h6Tag);
        }

    }

    function update(pid, pimg) {
        var qty = document.getElementById(pid).value;
        if (qty === '' || qty === 0) {
            qty = 1
            document.location = "cartAdd.php?action=update&pid=" + pid + "&quan=" + qty + "&pimg=" + pimg;
        } else {
            // ส่งรหัสสินค้า และจำนวนไปปรับปรุงใน session
            document.location = "cartAdd.php?action=update&pid=" + pid + "&quan=" + qty + "&pimg=" + pimg;
        }

    }

    function confirmOrder() {
        let create = document.getElementById("error-message");
        let sum = document.getElementById("sum").value;
        let add = document.getElementById("addtext");
        let deliveryType = document.getElementById('delivery-type');
        if (sum <= 0 || !deliveryType) {

            if (!create) {
                create = document.createElement("h3");
                create.id = "error-message";
                add.appendChild(create);
            }
            if (sum <= 0) {
                create.innerHTML = "<i class='fa-solid fa-triangle-exclamation'></i> กรุณาเพิ่มสินค้าลงตะกร้าก่อน";
                create.style.color = 'red';
                create.style.margin = '0.5rem 2.5rem';
                create.className = 'btn btn-warning';
            } else {
                Swal.fire({
                    title: 'คำเตือน',
                    icon: 'warning',
                    text: 'กรุณาระบุการจัดส่ง',
                    confirmButtonText: 'ตกลง',
                    confirmButtonColor: '#3085d6'
                })
            }
            return false;
        } else {
            let selectedValue = deliveryType.value;
            if (selectedValue === '') {
                Swal.fire({
                    title: 'คำเตือน',
                    icon: 'warning',
                    text: 'กรุณาระบุการจัดส่ง',
                    confirmButtonText: 'ตกลง',
                    confirmButtonColor: '#3085d6'
                });
                return false;
            } else {
                if(confirm("ต้องการเพิ่มสืนค้าลงตะกร้าหรือไม่?")){
                    return true;
                }else {
                    return false;
                }
            }
        }

    }
    window.onload = function() {
        Delivery();
    }
</script>