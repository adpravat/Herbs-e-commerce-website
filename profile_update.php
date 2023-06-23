<?php
include'cust_sidebar_header.php';

require_once('connection.php');
if(isset($_POST['edit']))
{
$id= $_POST['id'];
$name=$_POST['name'];
$pass=$_POST['password'];
$email=$_POST['email'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$filename=$_FILES["uploadfile"]["name"];
$tempname=$_FILES["uploadfile"]["tmp_name"];
$folder="img/".$filename;
move_uploaded_file($tempname,$folder);

$output='';



$sql ="UPDATE Users SET Name='$name', Email='$email', Address ='$address', Mobile='$phone', Password='$pass', Image='$folder' WHERE User_ID='$id'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
if($sql)
{

$output='Your profile is updated';
unset($_SESSION['username']);
$_SESSION['username'] = $name;

}
}
?>

<body>
    <div class="main-container">
    <div class="pd-ltr-20 xs-pd-20-10">
      <div class="min-height-200px">
        <div class="page-header">
          <div class="row">
            &nbsp &nbsp <?php echo $output; ?>
           </div><hr>
             <a href="profile.php" >Back To Dashboard</a>
</div>
</div>
</div>
</div>
</body>