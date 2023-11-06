function showNotification(){
    document.getElementById('notification').innerHTML = request.responseText;
    if(request.readyState == 4 && request.status == 200){
        if(request.responseText.trim() === 'approved'){
            Swal.fire({
                icon: 'success',
                text: 'ยืนยันการชำระเงินแล้ว',
                timer: 2500,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'reapproved'){
            Swal.fire({
                icon: 'warning',
                text: 'กรุณาตรวจสอบการชำระเงินอีกครั้ง',
                timer: 2500,
                showConfirmButton: false,
                timerProgressBar: true
            }).then(function(){
                location.reload();
            })
        }else if(request.responseText.trim() === 'denied'){
            Swal.fire({
                icon: 'success',
                text: 'ลบคำสั่งซื้อสำเร็จ',
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
        if(e.target && e.target.id ==='approve'){
            e.preventDefault();
            let ordID = e.target.getAttribute('data-ordID');
            let formData = new FormData();
            let status = 'paid';
            formData.append('approve',ordID);
            formData.append('status',status);
            request = new XMLHttpRequest();
            let url = 'include/order_manage.php';
            request.onreadystatechange = showNotification;
            request.open('POST',url);
            request.send(formData);
            // console.log(ordID)

        }else if(e.target && e.target.id === 'denied'){
            e.preventDefault();
            let ordID = e.target.getAttribute('data-ordID');
            // console.log(ordID)
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
                    let formData = new FormData();
                    formData.append('denied',ordID);
                    let url = 'include/order_manage.php';
                    request = new XMLHttpRequest();
                    request.onreadystatechange = showNotification;
                    request.open('POST',url);
                    request.send(formData);
                }
              })
        }else if(e.target && e.target.id === 'reapprove'){
            e.preventDefault();
            let ordID = e.target.getAttribute('data-ordID');
            let status = 'wait';
            let formData = new FormData();
            formData.append('reapprove',ordID);
            formData.append('status',status);
            let url = 'include/order_manage.php';
            request = new XMLHttpRequest();
            request.onreadystatechange = showNotification;
            request.open('POST',url);
            request.send(formData);
        }
    })
}