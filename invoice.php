<?php
include 'connection.php';
session_start();
$message = '';
$uname= $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>Invoice</title>

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

<?php
function fetch_customer_data($con){
$date=  date('d-m-Y' );
$invoiceno= date("dmY") . stripslashes(mt_rand());
$uname= $_SESSION['username'];
$sql="SELECT * FROM USERS WHERE Name='$uname'";
$stid=oci_parse($con,$sql);
oci_execute($stid);

$row=oci_fetch_array($stid);
$user_id=$row['USER_ID'];
$select_customer ="SELECT * FROM USERS WHERE USER_ID ='$user_id'";
$run_customer =oci_parse($con, $select_customer);
oci_execute($run_customer);
				
$output = '
				<div class="invoice-wrap" id="printableArea">
					<div class="invoice-box">
						<div class="invoice-header">
							<div class="logo text-center">
								<img src="img/logo.png" alt="">
							</div>
						</div>
						<h4 class="text-center mb-30 weight-600">INVOICE</h4>
';

$rows =oci_fetch_assoc($run_customer);{
$output .= '
						<div class="row pb-30">
							<div class="col-md-6">
								<h5 class="mb-15">'.$row["FIRSTNAME"].'</h5>
								<p class="font-14 mb-5">Date Issued: <strong class="weight-600">'.$date.'</strong></p>
								<p class="font-14 mb-5">Invoice No: <strong class="weight-600">'.$invoiceno.'</strong></p>
							</div>
							<div class="col-md-6">
								<div class="text-right">
									<p class="font-14 mb-5">'.$row["FIRSTNAME"].'</strong></p>
									<p class="font-14 mb-5">'.$row["ADDRESS"].'</p>
									<p class="font-14 mb-5">'.$row["EMAIL"].'</p>
									<p class="font-14 mb-5">'.$row["MOBILE"].'</p>
								</div>
							</div>
						</div>
';
}
return $output;
}
function fetch_cart_data($con)
{	
$output = '
						<div class="invoice-desc pb-30">
							<div class="invoice-desc-head clearfix">
								<div class="invoice-sub">Herb Name</div>
								<div class="invoice-rate">Price</div>
								<div class="invoice-hours">Quantity</div>
								<div class="invoice-subtotal">Subtotal</div>
							</div>
							<div class="invoice-desc-body">
	                        <ul>
';						
$totalprice=0;
$uname= $_SESSION['username'];
$sql="SELECT * FROM USERS WHERE Name='$uname'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
$row=oci_fetch_array($stid);
$user_id=$row['USER_ID'];
$qry = "SELECT * FROM CART where USER_ID =$user_id";
$stid = oci_parse($con, $qry);
oci_execute($stid);
while($row =oci_fetch_assoc($stid)){

$productid = $row['PRODUCT_ID'];
$innerqry ="SELECT PRODUCT_NAME, PRICE ,INFORMATION FROM PRODUCT WHERE PRODUCT_ID= $productid";
$stmt =oci_parse($con, $innerqry);
oci_execute($stmt);

$rowss =oci_fetch_assoc($stmt);{
$total = $rowss['PRICE'] * $row['QTY'];
$totalprice = $total + $totalprice;

$inner ="SELECT DELIVERY_DAY FROM ORDERS WHERE PRODUCT_ID= $productid AND USER_ID='$user_id'";
$stmt1 =oci_parse($con, $inner);
oci_execute($stmt1);
$row1=oci_fetch_array($stmt1);

$output .='
						<li class="clearfix">
							<div class="invoice-sub">'.$rowss["PRODUCT_NAME"].'</div>
							<div class="invoice-rate">'.$rowss["PRICE"].'</div>
							<div class="invoice-hours">'.$row["QTY"].'</div>
							<div class="invoice-subtotal"><span class="weight-600">Rs'.$total.'</span></div>
									</li>
							</ul>
';
}
}							
$output .= '
<br><br>
<h5 class="text-center"> You will be contacted via your registerd phone number </h5>
<h5 class="text-center"> Delivery day: '.$row1["DELIVERY_DAY"].' </h5>

							</div>
							<div class="invoice-desc-footer">
								<div class="invoice-desc-body">
									<ul>
										<li class="clearfix">
											<div class="invoice-subtotal"><span class="weight-600 font-24 text-danger">TOTAL PRICE:'.$totalprice.'</span></div>

										</li>
									</ul>									
								</div>
							</div>
						</div>
						<h4 class="text-center pb-20">Thank You!! </h4>
					</div>
				</div>
			</div>
		</div>
	</div>
';
return $output;
}
?>
<?php
if(isset($_POST["action"]))
{
include('pdf.php');
$file_name = md5(rand()) . '.pdf';
$html_code = '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">';
$html_code .= fetch_customer_data($con);
$html_code .= fetch_cart_data($con);
$pdf = new Pdf();
$pdf->load_html($html_code);
$pdf->render();
$file = $pdf->output();
file_put_contents($file_name, $file);

// calling user name from the log in  profile
$uname= $_SESSION['username'];
$sql="SELECT * FROM USERS WHERE Name='$uname'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
while($row = oci_fetch_assoc($stid)){

$customer_email=$row['EMAIL'];


require 'invoice_mailer/class.phpmailer.php';
$mail = new PHPMailer;
$mail->IsSMTP();								//Sets Mailer to send message using SMTP
$mail->Host = 'smtp.gmail.com';		//Sets the SMTP hosts of your Email hosting, this for Godaddy
$mail->Port = '587';								//Sets the default SMTP server port
$mail->SMTPAuth = true;							//Sets SMTP authentication. Utilizes the Username and Password variables
$mail->Username = 'customer.nepal123@gmail.com';					//Sets SMTP username
$mail->Password = 'nepalherbs123';					//Sets SMTP password
$mail->SMTPSecure = 'tls';							//Sets connection prefix. Options are "", "ssl" or "tls"
$mail->From = 'authentic.nepalherbs@gmail.com';			//Sets the From email address for the message
$mail->FromName = 'Authentic Nepal Herbs';
$address = array  ($customer_email);//Sets the From name of the message
while (list ($key, $val) = each ($address)) {
$mail->AddAddress	($val);}					//Adds a "To" address
$mail->WordWrap = 50;							//Sets word wrapping on the body of the message to a given number of characters
$mail->IsHTML(true);							//Sets message type to HTML
$mail->AddAttachment($file_name);     				//Adds an attachment from a path on the filesystem
$mail->Subject = 'Invoice Details';			//Sets the Subject of the message
$mail->Body = 'Please Find Invoice details in attach PDF File.';				//An HTML or plain text message body
if($mail->Send())								//Send an Email. Return true on success or false on error
{
$message = '<label style="margin-left:200px;" class="alert alert-success"> Dear Customer  Invoice of your product has been emailed to you successfully.</label>';
}
else
{
$message = '<label class="alert alert-danger"> Dear Customer Invoice  of your product could not be mailed please do  check your email address or contact our admin  with this email .</label>';
}
unlink($file_name);
}
}
?>

<body>
	<div class="header">
		<div class="header-left">
			<div class="menu-icon dw dw-menu"></div>
		</div>
		<div class="header-right">
			<div class="user-info-dropdown">
				<div class="dropdown">
					<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
						<span class="user-icon">
							<img src="vendors/images/photo1.jpg" alt="">
						</span>
						<span class="user-name"><?php echo $uname;?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
						<a class="dropdown-item" href="profile.php"><i class="dw dw-user1"></i> Profile</a>
						<a class="dropdown-item" href="login.php"><i class="dw dw-logout"></i> Log Out</a>
					</div>
				</div>
			</div>	
		</div>
	</div>


	<div class="left-side-bar">
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
			
                     <li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-house-1"></span><span class="mtext">Home</span>
						</a>
						<ul class="submenu">
							<li class="active"><a href="./index.php">Back to Home</a></li>
							<li><a href="./shop-grid.php">Back to Shop</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>


	<div class="mobile-menu-overlay"></div>
	<div class="main-container">	
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Invoice</h4>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 text-right">
					
			<form method="post">
            <button type="submit" name="action" class="btn btn-primary" value="">Send INVOICE in mail in PDF</button>
            </form><br>
            <button class="btn btn-secondary print" onclick="printDiv('printableArea')"><span class="ti-printer"> </span>Print Invoice</button>	
						</div>
					</div>
				</div>
<?php echo $message;?>				
<?php
echo fetch_customer_data($con);
echo fetch_cart_data($con);
?>

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>

	<!-- js -->
	<script src="admins/vendors/scripts/core.js"></script>
	<script src="admins/vendors/scripts/script.min.js"></script>
	<script src="admins/vendors/scripts/process.js"></script>
	<script src="admins/vendors/scripts/layout-settings.js"></script>
</body>
</html>