<?Php 
include 'connection.php';
include 'cust_sidebar_header.php';
?>



<div class="mobile-menu-overlay"></div>
	<div class="main-container">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Add Product</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="profile.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add Herb</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
<?php
if($_POST){
$uname= $_SESSION['username'];
$filename=$_FILES["uploadfile"]["name"];
$tempname=$_FILES["uploadfile"]["tmp_name"];
$folder="./img/".$filename;
move_uploaded_file($tempname,$folder);

$sql = "SELECT * FROM USERS where NAME= '$name'"; 
$stid = oci_parse($con, $sql);
oci_execute($stid);
$row=oci_fetch_array($stid);
$fname= $row['FIRSTNAME'];

$PRODUCT_NAME=htmlspecialchars(strip_tags($_POST['PRODUCT_NAME']));
$PRICE=htmlspecialchars(strip_tags($_POST['PRICE']));
$STOCK=htmlspecialchars(strip_tags($_POST['STOCK']));
$INFORMATION=htmlspecialchars(strip_tags($_POST['INFORMATION']));
$CATEGORY=htmlspecialchars(strip_tags($_POST['CATEGORY']));


$qry= "INSERT INTO PRODUCT (PRODUCT_ID,PRODUCT_NAME,PRICE, STOCK,INFORMATION,CATEGORY,IMAGE,ENTERED_BY,STATUS)
VALUES (SEQ_PRODUCT.nextval ,'$PRODUCT_NAME','$PRICE','$STOCK','$INFORMATION','$CATEGORY','$folder','$fname','Pending')";

$stid=oci_parse($con, $qry);
if(oci_execute($stid))
{
echo "<div class='alert alert-success'>New herb is added.[Success]</div>";
}else{
echo "<div class='alert alert-danger'>Not successful try again:( </div>";
}
}
?>

                         <div class="row">
                        <form style="margin-left:270px" action="cust_product_add.php" method="post" enctype="multipart/form-data">
                            <div class="group-input">
                                <label>Herb Name *</label>
                                <input style="margin-left: 118px;" type="text" name="PRODUCT_NAME" placeholder="Product Name">
                            </div>
                          <div class="group-input">
                                <label>Herb Price *</label>
                                <input style="margin-left: 125px;" type="number" name="PRICE" placeholder="Product Price">
                            </div>
                            <div class="group-input">
                                <label>Herb Stock *</label>
                                <input style="margin-left: 120px;" type="number" name="STOCK" placeholder="Product Stock">
                            </div>
                            <div class="group-input">
                                <label>Herb Category*</label>
                                <input style="margin-left: 98px;" type="text" name="CATEGORY" placeholder="Product category">
                            </div>

                            <hr>

                            <div class="group-input">
                                <label>Choose Image*</label>
                                <input style="margin-left: 65px;" type="file" style="border: none;" name="uploadfile">
                            </div><hr>
                            <div class="group-input">
                                <label>Herb Description *</label><br>
                                <input type="text" rows="4" class="form-control" cols="50" name="INFORMATION" placeholder="Product Description">
                            </div><hr>
                            <button type='submit' value='Save' class='site-btn coupon-btn'>Add Herb</button>
                   
                        </form>
                    </div>
                </div>
          

<!-- js -->
	<script src="admins/vendors/scripts/core.js"></script>
	<script src="admins/vendors/scripts/script.min.js"></script>
	<script src="admins/vendors/scripts/process.js"></script>
	<script src="admins/vendors/scripts/layout-settings.js"></script>
	<script src="admins/src/plugins/cropperjs/dist/cropper.js"></script>
	
</body>
</html>