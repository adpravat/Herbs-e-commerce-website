<?php
include_once("connection.php");
session_start();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>e-shop for herbs</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
   
    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="#"><img src="img/logo.PNG" alt=""></a>
        </div>
    </div>

    <!-- Humberger End -->

    <!-- Header Section Begin -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo.PNG" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Home</a></li>
                            <li><a href="./shop-grid.php">Shop</a></li>
                            <li><a href="./contact.php">Contact Us</a></li>
                             <?php
                         if(isset($_SESSION['username']))
                         {
                       echo '<li><a href="logout.php">Logout</a></li>';
                        }
                        else{
                            echo '<li><a href="signup.php">Signup</a></li>';
                             echo '<li><a href="login.php">Login</a></li>';
                        }
                            ?>
                        
                            
                        </ul>
                    </nav>
                </div>
<!---------------------------- Newsletter START------------------->

             <div class="col-lg-3 col-md-12">
                    <div class="footer__widget"><br>
                        <form action="newsletter_process.php" method='POST'>
                            <input type="text" name='email' placeholder="Your e-mail">
                            <button type="submit" name='submit' class="site-btn">Newsletter</button>
                        </form>
                    </div>
                </div>
 
<!---------------------------- Newsletter END------------------->
            </div>
             <?php
$action = isset($_GET['action']) ? $_GET['action'] : "";
// if it was redirected from delete.php
if($action=='sent'){
echo "<div class='alert alert-success'>Thank you for subscribing. Please check you email.</div>";
}?>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

        <!-- Hero Section Begin -->
    <section class="hero hero-normal">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Categories</span>
                        </div>
                        <ul>
                             <?php
                         if(isset($_SESSION['username']))
                         {
                       echo '<li><a href="profile.php">My Profile</a></li>';
                        }
                        
                            ?>
                            
                            <li><a href="./About Us.php">About Us</a></li>

                             <?php
                         if(isset($_SESSION['username']))
                         {
                       echo '<li><a href="./shoping-cart.php">Shoping Cart</a></li>';
                         }
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                             <form method='POST' action="search.php">
                                <div class="hero__search__categories">
                                    All Categories
                                    <span class="arrow_carrot-down"></span>
                                </div>
                                <input type="text" placeholder="What do yo u need?" name="search">
                                <button type="submit" name="submit" class="site-btn">SEARCH </button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>9841035640</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>

    
</body>
</html>