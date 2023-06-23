<?php
include'./header.php';
?>


                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.JPG">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Herb Details</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <a href="./index.php">Shop</a>
                            <span>Herb Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">

                <?php
if (isset($_POST['submit'])){
$id=$_POST['id'];
$sql="SELECT *FROM PRODUCT WHERE PRODUCT_ID='$id'";

$stid= oci_parse($con,$sql);
oci_execute($stid);
while($row=oci_fetch_assoc($stid)){
?>
 
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="img/about.jpg" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="<?php echo $row["IMAGE"];?>"
                                src="<?php echo $row["IMAGE"];?>" alt="">
                            <img data-imgbigurl="<?php echo $row["IMAGE"];?>"
                                src="<?php echo $row["IMAGE"];?>" alt="">
                            <img data-imgbigurl="<?php echo $row["IMAGE"];?>"
                                src="<?php echo $row["IMAGE"];?>" alt="">
                            <img data-imgbigurl="<?php echo $row["IMAGE"];?>"
                                src="<?php echo $row["IMAGE"];?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $row["PRODUCT_NAME"];?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(18 reviews)</span>
                        </div>
                        <div class="product__details__price">Rs<?php echo $row["PRICE"];?></div>
                        <p><?php echo $row["INFORMATION"];?></p>
                        <form method="post" action="cart_process.php">
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                <input type="number" name="hidden_quantity" value="1" id="quantity" required />
                                </div>
                            </div>
                        </div>
           
            <input type="hidden" name="hidden_name" value="<?php echo $row["PRODUCT_NAME"]; ?>" id="name" />
            <input type="hidden" name="hidden_price" value="<?php echo $row["PRICE"]; ?>" id="price" />
            <input type="hidden" name="hidden_id" value="<?php echo $row['PRODUCT_ID']; ?>">
            <input type="submit" value="add to cart" name="submit" class="primary-btn">
            </form>  

 
                    
                    <ul>
                        <li><b>Availability</b> <span><?php echo $row["STOCK"];?></span></li>
                        <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                                <hr>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">

                                   <h4><b>Reviews</b></h4><br>
                            </li>
                        </ul>
                        <!--Review Section-->
                        <form action="review_process.php" method="post">
                        <input type="text" class="form-control" name="review" id="review" placeholder="Write a review here">
                        <input type="hidden" name="id" value="<?php echo $row["PRODUCT_ID"];?>"><hr>
                        <input type="submit" value="Add review" name="addreview" class="primary-btn">
                    
                        </form>

                         <?php 
 if (isset($_POST['submit'])){
$id=$_POST['id'];
$sql="SELECT *FROM REVIEW WHERE PRODUCT_ID='$id'";
$stid= oci_parse($con,$sql);
oci_execute($stid);

while($row=oci_fetch_assoc($stid)){

$user_id= $row["USER_ID"];
$sql1="SELECT *FROM USERS WHERE USER_ID='$user_id'";
$stid1= oci_parse($con,$sql1);
oci_execute($stid1);

while ($rows=oci_fetch_assoc($stid1)){
$name=$rows["NAME"];
  ?>
  
                 <?php
                  if(empty($row["REVIEW"])){
                  echo 'No Review Yet';
                  }
                  else{
                    ?>
                   <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6><?php echo $name;?></h6>
                                    <p><?php echo $row["REVIEW"];?></p><hr>
                                </div>
                            </div>    
                        </div>
                        <?php
                  }
                  }
                  ?>
 <?php
 }
 }
 ?>       

                       
 <!-- END Review Section--> 
                    </div>
                
 <?php
 }
 }
 ?>  
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

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