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
                        <h2>Herbs Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>We Offer</h4>
                            <ul>
                                <li><a href="#">Medicinal Herbs</a></li>
                                <li><a href="#">Local Spices</a></li>
                                <li><a href="#">Organic Perfumes</a></li>
                                <li><a href="#">Organic Soaps</a></li>
                                <li><a href="#">Herbal Tea</a></li>
                                <li><a href="#">Vitamins & Supplements</a></li>
                            </ul>
                        </div>
                       
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
               <h2><b>Our Herbs</b></h2>
     
                    <div class="row">
                                <?php

if(isset($_POST['search']))
{
$search_term = $_POST['search'];

$search_term=preg_replace("#[^0-9a-z]#i"," ",$search_term);

$search_term = htmlspecialchars($search_term);
$split_search_terms = explode(" ", $search_term);
$search_terms = "";

foreach ($split_search_terms as $index => $term) {
if ($index == 0) {
$search_terms .= "%";
}
$search_terms .= strtolower($term);
$search_terms .= "%";
}


$sql = "SELECT * FROM Product WHERE LOWER(Product_Name) LIKE  '%$search_terms%'";
$stid = oci_parse($con, $sql);
oci_execute($stid);
$output='';


while($row = oci_fetch_array($stid))
{

?>

                               
                             <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">

                                 <div class="product__item__pic set-bg" data-setbg=""> 
                                    <img width="300px" height="300px"
                                      src="<?php echo $row["IMAGE"]; ?>" alt="Image">

                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href=""><?php echo $row["PRODUCT_NAME"]; ?></a></h6>
                                    <h5>Rs<?php echo $row["PRICE"]; ?></h5>
                                </div>
                            </div>
                            </div>
 <?php
}
$fetch=oci_fetch($stid);
$count=oci_num_rows($stid);

if($count==0)
{
$output .='No Products Found';
}

echo $output;
}
?>
                           </div>

 <!-- product pagination -->

                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

  <?php
  include'./footer.php';
?>
</body>
</html>
   <!-- Js Plugins -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/jquery.slicknav.js"></script>
    <script src="js/mixitup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/main.js"></script>

                              

