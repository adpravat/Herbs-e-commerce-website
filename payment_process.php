<?php
session_start();
include 'connection.php';


if (isset($_POST['done'])) {

$day = $_POST['timeoption'];
$uname= $_SESSION['username'];
$sql = "SELECT * FROM USERS where NAME= '$uname'"; 
$stid = oci_parse($con,$sql);
oci_execute($stid);
$row=oci_fetch_array($stid);
$user_id= $row['USER_ID'];
date_default_timezone_set('Asia/Kathmandu');
$date = date("m/d/Y");

    // insert data into order table
  $query = "SELECT PRODUCT_ID, QTY FROM CART WHERE USER_ID='$user_id'";
    $stid = oci_parse($con,$query);
    oci_execute($stid);

    $product_quantity = array();
    while ($row = oci_fetch_assoc($stid)) {
        $product_id = $row['PRODUCT_ID'];
        $bought_quantity = $row['QTY'];
        $product_quantity[$product_id] = $bought_quantity;
    }

  foreach ($product_quantity as $id => $quantity) {
        $query = "INSERT INTO ORDERS (ORDER_ID, PRODUCT_ID, QUANTITY, USER_ID, DELIVERY_DAY, ORDER_TIME) VALUES (SEQ_ORDER.nextval, :product_id, :quantity, :user_id, :day, TO_DATE('$date', 'mm/dd/yyyy'))";

        $stid = oci_parse($con, $query);

        oci_bind_by_name($stid, ':product_id', $id);
        oci_bind_by_name($stid, ':user_id', $user_id);
        oci_bind_by_name($stid, ':quantity', $quantity);
        oci_bind_by_name($stid, ':day', $day);
        oci_execute($stid);
    }

  // END insert data into order table

    // update products table
    foreach ($product_quantity as $id => $quantity) {
        $query = "SELECT PRODUCT_ID, STOCK FROM PRODUCT WHERE PRODUCT_ID='$id'";
        $stid = oci_parse($con, $query);
        oci_execute($stid);
        $row = oci_fetch_assoc($stid);
        $total_quantity = $row['STOCK'];

        $new_quantity = $total_quantity - $quantity;
       $query = "UPDATE PRODUCT SET STOCK='$new_quantity' WHERE PRODUCT_ID='$id'";

    $result = oci_parse($con, $query);
    oci_execute($result);
    }
 // END update products table


// remove items from cart

  //  $query = "DELETE FROM CART WHERE USER_ID='$user_id'";
  //  $stid = oci_parse($con, $query);
  //  oci_execute($stid);
    
//  END remove items from cart
header('location:invoice.php');

}
?>
