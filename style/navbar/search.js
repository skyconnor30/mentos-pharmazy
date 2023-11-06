function Search(){
    let searchvalue = document.getElementById('search').value;

    let formData = new FormData();
    formData.append('search',searchvalue);

    let url = 'store.php'
    request = new XMLHttpRequest();
    request.onreadystatechange = showResult;
    request.open('POST',url);
    request.send(formData)
}

function showResult(){
    if(request.readyState == 4 && request.status == 200){
        document.getElementById('notification').innerHTML = request.responseText;
        window.location.href = 'store.php';
    }
}

window.onload = function(){
    let search  = document.getElementById('search');
    search.onblur = Search;
}