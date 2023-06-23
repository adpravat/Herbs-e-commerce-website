<?php
include'connection.php';
session_start();

if(isset($_SESSION['username']))
{
$uname= $_SESSION['username'];
$sql="SELECT * FROM Users WHERE Name='$uname'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
$row=oci_fetch_array($stid);
$user_id=$row['USER_ID'];

if (isset($_POST['submit'])) {

$name = $_POST['hidden_name'];
$product_id = $_POST['hidden_id'];
$quantity = $_POST['hidden_quantity'];
$price = $_POST['hidden_price'];

}
$qry ="SELECT * FROM PRODUCT WHERE PRODUCT_ID = $product_id";
$stid = oci_parse($con, $qry);
oci_execute($stid);

while ($row=oci_fetch_array($stid))
{
$id = $row['PRODUCT_ID'];
$name = $row['PRODUCT_NAME'];
$amount = $row['PRICE'];
$discount = $row ['DISCOUNT_ID'];
$stock=  $row['STOCK'];
$info = $row ['INFORMATION'];
$review = $row ['REVIEW'];
$category = $row['CATEGORY'];
$image = $row ['IMAGE'];
$entered = $row['ENTERED_BY'];

if ($stock <=1) {

echo "<script>alert('No stock cannot be added to cart')</script>";
echo "<script>window.location='shop-grid.php'</script>";

exit;
}
else {
$stock = $stock-$quantity;
echo "<script>window.location='shop-grid.php?action=added'</script>";
}
}



//--------user id should be added to it
$qry = "INSERT into CART VALUES (seq_cart.nextval,$user_id, $id , $quantity)";

$stmt = oci_parse($con,$qry);
$row= oci_execute($stmt);
oci_free_statement($stmt);

if ($row){
echo "<br>";
echo "<script> window.location.href='shop-grid.php';</script>";
}
//---------------------------------------------------------------------------
//echo $stock; new value of stock
$stid = oci_parse($con,'UPDATE PRODUCT SET PRODUCT_NAME = :product_name, SHOP_NAME = :shop_name, PRICE = :rate_number, DISCOUNT_ID = :discount_number,
STOCK = :stock_number, INFORMATION = :info_product, REVIEW = :customer_review, CATEGORY = :category_list, IMAGE = :folder_name,
ENTERED_BY =:entered_name WHERE PRODUCT_ID= :product_id');

oci_bind_by_name($stid,':product_id',$id);
oci_bind_by_name($stid,':product_name',$name);
oci_bind_by_name($stid,':rate_number', $price);
oci_bind_by_name($stid,':discount_number', $discount);
oci_bind_by_name($stid,':stock_number', $stock);
oci_bind_by_name($stid,':info_product', $info);
oci_bind_by_name($stid,':customer_review', $review);
oci_bind_by_name($stid,':category_list', $category);
oci_bind_by_name($stid,':folder_name', $image);
oci_bind_by_name($stid,':entered_name', $entered);

oci_execute($stid);
oci_free_statement($stid);
oci_close($con);


}
else
{
echo '<script>alert("Please login first to add products to cart.");</script>';
echo '<script>window.location="shop-grid.php"</script>';
}

?>