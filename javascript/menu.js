
const navbar=document.querySelectorAll('.navbar a'),
cart=document.querySelector('.filled-cart'),
cartFooter=document.querySelector('.cart-footer'),
cartFooter2=document.querySelector('.footer2'),
cartHeader=document.querySelector('.cart header h3'),
cartHeaderMobile=document.querySelector('.cart-header h3'),
placeOrder=document.querySelector('.Place-order'),
openCartMobile=document.getElementById('open-cart'),
closeCart=document.querySelector('.goback'),
section=document.querySelector('section');
let cartFilled=false;

navbar.forEach(element=>{
    element.addEventListener('click',()=>{
        navbar.forEach(element2=>{
            element2.classList.remove('show');
        });
        section.setAttribute('id',element.textContent);
        element.classList.add('show');
        getMenu(element.textContent);
    });
});


placeOrder.addEventListener('click',()=>{
    location.href="payment";
});


function getMenu(menu){

const xhr=new XMLHttpRequest();
xhr.open("POST","php/getmenu.php",true);
xhr.onreadystatechange = function(){
    if(this.readyState===XMLHttpRequest.DONE){
        if(xhr.status==200 && xhr.readyState==4){
section.innerHTML=xhr.response;

        }
    }
}
xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");

xhr.send("menuOption="+menu);

}

closeCart.addEventListener('click',()=>{
    document.querySelector(' .cart-cont').classList.toggle('show');
    setTimeout(()=>{
        document.querySelector('.cart-cont').style.display="none";
    },50);
});

openCartMobile.addEventListener('click',()=>{
    document.querySelector('.cart-cont').style.display="flex";
    setTimeout(()=>{
        document.querySelector('.cart-cont').classList.toggle('show');
    },100);
});



window.onload = ()=>{
    getMenu("EXCLUSIVE DEALS");
}


function addToCart(product){
    const xhr=new XMLHttpRequest();

    xhr.open("POST","php/cart.php",true);
    xhr.onreadystatechange = function(){
        if(this.readyState===XMLHttpRequest.DONE){
            if(xhr.status==200 && xhr.readyState==4){
                getCart();
            product.querySelector('.cart').style.display="none";
            product.querySelector('.cart-running').style.display="flex";

            }
        }
    }
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    
    xhr.send("action="+"add&product_id="+product.getAttribute('id'));
}


function getCart(){
    const xhr=new XMLHttpRequest();

    xhr.open("POST","php/cart.php",true);
    xhr.onreadystatechange = function(){
        if(this.readyState===XMLHttpRequest.DONE){
            if(xhr.status==200 && xhr.readyState==4){
               if(xhr.response!="empty"){
                document.querySelector('.empty-cart').style.display="none";
                cart.style.display="block";
                cartFooter.style.display="flex";
                cartFilled=true;
                if(window.innerWidth>1055)
                cartFooter2.style.display="none";
                
else
cartFooter2.style.display="flex";
                cart.innerHTML=xhr.response;
                getTotal();
               } 
               else{
                document.querySelector('.empty-cart').style.display="flex";
                cart.style.display="none";
                cartFooter.style.display="none";
                cartFooter2.style.display="none";
                cartFilled=false;
                cartHeader.textContent="Your Cart is Empty";
                cartHeaderMobile.textContent="Your Cart is Empty";
               }
            }
        }
    }
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");

    xhr.send("action=get");
}

getCart();


function showDetails(element){
    element.parentElement.parentElement.lastElementChild.classList.toggle('show');
element.parentElement.parentElement.classList.toggle('show');
element.classList.toggle('show');
}


function removeProduct(product){
    const xhr=new XMLHttpRequest();
    xhr.open("POST","php/cart.php",true);
    xhr.onreadystatechange = function(){
        if(this.readyState===XMLHttpRequest.DONE){
            if(xhr.status==200 && xhr.readyState==4){
                getTotal();
                getCart();
                navbar.forEach(element=>{
                    if(element.classList.contains('show')){
                        getMenu(element.textContent);
                    }
                });
            }
        }
    }
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    
    xhr.send("action="+"remove&product_id="+product.getAttribute('id'));
}

function increaseQuantity(product){
    const xhr=new XMLHttpRequest();
console.log(product);
    xhr.open("POST","php/cart.php",true);
    xhr.onreadystatechange = function(){
        if(this.readyState===XMLHttpRequest.DONE){
            if(xhr.status==200 && xhr.readyState==4){
                console.log(xhr.response);
                getTotal();
                getCart();
                navbar.forEach(element=>{
                    if(element.classList.contains('show')){
                        getMenu(element.textContent);
                    }
                });
            }
        }
    }
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    
    xhr.send("action="+"increase&product_id="+product.getAttribute('id')+"&quantity=1");
}

function decreaseQuantity(product){
    const xhr=new XMLHttpRequest();
    xhr.open("POST","php/cart.php",true);
    xhr.onreadystatechange = function(){
        if(this.readyState===XMLHttpRequest.DONE){
            if(xhr.status==200 && xhr.readyState==4){
                console.log(xhr.response);
                getTotal();
                getCart();
                navbar.forEach(element=>{
                    if(element.classList.contains('show')){
                        getMenu(element.textContent);
                    }
                });
            }
        }
    }
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    
    xhr.send("action="+"decrease&product_id="+product.getAttribute('id')+"&quantity=1");
}


function getTotal(){
    const xhr=new XMLHttpRequest();
    xhr.open("POST","php/cart.php",true);
    xhr.onreadystatechange = function(){
        if(this.readyState===XMLHttpRequest.DONE){
            if(xhr.status==200 && xhr.readyState==4){
                var response = JSON.parse(xhr.response);
                cartFooter.querySelector('h3').textContent=response.totalPrice+" AED";
                cartFooter2.querySelector('h3').textContent=response.totalPrice+" AED";

                if(response.items=="1"){
                    cartHeader.textContent=response.items+" item added";
                    cartHeaderMobile.textContent="Cart ("+response.items+" item added)";
                }
                else{
                 cartHeader.textContent=response.items+" items added";
                 cartHeaderMobile.textContent="Cart ("+response.items+" items added)";
                }
                }
        }
    }
    xhr.setRequestHeader("content-type","application/x-www-form-urlencoded");
    
    xhr.send("action=total");
}


function toggleElementDisplay() {
    if(window.innerWidth>1055){
        if(cartFilled)
    cartFooter2.style.display="none";
    document.querySelector('.cart-cont').style.display="flex";

}
    
else if(cartFilled){
cartFooter2.style.display="flex";
document.querySelector('.cart-cont').style.display="none";
}
else
document.querySelector('.cart-cont').style.display="none";

  }


toggleElementDisplay();
window.addEventListener('resize', toggleElementDisplay);




function addToCartLogin(){
    document.querySelector('.pop-up').style.display="flex";
    console.log(document.querySelector('main .pop-up').className)
}

document.querySelector('.pop-up button').addEventListener('click',()=>{
    document.querySelector('.pop-up').style.display="none";

});