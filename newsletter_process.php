<?php
session_start();
//Set up the database access credentials
require_once('connection.php');
if(isset($_POST['submit']))
{

$email=$_POST['email'];
$name = $_SESSION['uname'];

//send email

$_SESSION['email']=$email;
$_SESSION['name']=$name;
require 'scripts/PHPMailerAutoload.php';

$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username ='authentic.nepalherbs@gmail.com';                 // SMTP username
$mail->Password ='nepalherbs123';                            // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$to=$_SESSION['email'];
$mail->setFrom('authentic.nepalherbs@gmail.com', 'Authentic Herbs');
$mail->addAddress($to);                                 // Add a recipient

$mail->isHTML(true);  

$mail->Subject = 'Welcome to your first newsletter';
$mail->Body = "
Hello " .$_SESSION['uname'].",
<br>
Thank you for subscribing to our weekly newsletter. You will now receive a monthly email notifying you of our latest herbs.
<br>
Here is your <a href ='http://localhost/herbs/shop-grid.php'>link</a> you can visit for now to access our newsletter updated herbs.
<br>

<br>

<br><br>
Regards,<br>
Authentic herbs Nepal, <br>
Kathmandu, Nepal.
";

$mail->send();
header('location:index.php?action=sent');


}
?>