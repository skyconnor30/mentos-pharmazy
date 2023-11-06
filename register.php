<?php 
    session_start();
    include('include/functions.php');
    include('include/head.php');
?>
<head>
<link rel="stylesheet" href="style/register/register.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="style/register/register.js"></script>
</head>
<body>
    <div class="flex-login-form">
        <form class=" card login-card-custom" method="post" id="regForm">
        <div class="title">Mentos Register</div>
        <div id="notification" style="display: none;"></div>
            <div class="user-details warp">
                <div class="form-outline mb-3 inputbox">
                    <label for="u_name" class="form-label">ชื่อ - นามสกุล</label>
                    <input type="text" class="form-control" name="u_name" id="u_name" aria-describedby="u_name" placeholder="กรอกชื่อ - นามสกุล">
                </div>
                <div class="form-outline inputbox">
                    <label for="u_username" class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" name="u_username" id="u_username" aria-describedby="u_username" placeholder="กรอกชื่อผู้ใช้">
                </div>
                <div class="form-outline inputbox">
                    <label for="email" class="form-label">อีเมล์</label>
                    <input type="text" class="form-control" name="email" id="email" aria-describedby="email" placeholder="กรอกอีเมล์">
                </div>
                <div class="form-outline inputbox">
                    <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="text" class="form-control" name="phone" id="phone" aria-describedby="phone" placeholder="กรอกเบอร์โทรศัพท์">
                </div>
                <div class="form-outline inputbox textbox" style="margin-bottom: 30px;">
                    <label for="address" class="form-label">ที่อยู่</label>
                    <textarea class="form-control" name="address" aria-describedby="address" id="address" placeholder="กรอกที่อยู่"></textarea>
                </div>
                <div class="form-outline inputbox">
                    <label for="u_password" class="form-label">รหัสผ่าน</label>
                    <div id="showPass">
                        <input type="password" class="form-control" name="u_password" id="u_password" placeholder="กรอกรหัสผ่าน">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-outline inputbox">
                    <label for="c_password" class="form-label">ยืนยันรหัสผ่าน</label>
                    <div id="showConfirmPass">
                        <input type="password" class="form-control" name="c_password" id="c_password" placeholder="ยืนยันรหัสผ่าน">
                        <div class="field-icon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                <div class="form-outline radio mb-3 inputbox inputgender">
                    <div class="mb-2">
                        <label for="gender">เพศ</label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="gender" value="male" aria-describedby="gender">
                                ชาย
                        </label>
                        <label>
                            <input type="radio" name="gender" value="female" aria-describedby="gender">
                                หญิง
                        </label>
                    </div>
                </div>
            </div>
            <button type="submit" name="signup" id="signup" class="btnbg-custom btn-lg mb-3" style="width: 80%;margin-left: auto;margin-right: auto;">สมัครสมาชิก</button>
            <div class="form-label mb-3">มีชื่อผู้ใช้อยู่แล้ว? คลิ๊ก <a href="login.php">เข้าสู่ระบบ</a> ตรงนี้</div>
        </form>
            
    </div>
</body>
</html>