<!DOCTYPE html>
<?php
session_start();
include 'connection.php';
$name= $_SESSION['username'];
?>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Admin Dashboard</title>

	<!-- Site favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="admins/vendors/images/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="admins/vendors/images/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="admins/vendors/images/favicon-16x16.png">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="admins/vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="admins/vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="admins/src/plugins/datatables/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="admins/src/plugins/datatables/css/responsive.bootstrap4.min.css">
	<link rel="stylesheet" type="text/css" href="admins/vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
</head>
<body>
	
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
	
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-name"><?php echo $name;?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						 <?php
                         if(isset($_SESSION['username']))
                         {
                      echo '<a class="dropdown-item" href="login.php"><i class="dw dw-logout"></i> Log Out</a>';
                        }
                          ?>
						
					</div>
				</div>
			</div>
			
		</div>
	</div>


	<div class="left-side-bar">
		
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
			
                    
						<ul class="submenu">
							<li><a href="admin.php">My Dashboard</a></li>
							<li><a href="admin_product_view.php">Manage Herbs</a></li>
							<li><a href="admin_user_view.php">Manage Users</a></li>
							<li><a href="admin_report_daily.php">Daily sales report</a></li>
							<li><a href="admin_report_weekly.php">Weekly sales report</a></li>
							<li><a href="admin_report_monthly.php">Monthly sales report</a></li>
					</ul>
	
					
				
			
				</ul>
			</div>
		</div>
	</div>