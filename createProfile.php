<?php
session_start();

if(!isset($_SESSION['phone']))
header("Location: login");

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
    <div class="create-profile">
        <div class="header">
            <h4>Create Profile</h4>
            <span></span>
        </div>
        <h4>Please enter your details</h4>
        <form>
            <input type="text" placeholder="Name*" max="30" name="name" onkeydown="return /[a-z]/i.test(event.key)" class="name">
            <input type="number" name="number" placeholder="MOBILE NUMBER*" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  name="phone" onkeypress="return (event.charCode != 32) && (event.charCode != 45) &&(event.charCode != 43)"  disabled value="<?php echo $_SESSION['phone']?>">
    <input type="email" name="email" placeholder="Email*" maxlength="200" onkeypress="return event.charCode != 32" class="email">
    <span class="error"></span>
    <button class="submit">SAVE</button>
        </form>
    </div>
</div>
</div>
        <div class="background"></div>
    </div>
    <script src="javascript/profile.js"></script>
</body>
</html>