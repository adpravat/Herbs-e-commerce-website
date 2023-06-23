<?php
include'connection.php';
session_start();

if(isset($_SESSION['username']))
 {

$username=$_SESSION['username'];
$sql="SELECT * FROM USERS WHERE NAME='$username'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
$row=oci_fetch_array($stid);
$user_id=$row["USER_ID"];
if(isset($_POST['addreview']))
{
	$id= $_POST['id'];
	$review=$_POST['review'];

	$sql ="INSERT INTO REVIEW (REVIEW,USER_ID,PRODUCT_ID) VALUES ('$review',$user_id,'$id')";
   $stid=oci_parse($con,$sql);
   oci_execute($stid);
     header("Location:shop-grid.php");
}
}
else  {
  echo '<script>alert("You are required to login first in order to post review. ");</script>';
  echo '<script>window.location="shop-grid.php"</script>';
}
?>