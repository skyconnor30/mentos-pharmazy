function validationInfo(){
    let uidup = document.getElementById('uidup').value;
    let usernameup = document.getElementById('u_usernameup').value;
    let fullNameup = document.getElementById("u_nameup").value;
    let emailup = document.getElementById("emailup").value;
    let addressup = document.getElementById("addressup").value;
    let phoneup = document.getElementById("phoneup").value;
    // Extract the selected gender value
    let genderup = document.querySelector('input[name="gender"]:checked').value;
    let avatarup = document.getElementById("avatar").files[0];
    let fullnameRegex = /^[\wก-๏\s]{4,20}/;
    let emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    let addressRegex = /^[\wก-๏\s.-]+/;
    let phoneRegex = /^[\d]{3}-[\d]{3}-[\d]{4}$/;

    if(fullNameup === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอก ชื่อ - นามสกุล',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!fullnameRegex.test(fullNameup)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอก ชื่อ - นามสกุล ให้ตรงกับเงื่อนไข [ก-ฮ,A-Z,a-z,0-9] 4 - 20 ตัวขึ้นไปและมีช่องว่างได้',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(emailup === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกอีเมล์',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!emailRegex.test(emailup)){
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
    }else if(addressup === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกที่อยู่',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!addressRegex.test(addressup)){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกที่อยู่ ให้ตรงกับเงื่อนไข ต้องมีตัวอักษรอะไรก็ได้ 4 ตัวขึ้นไป',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(phoneup === ''){
        Swal.fire({
            icon:'warning',
            title: 'คำเตือน',
            text: 'กรุณากรอกเบอร์โทรศัพท์',
            confirmButtonColor: '#3085d6'
        });
        return false;
    }
    else if(!phoneRegex.test(phoneup)){
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
    }
    
    let formData = new FormData();
    formData.append('uid',uidup);
    formData.append('u_username',usernameup);
    formData.append('u_name',fullNameup);
    formData.append('email',emailup);
    formData.append('address',addressup);
    formData.append('phone',phoneup);
    if(avatarup){
        formData.append('avatar',avatarup);
    }
    formData.append('gender',genderup);
    request = new XMLHttpRequest();
    let url = "include/update_user.php";
    request.onreadystatechange = showNotification;
    request.open("POST",url);
    request.send(formData); //send url parameter
}
function showNotification(){
    if(request.readyState == 4 && request.status == 200){
        // Update the content of the 'notification' element with the response
        document.getElementById('notification').innerHTML = request.responseText;
        // Check if the response is Updated., then show SweetAlert2
        if(request.responseText.trim() === "Updated."){
            Swal.fire({
                icon:'success',
                title: 'สำเร็จ',
                text: 'อัพเดทข้อมูลผู้ใช้เสร็จสิ้น',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === "Updated-photo"){
            Swal.fire({
                icon:'success',
                title: 'สำเร็จ',
                text: 'อัพเดทข้อมูลผู้ใช้เสร็จสิ้น',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === "Failed to update."){
            Swal.fire({
                icon:'error',
                title: 'ล้มเหลว',
                text: 'ไม่สามารถอัพเดทข้อมูลผู้ใช้ได้',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === "Failed to upload the photo."){
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
    let updateinfoBTN = document.getElementById("user_update");
    updateinfoBTN.addEventListener("click",function(e){
        e.preventDefault();
    })
    updateinfoBTN.onclick = validationInfo;;
}