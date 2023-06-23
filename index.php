<?php
include'./header.php';
?>


      <br>
<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.JPG">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Home</h2>
                        <div class="breadcrumb__option">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


                    <div class="hero__item set-bg" data-setbg="img/a.jpeg">
                        <div class="hero__text"><br><br><br><br><br><br><br><br><br><br><br>
                            <a href="shop-grid.php" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                             <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Our Herbs Category</h2>
                    </div>
                </div>
                <div class="categories__slider owl-carousel">
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/Dry-Ginger.JPG">
                            <h5><a href="#">Medicinal herbs</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                       <div class="categories__item set-bg" data-setbg="img/Cinnamon-Leaves.jpg">
                            <h5><a href="#">Local Spices</a></h5>
                        </div> 
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/Asparagus.jpg">
                            <h5><a href="#">Organic Perfumes/Soaps</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/Neem-tree.jpg">
                            <h5><a href="#">Herbal Tea</a></h5>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/Amla.jpg">
                            <h5><a href="#">Vitamins and Supplements</a></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Products</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".Medicinal">Medicinal Herbs</li>
                            <li data-filter=".Spices">Local Spices</li>
                            <li data-filter=".Perfumes">Perfumes</li>
                            <li data-filter=".Tea">Herbal Tea</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">

                 <?php
                $qry = "SELECT * FROM PRODUCT WHERE STATUS='Approved' AND CATEGORY='Medicinal herbs' ";
                 $stid = oci_parse($con, $qry);
                if(oci_execute($stid))
                {
                while($row=oci_fetch_array($stid))
                {$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
                ?>

                <div class="col-lg-3 col-md-4 col-sm-6 mix Medicinal ">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg=""> 
                        <img width="300px" height="300px" src="<?php echo $row["IMAGE"]; ?>" alt="Image">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?php echo $row["PRODUCT_NAME"]; ?></a></h6>
                            <h5>Rs<?php echo $row["PRICE"]; ?></h5>
                        </div>
                    </div>
                </div>
                <?php
            }
            }
            ?>

             <?php
                $qry = "SELECT * FROM PRODUCT WHERE STATUS='Approved' AND CATEGORY='Perfumes herbs' ";
                 $stid = oci_parse($con, $qry);
                if(oci_execute($stid))
                {
                while($row=oci_fetch_array($stid))
                {$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
                ?>

                <div class="col-lg-3 col-md-4 col-sm-6 mix Perfumes">
                    <div class="featured__item">
                         <div class="featured__item__pic set-bg" data-setbg="">
                         <img width="300px" height="300px" src="<?php echo $row["IMAGE"]; ?>" alt="Image">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?php echo $row["PRODUCT_NAME"]; ?></a></h6>
                            <h5>Rs<?php echo $row["PRICE"]; ?></h5>
                        </div>
                    </div>
                </div>

                <?php
            }
            }
            ?>

            <?php
                $qry = "SELECT * FROM PRODUCT WHERE STATUS='Approved' AND CATEGORY='Local spices' ";
                 $stid = oci_parse($con, $qry);
                if(oci_execute($stid))
                {
                while($row=oci_fetch_array($stid))
                {$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
                ?>

                <div class="col-lg-3 col-md-4 col-sm-6 mix Spices">
                    <div class="featured__item">
                         <div class="featured__item__pic set-bg" data-setbg="">
                        <img width="300px" height="300px" src="<?php echo $row["IMAGE"]; ?>" alt="Image">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?php echo $row["PRODUCT_NAME"]; ?></a></h6>
                            <h5>Rs<?php echo $row["PRICE"]; ?></h5>
                        </div>
                    </div>
               </div>
                     <?php
            }
            }
            ?>

                <?php
                $qry = "SELECT * FROM PRODUCT WHERE STATUS='Approved' AND CATEGORY='Herbal tea' ";
                 $stid = oci_parse($con, $qry);
                if(oci_execute($stid))
                {
                while($row=oci_fetch_array($stid))
                {$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
                ?>

                <div class="col-lg-3 col-md-4 col-sm-6 mix Tea">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="">
                        <img width="300px" height="300px" src="<?php echo $row["IMAGE"]; ?>" alt="Image">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="#"><?php echo $row["PRODUCT_NAME"]; ?></a></h6>
                            <h5>Rs<?php echo $row["PRICE"]; ?></h5>
                        </div>
                    </div>
                </div>
                     <?php
            }
            }
            ?>
            </div>
        </div>
        </section>
    <!-- Featured Section End -->

    <!-- Slider Begin -->
        <div class="product__discount">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Sales Off</h2>
                        </div>
                    </div>
                    </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                 <?php
                $qry = "SELECT * FROM PRODUCT WHERE STATUS='Approved' ";
                 $stid = oci_parse($con, $qry);
                if(oci_execute($stid))
                {
                while($row=oci_fetch_array($stid))
                {$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
                ?>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="">
                                            <img width="300px" height="300px" src="<?php echo $row["IMAGE"]; ?>" alt="Image">
                                            <div class="product__discount__percent">-20%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><button type="submit" name="submit" class="fa fa-shopping-cart"></button></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <h5><a href="#"><?php echo $row["PRODUCT_NAME"]; ?></a></h5>
                                            <div class="product__item__price">Rs<?php echo $row["PRICE"]; ?> <span>$36.00</span></div>
                                        </div>
                                    </div>
      
                                </div>
                                <?php
        }
        }
        ?>
                            </div>
                        </div>
                    </div>
                </div>
 
    <!-- Slider End -->

   
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