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
    $("#showConfirmPass a").on('click',function(e){//ref id $showPass -> a
        e.preventDefault();//stop refresh page
        if($('#showConfirmPass input').attr("type")== "text"){//check if input type = text change to password add class,remove class icon
            $('#showConfirmPass input').attr('type','password');
            $('#showConfirmPass i').addClass(" fa-eye-slash");
            $('#showConfirmPass i').removeClass(" fa-e fa-eye");
        }else if($('#showConfirmPass input').attr("type")== "password"){//check if input type = pass change to text add class,remove class icon
            $('#showConfirmPass input').attr('type','text');
            $('#showConfirmPass i').removeClass(" fa-eye-slash");
            $('#showConfirmPass i').addClass(" fa-e fa-eye");
        }
    })
    $('#showConfirmPass i').hide(); //ref id #showPass -> i hide icon
    $('#c_password').on('input',function () {//show icon when input field not empty
        if($(this).val().trim() !== ''){//check from input id=u_password using method value if !== NULL show icon
            $('#showConfirmPass i').show();
        }else{
            $('#showConfirmPass i').hide();
        }
    });
})
function validation(){
    let fullName = document.getElementById("u_name").value;
    let username = document.getElementById("u_username").value;
    let email = document.getElementById("email").value;
    let address = document.getElementById("address").value;
    let phone = document.getElementById("phone").value;
    let password = document.getElementById("u_password").value;
    let confirmPassword = document.getElementById("c_password").value;
    let selectedGenderRadioButton = document.querySelector('input[name="gender"]:checked');
    let gender = selectedGenderRadioButton ? selectedGenderRadioButton.value : "";
    let fullnameRegex = /^[\wก-๏\s]{4,20}/;
    let usernameRegex = /^[\w]{4,}/;
    let emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    let addressRegex = /^[\wก-๏\s.-]+/;
    let phoneRegex = /^[\d]{3}-[\d]{3}-[\d]{4}$/;
    let passwordRegex = /^[\w]{8,}/;

    if(fullName === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอก ชื่อ - นามสกุล',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!fullnameRegex.test(fullName)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอก ชื่อ - นามสกุล ให้ตรงกับเงื่อนไข [ก-ฮ,A-Z,a-z,0-9] 4 - 20 ตัวขึ้นไปและมีช่องว่างได้',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
    }
    else if(username === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกชื่อผู้ใช้',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!usernameRegex.test(username)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกชื่อผู้ใช้ให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 4 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
    }
    else if(email === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกอีเมล์',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!emailRegex.test(email)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: "กรุณากรอกอีเมล์ ให้ตรงกับเงื่อนไข [A-Z,a-z,0-9] 1 ตัวขึ้นไป",
            footer: 'ตัวอย่าง : user@email.com',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true
        });
    }
    else if(phone === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกเบอร์โทรศัพท์',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!phoneRegex.test(phone)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกเบอร์โทรศัพท์ ให้ตรงกับเงื่อนไข',
            footer: 'ตัวอย่าง : 012-345-6789',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
    }
    else if(address === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกที่อยู่',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!addressRegex.test(address)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกที่อยู่ ให้ตรงกับเงื่อนไข ต้องมีตัวอักษรอะไรก็ได้ 4 ตัวขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
    }
    else if(password === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกรหัสผ่าน',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!passwordRegex.test(password)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกรหัสผ่านให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 8 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
    }
    else if(confirmPassword === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกรหัสผ่านยืนยัน',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(password != confirmPassword){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรอกรหัสผ่านไม่ตรงกัน',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    else if(!gender){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณาระบุเพศ',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }else{
        console.log(gender);
        let formData = new FormData();
        formData.append('u_name',fullName);
        formData.append('u_username',username);
        formData.append('email',email);
        formData.append('phone',phone);
        formData.append('address',address);
        formData.append('u_password',password);
        formData.append('gender',gender);

        let url = 'include/register_db.php';
        request = new XMLHttpRequest();
        request.onreadystatechange = showResult;
        request.open('POST',url);
        request.send(formData);
    }
}

function showResult(){
    if(request.readyState == 4 && request.status == 200){
        document.getElementById('notification').innerHTML = request.responseText;
        if(request.responseText.trim() === 'registered'){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'สมัครสมาชิกสำเร็จ',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2000
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'username already exist'){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'พบข้อผิดพลาด',
                test: 'มีชื่อผู้ใช้นี้อยู่ในระบบแล้ว',
                confirmButtonColor: '#3085d6'
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'registered failed'){
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'พบข้อผิดพลาด',
                test: 'เกิดบางอย่างผิดพลาดขึ้น',
                confirmButtonColor: '#3085d6'
            }).then(function(){
                location.reload();
            })
        }
    }
}

window.onload = function(){
    let regBTN = document.getElementById("signup")
    regBTN.addEventListener('click',function(e){
        e.preventDefault();
    })
    regBTN.onclick = validation;
}