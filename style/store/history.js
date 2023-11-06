function showOrder(){
    if(request.readyState == 4 && request.status == 200){
        document.getElementById('orderHistory').innerHTML = request.responseText;
    }
}


window.onload = function(){
    document.body.addEventListener('click',function(event){
        if(event.target && event.target.id === 'btnOrder'){
            event.preventDefault();
            let orderID = event.target.getAttribute('data-ordID');
            // console.log(orderID)
            let url = 'include/showOrder.php';
            request = new XMLHttpRequest();
            let formData = new FormData();
            formData.append('ordID',orderID)
            request.onreadystatechange = showOrder;
            request.open('POST',url);
            request.send(formData);
        }else if(event.target && event.target.id === 'closeOrder'){
        document.getElementById('orderHistory').innerHTML = '';
        }
    })
}