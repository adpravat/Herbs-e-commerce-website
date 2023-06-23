;<?Php 
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
								<h4>All Users</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">All Users</li>
								</ol>
							</nav>
						</div>
						
					</div>
				</div>
				<!-- Simple user table start -->
				<div class="card-box mb-30">
					<div class="pd-20">
						<h4 class="text-blue h4">All Users</h4>
						
					</div>
					<div class="pb-20">
						<table class="data-table table stripe hover nowrap">
							<thead>
								<tr>
									<th class="table-plus datatable-nosort">Name</th>
									<th>E-mail</th>
									<th>Address</th>
									<th>Mobile</th>
									<th>Password</th>
									<th class="datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>

<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";

// if it was redirected from delete.php
if($action=='deleted'){
echo "<div class='alert alert-danger'>User is deleted.</div>";
}
if($action=='enable'){
echo "<div class='alert alert-success'>User account has been enabled.</div>";
}
if($action=='disable'){
echo "<div class='alert alert-danger'>User account has been disabled.</div>";
}

$qry = "SELECT * FROM Users WHERE Role='Customer'";  

$stid = oci_parse($con, $qry);
oci_execute($stid);
while ($row=oci_fetch_array($stid))
{
?>
 <tr>
									<td class="table-plus"><?php echo $row['NAME']; ?></td>
									<td><?php echo $row['EMAIL']; ?></td>
									<td><?php echo $row['ADDRESS']; ?></td>
									<td><?php echo $row['MOBILE']; ?> </td>
									<td><?php echo $row['PASSWORD']; ?></td>
									<td>
										<div class="dropdown">
											<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
												<i class="dw dw-more"></i>
											</a>
	<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
     <a class="dropdown-item" href="admin_user_enable.php?id=<?= $row['USER_ID'] ?>"><i class="dw dw-edit2"></i> Enable</a>
     <a class="dropdown-item" href="admin_user_disable.php?id=<?php echo $row['USER_ID']; ?>"><i class="dw dw-delete-3"></i> Disable</a>
	 <a class="dropdown-item" href="admin_user_delete.php?id=<?php echo $row['USER_ID']; ?>"><i class="dw dw-delete-3"></i> Delete</a>
											</div>
										</div>
									</td>
								</tr>

                              <?php
                               }
                                ?>
								
								
							</tbody>
						</table>
					</div>
				</div>
				<!-- Simple usertable End -->

			</div>
			
		</div>
	</div>
	<!-- js -->
	<script src="admins/vendors/scripts/core.js"></script>
	<script src="admins/vendors/scripts/script.min.js"></script>
	<script src="admins/vendors/scripts/process.js"></script>
	<script src="admins/vendors/scripts/layout-settings.js"></script>
	<script src="admins/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="admins/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="admins/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="admins/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<!-- buttons for Export datatable -->
	<script src="admins/src/plugins/datatables/js/dataTables.buttons.min.js"></script>
	<script src="admins/src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
	<script src="admins/src/plugins/datatables/js/buttons.print.min.js"></script>
	<script src="admins/src/plugins/datatables/js/buttons.html5.min.js"></script>
	<script src="admins/src/plugins/datatables/js/buttons.flash.min.js"></script>
	<script src="admins/src/plugins/datatables/js/pdfmake.min.js"></script>
	<script src="admins/src/plugins/datatables/js/vfs_fonts.js"></script>
	<!-- Datatable Setting js -->
	<script src="admins/vendors/scripts/datatable-setting.js"></script></body>
</html>