function validationProduct(){
    let pname = document.getElementById("pname").value;
    let price = document.getElementById("price").value;
    let pdetail = document.getElementById("pdetail").value;
    let ptype = document.getElementById("ptype").value;
    let pquan_stock = document.getElementById("pquan_stock").value;
    let plike = document.getElementById("plike").value;
    let pimg = document.getElementById("pimg").files[0];

    if(pname === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกชื่อสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(price === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกราคาสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(pdetail === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกรายละเอียดสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(ptype === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกประเภทสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(pquan_stock === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกจำนวนสินค้าในสต็อก',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(plike === ''){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณากรอกความนิยมของสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }else if(!pimg){
        Swal.fire({
            icon:'warning',
            title: 'เตือน',
            text: 'กรุณาใส่รูปภาพสินค้า',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }
    let formData = new FormData();
    formData.append('pname',pname);
    formData.append('pdetail',pdetail);
    formData.append('price',price);
    formData.append('ptype',ptype);
    formData.append('plike',plike);
    formData.append('pquan_stock',pquan_stock);
    if (pimg) {
        formData.append('pimg', pimg);
    }
    request = new XMLHttpRequest();
    request.onreadystatechange = showNotification;

    let url = "include/insert_product.php";
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
        if(request.responseText.trim() === 'inserted'){
            Swal.fire({
                icon:'success',
                title: 'สำเร็จ',
                text: 'เพิ่มสินค้าเสร็จสิ้น',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            })
        }else if(request.responseText.trim() === 'failed insert'){
            Swal.fire({
                icon:'error',
                title: 'ล้มเหลว',
                text: 'เพิ่มสินค้าไม่สำเร็จ',
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
    let addBTN = document.getElementById("product_add")
    addBTN.addEventListener("click",function(e){
        e.preventDefault();
    })
    addBTN.onclick = validationProduct;
}