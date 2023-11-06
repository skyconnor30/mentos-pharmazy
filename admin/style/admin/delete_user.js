function showNotification(){
    if(request.readyState == 4 && request.status == 200){
        document.getElementById("notification").innerHTML = request.responseText;
        if(request.responseText.trim() === 'deleted'){ //response deleted show notification
            Swal.fire({
                icon:'success',
                title: 'สำเร็จ',
                text: 'ลบข้อมูลผู้ใช้เสร็จสิ้น',
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
                text: 'ลบข้อมูลผู้ใช้ไม่สำเร็จ',
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
        if (event.target && event.target.id === "deleteUser") {
            let userID = event.target.getAttribute("data-uid");
            event.preventDefault();
            Swal.fire({//show notification confirm to delete
                title: "แจ้งเตือน",
                icon: "warning",
                text: "ต้องการลบข้อมูลผู้ใช้หรือไม่",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "ลบ",
                cancelButtonText: "ยกเลิก",
            }).then((result) => {
                if(result.isConfirmed){//when hit confirm btn using ajax
                    request = new XMLHttpRequest();
                    let url = "include/delete_user.php";
                    let formData = new FormData();
                    formData.append('uid',userID);
                    request.open("POST",url);
                    request.onreadystatechange = showNotification;
                    request.send(formData);
                }
            })
        }
    });
};