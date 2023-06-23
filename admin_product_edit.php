<?Php 
include ('connection.php');
include 'admin_sidebar_header.php';
?>

<?php
    if (isset($_GET['id'])) {
      $product_id = $_GET['id'];
     
      $sql = "SELECT * FROM PRODUCT WHERE PRODUCT_ID = :id";
      $stmt = oci_parse($con,$sql);
      oci_bind_by_name($stmt, ':id', $product_id);    
      oci_execute($stmt);
    
      while (($row = oci_fetch_array($stmt, OCI_ASSOC)) != false) {
    
        $product_id  = $row['PRODUCT_ID']; 
        $product_name  = $row['PRODUCT_NAME'];  
        $price = $row['PRICE'];
        $stock = $row ['STOCK'];
        $info = $row ['INFORMATION'];
        $category =$row ['CATEGORY'];
   
       
 }
 oci_free_statement($stmt);
 oci_close($con);
 
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
								<h4>Update Herb</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="profile.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Update Herb</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

                         <div class="row">
                        <br>
                        <form style="margin-left:270px" action="admin_product_edit_process.php" method="post" enctype="multipart/form-data">

                           <div class="group-input">
                                <input style="margin-left: 118px;" type="hidden" name="id" value ="<?php echo  $product_id ?? '' ?> ">
                            </div>
                            <div class="group-input">
                                <label>Herb Name *</label>
                                <input style="margin-left: 120px;" type="text" name="name" value ="<?php echo $product_name ?? '' ?>">
                            </div>
                          <div class="group-input">
                                <label>Herb Price *</label>
                                <input style="margin-left: 125px;" type="number" name="rate" value ="<?php echo $price ?? '' ?>">
                            </div>
                            <div class="group-input">
                                <label>Herb Stock *</label>
                                <input style="margin-left: 120px;" type="number" name="stock" value ="<?php echo $stock ?? '' ?>">
                            </div>
                            <div class="group-input">
                                <label>Herb Category*</label>
                                <input style="margin-left: 98px;" type="text" name="cat" value ="<?php echo $category ?? '' ?>">
                            </div>

                            <hr>

                            <div class="group-input">
                                <label>Choose Image*</label>
                                <input style="margin-left: 65px;" type="file" style="border: none;" name="uploadfile">
                            </div><hr>
                            <div class="group-input">
                                <label>Herb Description *</label><br>
                                <input type="text" rows="4" class="form-control" cols="50" name="info" value ="<?php echo $info ?? '' ?>">
                            </div><hr>

                            <button type="submit" name="submit" value="Submit" class="site-btn coupon-btn"><?=  isset($product_id) ? 'Update' : 'Submit' ?></button>

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