
<?php
session_start();
if(!isset($_SESSION['email']))
header("Location: login");
include_once "php/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KFC</title>
  <link rel="stylesheet" href="signup.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
  <div class="wrap">
    <div class="page">
        <button class="close"><i class='bx bx-x'></i></button>
        <div class="content">
  <div class="otp">
    <div class="header">
        <h3>One Time Password</h3>
        <h4>Please enter the 4 digit OTP sent to</h4>
        <span><?php
        $sql=mysqli_query($conn,"SELECT * FROM user where email='{$_SESSION['email']}'");
        $row=mysqli_fetch_assoc($sql);
        echo "+971 ".$row['phone_number'];
        ?></span>
    </div>
    <form>
      <div class="inputs">
        <input type="number" class="otp-input" autofocus maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   onkeypress="return (event.charCode != 32) && (event.charCode != 45) &&(event.charCode != 43)">
        <input type="number" class="otp-input" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   onkeypress="return (event.charCode != 32) && (event.charCode != 45) &&(event.charCode != 43)">
        <input type="number" class="otp-input" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   onkeypress="return (event.charCode != 32) && (event.charCode != 45) &&(event.charCode != 43)">
        <input type="number" class="otp-input" maxlength="1" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"   onkeypress="return (event.charCode != 32) && (event.charCode != 45) &&(event.charCode != 43)">
      </div>
      <div class="error" >
        
      </div>
      <div class="text">
        <span id="countdownTimer"><!-- 10:00 --></span>
        <button class="request">REQUEST AGAIN</button>
      </div>
      <button class="submit">VERFIY</button>
    </form>
</div>
</div>
</div>
        <div class="background"></div>
    </div>
    <script src="javascript//otp.js"></script>
</body>
</html>