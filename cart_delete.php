<?php
include 'connection.php';

if (isset($_GET['id'])) {
$id = $_GET['id'];
$qry = 'DELETE FROM CART WHERE PRODUCT_ID = :productID';
$stid = oci_parse($con, $qry);
oci_bind_by_name($stid, ':productID', $id);
oci_execute($stid);
header('Location:shoping-cart.php?action=deleted');

}
else{
header('Location: index.php');
}

?>