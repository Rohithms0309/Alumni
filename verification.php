<?php
session_start();

$con =mysqli_connect("localhost","root","") or die("Unnable to connect");
	
    mysqli_select_db($con,'login');
    
    if(isset($_GET['m']) && !empty($_GET['m']))
    {
        if(isset($_GET['w']) && !empty($_GET['w']))
        {
            $email=mysqli_real_escape_string($_GET['m']);
            $code=mysqli_real_escape_string($_GET['w']);

            $query=mysqli_query($con,"SELECT email,hashing,active FROM alumni WHERE email='".$email."' AND hashing='".$code."' AND active='0'");
            $num=mysqli_num_rows($query);

            if($num == 1)
            {
                mysqli_query($con,"UPDATE alumni SET active='1' WHERE WHERE email='".$email."' AND hashing='".$code."' AND active='0'");
                $_SESSION['msgemail']="Your account has been activated, You can login using the link below";
            }
            else if($num > 1)
            {
                $_SESSION['err']="EMAIL VERIFICATION ERROR CONTACT ADMIN";
            }
            else{
                $_SESSION['msgemail']="The url is either Invalid or you already have activated your account";
            }
        }
        else{
                $_SESSION['msgemail']="Invalid approach, Please use the link that has been sent to your email";
            }
        }
    }

?>