<?php
include 'connection.php';
session_start();

if (isset($_GET['id'])) {
$id = $_GET['id'];
$qry = 'DELETE FROM USERS WHERE USER_ID = :user_id';
$stid = oci_parse($con, $qry);
oci_bind_by_name($stid, ':user_id', $id);
oci_execute($stid);
header('Location:admin_user_view.php?action=deleted');

}
else{
header('Location:admin_user_view.php');
}

?>