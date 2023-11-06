$(document).ready(function(){//use jquery
    $("#showPass a").on('click',function(e){//ref id $showPass -> a
        e.preventDefault();//stop refresh page
        if($('#showPass input').attr("type")== "text"){//check if input type = text change to password add class,remove class icon
            $('#showPass input').attr('type','password');
            $('#showPass i').addClass(" fa-eye-slash");
            $('#showPass i').removeClass(" fa-e fa-eye");
        }else if($('#showPass input').attr("type")== "password"){//check if input type = pass change to text add class,remove class icon
            $('#showPass input').attr('type','text');
            $('#showPass i').removeClass(" fa-eye-slash");
            $('#showPass i').addClass(" fa-e fa-eye");
        }
    })
    $('#showPass i').hide(); //ref id #showPass -> i hide icon
    $('#u_password').on('input',function () {//show icon when input field not empty
        if($(this).val().trim() !== ''){//check from input id=u_password using method value if !== NULL show icon
            $('#showPass i').show();
        }else{
            $('#showPass i').hide();
        }
    });
})

function validation(){
    let username = document.getElementById("u_username").value;
    let password = document.getElementById("u_password").value;
    let usernameRegex = /^[\w]{4,}/;
    let passwordRegex = /^[\w]{8,}/;

    if(username === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'โปรดกรอกชื่อผู้ใช้',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!usernameRegex.test(username)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'โปรดกรอกชื่อผู้ใช้ให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 4 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
    }
    else if(password === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'โปรดกรอกรหัสผ่าน',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!passwordRegex.test(password)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'โปรดกรอกรหัสผ่านให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 8 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
    }else{
        let formData = new FormData();
        formData.append('u_username',username);
        formData.append('u_password',password);
        let url = 'include/login_db.php';
        request = new XMLHttpRequest();
        request.onreadystatechange = showNotification;
        request.open("POST",url);
        request.send(formData);
    } 
}

function showNotification(){
    if(request.readyState == 4 && request.status == 200){
        document.getElementById('notification').innerHTML = request.responseText;
        if(request.responseText.trim() === 'user login'){
            Swal.fire({
                icon:'success',
                title: 'สำเร็จ',
                text: 'เข้าสู่ระบบเสร็จสิ้น',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.href = 'index.php';
            })
        }else if(request.responseText.trim() === 'admin login'){
            Swal.fire({
                icon:'success',
                title: 'สำเร็จ',
                text: 'เข้าสู่ระบบเสร็จสิ้น',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.href = 'admin/admin.php'
            })
        }else if(request.responseText.trim() === 'wrong password'){
            Swal.fire({
                icon: 'error',
                title: 'พบข้อผิดพลาด',
                text: 'รหัสผ่านไม่ถูกต้อง',
                confirmButtonColor: '#3085d6'
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'wrong username'){
            Swal.fire({
                icon: 'error',
                title: 'พบข้อผิดพลาด',
                text: 'ไม่พบบัญชีผู้ใช้ดังกล่าว',
                confirmButtonColor: '#3085d6'
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'no result found'){
            Swal.fire({
                icon: 'error',
                title: 'พบข้อผิดพลาด',
                text: 'ไม่พบบัญชีผู้ใช้ดังกล่าว',
                confirmButtonColor: '#3085d6'
            }).then(function(){
                location.reload();
            })
        }
    }
}

window.onload = function(){
    let logBTN = document.getElementById('signin');
    logBTN.addEventListener('click',function(e){
        e.preventDefault();
    })
    logBTN.onclick = validation;
}