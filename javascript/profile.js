const form=document.querySelector('form'),
nameInput=form.querySelector('.name'),
close=document.querySelector('.close'),
errorMessage=document.querySelector('.error'),
emailInput=form.querySelector('.email'),
button=document.querySelector('.submit');


close.addEventListener('click',()=>{
    location.href="home";
})

form.onsubmit =(e)=>{
    e.preventDefault();
}

function validEmail(){
    var regex=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    var isvalid=regex.test(emailInput.value);
    return isvalid;
}


emailInput.addEventListener('keyup',()=>{
     
        if(emailInput.value.length>0 && validEmail() && nameInput.value.length>0){
            button.classList.add('active');
        }
        else
        button.classList.remove('active');

});

nameInput.addEventListener('keyup',()=>{
    if(emailInput.value.length>0 && validEmail() && nameInput.value.length>0){
        button.classList.add('active');
    }
    else
    button.classList.remove('active');
});


button.addEventListener('click',()=>{
    if(button.classList.contains('active')){
        const xhr= new XMLHttpRequest();
        xhr.open("POST","php/login.php",true);
        xhr.onreadystatechange= function(){
            if(this.readyState===XMLHttpRequest.DONE){
                if(xhr.status===200 && xhr.readyState===4){
                    if(xhr.response==="done"){
                        location.href="otp";
                        errorMessage.style.display="none";

                    }
                    else{
                        errorMessage.style.display="block";
                    errorMessage.textContent=xhr.response;    
                }
                }
            }
        }
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.send("name="+nameInput.value+"&email="+emailInput.value+"&action=register");
    }

});