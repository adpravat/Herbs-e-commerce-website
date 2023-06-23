<?php
include_once("connection.php");
session_start();
$error='';

if(isset($_POST['signin']))
{
$uname=$_POST['username'];
$password=$_POST['password'];
$userType=$_POST['rolelist'];

 //Validation START--------------------------->>

$sql="SELECT * FROM Users WHERE Name= '$uname'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
$row= oci_fetch_assoc($stid);

if(oci_num_rows($stid)==0)
{
$error= 'Username not found. Please try again';
}

else
{
$sql="SELECT * FROM Users WHERE Password = '$password'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
$row= oci_fetch_assoc($stid);

if(oci_num_rows($stid)==0)
{
$error= 'Password is incorrect. Please try again';
}
else
{
$sql="SELECT * FROM Users WHERE Name ='$uname' AND Password = '$password' AND Role ='$userType'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
$row= oci_fetch_assoc($stid);

if(oci_num_rows($stid)==0)
{
$error= 'Match not found. Please try again.';
}

else
{

//Email verification status for login

$sql="SELECT * FROM USERS WHERE Status= '0' AND NAME='$uname'";
$stid=oci_parse($con,$sql);
oci_execute($stid);
$row= oci_fetch_assoc($stid);

if(oci_num_rows($stid)==1)
{
$error= 'Please verify your account first.';
}

else
{

//Validation END--------------------------->>

$sql="SELECT * FROM Users WHERE Name= '$uname' AND Password = '$password' AND Role ='$userType'";
$stid=oci_parse($con,$sql);
oci_execute($stid);

$row= oci_fetch_assoc($stid);


$_SESSION['username']= $row['NAME'];
$_SESSION['userid']= $row['USER_ID'];
$_SESSION['role']= $row['ROLE'];

if(oci_num_rows($stid)==1)
{
if($_SESSION['role']=="Customer")
{

$_SESSION['userid']=$userid;
header("location:profile.php");
exit();
}
elseif($_SESSION['role']=="Admin")
{
$_SESSION['username']=$uname;
header("location:admin.php");
exit();
}
}
}
}
}
}
}
?>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/fonts/material-icon/css/material-design-iconic-font.min.css">
    <!-- Main css -->
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    
<!---------------- Login Form ---------------------------->

        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <img src="img/login.jpg" alt="sing up image"></figure>
                        <a href="signup.php" class="signup-image-link" >Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Login </h2><?php echo $error;?>
                        <form method="POST" action="login.php" onsubmit="return Validate()" name="lform"class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="username" id="your_name" placeholder="Your Username"/>
                            </div>
                            <div class="form-group">
                                <label for="password"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="password" placeholder="Password"/>
                            </div>

 <div class="form-group">
 <input type="radio" name="rolelist" value="Customer" class="agree-term" />
 <label class="label-agree-term"><span><span></span></span>Customer</label>
 <input type="radio" name="rolelist" value="Admin" class="agree-term" />
 <label class="label-agree-term"><span><span></span></span>Admin</label>
  </div>

                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
</body>



</html>


 <!-- JS -->
    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>