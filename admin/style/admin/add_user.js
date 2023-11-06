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

function userValidation(){
    let Username = document.getElementById('u_username').value;
    let Fullname = document.getElementById('u_name').value;
    let Email = document.getElementById('email').value;
    let Phone = document.getElementById('phone').value;
    let Address = document.getElementById('address').value;
    let Password = document.getElementById('u_password').value;
    let CPassword = document.getElementById('c_password').value;
    let URole = document.getElementById('urole').value;
    let Avatar = document.getElementById("avatar").files[0];
    let selectedGenderRadioButton = document.querySelector('input[name="gender"]:checked');
    let Gender = selectedGenderRadioButton ? selectedGenderRadioButton.value : "";
    let fullnameRegex = /^[\wก-๏\s]{4,20}/;
    let usernameRegex = /^[\w]{4,}/;
    let emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    let phoneRegex = /^[\d]{3}-[\d]{3}-[\d]{4}$/;
    let addressRegex = /^[\wก-๏\s.-]+/;
    let passwordRegex = /^[\w]{8,}/;

    if(Fullname === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอก ชื่อ - นามสกุล',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!fullnameRegex.test(Fullname)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอก ชื่อ - นามสกุล ให้ตรงกับเงื่อนไข [ก-ฮ,A-Z,a-z,0-9] 4 - 20 ตัวขึ้นไปและมีช่องว่างได้',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }else if(Username === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกชื่อผู้ใช้',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!usernameRegex.test(Username)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกชื่อผู้ใช้ให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 4 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }else if(Email === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกอีเมล์',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!emailRegex.test(Email)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: "กรุณากรอกอีเมล์ ให้ตรงกับเงื่อนไข [A-Z,a-z,0-9] 1 ตัวขึ้นไป",
            footer: 'ตัวอย่าง : user@email.com',
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true
        });
        return false;
    }else if(Phone === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกเบอร์โทรศัพท์',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!phoneRegex.test(Phone)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกเบอร์โทรศัพท์ ให้ตรงกับเงื่อนไข',
            footer: 'ตัวอย่าง : 012-345-6789',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }else if(Address === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกที่อยู่',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!addressRegex.test(Address)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกที่อยู่ ให้ตรงกับเงื่อนไข ต้องมีตัวอักษรอะไรก็ได้ 4 ตัวขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }else if(Password === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกรหัสผ่าน',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!passwordRegex.test(Password)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกรหัสผ่านให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 8 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }else if(CPassword === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกรหัสผ่านยืนยัน',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(Password != CPassword){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรอกรหัสผ่านไม่ตรงกัน',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }else if(URole === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกประเภทผู้ใช้',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!Avatar){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณาใส่รูปภาพผู้ใช้',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!Gender){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณาระบุเพศ',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    
    let formData = new FormData();
    formData.append('u_username',Username);
    formData.append('u_name',Fullname);
    formData.append('email',Email);
    formData.append('phone',Phone);
    formData.append('address',Address);
    formData.append('u_password',Password);
    formData.append('urole',URole);
    formData.append('avatar',Avatar);
    formData.append('gender',Gender);

    request = new XMLHttpRequest();
    request.onreadystatechange = showNotification;
    request.open("POST","include/insert_user.php");
    request.send(formData);
}

function showNotification(){
    if(request.readyState == 4 && request.status == 200){
        // Update the content of the 'notification' element with the response
        document.getElementById('notification').innerHTML = request.responseText;
        // Check if the response is Updated., then show SweetAlert2
        if(request.responseText.trim() === 'inserted'){
            Swal.fire({
                icon:'success',
                title: 'สำเร็จ',
                text: 'เพิ่มข้อมูลผู้ใช้เสร็จสิ้น',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'failed insert'){
            Swal.fire({
                icon:'error',
                title: 'ล้มเหลว',
                text: 'เพิ่มข้อมูลผู้ใช้ไม่สำเร็จ',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'Failed to upload the photo.'){
            Swal.fire({
                icon:'error',
                title: 'ล้มเหลว',
                text: 'อัพเดทรูปผู้ใช้ไม่สำเร็จ',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === "Invalid file type. Please upload a PNG,JPG,JPEG,GIF file."){
            Swal.fire({
                icon:'error',
                title: 'ล้มเหลว',
                text: 'โปรดอัพโหลดรูปภาพในนามสกุล .png, .jpg, .jpeg, .gif เท่านั้น',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }
    }
}

window.onload = function(){
    let addBTN = document.getElementById('user_add');
    addBTN.addEventListener("click",function(e){
        e.preventDefault();
    })
    addBTN.onclick = userValidation;
}