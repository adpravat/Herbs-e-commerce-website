<?Php 
include 'connection.php';
include 'admin_sidebar_header.php';
?>


	<div class="mobile-menu-overlay"></div>
	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>All Herbs</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">All Herbs</li>
								</ol>
							</nav>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
							
								<a class="btn btn-primary dropdown-toggle" href="admin_product_add.php" role="button">
									Add Herb
								</a>
	
							
						</div>
					</div>
				</div>

				<!-- Bordered table  start -->
				<div class="pd-20 card-box mb-30">
					<div class="clearfix mb-20">
						<div class="pull-left">
							<h4 class="text-blue h4">All Herbs</h4>
						
						</div>
						
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Herb name</th>
								<th scope="col">Price</th>
								<th scope="col">Stock</th>
								<th scope="col">Category</th>
								<th scope="col">Seller</th>
								<th scope="col"></th>
							</tr>
						</thead>

						<tbody>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
if($action=='deleted'){
echo "<div class='alert alert-danger'>Herb has been deleted.</div>";
}
if($action=='updated'){
echo "<div class='alert alert-success'>Herb has been updated.</div>";
}

$qry = "SELECT * FROM PRODUCT ";  

$stid = oci_parse($con, $qry);
oci_execute($stid);
while ($row=oci_fetch_array($stid))
{$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
?>

            <tr>
                    <td><?php echo $IMAGE ? "<img src='{$IMAGE}' style='width:50px;height:50px;' />" : "No image found.";  ?></td>
                    <td><?php echo $row['PRODUCT_NAME']; ?></td>
                    <td><?php echo $row['PRICE']; ?></td>
                    <td><?php echo $row['STOCK']; ?></td>
                    <td><?php echo$row['CATEGORY']; ?></td>
                    <td><?php echo $row['ENTERED_BY']; ?></td>
                    
                    </td>
                    <td>

                   <a href="admin_product_edit.php?id=<?= $row['PRODUCT_ID'] ?>" class="btn btn-success ">Edit</a>
                   <a href="admin_product_delete.php?id=<?php echo $row['PRODUCT_ID']; ?>" class='btn btn-danger'>Delete</a>

                    </td>
                </tr>
                </tr>

<?php
}
?>
						
						</tbody>
					</table>
					<div class="collapse collapse-box" id="border-table">
						<div class="code-box">
							<div class="clearfix">
								<a href="javascript:;" class="btn btn-primary btn-sm code-copy pull-left"  data-clipboard-target="#border-table-code"><i class="fa fa-clipboard"></i> Copy Code</a>
								<a href="#border-table" class="btn btn-primary btn-sm pull-right" rel="content-y"  data-toggle="collapse" role="button"><i class="fa fa-eye-slash"></i> Hide Code</a>
							</div>
							<pre><code class="xml copy-pre" id="border-table-code">
<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
    </tr>
  </tbody>
</table>
							</code></pre>
						</div>
					</div>
				</div>
				<!-- Bordered table End -->

				
			</div>
		</div>
	</div>
	<!-- js -->
	<script src="admins/vendors/scripts/core.js"></script>
	<script src="admins/vendors/scripts/script.min.js"></script>
	<script src="admins/vendors/scripts/process.js"></script>
	<script src="admins/vendors/scripts/layout-settings.js"></script>
</body>
</html>