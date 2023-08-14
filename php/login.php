<?php


session_start();
include_once "database.php";

$action=mysqli_escape_string($conn,$_POST['action']);
if($action==="login"){
    $phone=filter_input(INPUT_POST,"phone",FILTER_SANITIZE_NUMBER_INT);
    $phone=mysqli_escape_string($conn,$phone);

    $sql=mysqli_query($conn,"SELECT * FROM user where phone_number={$phone}");
    if(mysqli_num_rows($sql)>0){
        $code=rand(9999, 1111);
      $updateSql=mysqli_query($conn,"UPDATE user set verifCode={$code} where phone_number={$phone}");
      if($updateSql){
        $row=mysqli_fetch_assoc($sql);
$sender="YOUR_EMAIL";
$reciever=$row['email'];
$subject="Your Verification Code-it expires after 4 minutes";
$message="Your verification code is $code";
        if(mail($reciever,$subject,$message,$sender)){
            echo "done";
            $_SESSION['email']=$row['email'];
        }

      } 
      else
      echo "something wrong happened"; 
    }
    else{
      $_SESSION['phone']= $phone;
    echo "notRegistered";
    }
}

else if($action==="otp"){
  $code=filter_input(INPUT_POST,"code",FILTER_SANITIZE_NUMBER_INT);
  $code=mysqli_escape_string($conn,$code);
$expired=mysqli_escape_string($conn,$_POST['expired']);
  $sql=mysqli_query($conn,"SELECT * FROM user where email='{$_SESSION['email']}'");
  $row=mysqli_fetch_assoc($sql);
  if($expired!="true"){
if($code===$row['verifCode']){
  $code=0;
$sqlUpdate=mysqli_query($conn,"UPDATE user set verifCode={$code}, status='verified' where email='{$_SESSION['email']}'");
if($sqlUpdate){
  $_SESSION['email']="";
  $_SESSION['phone']="";
session_unset();
$_SESSION['user']=$row['user_id'];
echo "done";
}
else
echo "Something went wrong!";
    

}
else
echo "You have entered an incorrect OTP. Please try again";


  }
  else{
if($row['status']==="verified"){
$code=0;
  $sqlUpdate = mysqli_query($conn, "UPDATE user SET verifCode={$code} WHERE email='{$_SESSION['email']}'");
}    
else
      $sqlUpdate=mysqli_query($conn,"DELETE FROM user where email='{$_SESSION['email']}'");
if($sqlUpdate){
  $_SESSION['phone']="";
    $_SESSION['email']="";
    session_unset();
    echo "done";
}
  }

}

else if($action==="register"){
  $name=filter_input(INPUT_POST,"name",FILTER_SANITIZE_SPECIAL_CHARS);
  $name=mysqli_escape_string($conn,$name);
  
  $email=filter_input(INPUT_POST,"email",FILTER_SANITIZE_SPECIAL_CHARS);
  $email=mysqli_escape_string($conn,$email);

  if(!empty($email) && !empty($name)){
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
      $code=rand(9999, 1111);
      $sqlInsert=mysqli_query($conn,"INSERT INTO user(name,phone_number,email,verifCode,status) VALUES ('{$name}',{$_SESSION['phone']},'{$email}',{$code},'not-verified')");
      if($sqlInsert){
        $sqlSelect=mysqli_query($conn,"SELECT * FROM user where phone_number={$_SESSION['phone']}");
        $row=mysqli_fetch_assoc($sqlSelect);
        $sender="YOUR_EMAIL";
        $reciever=$row['email'];
        $subject="Your Verification Code-it expires after 4 minutes";
        $message="Your verification code is $code";
                if(mail($reciever,$subject,$message,$sender)){
                    $_SESSION['phone']="";
                    session_unset();
                    $_SESSION['email']=$row['email'];
                    echo "done";

                  }
                else
                echo "something wrong happened"; 
              } 
        else     
        echo "something wrong happened"; 
    }
  }
}
else{
  $_SESSION['user']="";
  session_unset();
  session_destroy();
  
  echo "done";

}

?>
