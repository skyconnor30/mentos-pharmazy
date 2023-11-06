function showNotification(){
    if(request.readyState == 4 && request.status == 200){
        document.getElementById("notification").innerHTML = request.responseText;
        if(request.responseText.trim() === 'deleted'){ //response deleted show notification
            Swal.fire({
                icon:'success',
                title: 'สำเร็จ',
                text: 'ลบสินค้าเสร็จสิ้น',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }else{//not reponse deleted show notification
            Swal.fire({
                icon:'error',
                title: 'ล้มเหลว',
                text: 'ลบสินค้าไม่สำเร็จ',
                showConfirmButton: false,
                timerProgressBar: true,
                timer: 2500
            }).then(function(){
                location.reload();
            })
        }
    }
}

window.onload = function() {
    // Use event delegation to handle click events for all delete buttons
    document.body.addEventListener("click", function(event) {
        if (event.target && event.target.id === "deleteProduct") {
            let productID = event.target.getAttribute("data-pid");
            Swal.fire({//show notification confirm to delete
                title: "แจ้งเตือน",
                icon: "warning",
                text: "ต้องการลบข้อมูลสินค้าหรือไม่",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "ลบ",
                cancelButtonText: "ยกเลิก",
            }).then((result) => {
                if(result.isConfirmed){//when hit confirm btn using ajax
                    request = new XMLHttpRequest();
                    let url = "include/delete_product.php";
                    let formData = new FormData();
                    formData.append('pid',productID);
                    request.open("POST",url);

                    request.onreadystatechange = showNotification;
                    request.send(formData);
                }
            })
        }
    });
};

