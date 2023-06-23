<?php
session_start();
//Set up the database access credentials
require_once('connection.php');
if(isset($_POST['submit']))
{

$name=$_POST['name'];
$email=$_POST['email'];
$msg=$_POST['message'];

//send email

$_SESSION['email']=$email;
$_SESSION['name']=$name;
$_SESSION['message']=$msg;
require 'scripts/PHPMailerAutoload.php';

$mail = new PHPMailer;
//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'authentic.nepalherbs@gmail.com';                 // SMTP username
$mail->Password = 'nepalherbs123';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to
$to='authentic.nepalherbs@gmail.com';
$mail->setFrom('authentic.nepalherbs@gmail.com', 'Authentic herbs');
$mail->addAddress($to);     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Contact Message From Customer';
$mail->Body = "
Hello,
<br>
<br>
This is " .$_SESSION['name']."
<br>
My message is: " .$_SESSION['message']."
<br><br>
Regards,<br>
 " .$_SESSION['name'].".
";

$mail->send();
header('location:contact.php?action=contact_sent');


}
?>


