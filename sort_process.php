 <?php
require'connection.php';

if(isset($_POST["action"]))

{
if (isset($_POST['shop']))
{
$shop=$_POST['shop'];
$shop_filter = implode(',',$shop); //convert variable value from array to string
$sql ="SELECT * FROM Product WHERE Shop_Name IN ('".$shop_filter."')";
$stid = oci_parse($con,$sql);
oci_execute($stid);
$output='';
?>



 <?php
while ($row=oci_fetch_array($stid))
{
$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
echo $output =  '
<div class="col-md-4">
<div style="border:1px solid #333; width:250px; background-color:#f1f1f1; border-radius:5px;margin-bottom:20px; margin-left:50px;  margin-right:90px; padding:20px;" align="center">
<form method="post" action="add_cart.php">

<img src='.$IMAGE.' style="width:100px;height:100px;"><br/>

<h4 class="text-info">'.$row["PRODUCT_NAME"].'</h4>
<h4 class="text-info">'.$row["CATEGORY"].'</h4>

<h4 class="text-info">$ '.$row["PRICE"].'</h4>

<input type="number" name="hidden_quantity" value="" class="form-control" id ="quantity" required />

<input type="hidden" name="hidden_name" value="'.$row["PRODUCT_NAME"].'" />

<input type="hidden" name="hidden_price" value="'.$row["PRICE"].'" />
<br>
<input type = "submit"   name= "submit" value= "Add to cart" class="btn btn-primary btn-block" autocomplete= "off">
<div class="overlay">
<h2 class="text">Information:'.$row["INFORMATION"].' </h2>
</div>
</form>

<form method="post" action="review.php">
<input type="hidden" name="id" value="'.$row["PRODUCT_ID"].'">
<button style="margin-top:10px;" name="submit" type="submit" class="btn btn-outline-secondary">Reviews</button>
</form>
</div>
</div>';
}
}

// -----------Sorting by category--------------//

if (isset($_POST['cat']))
{
$cat=$_POST['cat'];
$cat_filter = implode(',',$cat);

$sql = "SELECT * FROM Product WHERE Category IN ('$cat_filter')";
$stid = oci_parse($con,$sql);
oci_execute($stid);

$output='';
while ($row=oci_fetch_assoc($stid))
{
echo $output =  '<div class="col-lg-4 col-md-6 col-sm-6">
                            <form method="post" action="cart_process.php">
                            <div class="product__item">

                                 <div class="product__item__pic set-bg" data-setbg=""> 
            <img src='.$row["IMAGE"].' width="300px" height="300px">
            <input type="number" name="hidden_quantity" value=""class="form-control" id="quantity" required />
            <input type="hidden" name="hidden_name" value="'.$row["PRODUCT_NAME"].'" id="name" />
            <input type="hidden" name="hidden_price" value="'.$row["PRICE"].'" id="price" />
            <input type="hidden" name="hidden_id" value="'.$row['PRODUCT_ID'].'">
            <br>
            
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><button type="submit" name="submit" class="btn"><i class="fa fa-shopping-cart"></i></button><i class=""></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="">'.$row["PRODUCT_NAME"].'</a></h6>
                                    <h5>Rs'.$row["PRICE"].'</h5>
                                </div>
                            </div>
                        </form>
                            </div>';

// -----------Sorting by category--------------//

}
}
}
?>

