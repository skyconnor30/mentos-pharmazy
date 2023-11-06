function validationInfo(){
    let pidup = document.getElementById("pidup").value;
    let pnameup = document.getElementById("pnameup").value;
    let priceup = document.getElementById("priceup").value;
    let pdetailup = document.getElementById("pdetailup").value;
    let ptypeup = document.getElementById("ptypeup").value;
    let pquan_stockup = document.getElementById("pquan_stockup").value;
    let plikeup = document.getElementById("plikeup").value;
    let pimgup = document.getElementById("pimg").files[0];

    if(pnameup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกชื่อสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }else if(priceup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกราคาสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }else if(pdetailup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกรายละเอียดสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }else if(pquan_stockup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกจำนวนสินค้าในสต็อก',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }else if(plikeup === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกความนิยมของสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
    }
    let formData = new FormData();
    formData.append('pid',pidup);
    formData.append('pname',pnameup);
    formData.append('pdetail',pdetailup);
    formData.append('price',priceup);
    formData.append('ptype',ptypeup);
    formData.append('plike',plikeup);
    formData.append('pquan_stock',pquan_stockup);
    if (pimgup) {
        formData.append('pimg', pimgup);
    }
    request = new XMLHttpRequest();
    request.onreadystatechange = showNotification;

    let url = "include/update_product.php";
    request.open("POST",url); // use method post
    // let data = "pname=" + encodeURIComponent(pnameup) + "&pdetail=" + encodeURIComponent(pdetailup) +
    //            "&price=" + encodeURIComponent(priceup) + "&ptype=" + encodeURIComponent(ptypeup) +
    //            "&plike=" + encodeURIComponent(plikeup) + "&pquan_stock=" + encodeURIComponent(pquan_stockup) +
    //            "&pid=" + encodeURIComponent(pidup);

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
                text: 'อัพเดทสินค้าเสร็จสิ้น',
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
                text: 'อัพเดทสินค้าเสร็จสิ้น',
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
                text: 'ไม่สามารถอัพเดทข้อมูลสินค้าได้',
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
                text: 'อัพเดทรูปสินค้าไม่สำเร็จ',
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
    let updateinfoBTN = document.getElementById("product_update")
    updateinfoBTN.addEventListener("click",function(e){
        e.preventDefault();
    })
    updateinfoBTN.onclick = validationInfo;
}