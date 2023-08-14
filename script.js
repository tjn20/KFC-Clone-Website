



/*
*** VARIABLES
*/ 

const cartHover=document.querySelector(".icon-large");
const headerLeftCurrent=document.querySelector(".current");
const headerLiftbuttons=document.querySelectorAll(".select");
/*
DESKTOP SMALLER
*/ 
const headerLeftCurrentSmall=document.querySelector(".current");
const headerLiftbuttonsSmall=document.querySelectorAll(".change");


const openDesktopMenu=document.querySelector(".ri-menu-line");
const desktopMenu=document.querySelector(".hidden-menu");
const bodyDiv=document.querySelector(".sitelight");
const desktopMode=document.getElementById("DesktoplightMode");
const MobileMode=document.getElementById("MobilelightMode");
const main=document.querySelector("main");
const MobileMenu=document.querySelector(".Mobile-hidden-menu");
const openMobileMenu=document.querySelector("#OpenMobileMenu");
const MobileHeaderCenterCurrent=document.querySelector(".current");
const MobileHeaderCenterbuttons=document.querySelectorAll(".mobileSelect");
const menuopened=document.querySelector(".menuopened");

/* 
*** METHODS 
*/

const mainDisplay=document.querySelector(".sitelight");




desktopMode.addEventListener("click",()=>{
     if(desktopMode.children[0].className==="ri-sun-fill"){
        desktopMode.children[0].className="ri-moon-line";
        mainDisplay.className="sitedark";
        desktopMode.setAttribute("title","darkMode");
        desktopMode.className="darkMode";
        MobileMode.children[0].className="ri-moon-line";
        bodyDiv.className="sitedark";
        MobileMode.setAttribute("title","darkMode");
        MobileMode.className="darkMode";

    }
    else if(desktopMode.children[0].className==="ri-moon-line"){
        desktopMode.children[0].className="ri-sun-fill";
        mainDisplay.className="sitelight";
        desktopMode.setAttribute("title","LightMode");
        desktopMode.className="lightMode";
        MobileMode.children[0].className="ri-sun-fill";
        bodyDiv.className="sitelight";
        MobileMode.setAttribute("title","LightMode");
        MobileMode.className="lightMode";
    } 


});


MobileMode.addEventListener("click",()=>{
    if(MobileMode.children[0].className==="ri-sun-fill"){
        desktopMode.children[0].className="ri-moon-line";
        mainDisplay.className="sitedark";
        desktopMode.setAttribute("title","darkMode");
        desktopMode.className="darkMode";
        MobileMode.children[0].className="ri-moon-line";
        bodyDiv.className="sitedark";
        MobileMode.setAttribute("title","darkMode");
        MobileMode.className="darkMode";;

    }
    else if(MobileMode.children[0].className==="ri-moon-line"){
        desktopMode.children[0].className="ri-sun-fill";
        mainDisplay.className="sitelight";
        desktopMode.setAttribute("title","LightMode");
        desktopMode.className="lightMode";
        MobileMode.children[0].className="ri-sun-fill";
        bodyDiv.className="sitelight";
        MobileMode.setAttribute("title","LightMode");
        MobileMode.className="lightMode";
       
    }
});







openMobileMenu.addEventListener("click",()=>{
    if(MobileMenu.className==="hidden-menu mobile-menu display"){
    document.querySelector("html").style.overflowY="scroll";
    }
    else
    document.querySelector("html").style.overflowY="hidden";
    menuopened.classList.toggle("menuClose");
    MobileMenu.classList.toggle("mobile-menu");
    MobileMenu.classList.remove("close");
    MobileMenu.classList.add("display");
});

openDesktopMenu.addEventListener("click",()=>{
    if(desktopMenu.className==="hidden-menu desktop-menu"){
    document.querySelector("html").style.overflowY="scroll";
    }
    else{
    document.querySelector("html").style.overflowY="hidden";
}
 menuopened.classList.toggle("menuClose");
    desktopMenu.classList.toggle("desktop-menu");
});

menuopened.addEventListener("click",()=>{
    desktopMenu.classList.toggle("desktop-menu");
    menuopened.classList.toggle("menuClose");
    document.querySelector("html").style.overflowY="scroll";
    MobileMenu.classList.toggle("mobile-menu");
    MobileMenu.classList.remove("close");
});


cartHover.addEventListener("mouseover",()=>{
document.getElementById("cart-tab").style.display="flex";
});

cartHover.addEventListener("mouseleave",()=>{
 document.getElementById("cart-tab").style.display="none";
});




headerLiftbuttons.forEach(element=>element.addEventListener("click",()=>{
    headerLiftbuttons.forEach(element=>{
    element.classList.remove("current");
    if(element.children[1]!=undefined)
    element.removeChild(element.children[1]);
});

element.classList.add('current');
if(element.children[1]!=undefined)
return;
else{
    const son=document.createElement("i");
    son.setAttribute("class","ri-check-line");
    element.appendChild(son); 
  

}



}));



headerLiftbuttonsSmall.forEach(element=>element.addEventListener("click",()=>{
    headerLiftbuttonsSmall.forEach(element=>{
    element.classList.remove("current");
    if(element.children[0]!=undefined)
    element.removeChild(element.children[0]);
});

element.classList.add('current');
if(element.children[0]!=undefined)
return;
else{
    const son=document.createElement("i");
    son.setAttribute("class","ri-check-line");
    element.appendChild(son); 
  

}



}));


MobileHeaderCenterbuttons.forEach(element=>element.addEventListener("click",()=>{

         MobileMenu.className="Mobile-hidden-menu";
    MobileHeaderCenterbuttons.forEach(element=>{
    element.classList.remove("current");
    element.parentNode.style.color="black";
});

element.classList.add("current");

element.parentNode.style.color="red";


}));
