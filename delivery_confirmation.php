<?php
include'./header.php';
?>

 <!-- Breadcrumb Section Begin -->
  <br>  <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.JPG">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Delivery Confirmation</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Delivery Confirmation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


<section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <h4>Delivery Details</h4>
                <form action="payment_process.php" method="POST">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>We will contact you for your herb delivery via phone</p>  
                            </div>
                           <hr>
                                <p>Select for delivery day</p>
                                 <select name="timeoption" value="">
                                        <hr><option value="Monday">Monday</option>
                                        <option value="Tuesday">Tueday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                    </select>
                                </div>
                                <button name="done" type="submit" class="site-btn">Confirm for invoice</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

<?php
  include'./footer.php';
?>

    <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

 

</body>

</html>

<?php
date_default_timezone_set('Asia/Kathmandu');
$date = date("Y-m-d");
//echo $date;
$day = date("D",strtotime($date));
switch($day) {

case "Fri":
$a= strtotime($date."+ 2 days");
break;

case "Sat":
$b= strtotime($date."+ 2 days");
break;

case "Sun":
$c= strtotime($date."+ 1 day");
break;

case "Mon":
$d= strtotime($date."+ 1 day");
break;

case "Tue":
$e= strtotime($date."+ 1 day");
break;

case "Wed":
$f= strtotime($date."+ 1 day");
break;

case "Thu":
$g= strtotime($date."+ 1 day");
break;
}


?>