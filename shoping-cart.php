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
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Herbs</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
  <?php

$action = isset($_GET['action']) ? $_GET['action'] : "";
if($action=='deleted'){
echo "<div class='alert alert-danger'>Herb has been removed from the cart.</div>";
}

$totalprice=0;
$uname= $_SESSION['username'];
$sql="SELECT * FROM Users WHERE Name='$uname'";
$stid=oci_parse($con,$sql);
oci_execute($stid);//
$row=oci_fetch_array($stid);
$user_id=$row['USER_ID'];
$qry = "SELECT * FROM CART where USER_ID =$user_id";
$stid = oci_parse($con, $qry);
oci_execute($stid);
while($row =oci_fetch_assoc($stid)){
$productid = $row['PRODUCT_ID'];
$innerqry ="SELECT PRODUCT_NAME, PRICE,CATEGORY,DISCOUNT_ID ,IMAGE FROM PRODUCT WHERE PRODUCT_ID= $productid";
$stmt =oci_parse($con, $innerqry);
oci_execute($stmt);
while($rows =oci_fetch_assoc($stmt)) {
$IMAGE = htmlspecialchars($rows['IMAGE'], ENT_QUOTES);
$quantity= $row[ 'QTY'];
$prices= $rows['PRICE'];
$total = ($rows['PRICE'])* $row['QTY'];
$totalprice = $total + $totalprice;
?>
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="img/cart/cart-1.jpg" alt="">
                                        <h5><?php echo $rows["PRODUCT_NAME"]; ?></h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                        <?php echo $rows["PRICE"]; ?>
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <?php echo $row["QTY"]; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        <?php echo $totalprice; ?>
                                    </td>
                                    <td class="shoping__cart__item__close">
                                        <a href="cart_delete.php?id=<?php echo $row['PRODUCT_ID']; ?>"
                                class='btn btn-danger'><span class="icon_close"></span></a>
                                        
                                    </td>
                                </tr>
 <?php
}
?>
<?php
}
?>

                            </tbody>                           
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="shop-grid.php" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                        <a href="shoping-cart.php" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            Upadate Cart</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5></h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                     <li>Subtotal<span>Rs<?php echo number_format($totalprice, 2, '.', ','); ?></span></li>
                     <li>Total <span>Rs<?php echo number_format($totalprice, 2, '.', ','); ?></span></li>
                        </ul>
 <!------------paypal button------------->
                        <button class="primary-btn" onclick="GFG_Fun(); this.style.visibility='hidden'" ;>PROCEED TO CHECKOUT</button>
                        <div id="paypal-button-container" style="display: none;"></div>
                        <script src="https://www.paypal.com/sdk/js?client-id=AeQYLEx3jRq5Hw2ZXzKGCkcmwRo761NGCncRPjFsUtx-yz63eQL9BoM9JgNA-yt26hBqrX7-KqnAdxoI&currency=USD"
                        data-sdk-integration-source="button-factory">
// -----End paypal button-------------->                         
                    </script>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

<!-- PAYPAL JAVA SCRIPT START__------------------->
    <script>
    function show(divId) {
        $("#" + divId).show();
    }

    function GFG_Fun() {
        show('paypal-button-container');
        $('#GFG_DOWN').text("");
    }
    </script>
    <script>
    paypal.Buttons({
        style: {
            shape: 'pill',
            color: 'blue',
            layout: 'vertical',
            label: 'pay',

        },
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?php echo $totalprice; ?>'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                alert('Transaction completed by ' + details.payer.name.given_name + '!');
                window.location.href = 'delivery_confirmation.php';
            });
        }
    }).render('#paypal-button-container');
    </script>

  <!-- END JS FOR PAYPAL-->  
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