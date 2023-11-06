<?php
include("include/functions.php");
include("include/head.php");
include("include/header.php");
if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
}
else if (!isset($_POST['product']) || !isset($_POST['pid'])) {
    header("location: store.php");
    exit;
} else {
    $pid = $_POST['product']; //get value from button name product (value is pid)
}
?>

<head>
    <link href="style/store/product.css" rel="stylesheet">
    <script>
        function Check(pid, pname, price, pimg) {
            let create = document.getElementById("error-message");
            let q = parseInt(document.getElementById("quan").value);
            let qrecent = parseInt(document.getElementById("quanrecent").value);
            let add = document.getElementById("addtext");
                if (q <= 0) {
                    if (!create) {
                        create = document.createElement("h6");
                        create.id = "error-message";
                        add.appendChild(create);
                    }
                    create.innerHTML = "สินค้าต้องมีค่าเป็น 1 ขึ้นไป";
                } else {
                    if (create) {
                        // Remove the error message if it exists
                        create.remove();
                    }
                    if (q > qrecent) {
                        Swal.fire({
                            icon: 'error',
                            title: 'ล้มเหลว',
                            text: 'สินค้าที่เลือกจำนวนเกินกับสินค้าที่มีอยู่',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'ตกลง'
                        })
                        console.log(q,qrecent)
                    } else {
                        location = "cartAdd.php?action=add&pid=" + pid + "&pname=" + pname + "&price=" + price + "&quan=" + q + "&pimg=" + pimg;
                    }
                }
        }

        function like() {
            let likeIcon = document.getElementById('like-icon');
            let plike = document.getElementById('plike').value;
            let pid = document.getElementById('pid').value;
            if (likeIcon.classList.contains('fa-regular')) { //method .contains to check class in <i></i> if have fa-regular is true
                likeIcon.classList.remove('fa-regular');
                likeIcon.classList.add("fa-solid");
                likeIcon.classList.add("fa-heart");
                let url = 'include/addlike.php?pid=' + pid + '&plike=' + plike;
                request = new XMLHttpRequest();
                request.open('GET', url);
                request.send();
            } else {
                likeIcon.classList.remove("fa-solid");
                likeIcon.classList.remove("fa-heart");
                likeIcon.classList.add("fa-regular");
                likeIcon.classList.add("fa-heart");
                let url = 'include/addlike.php?pid=' + pid + '&plikeminus=' + plike;
                request = new XMLHttpRequest();
                request.open('GET', url);
                request.send();

            }
            request.onreadystatechange = function() {
                if (request.readyState == 4 && request.status == 200) {
                    document.getElementById('notification').innerHTML = request.responseText;
                }
            }
        }

        function changeQuan(price) {
            let text = document.getElementById("textsum")
            let quan = document.getElementById("quan").value
            let deliveryType = document.getElementById('delivery-type').value;
            let deliveryPrice = 0
            let textDeli = document.getElementById("textDeli")
            if (quan <= 0) {
                text.innerHTML = "ยอดรวม : 0.00 บาท (ยังไม่รวมค่าจัดส่ง)"
                textDeli.innerHTML = "ยอดรวมสุทธิ : 0.00 บาท "
            } else {
                let sum = price * quan
                text.innerHTML = "ยอดรวม : " + sum.toFixed(2) + " บาท (ยังไม่รวมค่าจัดส่ง)"

                if (deliveryType === 'flash') {
                    deliveryPrice = 50;
                    let total = sum + deliveryPrice
                    textDeli.innerHTML = "ยอดรวมสุทธิ : " + total.toFixed(2) + " บาท"
                    document.getElementById("total_sum").value = total
                } else if (deliveryType === 'kerry') {
                    deliveryPrice = 100;
                    let total = sum + deliveryPrice
                    textDeli.innerHTML = "ยอดรวมสุทธิ : " + total.toFixed(2) + " บาท"
                    document.getElementById("total_sum").value = total
                } else if (deliveryType === 'thaipost') {
                    deliveryPrice = 45;
                    let total = sum + deliveryPrice
                    textDeli.innerHTML = "ยอดรวมสุทธิ : " + total.toFixed(2) + " บาท"
                    document.getElementById("total_sum").value = total
                } else if (deliveryType === 'jt') {
                    deliveryPrice = 65;
                    let total = sum + deliveryPrice
                    textDeli.innerHTML = "ยอดรวมสุทธิ : " + total.toFixed(2) + " บาท"
                    document.getElementById("total_sum").value = total
                } else if (deliveryType === 'dhl') {
                    deliveryPrice = 55;
                    let total = sum + deliveryPrice
                    textDeli.innerHTML = "ยอดรวมสุทธิ : " + total.toFixed(2) + " บาท"
                    document.getElementById("total_sum").value = total
                }
            }
            document.getElementById("delivery_price").value = deliveryPrice
            
        }

        function CheckOrder() {
            let create = document.getElementById("error-message");
            let quan = document.getElementById("quan").value; // Get the value from the visible input field
            let quanDummy = document.getElementById("quan_dummy"); // Get the hidden input field
            let add = document.getElementById("addtext");
            let deliveryType = document.getElementById('delivery-type').value;
            if (quan <= 0) {
                if (!create) {
                    create = document.createElement("h6");
                    create.id = "error-message";
                    add.appendChild(create);
                }
                create.innerHTML = "สินค้าต้องมีค่าเป็น 1 ขึ้นไป";
                return false;
            } else if(deliveryType!="flash"&&deliveryType!="kerry"&&deliveryType!="thaipost"&&deliveryType!="jt"&&deliveryType!="dhl"){
                alert("กรุณาเลือกการจัดส่ง")
                return false;
            }
            else {
                if (create) {
                    create.remove();
                }

                // Update the value of the hidden input field with the visible input's value
                quanDummy.value = quan;

                if (confirm("ต้องการสั่งซื้อสินค้าหรือไม่")) {
                    return true; // Continue with form submission
                } else {
                    return false; // Cancel form submission
                }
            }
        }
    </script>
</head>

<body>
    <header>
        
    </header>
    <main>
        <?php
        $show_product = $pdo->prepare("SELECT * FROM product WHERE pid = :pid");
        $show_product->bindParam(":pid", $pid);
        $show_product->execute();
        $row = $show_product->fetch(PDO::FETCH_ASSOC);
        if(isset($_SESSION['user_login'])){
            $uid = $_SESSION['user_login'];
        }
        ?>
        <section>
            <div class="bg-light py-3">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 mb-0 color1">
                            <article style="display: flex;justify-content: center;align-items: center;">
                                <a href="index.php" class="changec">หน้าหลัก</a> <span class="mx-2 mb-0">/</span>
                                <a href="store.php" class="changec">รายการสินค้า</a> <span class="mx-2 mb-0">/</span>
                                <span><?= $row['pname'] ?></span>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <aside>
            <section class="hero ">
                <div class="container1 card">
                    <div class="hero-con">
                        <div class="hero-info">
                            <h3><?= $row['pname'] ?></h3>
                            <h4>รายละเอียดสินค้า</h4>
                            <h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?= $row['pdetail'] ?></h6>
                            <p><span>ราคา : </span><?= number_format($row['price'], 2) ?> ฿</p>
                            <p><span>จำนวนในสต๊อก : </span><?= $row['pquan_stock'] ?> </p>
                            <input type="hidden" id="quanrecent" value="<?= $row['pquan_stock'] ?>">
                            <input type="number" class="form-control" style="width: 15rem;" id="quan" name="quan" value="0">

                            <div id="addtext"></div>
                            <div id="notification" style="display: none;"></div>
                            <br>
                            <span>
                                <button type="submit" class="btn" onclick="Check('<?= $pid ?>','<?= $row['pname'] ?>','<?= $row['price'] ?>','<?= $row['pimg'] ?>')" name="add" style="text-decoration: none;background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;color:white;">เพิ่มลงตะกร้า</button>
                                <input type="hidden" name="plike" id="plike" value="<?= $row['plike'] ?>">
                                <input type="hidden" name="pid" id="pid" value="<?= $pid ?>">
                                <button class="btn" style="background-color: rgba(20,172,204,1);padding: 0.7rem 2.5rem;border-radius: 10px;" onclick="like()"><i id="like-icon" class="fa-regular fa-heart"></i></button>

                                <form action="include/AddOrders.php" method="POST" onsubmit="return CheckOrder();">
                                    <article class="ship-type">
                                        <aside>
                                            การจัดส่ง :
                                        </aside>
                                        <section>
                                            <select class="form-control" id="delivery-type" name="delivery_type" onchange="changeQuan('<?= $row['price'] ?>')">
                                                <option value="">กรุณาเลือกการจัดส่ง</option>
                                                <option value="flash">Flash Express</option>
                                                <option value="kerry">Kerry Express</option>
                                                <option value="thaipost">Thailand Post : EMS</option>
                                                <option value="jt">J&T Express</option>
                                                <option value="dhl">DHL Express</option>
                                            </select>
                                        </section>
                                    </article>
                                    <input type="hidden" name="delivery_price" id="delivery_price" value="">
                                    <input type="hidden" name="total_sum" id="total_sum" value="">
                                    <input type="hidden" id="quan_dummy" name="quan_dummy">
                                    <input type="hidden" name="pid" value=<?= $row['pid'] ?>>
                                    <input type="hidden" name="price" value=<?= $row['price'] ?>>
                                    <div id="textsum" class="firstprice">ยอดรวม : 0.00 บาท (ยังไม่รวมค่าจัดส่ง) </div>
                                    <div id="textDeli" class="firstprice">ยอดรวมสุทธิ : 0.00 บาท</div>
                                    <button type="submit" class="btn" name="Orders" style="text-decoration: none;background-color: rgba(20,172,204,1);padding: 0.7rem;border-radius: 10px;color:white;width:7rem;margin-top: 0.7rem;">ชำระเงิน</button>
                                </form>
                            </span>
                        </div>
                        <div class="hero-img">
                            <?php
                                $relativePhotoPath = str_replace('../', '', $row['pimg']);
                            ?>
                            <img src="<?= $relativePhotoPath?>" width="350" height="400">
                        </div>
                    </div>
                </div>
            </section>
        </aside>
    </main>
</body>