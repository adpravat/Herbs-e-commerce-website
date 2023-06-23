<?php
include 'connection.php';
session_start();

if (isset($_GET['id'])) {
$id = $_GET['id'];
$qry = "UPDATE PRODUCT SET STATUS= 'Approved' WHERE  PRODUCT_ID = :productID";
$stid = oci_parse($con,$qry);
oci_bind_by_name($stid,':productID',$id);
oci_execute($stid);
header('Location:admin.php?action=approved');
}
else{
header('Location:admin.php');
}

?>