<?php 
include 'connection.php';
include 'admin_sidebar_header.php';
?>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4">
						<img src="img/logo.png" alt="">
					</div>
					<div class="col-md-8">
						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue"><?php echo $name;?></div>
						</h4>
						<p class="font-18 max-width-600">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Unde hic non repellendus debitis iure, doloremque assumenda. Autem modi, corrupti, nobis ea iure fugiat, veniam non quaerat mollitia animi error corporis.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart"></div>
							</div>
							<div class="widget-data">
<?php
$qry = "SELECT COUNT(PRODUCT_ID) as PRODUCT_ID FROM PRODUCT WHERE STATUS='Approved'";  
$stid = oci_parse($con, $qry);
oci_execute($stid);
$row=oci_fetch_array($stid);
$count1 = $row['PRODUCT_ID']; 
?>
								<div class="h4 mb-0"><?php echo $count1;?></div>
								<div class="weight-600 font-14">Total Products</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart2"></div>
							</div>
							<div class="widget-data">
<?php
$qry = "SELECT COUNT(ORDER_ID) as ORDER_ID FROM ORDERS";  
$stid = oci_parse($con, $qry);
oci_execute($stid);
$row=oci_fetch_array($stid);
$count2 = $row['ORDER_ID']; 
?>
								<div class="h4 mb-0"><?php echo $count2;?></div>
								<div class="weight-600 font-14">Total Orders</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart3"></div>
							</div>
							<div class="widget-data">
<?php
$qry = "SELECT COUNT(USER_ID) as USER_ID FROM USERS";  
$stid = oci_parse($con, $qry);
oci_execute($stid);
$row=oci_fetch_array($stid);
$count3 = $row['USER_ID']; 
?>
								<div class="h4 mb-0"><?php echo $count3;?></div>
								<div class="weight-600 font-14">Total Users</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 mb-30">
					<div class="card-box height-100-p widget-style1">
						<div class="d-flex flex-wrap align-items-center">
							<div class="progress-data">
								<div id="chart4"></div>
							</div>
							<div class="widget-data">
<?php
$qry = "SELECT SUM(QUANTITY) as QUANTITY FROM ORDERS";  
$stid = oci_parse($con, $qry);
oci_execute($stid);
$row=oci_fetch_array($stid);
$count4 = $row['QUANTITY']; 
?>
								<div class="h4 mb-0"><?php echo $count4;?></div>
								<div class="weight-600 font-14">Total Sales</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xl-8 mb-30">
					<div class="card-box height-100-p pd-20">
						<h2 class="h4 mb-20">Today's Sale</h2>
						<div id="dailysales"></div>
					</div>
				</div>
				<div class="col-xl-4 mb-30">
					<div class="card-box height-100-p pd-20">
						<h2 class="h4 mb-20">Sales per herb</h2>
						<div id="donutchart" style="width:500px; height: 300px; margin-left: -100px;"></div>
					</div>
				</div>
			</div>
			<div class="card-box mb-30">
				<h2 class="h4 pd-20">Herbs approval of customers</h2>
				<table class="data-table table nowrap">
					<thead>
						<tr>
							<th class="table-plus datatable-nosort">Product</th>
							<th>Name</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Category</th>
							<th>Seller</th>
							<th>Status</th>
							<th class="datatable-nosort">Action</th>
						</tr>
					</thead>
					<tbody>
<?php
$action = isset($_GET['action']) ? $_GET['action'] : "";
// if it was redirected from delete.php
if($action=='approved'){
echo "<div class='alert alert-success'>Herb is approved.</div>";
}

$qry = "SELECT * FROM PRODUCT WHERE STATUS='Pending'";  
$stid = oci_parse($con, $qry);
oci_execute($stid);
while ($row=oci_fetch_array($stid))
{$IMAGE = htmlspecialchars($row['IMAGE'], ENT_QUOTES);
?>
	                    <tr>
						<td class="table-plus">
					<?php echo $IMAGE ? "<img src='{$IMAGE}' style='width:50px;height:50px;' />" : "No image found.";  ?></td>	
					<td><?php echo $row['PRODUCT_NAME']; ?></td>
                    <td><?php echo $row['PRICE']; ?></td>
                    <td><?php echo $row['STOCK']; ?></td>
                    <td><?php echo$row['CATEGORY']; ?></td>
                    <td><?php echo $row['ENTERED_BY']; ?></td>
                    <td><?php echo $row['STATUS']; ?></td>
					<td><a href="admin_product_approve.php?id=<?= $row['PRODUCT_ID'] ?>" class="btn btn-success ">Approve</a></td>
						
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

		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!---------------------Daily Sales Report------------->
<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Product", "Total Sales", { role: "style" } ],
        <?php
        $daily_query = "SELECT PRODUCT_ID, SUM(QUANTITY) AS QUANTITY FROM ORDERS WHERE ORDER_TIME >= trunc(sysdate,'D') GROUP BY PRODUCT_ID";
         $stid = oci_parse($con, $daily_query);
         
          oci_execute($stid);
          while ($row=oci_fetch_array($stid)) 
          {  
            $product_id = $row['PRODUCT_ID'];
         
          $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID ='$product_id'";
          $stid1 = oci_parse($con, $query);
          oci_execute($stid1);
          $rows = oci_fetch_array($stid1);
          $quantity = $row['QUANTITY'];
          ?>
           ["<?php echo $rows['PRODUCT_NAME'];?>", <?php echo $quantity;?>, "green"],
           <?php 
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
         width: 600,
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
         
          $query = "SELECT * FROM PRODUCT WHERE PRODUCT_ID ='$product_id'";
          $stid1 = oci_parse($con, $query);
          oci_execute($stid1);
          $rows = oci_fetch_array($stid1);
          $quantity = $row['QUANTITY'];
          ?>
           ['<?php echo $rows['PRODUCT_NAME'];?>', <?php echo $quantity;?>],
           <?php 
        }
           ?>
           ]);

        var options = {
          title: '',
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
	<script src="admins/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="admins/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
	<script src="admins/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
	<script src="admins/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
	<script src="admins/vendors/scripts/dashboard.js"></script>
</body>
</html>