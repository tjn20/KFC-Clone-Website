


const showPrice=document.querySelector('.total'),
totalPriceValue=document.querySelector('.total .price-sum h3'),
items=document.querySelector('.order-quantity'),
subtotal=document.querySelector('.subtotal .sub'),
chosenAddress=document.querySelector('#chosen-address'),
form=document.querySelector('form'),
cityInput=form.querySelector('.city'),
areaInput=form.querySelector('.area'),
streetInput=form.querySelector('.street'),
buildingInput=form.querySelector('.building'),
submitBtn=form.querySelector('.submit'),
errorMsgCont=document.querySelector('.error-message'),
errorMsg=errorMsgCont.querySelector('span'),
changeBtn=document.querySelector('.change'),
completeOrder=document.querySelector('.complete-order'),
chooseLocationField=document.querySelector('.choose-location'),
userInstructions=document.querySelector('.user-instructions input'),
currentLocation=form.querySelector('.currentLocation');

let itemsNumber;
let price;



window.onload = ()=>{
    const xhr= new XMLHttpRequest();
    xhr.open("POST","php/cart.php",true);
    xhr.onreadystatechange =function(){
        if(this.readyState===XMLHttpRequest.DONE){
            if(xhr.readyState===4 && xhr.status===200){
                var response = JSON.parse(xhr.response);
                price=+response.totalPrice;
                itemsNumber=+response.items;
                subtotal.textContent=response.totalPrice+" AED";
                totalPriceValue.textContent=(+ response.totalPrice+9.50)+" AED";
                if(response.items>1)
                items.textContent=response.items+" items";
                else
                items.textContent=response.items+" item";

            }
        }
    }
    
    
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    xhr.send("action=total");
}


form.onsubmit= (e)=>{
    e.preventDefault();
}

submitBtn.addEventListener('click',()=>{
const xhr= new XMLHttpRequest();
xhr.open("POST","php/order.php",true);
xhr.onreadystatechange =function(){
    if(this.readyState===XMLHttpRequest.DONE){
        if(xhr.readyState===4 && xhr.status===200){
            if(xhr.response!=="done"){
                errorMsg.textContent=xhr.response;
                errorMsgCont.style.display="flex";
            }
            else{
            errorMsgCont.style.display="none";
            chooseLocationField.style.display="none";
            changeBtn.style.display="flex";
            chosenAddress.textContent=buildingInput.value+","+streetInput.value+","+areaInput.value+","+cityInput.value;
        }
        }
    }
}


xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
xhr.send("city="+cityInput.value+"&area="+areaInput.value+"&street="+streetInput.value+"&building="+ buildingInput.value+"&type=manual");

});


currentLocation.addEventListener('click',()=>{
    getCurrentLocation();
    chooseLocationField.style.display="none";
    changeBtn.style.display="flex";
});


showPrice.addEventListener('click',()=>{
    showPrice.querySelector('i').className=(showPrice.querySelector('i').className==="bx bx-chevron-down"?"bx bx-chevron-up":"bx bx-chevron-down");
    document.querySelector('.order-price').classList.toggle('show');
});


function addAddress(data) {
const xhr= new XMLHttpRequest();
xhr.open("POST","php/order.php",true);
xhr.onreadystatechange =function(){
    if(this.readyState===XMLHttpRequest.DONE){
        if(xhr.readyState===4 && xhr.status===200){
            if(xhr.response!=="done"){
                console.log(xhr.response);
                errorMsg.textContent=xhr.response;
                errorMsgCont.style.display="flex";
            }
            else{
            errorMsgCont.style.display="none";
            chosenAddress.textContent=buildingNo+","+street+","+area+","+city;
        }
        }
    }
}

const city=""+data.address.county;
const area="" + data.address.city;
const street=""+data.address.road;
const building=Number(data.address.house_number);
let buildingNo=1;
if(!area)
area+=data.address.village;
if(building)
buildingNo=building;


xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
xhr.send("city="+city+"&area="+area+"&street="+street+"&building="+ buildingNo+"&type=currentlocation");


  }




function getCurrentLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(
      (position) => {
        const currentLocation = {
          lat: position.coords.latitude,
          lng: position.coords.longitude,
        };
        const url =`https://nominatim.openstreetmap.org/reverse?format=json&lat=${currentLocation.lat}&lon=${currentLocation.lng}`;
        fetch(url).then(res=>res.json()).then(data=>{
           addAddress(data);
           console.log(data);
        });
      },
      (error) => {
        console.log('Error getting current location: ' + error.message);
      }
    );
  } else {
    console.log('Geolocation is not supported by this browser.');
  }
}


changeBtn.addEventListener('click',()=>{
    chooseLocationField.style.display="flex";
    changeBtn.style.display="none";
});



completeOrder.addEventListener('click',()=>{
    if(cityInput.value.length>0 && areaInput.value.length>0 && streetInput.value.length>0 && buildingInput.value.length>0){
        const xhr= new XMLHttpRequest();
        xhr.open("POST","php/order.php",true);
        xhr.onreadystatechange =function(){
            if(this.readyState===XMLHttpRequest.DONE){
                if(xhr.readyState===4 && xhr.status===200){
                    if(xhr.response!=="done"){
                        errorMsg.textContent=xhr.response;
                        errorMsgCont.style.display="flex";
                        chooseLocationField.style.display="flex";
                    }
                    else{
                    location.href="home";
                }
                }
            }
        }
        userInst="";
if(!userInstructions.value.length>0)
userInstructions.value="not-provided";
else
userInst+=userInstructions;

        xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
xhr.send("items="+itemsNumber+"&totalPrice="+price+"&type=complete"+"&userInst="+userInstructions.value);
    }
    else{
        errorMsg.textContent="Please enter your address to continue";
        errorMsgCont.style.display="flex";
        chooseLocationField.style.display="flex";
    }
});