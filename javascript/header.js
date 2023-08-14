const openMenuBtn=document.querySelector('.openMenu'),
loginBtn=document.querySelectorAll('.login'),
logOut=document.querySelectorAll('.log-out'),
openProfile=document.querySelector('.profile'),
profile=document.querySelector('.user'),
cartBtn=document.querySelector('.openCart'),
cartItem=document.querySelector('.item-number'),
menu=document.querySelector('.hidden-menu');


cartBtn.addEventListener('click',()=>{
    window.location.href = 'menu.php';
})

logOut.forEach(element=>{
    element.addEventListener('click',()=>{
        const xhr= new XMLHttpRequest();
        xhr.open("POST","php/login.php",true);
        xhr.onreadystatechange = function(){
            if(this.readyState===XMLHttpRequest.DONE){
                if(xhr.status==200 && xhr.readyState==4){
                    location.reload();

                }
            }
        }
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
            xhr.send("action=logout");
    });
})

openProfile.addEventListener('click',()=>{
    profile.classList.toggle('show');
});


loginBtn.forEach(element=>{
    element.addEventListener('click',()=>{
        location.href="login";
    })
});

openMenuBtn.addEventListener('click',()=>{
menu.classList.toggle('show');
})

window.onload=()=>{
    const xhr= new XMLHttpRequest();
    xhr.open("POST","php/cart.php",true);
    xhr.onreadystatechange=function(){
        if(this.readyState===XMLHttpRequest.DONE){
            if(xhr.status==200 && xhr.readyState==4){
if(xhr.response!=="empty"){
    var response = JSON.parse(xhr.response);
    cartItem.textContent=response.items;  
}
            }
        }
    }
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.send("action=total");
}