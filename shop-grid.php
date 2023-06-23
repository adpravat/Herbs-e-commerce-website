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
                        <h2>E-herbs</h2>
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
                            <h4>Herb Sorting</h4>

                                <?php
                                $query="SELECT DISTINCT Category FROM PRODUCT";
                                $stid = oci_parse($con, $query);
                                oci_execute($stid);
                                while ($row=oci_fetch_array($stid)) 
                                {
                                ?>
                            <ul>
                                   <label class="d-flex form-check-label">
                                            <input type="checkbox" class="form-check-input product_check"
                                                value="<?php echo $row['CATEGORY'];?>" id="cat">
                                            <?php echo $row['CATEGORY'];?>
                                        </label>
                            </ul>
                            <?php
                                }
                                ?>
                        </div>
                        <br>


                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">

                                                  <?php
                $qry = "SELECT * FROM PRODUCT WHERE PRODUCT_ID='1' OR PRODUCT_ID='2' OR PRODUCT_ID='3' OR PRODUCT_ID='8' ";
                 $stid = oci_parse($con, $qry);
                if(oci_execute($stid))
                {
                while($row=oci_fetch_array($stid))
                {$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
                ?>

                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img style="width: 100px; height: 100px;" src="<?php echo $row["IMAGE"]; ?>" alt="Image">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?php echo $row['PRODUCT_NAME'];?></h6>
                                                <span>Rs<?php echo $row['PRICE'];?></span>
                                            </div>
                                        </a>
                        <?php
                    }
                }
                ?>
                                      
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                $qry = "SELECT * FROM PRODUCT WHERE PRODUCT_ID='4' OR PRODUCT_ID='5' OR PRODUCT_ID='6' OR PRODUCT_ID='7' ";
                 $stid = oci_parse($con, $qry);
                if(oci_execute($stid))
                {
                while($row=oci_fetch_array($stid))
                {$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
                ?>

                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                 <img style="width: 100px; height: 100px;" src="<?php echo $row["IMAGE"]; ?>" alt="Image">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?php echo $row['PRODUCT_NAME'];?></h6>
                                                <span>Rs<?php echo $row['PRICE'];?></span>
                                            </div>
                                        </a>
                        <?php
                    }
                }
                ?>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                </div>
                <div class="col-lg-9 col-md-7">
               <h2><b>Our Herbs</b></h2>
               <?php
               //-------add to cart alert------->                     
$action = isset($_GET['action'])?$_GET['action'] : "";
if($action=='added'){
echo "<div class='alert alert-success'>Herb is added to the cart.</div>";
}
?>
<!------add to cart alert--> 
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>16</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="result">

                         <?php
                $qry = "SELECT * FROM PRODUCT WHERE STATUS='Approved' ORDER BY PRODUCT_ID ASC";
                 $stid = oci_parse($con, $qry);
                if(oci_execute($stid))
                {
                while($row=oci_fetch_array($stid))
                {$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
                ?>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                 <div class="product__item__pic set-bg" data-setbg=""> 
            <img width="300px" height="300px" src="<?php echo $row["IMAGE"]; ?>" alt="Image">
            <br>
            
            <ul class="product__item__pic__hover">
            <form method="post" action="shop-details.php">
            <input type="hidden" name="id" value="<?php echo $row['PRODUCT_ID']; ?>">
            <li><button type="submit" name="submit" class="fa fa-retweet"></button></li>
            </form>

            <form method="post" action="cart_process.php">
            <input type="number" name="hidden_quantity" value=""class="form-control" id="quantity" required />
            <input type="hidden" name="hidden_name" value="<?php echo $row["PRODUCT_NAME"]; ?>" id="name" />
            <input type="hidden" name="hidden_price" value="<?php echo $row["PRICE"]; ?>" id="price" />
            <input type="hidden" name="hidden_id" value="<?php echo $row['PRODUCT_ID']; ?>">
            <li><button type="submit" name="submit" class="fa fa-heart"></button></li>
            </form></ul>
            </div>

                                <div class="product__item__text">
                                <h6><a href=""><?php echo $row["PRODUCT_NAME"]; ?></a></h6>
                                <h5>Rs<?php echo $row["PRICE"]; ?></h5>
                                </div>
                                </div>
                            </div>
                    <?php
                    }
                    }
                    ?>
                           
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

<!-- Product sorting -->
 <script>
    $(document).ready(function() {
        $('.product_check').click(function() {
            $('#loader').show();
            var action = 'data';
            var shop = get_filter_text('shop');
            var cat = get_filter_text('cat');

            $.ajax({
                url: 'sort_process.php',
                method: 'POST',
                data: {
                    action: action,
                    shop: shop,
                    cat: cat
                },
                success: function(response) {
                    $('#result').html(response);
                    $('#loader').hide();
                }

            });

        });

        function get_filter_text(text_id) {
            var filterData = [];
            $('#' + text_id + ':checked').each(function() {
                filterData.push($(this).val());

            });
            return filterData;
        }
    });
    </script>
<!-- Product sorting end -->

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