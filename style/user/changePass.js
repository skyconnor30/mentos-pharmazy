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
    $("#showNewPass a").on('click',function(e){//ref id $showPass -> a
        e.preventDefault();//stop refresh page
        if($('#showNewPass input').attr("type")== "text"){//check if input type = text change to password add class,remove class icon
            $('#showNewPass input').attr('type','password');
            $('#showNewPass i').addClass(" fa-eye-slash");
            $('#showNewPass i').removeClass(" fa-e fa-eye");
        }else if($('#showNewPass input').attr("type")== "password"){//check if input type = pass change to text add class,remove class icon
            $('#showNewPass input').attr('type','text');
            $('#showNewPass i').removeClass(" fa-eye-slash");
            $('#showNewPass i').addClass(" fa-e fa-eye");
        }
    })
    $('#showNewPass i').hide(); //ref id #showPass -> i hide icon
    $('#n_password').on('input',function () {//show icon when input field not empty
        if($(this).val().trim() !== ''){//check from input id=u_password using method value if !== NULL show icon
            $('#showNewPass i').show();
        }else{
            $('#showNewPass i').hide();
        }
    });
    $("#showNewCPass a").on('click',function(e){//ref id $showPass -> a
        e.preventDefault();//stop refresh page
        if($('#showNewCPass input').attr("type")== "text"){//check if input type = text change to password add class,remove class icon
            $('#showNewCPass input').attr('type','password');
            $('#showNewCPass i').addClass(" fa-eye-slash");
            $('#showNewCPass i').removeClass(" fa-e fa-eye");
        }else if($('#showNewCPass input').attr("type")== "password"){//check if input type = pass change to text add class,remove class icon
            $('#showNewCPass input').attr('type','text');
            $('#showNewCPass i').removeClass(" fa-eye-slash");
            $('#showNewCPass i').addClass(" fa-e fa-eye");
        }
    })
    $('#showNewCPass i').hide(); //ref id #showPass -> i hide icon
    $('#c_password').on('input',function () {//show icon when input field not empty
        if($(this).val().trim() !== ''){//check from input id=u_password using method value if !== NULL show icon
            $('#showNewCPass i').show();
        }else{
            $('#showNewCPass i').hide();
        }
    });
})

function validationChangeP(){
    let password = document.getElementById("u_password").value;
    let Npassword = document.getElementById("n_password").value;
    let Cpassword = document.getElementById("c_password").value;
    let passwordRegex = /^[\w]{8,}/;

    if(password === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกรหัสผ่าน',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(Npassword === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกรหัสผ่านใหม่',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(Cpassword === ''){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกยืนยันรหัสผ่านใหม่',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!passwordRegex.test(password)){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกรหัสผ่านให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 8 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }else if(!passwordRegex.test(Npassword)){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'โปรดกรอกรหัสผ่านใหม่ให้ตรงเงื่อนไข ต้องเป็น [A-Z,a-z,0-9] ตั้งแต่ 8 ตัวอักษรขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }else if(Npassword != Cpassword){
        Swal.fire({
            icon:'warning',
            title: 'แจ้งเตือน!',
            text: 'กรอกรหัสผ่านใหม่ไม่ตรงกัน',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }
    return true
}
window.onload = function(){
    let updatePBTN = document.getElementById("updatepass")
    updatePBTN.onclick = validationChangeP;
}