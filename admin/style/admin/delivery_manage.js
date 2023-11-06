function showNotification(){
    if(request.readyState == 4 && request.status == 200){
        document.getElementById('notification').innerHTML = request.responseText;
        if(request.responseText.trim() === 'shipping'){
            Swal.fire({
                icon: 'success',
                text: 'สินค้ากำลังจัดส่ง',
                timer: 2500,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'shipped'){
            Swal.fire({
                icon: 'success',
                text: 'สินค้าจัดส่งสำเร็จ',
                timer: 2500,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'prepare'){
            Swal.fire({
                icon: 'success',
                text: 'กำลังจัดเตรียมสินค้า',
                timer: 2500,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'denied'){
            Swal.fire({
                icon: 'success',
                text: 'ลบคำสั่งซื้อสินค้าสำเร็จ',
                timer: 2500,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'error'){
            Swal.fire({
                icon: 'error',
                text: 'ไม่สามารถทำรายการได้',
                timer: 2500,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(function(){
                location.reload();
            })
        }
    }
}

window.onload = function(){
    document.body.addEventListener('click',function(e){
        if(e.target && e.target.id === 'shipping'){
            let deliveryID = e.target.getAttribute('data-deliID');
            let status = 'shipping';
            e.preventDefault();
            // console.log(deliveryID);
            let formData = new FormData();
            formData.append('shipping',deliveryID);
            formData.append('delivery_status',status);
            let url = 'include/delivery_manage.php';
            request = new XMLHttpRequest();
            request.onreadystatechange = showNotification;
            request.open('POST',url);
            request.send(formData);
        }else if(e.target && e.target.id === 'prepare'){
            let deliveryID = e.target.getAttribute('data-deliID');
            let status = 'prepare';
            e.preventDefault();
            let formData = new FormData();
            formData.append('prepare',deliveryID);
            formData.append('delivery_status',status);
            let url = 'include/delivery_manage.php';
            request = new XMLHttpRequest();
            request.onreadystatechange = showNotification;
            request.open('POST',url);
            request.send(formData);
        }else if(e.target && e.target.id === 'shipped'){
            let deliveryID = e.target.getAttribute('data-deliID');
            let status = 'shipped';
            e.preventDefault();
            let formData = new FormData();
            formData.append('shipped',deliveryID);
            formData.append('delivery_status',status);
            let url = 'include/delivery_manage.php';
            request = new XMLHttpRequest();
            request.onreadystatechange = showNotification;
            request.open('POST',url);
            request.send(formData);
        }else if(e.target && e.target.id === 'denied'){
            e.preventDefault();
            Swal.fire({
                title: 'แจ้งเตือน',
                text: "ต้องการลบคำสั่งซื้อนี้หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "ลบ",
                cancelButtonText: "ยกเลิก",
              }).then((result) => {
                if(result.isConfirmed){//when hit confirm btn using ajax
                    let deliveryID = e.target.getAttribute('data-deliID');
                    let formData = new FormData();
                formData.append('denied',deliveryID);
                let url = 'include/delivery_manage.php';
                request = new XMLHttpRequest();
                request.onreadystatechange = showNotification;
                request.open('POST',url);
                request.send(formData);
                }
              })
        }
    })
}