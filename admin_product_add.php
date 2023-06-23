<?Php 
include 'admin_sidebar_header.php';
?>

<?php
if($_POST){
include 'connection.php';


$uname= $_SESSION['username'];
$filename=$_FILES["uploadfile"]["name"];
$tempname=$_FILES["uploadfile"]["tmp_name"];
$folder="./img/".$filename;
move_uploaded_file($tempname,$folder);



$PRODUCT_NAME=htmlspecialchars(strip_tags($_POST['PRODUCT_NAME']));
$PRICE=htmlspecialchars(strip_tags($_POST['PRICE']));
$STOCK=htmlspecialchars(strip_tags($_POST['STOCK']));
$INFORMATION=htmlspecialchars(strip_tags($_POST['INFORMATION']));
$CATEGORY=htmlspecialchars(strip_tags($_POST['CATEGORY']));


$qry= "INSERT INTO PRODUCT (PRODUCT_ID,PRODUCT_NAME,PRICE, STOCK,INFORMATION,CATEGORY,ENTERED_BY, IMAGE)
VALUES (SEQ_PRODUCT.nextval ,'$PRODUCT_NAME','$PRICE','$STOCK','$INFORMATION','$CATEGORY','$uname','$folder')";

$stid=oci_parse($con, $qry);
if(oci_execute($stid))
{
echo "<div style='margin-left:300px; margin-top:100px' class='alert alert-success'>New herb is added.</div>";
}else{
echo "<div class='alert alert-danger'>Herb not found.</div>";
}
}
?>

<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Add herb</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="profile.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Add herb</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

                         <div class="row">
                   
                        <br>
                        <form style="margin-left:270px" action="admin_product_add.php" method="post" enctype="multipart/form-data">
                            
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
                            <button type='submit' value='Save' class='site-btn coupon-btn'>Add herb</button>
                   
                        </form>
                    </div>
                </div>
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