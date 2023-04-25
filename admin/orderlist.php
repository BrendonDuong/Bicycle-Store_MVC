<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
    $ct = new cart();
    if(isset($_GET['shiftid'])){
		echo "<script>window.location = 'orderlist.php'</script>";
		$orderId = $_GET['shiftid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted = $ct->shifted($orderId,$time,$price);
	}
	$ct = new cart();
	if(isset($_GET['ordercancelid'])){
		echo "<script>window.location = 'orderlist.php'</script>";
		$orderId = $_GET['ordercancelid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$order_cancel = $ct->order_cancel($orderId,$time,$price);
	}
	if(isset($_GET['delid'])){
		$orderId = $_GET['delid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$del_shifted = $ct->del_shifted($orderId,$time,$price);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Order List</h2>
                <div class="block">  
					<?php
					if(isset($shifted)){
						echo $shifted;
					}
					?> 
					<?php
					if(isset($del_shifted)){
						echo $del_shifted;
					}
					?>      
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<!-- <th>Order ID</th> -->
							<th>Order Date</th>
							<th>Delivery Date</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Total Price</th>
							<th>Payment Method</th>
							<th>Customer ID</th>
							<th>View Profile</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$ct = new cart();
						$fm = new Format();
						$get_inbox_cart = $ct->get_inbox_cart();
						if($get_inbox_cart){
							$i = 0;
							while($result = $get_inbox_cart->fetch_assoc()){
								$i++;
						
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<!-- <td><?php echo $result['orderId'] ?></td> -->
							<td><?php echo $result['date_order'] ?></td>
							<td><?php
							echo $result['delivery_date']
							//  $date = $result['date_order'];
							//  $delivery_date = strtotime ( '+3 day' , strtotime ( $date ) ) ;
							//  $delivery_date = date ( 'Y-m-j' , $delivery_date );
							//  echo $delivery_date; 
                            // $delivery_date = $result['date_order'];
                            // echo date('Y-m-d', strtotime($delivery_date. ' + 3 days'));
							 ?></td>
							<td><?php echo $result['productName'] ?></td>
							<td><?php echo $result['quantity'] ?></td>
							<td><?php echo $result['price']." "."USD" ?></td>
							<td><?php echo $result['payment_method'] ?></td>
							<td><?php echo $result['customerId'] ?></td>
							<td><a href="customer.php?customerid=<?php echo $result['customerId'] ?>">View Customer</a></td>
							<td>
								<a href="orderedit.php?orderid=<?php echo $result['orderId'] ?>">Edit</a> ||
								<?php
								if($result['status']==0){
								?>

								<a href="?shiftid=<?php echo $result['orderId'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Pending</a>
								
								<?php
								}elseif($result['status']==1){								
								?>

								<?php
								echo 'Shifting...';
								?>

                                <?php
								}elseif($result['status']==3){								
								?>

                                <a href="?ordercancelid=<?php echo $result['orderId'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Cancel Order</a>

								<?php
								}else{//elseif($result['status']==2)
									if($result['status']==2){
								?>
                                <?php
								echo 'Delivered';
								?>

                                || <a onclick ="return confirm('Are you want to delete?');" href="?delid=<?php echo $result['orderId'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Remove</a>

                                <?php
								}elseif($result['status']==4){
								?>
								<?php
								echo 'Cancelled';
								?>

								|| <a onclick ="return confirm('Are you want to delete?');" href="?delid=<?php echo $result['orderId'] ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Remove</a>
								
								<?php
								
								}}
								?>
							</td>
						</tr>
						<?php
						}
					}
						?>
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
