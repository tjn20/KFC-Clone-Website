<?php
session_start();
include_once "database.php";
$output="";
if(!isset($_SESSION['user'])){
$menu=mysqli_escape_string($conn,$_POST['menuOption']);
if($menu==="SANDWICH & WRAPS")
$menu="sandwich";
else if($menu==="Sides & Desserts")
$menu="sides";
$sql=mysqli_query($conn,"SELECT * FROM products where category='{$menu}'");
if(mysqli_num_rows($sql)>0){
    while($row=mysqli_fetch_assoc($sql)){

      $output.=' <div class="deal-card" id="'.$row['product_id'].'">';
      $output.= '<div class="img-box">';
      $output.= '<img src="php/images/'.$row['product_img'].'">
      </div>
      <div class="content">
        <h2>'.$row['product_name'].'</h2>
          <p class="descritption">
          '.$row['product_desc'].'
          </p>
          <div class="customize-container">';
            if($row['discount_price']>0){
              
            $output.='
            <h5 class="mainPriceAfter">'.$row['price'].' AED</h5>
            <h5 class="offerPrice">'.$row['discount_price'].' AED</h5>
            <h5 class="offerAmount">'. calculateDiscountPercentage($row['price'],$row['discount_price']).'% OFF</h5>';
            }
            else{
$output.=' <h5 class="offerPrice">'.$row['price'].' AED</h5>';
            }
           $output.=' 
          </div>
          <button class="cart" onclick="addToCartLogin()"><i class="bx bx-plus"></i>ADD TO CART</button>
      </div>
</div>';
    }

   

}
}
else{
    $menu=mysqli_escape_string($conn,$_POST['menuOption']);
    if($menu==="SANDWICH & WRAPS")
    $menu="sandwich";
    else if($menu==="Sides & Desserts")
    $menu="sides";
    $sql=mysqli_query($conn,"SELECT * FROM products where category='{$menu}'");
    if(mysqli_num_rows($sql)>0){

        while($row=mysqli_fetch_assoc($sql)){
            $cartSql=mysqli_query($conn,"SELECT * FROM cart where product_id={$row['product_id']} AND user_id={$_SESSION['user']}");
if(mysqli_num_rows($cartSql)>0){
$result=true;
$cartSqlFetch=mysqli_fetch_assoc($cartSql);
$quantity=$cartSqlFetch['quantity'];
if($quantity>1)
$quantityResult=true;
else
$quantityResult=false;

}
else{
$result=false;
$quantity=1;
$quantityResult=false;

}

            $output.=' <div class="deal-card" id="'.$row['product_id'].'">';
            $output.= '<div class="img-box">';
            $output.= '<img src="php/images/'.$row['product_img'].'">
            </div>
            <div class="content">
              <h2>'.$row['product_name'].'</h2>
                <p class="descritption">
                '.$row['product_desc'].'
                </p>
                <div class="customize-container">';
                  if($row['discount_price']>0){
                    
                  $output.='
                  <h5 class="mainPriceAfter">'.$row['price'].' AED</h5>
                  <h5 class="offerPrice">'.$row['discount_price'].' AED</h5>
                  <h5 class="offerAmount">'. calculateDiscountPercentage($row['price'],$row['discount_price']).'% OFF</h5>';
                  }
                  else{
    $output.=' <h5 class="offerPrice">'.$row['price'].' AED</h5>';
                  }
                 $output.=' 
                </div>
                
                <button class="cart" onclick="addToCart(this.parentElement.parentElement)" style="display:' . ($result ? 'none' : 'flex') . ';"><i class="bx bx-plus"></i>ADD TO CART</button>
               <div class="cart-running" style="display:' . ($result ? 'flex' : 'none') . ';">
                <button class="remove" onclick="removeProduct(this.parentElement.parentElement.parentElement)"  style="display:' . ($quantityResult ? 'none' : 'flex') . ';" ><i class="bx bx-trash"  ></i></button>
                <button class="dec" onclick="decreaseQuantity(this.parentElement.parentElement.parentElement)" style="display:' . ($quantityResult ? 'flex' : 'none') . ';"><i class="bx bx-minus"   ></i></button>

                <span>'.$quantity.'</span>
                <button class="add"><i class="bx bx-plus" onclick="increaseQuantity(this.parentElement.parentElement.parentElement.parentElement)"></i></button>
               </div>
            
            </div>
    </div>';
        }
     

    }
}
echo $output;


function calculateDiscountPercentage($oldPrice, $newPrice) {
  if ($oldPrice <= 0 || $newPrice <= 0 || $newPrice >= $oldPrice) {
      return 0; 
  }

  $discountPercentage = (($oldPrice - $newPrice) / $oldPrice) * 100;
  return round($discountPercentage); 
}
?>