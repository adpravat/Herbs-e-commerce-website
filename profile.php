<?php 
include 'cust_sidebar_header.php';


$uname= $_SESSION['username'];
$sql="SELECT * FROM Users WHERE Name='$uname'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
$row=oci_fetch_array($stid);


//$img=$row['IMAGE'];
$id=$row['USER_ID'];
$name=$row['NAME'];
$password=$row['PASSWORD'];
$email=$row['EMAIL'];
$address=$row['ADDRESS'];
$phone=$row['MOBILE'];
$gender=$row['GENDER'];
$img=$row['IMAGE'];

?>
	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-12 col-sm-12">
							<div class="title">
								<h4>Profile</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Profile</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
						<div class="pd-20 card-box height-100-p">
							<div class="profile-photo">
								<a href="modal" data-toggle="modal" data-target="#modal" class="edit-avatar"><i class="fa fa-pencil"></i></a>
								<a href="javascript:;">
<?php
if((empty($img)))
{
?>
<img class="avatar-photo" src="img/avatar.jpg" id="image" onchange="readURL(this);"/>
<?php
}
else
{
?>
<img class="avatar-photo" src="<?php echo $img;?>" id="image" onchange="readURL(this);" />
<?php
}
?>
                  </a>


							</div>
							<h5 class="text-center h5 mb-0"><?php echo $name;?></h5>
							<div class="profile-info">
								<h5 class="mb-20 h5 text-blue">Contact Information</h5>
								<ul>
									<li>
										<span>Email Address:</span>
										<?php echo $email;?>
									</li>
									<li>
										<span>Phone Number:</span>
									     <?php echo $phone;?>
									</li>
									<li>
										<span>Gender:</span>
										<?php echo $gender;?>
									</li>
									<li>
										<span>Address:</span>
										 <?php echo $address;?>
									</li>
 <form action="profile_update.php" method="post" enctype="multipart/form-data">
									<li>
<label>Upload photo</label>
<input type="file" name="uploadfile" class="form-control form-control-lg">
						</li>
							</ul>
							</div>
						</div>
					</div>
					<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
						<div class="card-box height-100-p overflow-hidden">
							<div class="profile-tab height-100-p">
								<div class="tab height-100-p">
									<ul class="nav nav-tabs customtab" role="tablist">
										
										
										<li class="nav-item">
											<a class="nav-link" data-toggle="tab" href="#setting" role="tab">Your Info</a>
										</li>
									</ul>
									<div class="tab-content">
										
										<!-- Setting Tab start -->
										<div  id="setting" role="tabpanel">
											<div class="profile-setting">
					                        
													<ul class="profile-edit-list row">
														<li class="weight-500 col-md-6">

		
															<h4 class="text-blue h5 mb-20">Edit Your Personal Setting</h4>
															<div class="form-group">

															<input class="form-control form-control-lg" type="hidden" name="id" value ="<?php echo $id??''?>">

															<label>User Name</label>
															<input class="form-control form-control-lg" type="text" name="name" value ="<?php echo$name??''?>">
															</div>
															<div class="form-group">
																<label>Password</label>
															<input class="form-control form-control-lg" type="text" name="password" value ="<?php echo $password??''?>">
															</div>
															<div class="form-group">
																<label>Email</label>
															<input class="form-control form-control-lg" type="email" name="email" value ="<?php echo $email??''?>">
															</div>
															
															<div class="form-group">
																<label>Phone Number</label>
															<input class="form-control form-control-lg" type="text" name="phone" value ="<?php echo $phone??''?>">
															</div>
															<div class="form-group">
																<label>Address</label>
															<input class="form-control form-control-lg" type="text" name="address" value ="<?php echo $address??''?>">
															
															<br>
															<div class="form-group">
															</div>
															<div class="form-group mb-0">
																<input type="submit" name="edit" class="btn btn-primary" value="Update Information">
															</div>
														</li>
												
													</ul>
												</form>
											</div>
										</div>
										<!-- Setting Tab End -->


									</div>
								</div>
							</div>
						</div>
					</div>
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