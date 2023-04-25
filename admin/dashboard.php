<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/cart.php';?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Dashboard:</h2>
                <div class="block">               
                Statistics of order revenue by: <span id="text-date"></span>     
                <!-- <select class="select-date">
                  <option value="7days">7 Days ago</option>
                  <option value="1months">1 Months ago</option>
                  <option value="90days">90 Days ago</option>
                  <option value="365days">365 Days ago</option>
                </select>                 -->
                </div>
                <!-- <div id="chart" style="height: 250px;"></div> -->
                <body>
  <br /><br />
  <div class="card-header">
    Order Revenue Statistics Chart
    <form method="POST">
      From: <input type="date" name="date_from">
      To: <input type="date" name="date_to">
      <input type="submit" name="submit" value="Filter">
    </form>
    <div id="chart"></div>
  </div>
</body>
                <div id='revenue-chart' ></div>
            </div>
        </div>
        <!-- <script type="text/javascript">
          $(document).ready(function(){
            statistical();
         var char = new Morris.Area({
  // ID of the element in which to draw the chart.
  element: 'chart',
  // The name of the data record attribute that contains x-values.
  xkey: 'date',
  // A list of names of data record attributes that contain y-values.
  ykeys: ['date','ordered','sales','quantity'],
  // Labels for the ykeys -- will be displayed when you hover over the
  // chart.
  labels: ['Ordered','Sales','Quantity']
});
      function statistical(){
        var text  = '365 days ago';
        $('#text-date').text(text);
        $.ajax({
          url:"classes/statistical.php",
          method:"POST",
          dataType:"JSON",
          success:function(data)
          {
            char.setData(data);
            $('#text-date').text(text);
          }
        });
      }
    });
        </script> -->
        <?php
        // Calculating revenue in 2023
$ct = new cart();
if (isset($_POST['submit'])) {
  $date_from = $_POST['date_from'];
  $date_to = $_POST['date_to'];
$revenue_data = $ct->revenueStatisticsByMonthYear(2023, $date_from, $date_to);
}else{
  $revenue_data = $ct->revenueStatisticsByDate(2023);
}
// $revenue_data = revenueStatisticsByMonthYear(2023);

// Displaying Morris Charts Using jQuery and Morris.js
// echo "<div id='revenue-chart'></div>";
echo "<script>";
echo "var text  = '365 days ago';";
echo "$('#text-date').text(text);";
echo "$(function() {";
echo "Morris.Area({";
echo "element: 'revenue-chart',";
echo "data: " . $revenue_data . ",";
echo "xkey: 'date',";
echo "ykeys: ['revenue','quantity','orders'],";
echo "labels: ['Revenue','Quantity','Orders']";
echo "});";
echo "});";
echo "</script>";
        ?>
       
       <div class="grid_10">
            <div class="box round first grid">
                <h2>Total Revenue of Order List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							
							<th>Total Order Customer</th>
							<th>Quantity</th>
							<th>Total Revenue</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$ct = new cart();
						$fm = new Format();
						$get_total_orders = $ct->get_total_orders();
            $get_total_quantity = $ct->get_total_quantity();
            $get_total_revenue = $ct->get_total_revenue();
						
						?>
						<tr class="odd gradeX">
						
							<td><?php echo $get_total_orders ?></td>
							<td><?php echo $get_total_quantity ?></td>
							<td><?php echo $get_total_revenue." "."USD" ?></td>
						</tr>
					</tbody>
				</table>
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>