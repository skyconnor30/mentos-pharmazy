<?php
include('include\head.php');
if (isset($_COOKIE['visit'])) {
    $visit = $_COOKIE["visit"] + 1;
    setcookie('visit', $visit);
}
?>

<head>
    <link rel="stylesheet" href="style/about/about.css">
    <script src="style/about/about.js"></script>
</head>

<body>
    <div>
        <header>
            <?php
            include('include\header.php');
            ?>
        </header>
        <div class="container">

        </div>
        <section class="hero">
            <div class="container">
                <div class="hero-con">
                    <div class="hero-info">
                        <h3>MENTOS PHARMAZY คือใคร</h3>
                        <p>ร้านขายยา ที่มียาครบวงจร เรื่องสุขภาพ เรื่องผิวหน้า ที่นี่ที่เดียวครบวงจร</p>

                    </div>


                </div>
            </div>

        </section>
    </div>

    <div class="container">

    </div>
    <section class="About">
        <div class="container">
            <div class="About-con">
                <div class="About-info">
                    <h3>เกี่ยวกับเรา</h3>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pharmacy is the science and practice of discovering, producing, preparing, dispensing, reviewing and monitoring medications, aiming to ensure the safe, effective, and affordable use of medicines. It is a miscellaneous science as it links health sciences with pharmaceutical sciences and natural sciences. The professional practice is becoming more clinically oriented as most of the drugs are now manufactured by pharmaceutical industries. Based on the setting, pharmacy practice is either classified as community or institutional pharmacy. Providing direct patient care in the community of institutional pharmacies is considered clinical pharmacy.</p>
                </div>

                <div class="hero-img">
                    <img src="assets/images/pharmazy.jpg">
                </div>
            </div>
        </div>

    </section>
    </div>

    <section class="blog">
        <div class="container">

            <div class="blog-title">
                <h3>ผู้จ่ายยาของเรา</h3>
            </div>

            <div class="blog-con">

                <div class="blog-item">
                    <img src="assets/images/mhor1.jpg">
                    <h4>เภสัชกร</h4>
                    <h5>ปริญญาเอก ภาควิชาวิทยาการคอมพิวเตอร์</h5>
                    <p>มีประสบการณ์เภสัชกรร้านขายยาเดียวและร้านขายยา Mexcio มายาวนานกว่า 10 ปี</p>

                </div>

                <div class="blog-item">
                    <img src="assets/images/mhor2.jpg" alt="">
                    <h4>ผู้ช่วยเภสัชกร</h4>
                    <h5>ปริญญาเอก ภาควิชาไฟฟ้ากำลัง</h5>
                    <p>มีความเชียวชาญด้านยา อาหารเสริม สกินแคร์ มีประสบการณ์ร้านขายยาที่ Argentina 5 ปี</p>

                </div>

                <div class="blog-item">
                    <img src="assets/images/mhor3.jpg" alt="">
                    <h4>จัดจำหน่าย</h4>
                    <h5>ปริญญาเอก ภาควิชาสถาปัตยกรรม</h5>
                    <p>มีประสบการณ์ร้านขายยามากกว่า 12 ปี เคยอยู่ร้านยา France มาหลายที่</p>

                </div>

            </div>

        </div>
    </section>

    <article class="container">
            <h4 class="text-center text-dark alert alert-info"><i class="fa-solid fa-file"></i> รายการสินค้าอุปกรณ์การเเพทย์</h4>
            <table id="MedicalTable" class="table table-responsive-md">
                <thead class="table-info">
                    <th>ลำดับที่</th>
                    <th>ชื่ออังกฤษ</th>
                    <th>ชื่อไทย</th>
                    <th>ระดับความเสี่ยง</th>
                    <th>ระบบไฟฟ้า</th>
                    <th>การฆ่าเชื้อ</th>
                    </tr>
                </thead>
                <tbody id="result">
                </tbody>
            </table>
    </article>
    <div class="footer-top">
        <div class="container">
            <div class="footer-top-con">
                <div class="footer-top-item">
                    <img style="width: 100%;height:120px;" src="assets/images/mentos.png" alt="">

                    <div class="footer-top-item-con">

                        <div class="info">
                            <span class="info-title">ร้านขายยาออนไลน์ อาหารเสริม เม็ดแรกติดใจ เม็ดต่อไปติดคอ</span>

                        </div>
                    </div>

                    <div class="footer-top-item-con">

                        <div class="info">
                            <span class="info-title"><img src="assets/images/tel.png"></span>
                            <span class="info-desc space">099-9999999</span>
                        </div>
                    </div>

                    <div class="footer-top-item-con">

                        <div class="info">
                            <span class="info-title"><img src="assets/images/gmail.png"></span>
                            <span class="info-desc space">mentosphmz@gmail.com</span>
                        </div>
                    </div>
                </div>
                <div class="footer-top-item">
                    <h4>About</h4>
                    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ร้านขายยาเราเริ่มก่อตั้งเมื่อปี พ.ศ 2558 โดยเภสัชกรจาก 2 มหาวิทยาลัย จุฬา และ มหิดล โดยเรามีแนวความคิดว่า อยากเปลี่ยนรูปแบบร้านยาแบบเดิมๆ ให้เป็นร้านทีมีศักยภาพใกล้เคียงกับร้าน Chain store ชั้นนำต่างๆ ในเรื่องของรูปแบบร้าน การบริหารจัดการ จำนวนสินค้ากว่า 4000 รายการ รวมถึงการนำเทคโนโลยีต่างๆเข้ามาใช้อาจจะเป็นเพราะเรามีประสบการณ์ทั้งการทำงานกับร้านยามาหลากหลายรูปแบบ ทำให้เราเห็นจุดที่ดีและจุดอ่อน เราจึงได้ทำร้านนี้ขึ้นเพื่อให้เห็นเป็นที่ประจักษ์ว่าร้านยาบ้านๆธรรมดา ก็สามารถพัฒนาศักยภาพให้เติบโตได้</p>
                </div>
                <div class="footer-top-item">
                    <h4>Stay Connected</h4>
                    <p><img src="assets/images/ig.png"> <span class="space">kornmongkhon</span></p>
                    <p><img src="assets/images/ig.png"> <span class="space">peem_des</span></p>
                    <p><img src="assets/images/ig.png"> <span class="space">peeanw</span></p>
                    <p><img src="assets/images/ig.png"> <span class="space">imtrex_.png</span></p>
                </div>
                <div class="footer-top-item" style="display: flex;">
                    <h5>จำนวนคนเข้าชมเว็ปไซต์ในวันนี้</h5>
                    <span style="margin:0rem 1rem;" id="visit-count">
                        <?php if (isset($_COOKIE['visit'])) : ?>
                            <?= $visit ?>
                        <?php else : ?>
                            <?= 0 ?>
                        <?php endif; ?>
                    </span>
                    <h5>คน</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>Copyright 2023 ©. Mentos Pharmazy (When ever you're sick, think of us)</p>
    </div>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        let table = new DataTable('#MedicalTable');
    </script>
</body>

</html>