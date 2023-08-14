<?php

session_start();

include_once "database.php";

if(isset($_SESSION['user'])){
    $action=mysqli_escape_string($conn,$_POST['action']);

$output="";
$totalPrice=0;
$items=0;
if($action==="add"){
    $productID=mysqli_escape_string($conn,$_POST['product_id']);

    $sql=mysqli_query($conn,"INSERT INTO cart(user_id,product_id) Values ({$_SESSION['user']},{$productID})");
}
else if($action==="get"){
    $newSql=mysqli_query($conn,"SELECT  * FROM cart where user_id={$_SESSION['user']}");
    if(mysqli_num_rows($newSql)>0){
    while($rowSql=mysqli_fetch_assoc($newSql)){
$productSql=mysqli_query($conn,"SELECT  * FROM products where product_id={$rowSql['product_id']}");
$productSqlFetch=mysqli_fetch_assoc($productSql);
$offer="";
if($productSqlFetch['discount_price']!=0){
$result=$productSqlFetch['discount_price'];
$offer.='<span>'.$productSqlFetch['price']*$rowSql['quantity'].' AED</span>';
}
else
$result=$productSqlFetch['price'];



$output.='<div class="item-added" id="'.$productSqlFetch['product_id'].'">
    <div class="item-added-details">
            <h3>'.$productSqlFetch['product_name'].'</h3>
            <div class="item-price">
                <span>'.$result*$rowSql['quantity'].' AED</span>
                '.$offer.'
            </div>
    </div>
    <div class="item-details">
        <button class="showDetails" onclick="showDetails(this)">Details<i class="bx bx-chevron-down" ></i></button>
        <div class="item-quantity">
            <div class="item-adjust">';
            if($rowSql['quantity']>1)
            $output.='<button class="dec" onclick="decreaseQuantity(this.parentElement.parentElement.parentElement.parentElement)"><i class="bx bx-minus"></i></button>'; 
            else  
            $output.='<button class="remove" onclick="removeProduct(this.parentElement.parentElement.parentElement.parentElement)"><i class="bx bx-trash" ></i></button>';
            $output.='  <span>'.$rowSql['quantity'].'</span>
                <button class="add" onclick="increaseQuantity(this.parentElement.parentElement.parentElement.parentElement)"><i class="bx bx-plus"></i></button>
            </div>
        </div>
    </div>
    <div class="item-desc">
        <p>'.$productSqlFetch['product_desc'].'</p>
    </div>
</div>';
    }
}
else{
    echo "empty";
}
echo $output;
}

else if($action==="remove"){
    $productID=mysqli_escape_string($conn,$_POST['product_id']);
    $sql=mysqli_query($conn,"DELETE FROM cart where (user_id={$_SESSION['user']} AND product_id={$productID})");
   
}

else if($action==="increase"){
    $quantity=mysqli_escape_string($conn,$_POST['quantity']);
    $productID=mysqli_escape_string($conn,$_POST['product_id']);
    $sql=mysqli_query($conn,"UPDATE cart set quantity=quantity+{$quantity} where product_id={$productID} AND user_id={$_SESSION['user']}");
}

else if($action==="decrease"){
    $quantity=mysqli_escape_string($conn,$_POST['quantity']);
    $productID=mysqli_escape_string($conn,$_POST['product_id']);
    $sql=mysqli_query($conn,"UPDATE cart set quantity=quantity-{$quantity} where product_id={$productID} AND user_id={$_SESSION['user']}");
}

else if($action==="total"){
    $newSql=mysqli_query($conn,"SELECT  * FROM cart where user_id={$_SESSION['user']}");
    if(mysqli_num_rows($newSql)>0){
    while($rowSql=mysqli_fetch_assoc($newSql)){
$productSql=mysqli_query($conn,"SELECT  * FROM products where product_id={$rowSql['product_id']}");
$productSqlFetch=mysqli_fetch_assoc($productSql);
if($productSqlFetch['discount_price']!=0)
$result=$productSqlFetch['discount_price'];
else
$result=$productSqlFetch['price'];
$items+=$rowSql['quantity'];
$totalPrice=$totalPrice+$result*$rowSql['quantity'];
}

header('Content-Type: application/json');

echo json_encode(array('totalPrice'=>$totalPrice,'items'=>$items));
    } 
}
/* else if($action==="adjust"){

} */


}
else
echo "empty";
?>