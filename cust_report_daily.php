<?php
include'connection.php';
include'cust_sidebar_header.php';

$uname= $_SESSION['username'];
$sql = "SELECT * FROM USERS where NAME= '$name'"; 
$stid2 = oci_parse($con, $sql);
oci_execute($stid2);
$row=oci_fetch_array($stid2);
$fname= $row['FIRSTNAME'];
?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Daily Sales</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="admin.php">Home</a></li>
									<li class="breadcrumb-item active" aria-current="page">Charts</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>
				<div class="bg-white pd-20 card-box mb-30">
					<h4 class="h4 text-blue">Daily sales chart</h4>
					<div id="dailysales"></div>
				</div>
				<div class="bg-white pd-20 card-box mb-30">
					<h4 class="h4 text-blue">Sales per herb chart</h4>
					<div id="donutchart" style="width:550px; height: 500px; margin-left: 230px;"></div>
				</div>
				<div class="bg-white pd-20 card-box mb-30">
					<h4 class="h4 text-blue">Herbs sold today</h4>
					  <table class="table table-hover">
                    <thead class=" text-success">
                        <th>
                          
                        </th>
                        <th>
                         Product Name
                        </th>
                        <th>
                         Quantity
                        </th>
                        <th>
                         Price
                        </th>
                         <th>
                         Total Sales
                        </th>
                      </thead>
                    <tbody>
                     <?php 
         $daily_query = "SELECT * FROM ORDERS WHERE ORDER_TIME >= trunc(sysdate,'DD') ORDER BY PRODUCT_ID ASC";
         $stid = oci_parse($con, $daily_query); 
          oci_execute($stid);
           $i=0;
          $total=0;
          while ($row=oci_fetch_array($stid)) 
          {  
          $product_id = $row['PRODUCT_ID'];
          $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID ='$product_id' AND ENTERED_BY ='$fname'";
          $stid1 = oci_parse($con, $query);
          oci_execute($stid1);
          while($rows=oci_fetch_array($stid1))
          {
          $quantity = $row['QUANTITY'];
          $IMAGE = htmlspecialchars($rows['IMAGE'], ENT_QUOTES);
          $NAME = $rows['PRODUCT_NAME'];
          $price = $rows['PRICE'];
          $total = $row['QUANTITY'] * $rows['PRICE'];
?>                      
                          <tr>
                          <td>
                            <?php echo $IMAGE ? "<img src='{$IMAGE}' style='width:100px;height:100px;' />" : "No image found.";  ?>
                          </td>
                          <td>
                           <?php echo $NAME; ?>
                          </td>
                          <td>
                              <?php echo $quantity; ?>
                            
                          </td>
                          <td class="text-primary">
                             $<?php echo $price; ?>
                          </td>
                          <td>
                            $<?php echo $total; ?>
                          </td>

                        </tr>
<?php
$i++;
}
}
if ($i <1)
{
  ?>
  <tr>
    <td>
      No data yet
    </td>
  </tr>
<?php
}

?>
                    </tbody>
                  </table>
				</div>
				</div>
			</div>
			
		</div>
	</div>

	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!---------------------Daily Sales Report------------->
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Product", "Total Sales", { role: "style" } ],
        <?php
        $daily_query = "SELECT PRODUCT_ID, SUM(QUANTITY) AS QUANTITY FROM ORDERS WHERE ORDER_TIME >= trunc(sysdate,'DD') GROUP BY PRODUCT_ID";
         $stid = oci_parse($con, $daily_query);
         
          oci_execute($stid);
          while ($row=oci_fetch_array($stid)) 
          {  
            $product_id = $row['PRODUCT_ID'];
         
          $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID ='$product_id' AND Entered_by ='$fname'";
          $stid1 = oci_parse($con, $query);
          oci_execute($stid1);
           while($rows=oci_fetch_array($stid1))
          {
          $quantity = $row['QUANTITY'];
          ?>
           ["<?php echo $rows['PRODUCT_NAME'];?>", <?php echo $quantity;?>, "green"],
           <?php 
        }
      }
           ?>
           ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Daily Sales: <?php echo date('d M Y'); ?>",
         width: 800,
        height: 300,
        bar: {groupWidth: "75%"},
        legend: { position: "none" },
        backgroundColor: { fill:'transparent' },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("dailysales"));
      chart.draw(view, options);
  }
  </script>

  <!--Daily Sales Summary Report-->

  <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php
        $daily_query = "SELECT PRODUCT_ID, SUM(QUANTITY) AS QUANTITY FROM ORDERS WHERE ORDER_TIME >= trunc(sysdate,'DD') GROUP BY PRODUCT_ID";
         $stid = oci_parse($con, $daily_query);
         
          oci_execute($stid);
          while ($row=oci_fetch_array($stid)) 
          {  
            $product_id = $row['PRODUCT_ID'];
         
          $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID ='$product_id' AND Entered_by ='$fname'";
          $stid1 = oci_parse($con, $query);
          oci_execute($stid1);
           while($rows=oci_fetch_array($stid1))
          {
          $quantity = $row['QUANTITY'];
          ?>
           ['<?php echo $rows['PRODUCT_NAME'];?>', <?php echo $quantity;?>],
           <?php 
        }
      }
           ?>
           ]);

        var options = {
          title: 'Sale Per Product',
          legend: 'none',
          pieSliceText: 'label',
          pieHole: 0.4,

          backgroundColor: { fill:'transparent'},
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data, options);
      }
    </script>
	<!-- js -->
	<script src="admins/vendors/scripts/core.js"></script>
	<script src="admins/vendors/scripts/script.min.js"></script>
	<script src="admins/vendors/scripts/process.js"></script>
	<script src="admins/vendors/scripts/layout-settings.js"></script>
	<script src="admins/src/plugins/apexcharts/apexcharts.min.js"></script>
	<script src="admins/vendors/scripts/apexcharts-setting.js"></script>
</body>
</html>