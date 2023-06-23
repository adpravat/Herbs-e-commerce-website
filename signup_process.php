<?php
include'connection.php';

if(isset($_POST['CREATE']))
{ 
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['username'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $mobile=$_POST['mobile'];
    $pass=$_POST['password'];
    $gender= $_POST['gender'];
    $role=$_POST['rolelist'];
  

$output='';
    //Generate verification key

    $vkey = md5(time().$uname);
    $date=  date("Y/m/d");

if (EMPTY($uname) OR EMPTY($fname) OR EMPTY($lname) OR EMPTY($email) OR EMPTY($pass) OR EMPTY($mobile) OR EMPTY ($address) OR EMPTY($role) OR EMPTY($gender)) 
{
       header ('Location:signup.php?action=empty');
}
else
{
  $sql="SELECT * FROM Users WHERE Name= '$uname'";
  $stid=oci_parse($con,$sql);
  oci_execute($stid);
  $row= oci_fetch_assoc($stid);
  if(oci_num_rows($stid)>0)
{
  header ('Location:signup.php?action=uname');
}

else
{
  $sql="SELECT * FROM Users WHERE Email= '$email'";
  $stid=oci_parse($con,$sql);
  oci_execute($stid);
  $row= oci_fetch_assoc($stid);
  if(oci_num_rows($stid)>0)
{
  header ('Location:signup.php?action=email');
}

else
{
  $sql="SELECT * FROM Users WHERE Password= '$pass'";
  $stid=oci_parse($con,$sql);
  oci_execute($stid);
  $row= oci_fetch_assoc($stid);
  if(oci_num_rows($stid)>0)
{
  header ('Location:signup.php?action=pass');
}

else
{

  $sql1="INSERT INTO Users(Firstname,Lastname,Name,Email,Address,Mobile,Password,Gender,Role,vkey,Status) VALUES ('$fname','$lname','$uname','$email','$address','$mobile','$pass','$gender','$role','$vkey',0)";
  $stid=oci_parse($con,$sql1);
  oci_execute($stid);

  if($sql1)
  {
    //send email

  $_SESSION['email']=$email;  
  $_SESSION['username']=$uname;
  $_SESSION['password']=$pass;
  $_SESSION['vkey']=$vkey;
  include('activateemail.php');
  }
}
}
}
}
}
?>
