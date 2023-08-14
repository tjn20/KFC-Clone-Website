<?php
session_start();

if(isset($_SESSION['user'])){
    include_once "database.php";
    
    $sql=mysqli_query($conn,"SELECT * FROM cart where user_id={$_SESSION['user']}");
    if(mysqli_num_rows($sql)>0){
        $type=filter_input(INPUT_POST,"type",FILTER_SANITIZE_SPECIAL_CHARS);
        if($type==="complete"){

$itemsNo=mysqli_escape_string($conn,$_POST['items']);
$totalPrice=mysqli_escape_string($conn,$_POST['totalPrice']);
$userInst=mysqli_escape_string($conn,$_POST['userInst']);


 $sqlInsert=mysqli_query($conn,"INSERT INTO orders(user_id,items_no,total_price,user_instructions) VALUES ({$_SESSION['user']},{$itemsNo},{$totalPrice},'{$userInst}')");
if($sqlInsert){
    
   $check=false;
   $sqlGetOrder=mysqli_query($conn,"SELECT * FROM orders where user_id={$_SESSION['user']} order by order_id DESC LIMIT 1");
    $sqlInsertRow=mysqli_fetch_assoc($sqlGetOrder);
    while($row=mysqli_fetch_assoc($sql)){
        $SqlInsertFromCart=mysqli_query($conn,"INSERT INTO orderitems VALUES({$sqlInsertRow['order_id']},{$row['product_id']},{$row['quantity']})");    
    if($SqlInsertFromCart)
    $check=true;
    else
    $check=false;
    }
    if($check){
        $sqlDelete=mysqli_query($conn,"DELETE FROM cart where user_id={$_SESSION['user']}");
        if($sqlDelete){
$getUser=mysqli_query($conn,"SELECT * FROM user where user_id={$_SESSION['user']}");
$getUserRow=mysqli_fetch_assoc($getUser);

$mailSender="tjndocsell@gmail.com";

$mailReciever=$getUserRow['email'];
$subject="Your Order has been confirmend!- Delivery | KFC";
$message=" Hi {$getUserRow['name']},
Thank you for choosing KFC! your order has been confirmed and will be delivered at your doorstep shortly!
ORDER NUMBER. {$sqlInsertRow['order_id']}
{$sqlInsertRow['order_date']}
----------------
Delivery Address
{$getUserRow['building_no']},{$getUserRow['street']},{$getUserRow['area']},{$getUserRow['city']}

SubTotal  AED {$totalPrice}
Shipping  AED 9.5
Grand Total AED".$totalPrice+9.5;

if(mail($mailReciever,$subject,$message,$mailSender))
echo "done";
else
            echo "Something went wrong! Please try again";


        }
        else{
            echo "Something went wrong! Please try again 14";

        }
    }
    else{
        echo "Something went wrong! Please try again 13 ";

    }
}
else{
    echo "Something went wrong! Please try again 12";
}

        }
else{
    
    $city=filter_input(INPUT_POST,"city",FILTER_SANITIZE_SPECIAL_CHARS);
    $city=mysqli_escape_string($conn,$city);

    $area=filter_input(INPUT_POST,"area",FILTER_SANITIZE_SPECIAL_CHARS);
    $area=mysqli_escape_string($conn,$area);
    
    $street=filter_input(INPUT_POST,"street",FILTER_SANITIZE_SPECIAL_CHARS);
    $street=mysqli_escape_string($conn,$street);

    $building=filter_input(INPUT_POST,"building",FILTER_SANITIZE_SPECIAL_CHARS);
    $building=mysqli_escape_string($conn,$building);
if(!empty($city) && !empty($area) &&  !empty($street) &&  !empty($building)){
$userSql=mysqli_query($conn,"UPDATE user set city='{$city}',area='{$area}',street='{$street}',building_no={$building} where user_id={$_SESSION['user']}");
if($userSql)
echo "done";
else
echo "Something went wrong! Please try again";

}
else
echo "Please enter all fields";     
}
    
}
    else
    header("Location: ../menu");
}
    else
    header("Location: ../login");




?>