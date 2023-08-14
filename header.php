<?php

session_start();

include_once "php/database.php";

$result=false;
if(isset($_SESSION['user'])){
    $result=true;
    $sql=mysqli_query($conn,"SELECT * FROM user where user_id={$_SESSION['user']}");
    $sqlRow=mysqli_fetch_assoc($sql);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KFC</title>
    <link rel="stylesheet" href="headertry.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <header class="nav" style="position: <?php echo isset($position)?$position:"";  ?>;">
        <div class="header-left">
            <div class="hidden-menu">
            <div class="menu-user" style="display: <?php echo ($result?"none":"flex") ?>;">
                <i class="ri-user-add-fill"></i>
                <p>Login to unlock exclusive <br>
                <span>Offers and Discounts</span>
                </p>
                <button class="menu-login login">LOGIN</button>
            </div>
            <div class="menu-user-logined" style="display: <?php echo ($result?"flex":"none") ?>;">
                    <i class='bx bxs-user person-icon'></i>
                    <span><?php echo $sqlRow['name'] ?></span>
                    <i class='bx bx-log-in log-out'></i>

            </div>
            <hr>
            <div class="menu-lang-country">
               <div class="menu-lang">
                <h4>Language/اللغة</h4>
                <button>عربي</button> 
               </div>
               
                <div class="menu-country">
                 <h4>Country</h4>
                 <p><img src="images/Wikipedia-Flags-AE-United-Arab-Emirates-Flag.512.png" alt=""> UAE</p>
                </div>
            </div>
            <hr>
            <div class="menu-order">
                <a href="#"><i class="ri-store-3-line"></i>Store Locations</a>
                <a href="#"><i class='bx bx-shopping-bag' ></i>Track Order</a>
                <a href="#"><i class="ri-order-play-line"></i>Order History</a>
                <a href="#"><i class='bx bxs-offer'></i>Offers</a>
                <a href="menu.php"><i class='bx bx-food-menu' ></i>Explore Menu</a>
            </div>
            <hr>
            <div class="menu-others">
                <a href="#">Feedback</a>
                <a href="#">FAQ</a>
                <a href="#">Terms & Conditions</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Contact</a>
                <a href="#">Nutrition Information</a>
            </div>
            <hr>
            <div class="menu-others-2">
                <a href="#"><i class="ri-phone-fill"></i> Call Support</a>
            </div>
            <hr>
            <p><br><br><br><br><br><br><br><br><br></p>              
            </div> 
            
            <i class='bx bx-menu-alt-left openMenu'></i>
        </div>
        <div class="header-center">
            <img src="images/logo2.png">
        </div>
        <div class="header-right">
            <div class="icon-large">
                <i class="ri-shopping-cart-line openCart"></i>
                <div class="fly-item"><span class="item-number">0</span></div>
            </div>
                <button>عربي</button>
                <button class="login" style="display: <?php echo ($result?"none":"flex") ?>;">LOGIN</button>
                <div class="profile-cont" style="display: <?php echo ($result?"flex":"none") ?>;">
                    <i class='bx bxs-user person-icon profile'></i>
                    <span><?php echo $sqlRow['name'] ?></span>
                </div>
                <div class="user" style="display: <?php echo ($result?"flex":"none") ?>;">
                    <i class='bx bx-log-in log-out'></i>
                    
                </div>
            </div>
    </header>
    <script src="javascript/header.js"></script>

</body>
</html>