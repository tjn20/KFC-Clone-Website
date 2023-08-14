const inputPhone=document.querySelector('.numb'),
buttonLogin=document.querySelector('.submit'),
close=document.querySelector('.close'),
loginErorMessage=document.querySelector('.error-message'),
phoneReq=[
    {regex:/[0]/ ,index:0},
    {regex:/[5]/ ,index:1},
    {regex:/[062584]/ ,index:2},
    {regex:/^\d{10}$/,index:3},
];

document.querySelector('form').onsubmit =(e)=>{
    e.preventDefault();
}

close.addEventListener('click',()=>{
    location.href="home";
})

inputPhone.addEventListener('keyup',()=>{
    var as=""+inputPhone.value;
    if(phoneReq[0].regex.test(as.charAt(0)) && phoneReq[1].regex.test(as.charAt(1)) && phoneReq[2].regex.test(as.charAt(2)) &&phoneReq[3].regex.test(as) ){
        buttonLogin.classList.add('active');
    }
    else{
        buttonLogin.classList.remove('active');
        loginErorMessage.textContent="Please enter a valid phone number";
        if(inputPhone.value.length<1)
        loginErorMessage.textContent="E.g. 5XXXXXXX";

        
    }

}); 

buttonLogin.addEventListener('click',()=>{
    if(buttonLogin.classList.contains('active')){
        const xhr= new XMLHttpRequest();
        xhr.open("POST","php/login.php",true);
        xhr.onreadystatechange= function(){
            if(this.readyState===XMLHttpRequest.DONE){
                if(xhr.status===200 && xhr.readyState===4){
                    console.log(12+" "+xhr.response);
                    if(xhr.response==="done"){
                        location.href="otp/"; 
                    }
                    else if(xhr.response==="notRegistered"){
                        location.href="createProfile";


                    }
                    else
                    loginErorMessage.textContent=xhr.response;


                }
            }
        }
        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
        xhr.send("phone="+ +inputPhone.value+"&action=login");
    }

});