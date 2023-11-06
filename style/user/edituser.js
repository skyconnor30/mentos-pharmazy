function validationInfo(){
    let fullNameup = document.getElementById("u_nameup").value;
    let emailup = document.getElementById("emailup").value;
    let addressup = document.getElementById("addressup").value;
    let phoneup = document.getElementById("phoneup").value;
    let fullnameRegex = /^[\wก-๏\s]{4,20}/;
    let emailRegex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    let addressRegex = /^[\wก-๏\s.-]+/;
    let phoneRegex = /^[\d]{3}-[\d]{3}-[\d]{4}$/;

    if(fullNameup === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your full name.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }
    else if(!fullnameRegex.test(fullNameup)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: 'Please enter your Full Name in regex [ก-ฮ,A-Z,a-z,0-9] 4 - 20 characters and can be whitespace.',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(emailup === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your email.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }
    else if(!emailRegex.test(emailup)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: "Please enter a valid Email in regex example : user@email.com, it's can be [A-Z,a-z,0-9] 1 or more characters",
            showConfirmButton: false,
            timer: 4500,
            timerProgressBar: true
        });
        return false;
    }
    else if(phoneup === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your phone.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }
    else if(!phoneRegex.test(phoneup)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: 'Please enter your phone number in regex example : 012-345-6789',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    else if(addressup === ''){
        Swal.fire({
            icon:'warning',
            title: 'Warning!',
            text: 'Please enter your address.',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'ตกลง'
        });
        return false;
    }
    else if(!addressRegex.test(addressup)){
        Swal.fire({
            icon:'warning',
            title: 'Not match with Regex!',
            text: 'Please enter your address in regex must be 4 or more characters with any characters.',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true
        });
        return false;
    }
    return true;
}
window.onload = function(){
    let updateinfoBTN = document.getElementById("updateinfo")
    updateinfoBTN.onclick = validationInfo;
}