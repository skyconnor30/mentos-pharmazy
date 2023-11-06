<?php
include('include\head.php');
if(empty($_COOKIE['visit'])){
    setcookie('visit',0,time() + 3600*24);
}
if(isset($_COOKIE['visit'])){
    $visit = $_COOKIE["visit"]+1;
    setcookie('visit',$visit);
}
?>

<head>
    <link href="style/index/index.css" rel="stylesheet"></link>
    <style>
        .hidden-head{
            display: none;
        }

        .hero-img-mobile {
            display: none;
        }
        .h4-mobile{
            display: none;
        }
        @media screen and (max-width: 778px){
            .hero-info h3 , p{
                text-align: center;
            }
            .hero-img{
                display: none;
            }
            .footer-top{
                display: none;
                padding: 2rem;
            }
            .footer-bottom{
                margin-top: 2rem;
            }
            .h4-mobile{
            display: none;
        }
        }
        @media screen and (max-width: 500px) {
            .hidden-head {
                display: block;
                text-align: center;
                padding-top: 2rem;
            }

            .hero-img-mobile img {
            width: 120px;
            height: 40px; 
            }

            .hero-img {
                display: none;

            }
            .footer-top{
                display: none;
            }
            .text{
                display: none;
                /* margin-bottom: 2rem; */
            }
            /* .blog-item .moblie-margin{
                margin-top: 2rem;
            } */
            .h4-skin{
                display: none;
            }
            .h4-mobile{
                display: block;
            }
            .buyBTN{
                margin-top: 1.6rem;
            }

        }
    </style>
</head>

<body id="bodytag">
    <div>
        <header>
            <?php
            include('include\header.php');
            ?>
        </header>
        <?php if(isset($_SESSION['success_login'])):?>
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
                }).then(function(){
                    <?php
                    unset($_SESSION['success_login']);
                    ?>
                })
            </script>
        <?php endif;?>
        <section class="hero">
            <div class="container">
                <div class="hero-con">
                    <div class="hero-info">
                        <h3>MENTOS PHARMAZY</h3>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เภสัชศาสตร์เป็นศาสตร์และการฝึกฝนในการค้นหา ผลิต จัดเตรียม จ่าย ทบทวน และติดตามยา โดยมีจุดมุ่งหมายเพื่อให้แน่ใจว่าการใช้ยามีความปลอดภัย มีประสิทธิภาพ และราคาไม่แพง เป็นวิทยาศาสตร์เบ็ดเตล็ดเนื่องจากเชื่อมโยงวิทยาศาสตร์สุขภาพกับวิทยาศาสตร์เภสัชกรรมและวิทยาศาสตร์ธรรมชาติ การปฏิบัติวิชาชีพกำลังมุ่งเน้นไปที่ทางคลินิกมากขึ้น เนื่องจากปัจจุบันยาส่วนใหญ่ผลิตโดยอุตสาหกรรมยา ขึ้นอยู่กับสภาพแวดล้อม การปฏิบัติงานด้านเภสัชกรรมจัดเป็นร้านขายยาชุมชนหรือร้านขายยาแบบสถาบัน การให้การดูแลผู้ป่วยโดยตรงในชุมชนร้านขายยาของสถาบันถือเป็นร้านขายยาคลินิก</p>
                        <a href="store.php" class="hero-btn">สั่งซื้อ</a>
                    </div>

                    <div class="hero-img">
                        <img src="assets/images/pharmazy.jpg" alt="">
                    </div>
                </div>
            </div>

        </section>
    </div>
    
    <section class="blog">
        <div class="container">

            <div class="blog-title">
                <h3>ประเภทสินค้า</h3>
            </div>

            <div class="blog-con">

                <div class="blog-item">
                    <img src="assets/images/yasaman.jpg" alt="">
                    <h4>ยาสามัญประจำบ้าน</h4>
                    <p class="text">"ยาสามัญประจำบ้าน" คือ ตัวยาที่กระทรวงสาธารณะสุขได้พิจารณาเอาไว้ว่าเป็นยาอันเหมาะสมที่ประชาชนควรซื้อมาไว้ประจำบ้านของตนเอง เพื่อจะเป็นประโยชน์ในการใช้ดูแลตัวเองจากอาการเจ็บป่วยเล็กๆ น้อยๆ ที่สามารถเกิดขึ้นได้ทั่วไปในชีวิตประจำวัน</p>
                    <a href="store.php?ptype=home-medicine">สั่งซื้อ</a>
                </div>

                <div class="blog-item">
                    <img src="assets/images/serm.jpg" alt="">
                    <h4>อาหารเสริม</h4>
                    <p class="text">อาหารเสริม (Complementary foods) ทางเภสัชกรรมหมายถึง อาหารที่ให้รับประทานเพิ่มเติมนอกเหนือจากอาหารหลัก (อาหารมีประโยชน์ 5 หมู่ ที่ได้รับ 3 มื้อต่อวัน) โดยการให้อาหารเสริมมีวัตถุประสงค์ต่างๆ เช่น เพื่อช่วยให้สุขภาพแข็งแรง เพื่อเพิ่มพลังงานให้กับร่างกาย</p>
                    <a class="buyBTN" href="store.php?ptype=supplementary-food">สั่งซื้อ</a>
                </div>

                <div class="blog-item">
                    <img src="assets/images/skincare.jpg" alt="">
                    <h4 class="h4-skin">สกินแคร์</h4>
                    <h4 class="h4-mobile">สกินแคร์</h4>
                    <p class="text">สกินแคร์คือ ผลิตภัณฑ์สำหรับดูแลและฟื้นฟูผิวที่เสื่อมสภาพให้ดีขึ้น เช่น รอยดำ รอยแดง ฝ้า กระ ริ้วรอยก่อนวัย รวมถึงให้ความชุ่มชื้นกันผิวไม่ว่าจะเป็นผิวหน้าหรือผิวกาย โดยสกินแคร์แต่ละชนิดอาจมีรูปแบบและส่วนผสมที่แตกต่างกัน ดังนั้น จึงควรเลือกใช้สกินแคร์ให้เหมาะกับสภาพผิว</p>
                    <a class="mobile-margin buyBTN" href="store.php?ptype=skin-care">สั่งซื้อ</a>
                </div>

            </div>

        </div>

    </section>

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
                        <?php if(isset($_COOKIE['visit'])):?>
                            <?=$visit?>
                        <?php else:?>
                            <?=0?>
                        <?php endif;?>
                    </span>
                    <h5>คน</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <p>Copyright 2023 ©. Mentos Pharmazy (When ever you're sick, think of us)</p>
    </div>

</body>

</html>