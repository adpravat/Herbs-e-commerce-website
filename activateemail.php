<?php
if(!isset($_SESSION))
{
session_start();
}
require 'scripts/PHPMailerAutoload.php';

$mail = new PHPMailer;
$vkey=$_SESSION['vkey'];
$uname=$_SESSION['username'];
$pass=$_SESSION['password'];
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'enter email here ';                 // SMTP username
$mail->Password = 'enter password here';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$to=$_SESSION['email'];
$mail->setFrom('authentic.nepalherbs@gmail.com', 'Authentic Nepal Herbs');
$mail->addAddress($to);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Email Verification';
$mail->Body = "
Hello " .$_SESSION['username'].",<br><br>
Thanks for signing up!
Your account has been created, please click <a href ='http://localhost/herbs/verify_email.php?email=".$_SESSION['email']."&vkey=".$_SESSION['vkey']."'>here </a> to activate your account. <br>You can use these credentials to login to the website after you have activated your account:
<br><br>
Username:" .$_SESSION['username']."<br>
Password:" .$_SESSION['password']."
<br><br>
Regards,<br>
Authentic Herbs
";

$mail->send();
header('location:thankyou.php');

?>