<?php 
    include('include/head.php');
    include('include/functions.php');
    include('include/header.php');
?>

<head>
    <style>
        h1{
            margin: 2rem 0;
        }
        h1,table{
            text-align: center;
        }
        .swal-wide{
        width:850px ;
        
        }
    </style>
    <script src="style/store/history.js"></script>
</head>
<body>
    <h1>ประวัติการสั่งซื้อ</h1>
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
                        }, 2000)
                    </script>
    <?php else:?>
    <?php
    $uid = $_SESSION["user_login"];
        $stmt=$pdo->prepare("SELECT DISTINCT orders.ordID,orders.ordName,orders.amount FROM orders JOIN order_detail on orders.ordID=order_detail.ordID WHERE uid = ?");
        $stmt->bindParam(1,$uid);
        $stmt->execute();?>
        <main class="container">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อสินค้า</th>
                        <th>ราคารวม</th>
                        <th>รายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $count=1; while($row=$stmt->fetch()): ?>
                    <tr>
                        <td><?=$count?></td>
                        <td><?=$row['ordName']?></td>
                        <td><?=number_format($row['amount'],2)?> บาท</td>
                        <td>
                            <form method="post">
                                <input type="hidden" name="ordID" id="ordID" value="<?=$row['ordID']?>">
                                <button class="btn btn-info" id="btnOrder" data-ordID="<?=$row['ordID']?>">ดูรายละเอียด</button>
                            </form>
                        </td>
                    </tr>
                    <?php $count++; endwhile;?>
                </tbody>
            </table>
            <section id="orderHistory" style="padding-bottom: 3rem;padding-top: 2rem;">
            </section>
        </main>
        <?php endif;?>
</body>
</html>