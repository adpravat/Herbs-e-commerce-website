<?php 
include 'cust_sidebar_header.php';
?>

<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>My Herbs</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="profile.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">My Herbs</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

<!--- PENDING  PRODUCT APPROVAL-------->


				<div class="card-box mb-30">
				<h2 class="h4 pd-20">Pending herbs for approval</h2>
				<table class="data-table table nowrap">
					<thead>
						<tr>
							<th class="table-plus datatable-nosort">#</th>
							<th>Name</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Category</th>
							<th>Seller</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
<?php
$qry = "SELECT * FROM PRODUCT WHERE STATUS='Pending'";  
$stid = oci_parse($con, $qry);
oci_execute($stid);
while ($row=oci_fetch_array($stid))
{$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
?>
	                    <tr>
						<td class="table-plus">
					<?php echo $IMAGE ? "<img src='{$IMAGE}' style='width:50px;height:50px;' />" : "No image found.";  ?></td>	
					<td><?php echo $row['PRODUCT_NAME']; ?></td>
                    <td><?php echo $row['PRICE']; ?></td>
                    <td><?php echo $row['STOCK']; ?></td>
                    <td><?php echo$row['CATEGORY']; ?></td>
                    <td><?php echo $row['ENTERED_BY']; ?></td>
                    <td><?php echo $row['STATUS']; ?></td>
						</tr>

<?php
}
?>

					</tbody>
				</table>
		</div>

<!--- END PENDING PRODUCT APPROVAL-------->


<!---  START CUSTOMERS APPROVED HERBS OR VIEW HERBS-------->
 <div class="card-box mb-30">
				<h2 class="h4 pd-20">Approved herbs by admin</h2>
				<table class="data-table table nowrap">
					<thead>
						<tr>
							<th class="table-plus datatable-nosort">#</th>
							<th>Name</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Category</th>
							<th>Seller</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
 <?php
$action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
if($action=='deleted'){
echo "<div class='alert alert-danger'>Herb is deleted.</div>";
}
if($action=='updated'){
echo "<div class='alert alert-success'>Herb has been updated.</div>";
}

$uname= $_SESSION['username'];
$sql = "SELECT * FROM USERS where NAME= '$name'"; 
$stid = oci_parse($con, $sql);
oci_execute($stid);
$row=oci_fetch_array($stid);
$fname= $row['FIRSTNAME'];

$qry = "SELECT * FROM PRODUCT where (ENTERED_BY)= '$fname' AND STATUS='Approved'";  

$stid = oci_parse($con, $qry);
oci_execute($stid);

while ($row=oci_fetch_array($stid))
{$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
?>

            <tr>
                    <td><?php echo $IMAGE ? "<img src='{$IMAGE}' style='width:50px;height:50px;' />" : "No image found.";  ?> </td>
                    <td><?php echo $row['PRODUCT_NAME']; ?></td>
                    <td><?php echo $row['PRICE']; ?></td>
                    <td><?php echo $row['STOCK']; ?></td>
                    <td><?php echo$row['CATEGORY']; ?></td>
                    <td><?php echo $row['ENTERED_BY']; ?></td>
                    <td><?php echo $row['STATUS']; ?></td>
                    <td>

                   <a href="cust_product_edit.php?id=<?= $row['PRODUCT_ID'] ?>" class="btn btn-success ">Edit</a>
                   <a href="cust_product_delete.php?id=<?php echo $row['PRODUCT_ID']; ?>" class='btn btn-danger'>Delete</a>

                    </td>
                </tr>
                </tr>

<?php
}
?>

					</tbody>
				</table>
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
