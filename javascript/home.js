
 



const deliveryOptions=[
  {descritopn:"Our delivery drivers sanitize their hands before and after every food order",image:"images/icon_handwash_1607.png"},
  {descritopn:"All our delivery drivers wear masks and gloves",image:"images/icon_delivery_mask_1607.png"},
  {descritopn:"All delivery bags are sanitized before and after every order",image:"images/icon_handwash_1607.png"},
  {descritopn:"Takeaway food bags will be sealed with tape",image:"images/icon_delivery_bag_1607.png"},
];
var paginationItems = document.getElementsByClassName('buttons');
var activeItemIndex = 0;
var isAutoAnimating = true;
const deliveryCont=document.getElementById("delivery-container");
let DeliveryIndex=0;
const img=document.getElementById("dev-img");
const content=document.getElementById("dev-p");

const MobiledeliveryCont=document.getElementById("delivery-container-mobile");
let MobileDeliveryIndex=0;
const Mobileimg=document.getElementById("dev-img-mobile");
const Mobilecontent=document.getElementById("dev-p-mobile");
const swiperSlides=document.querySelectorAll('.swiper-slide');



setInterval(change,5000);
change();
function change(){
  if(DeliveryIndex<deliveryOptions.length){
  content.textContent=deliveryOptions[DeliveryIndex].descritopn;
  img.src=deliveryOptions[DeliveryIndex].image;

  DeliveryIndex++;

  Mobilecontent.textContent=deliveryOptions[MobileDeliveryIndex].descritopn;
  Mobileimg.src=deliveryOptions[MobileDeliveryIndex].image;

  MobileDeliveryIndex++;
  }
  else
  DeliveryIndex=0;
  MobileDeliveryIndex=0;
}


function updateActiveItem() {
    for(var i=0;i<paginationItems.length; i++){
        paginationItems[i].removeAttribute("checked");
    }
   
    paginationItems[activeItemIndex].setAttribute("checked",true);
  }
  
  function autoAnimatePagination() {
    if (!isAutoAnimating) { // Check if automatic animation is enabled
      return;
    }
  
    activeItemIndex++;
    if (activeItemIndex >= paginationItems.length) {
      activeItemIndex = 0;
    }
    updateActiveItem();
  }
  
  setInterval(autoAnimatePagination, 8000);
  
  // Disable automatic animation on page click
  for (var i = 0; i < paginationItems.length; i++) {
    paginationItems[i].addEventListener('click', function() {
      isAutoAnimating = false; // Disable automatic animation
      activeItemIndex = Array.from(paginationItems).indexOf(this); // Update active item index
      updateActiveItem();
    });
  }


  swiperSlides.forEach(element=>{
    element.addEventListener('click',()=>{
      location.href="menu";
    })
  });
