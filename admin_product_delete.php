<?php
include 'connection.php';
session_start();

if (isset($_GET['id'])) {
$id = $_GET['id'];
$qry = 'DELETE FROM PRODUCT WHERE PRODUCT_ID = :productID';
$stid = oci_parse($con, $qry);
oci_bind_by_name($stid, ':productID', $id);
oci_execute($stid);
header('Location:admin_product_view.php?action=deleted');

}
else{
header('Location:admin_product_view.php');
}

?>