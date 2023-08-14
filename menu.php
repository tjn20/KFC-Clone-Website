<?php
session_start();

include_once "php/database.php";

$user=false;
if(isset($_SESSION['user']))
$user=true;




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EXPLORE MENU</title>
    <link rel="stylesheet" href="menu.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
<main class="sitelight">
        <div class="pop-up">
           <div class="popup-details">
            <button><i class='bx bx-x'></i></button>
            <div>
             <h3>Please Login To Add To Cart</h3>
             <a href="login">Login</a>
            </div> 
           </div>
         </div>
        <div class="desktop">
            <nav class="navbar">
                <a class=" deals show">EXCLUSIVE DEALS</a>
                <a class="limited" >LIMITED TIME</a>
                <a class="sandwich">SANDWICH & WRAPS</a>
                <a class="for-one">CHICKEN FOR 1</a>
                <a class="for-sharing">For Sharing</a>
                <a class="sides">Sides & Desserts</a>
                <a class="dips">Dips</a>
                <a class="beverages">Beverages</a>
               </nav>
               <div class="menu">
                
                       <section id="EXCLUSIVE DEALS" >
                      
                       </section>
                <div class="cart-cont">
                <header class="cart-header" >
                <i class='bx bx-arrow-back goback' ></i>
                <h3></h3>
                </header>
                    <div class="cart">
                    <?php
                           if($user){
                                $newSql=mysqli_query($conn,"SELECT  product_id FROM cart where user_id={$_SESSION['user']}");
                              if(mysqli_num_rows($newSql)>0)
                              $result=true;
                              else
                              $result=false;
                           }
                           else
                           $result=false;

                                ?>
                        <header>
                            <h3><?php if($result) echo ""; else echo "Your Cart is Empty"; ?></h3>
                            <div class="design">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </header>
                        <main>
                       
                            <div class="empty-cart" style="display: <?php if($result) echo "none"; else echo "flex"; ?>;">
                               <img src="images/emptyCart.052e2617.svg" alt="">
                                <p>Explore our menu to add some items to your cart</p>
                            </div> 
                            <div class="filled-cart" style="display: <?php if($result) echo "block"; else echo "none"; ?>;">
                             
                            </div>
                        </main>
                    </div>
                    <div class="cart-footer Place-order" style="display: <?php if($result) echo "flex"; else echo "none"; ?>;" id="footer">
                        <div class="price">
                            <h3></h3>
                            <span>*All peices are VAT Inclusive</span>
                        </div>
                        <div>Place Order <i class='bx bxs-right-arrow-alt'></i></div> 
                 </div>
                </div>
                <div class="cart-footer  footer2" id="open-cart" >
                        <div class="price">
                            <h3></h3>
                            <span>*All peices are VAT Inclusive</span>
                        </div>
                        <div>view Cart <i class='bx bxs-right-arrow-alt'></i></div> 
                 </div>
               </div>
               
          </div>
          
    </main>
    <script src="javascript/menu.js"></script>
</body>
</html>