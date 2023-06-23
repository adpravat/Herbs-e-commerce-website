<?php
require_once 'connection.php';
if (isset($_POST['id'])) {


$id = $_POST['id'];
$name  = $_POST['name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$password = $_POST['password'];


$stid = oci_parse($con,'UPDATE USERS SET NAME = :user_name, EMAIL = :u_email, 
ADDRESS = :u_address, MOBILE = :u_mobile, PASSWORD = :password WHERE USER_ID= :user_id');

oci_bind_by_name($stid,':user_id',$id);
oci_bind_by_name($stid,':user_name',$name);
oci_bind_by_name($stid,':u_email', $email);
oci_bind_by_name($stid,':u_address', $address);
oci_bind_by_name($stid,':u_mobile', $phone);
oci_bind_by_name($stid,':password', $password);


oci_execute($stid);
if($stid){
header ('Location:admin_user_view.php');
}
oci_free_statement($stid);
oci_close($con);
}
