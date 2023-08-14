<?php
if(isset($_GET['url'])){
    
 $requestedUrl = $_GET['url'];
switch ($requestedUrl) {
    case '':
        include 'home.php';
        break;

        case 'home':
            include 'home.php';
            break;

    case 'menu':
        include 'menu.php';
        break;
     case 'payment':
            include 'payment.php';
            break; 

     case 'login':
            include 'login.php';
                break; 

                case 'otp':
                    include 'otp.php';
                        break;           
              
             case 'createProfile':
                include 'createProfile.php';
                break; 
             

    default:
        header("Location: home.php");
        break;
} 

} 




?>
