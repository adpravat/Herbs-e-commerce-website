<?php
require_once 'connection.php';
if (isset($_POST['id'])) {


$id = $_POST['id'];
$name  = $_POST['name'];
$price = $_POST['rate'];
$stock = $_POST['stock'];
$information = $_POST['info'];
$category = $_POST['cat'];
$filename=$_FILES["uploadfile"]["name"];
$tempname=$_FILES["uploadfile"]["tmp_name"];
$folder="img/".$filename;
move_uploaded_file($tempname,$folder);


$stid = oci_parse($con,'UPDATE PRODUCT SET PRODUCT_NAME = :product_name,PRICE = :rate_number, 
STOCK = :stock_number, INFORMATION = :info_product, CATEGORY = :category_list, IMAGE = :folder_name WHERE PRODUCT_ID= :product_id');

oci_bind_by_name($stid,':product_name',$name);
oci_bind_by_name($stid,':rate_number', $price);
oci_bind_by_name($stid,':stock_number', $stock);
oci_bind_by_name($stid,':info_product', $information);
oci_bind_by_name($stid,':category_list', $category);
oci_bind_by_name($stid,':folder_name', $folder);
oci_bind_by_name($stid,':product_id',$id);

oci_execute($stid);
if($stid){
header ('Location:admin_product_view.php?action=updated');
}
oci_free_statement($stid);
oci_close($con);
}
