<?php

session_start();

if(isset($_SESSION['user'])){
include_once "php/database.php";

$sql=mysqli_query($conn,"SELECT * FROM cart where user_id={$_SESSION['user']}");
if(!mysqli_num_rows($sql)>0)
header("Location: menu");
else{
$newSql=mysqli_query($conn,"SELECT * FROM user where user_id={$_SESSION['user']}");
    $sqlRow=mysqli_fetch_assoc($newSql);
}
}
else
header("Location: login");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KFC</title>
    <link rel="stylesheet" href="payment.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <header>

    </header>
    <main>
       <div class="payment-cont">
        <div class="checkout-title">
            <h3>Checkout</h3>
            <span></span>
        </div>
        <div class="checkout-cont">
            <div class="checkout">
                <header> 
                    <h3>Select Delivery Preference</h3>
                </header>
                <div class="checkout-content">
                    <div class="user-info">
                        <h4><?php echo $sqlRow['name']?></h4>
                        <span><i class='bx bxs-phone' ></i>+971 - <?php echo $sqlRow['phone_number']?></span>
                    </div>
                    <div class="choose-location" style="display:<?php echo ( $sqlRow['city']==="not-provided"?"flex":"none")?>">
                        <header>
                            Enter your Location
                        </header>
                        <div class="error-message">
                            <span></span>
                           </div>
                        <form >
                            <div class="location-details">
                               <div class="field">
                                <label>City</label>
                                <input type="text" placeholder="City" value="<?php echo ( $sqlRow['city']==="not-provided"?"":$sqlRow['city'])?>" name="city" class="city">
                               </div>
                               <div class="field">
                                <label>Area</label>
                                <input type="text" placeholder="Area" value="<?php echo ( $sqlRow['area']==="not-provided"?"":$sqlRow['area'])?>"  name="area" class="area">
                               </div>
                               <div class="field">
                                <label>Street Name</label>
                                <input type="text" placeholder="StreetName" value="<?php echo ( $sqlRow['street']==="not-provided"?"":$sqlRow['street'])?>"  name="street" class="street">
                               </div>
                               <div class="field">
                                <label>Building No.</label>
                                <input type="number" placeholder="Building No." value="<?php echo ( $sqlRow['building_no']=="0"?"":$sqlRow['building_no'])?>" name="building" class="building" min="0">
                               </div>
                            </div>
                            <input type="submit" value="SAVE" class="submit">
                            <h4>Or use Current Location</h4>
                            <button class="currentLocation"><i class='bx bx-current-location'></i>Current Location</button>
                        </form>
                    </div>
                    <div class="location-chosen">
                        <div class="location-header">
                            <h4>We'll deliver your order here</h4>
                            <button style="display:<?php echo ( $sqlRow['city']==="not-provided"?"none":"flex")?>" class="change">CHANGE</button>
                        </div>
                        <span id="chosen-address"><?php echo ( $sqlRow['city']==="not-provided"?"":$sqlRow['building_no'].",".$sqlRow['street'].",".$sqlRow['area'].",".$sqlRow['city'])?></span>
                    </div>
                    <div class="user-instructions">
                        <h3>Special Instructions (Optional)</h3>
                        <input type="text" maxlength="200" placeholder="Add Cooking/Delivery Instructions (Optional)">
                    </div>
                </div>

            </div>
            <div class="order-summary">
                <header>
                    <h5>Order Summary</h5>
                </header>
                <div class="order-div">
                <div class="order-cont">
                    <h3 class="order-quantity"></h3>
                    <div class="order-price">
                        <div class="total price-sum">
                            <h3>Total</h3>
                           <div class="price-sum">
                            <h3></h3>
                            <i class='bx bx-chevron-down'></i>
                           </div>
                        </div>
                        <div class="subtotal price-sum">
                            <h4>Subtotal</h4>
                            <h4 class="sub"></h4>
                        </div>
                        <div class="delivery price-sum">
                            <h4>Delivery Fees</h4>
                            <h4>9.50 AED</h4>
                        </div>
                    </div>
        
                </div>
                <div class="payment-type">
                    <h3>Payment Mode</h3>
                    <h3><i class='bx bxs-circle'></i> Cash on Delivery</h3>
                </div>
                <div class="complete-order">
                    <h3>Complete Order</h3>
                    <i class='bx bxs-right-arrow-alt'></i> </div>
            </div>
            </div>

        </div>
       </div>
    </main>
    <script src="javascript/payment.js"></script>

</body>
</html>