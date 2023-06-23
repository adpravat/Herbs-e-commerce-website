<?Php 
include 'connection.php';
?>

<?php
    if (isset($_GET['id'])) {
      $user_id = $_GET['id'];
     
      $sql = "UPDATE USERS SET STATUS='0' WHERE USER_ID = :id";
      $stmt = oci_parse($con,$sql);
      oci_bind_by_name($stmt, ':id', $user_id);    
      oci_execute($stmt);
  header ('Location:admin_user_view.php?action=disable');
 }
 oci_free_statement($stmt);
 oci_close($con);
 
 ?>

