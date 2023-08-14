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
    <div class="login">
        <img src="php/images/banner.64dce7fa.svg" alt="">
    <form id="loginForm">
        <h4>Login with a valid local Mobile Number</h4>
        <div class="phone-number">
            <span>+971</span>
            <input type="number" name="phoneNumber" placeholder="MOBILE NUMBER*" class="numb" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  name="phone" onkeypress="return (event.charCode != 32) && (event.charCode != 45) &&(event.charCode != 43)">
        </div>
        <span class="error-message">E.g. 5XXXXXXX</span>
        <button class="submit">SUBMIT</button>
    </form>
    </div>
</div>
</div>
        <div class="background"></div>
    </div>
   <script src="javascript/login.js"></script>
</body>
</html>