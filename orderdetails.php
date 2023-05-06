<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<style type="text/css">
    .cartpage h2 {
    width: 500px;
}
</style>  

<?php 
    $login_check = Session::get('customer_login');
    if($login_check==false){
		echo "<script>window.location ='login.php';</script>";//header('Location:login.php');
  }
  $ct = new cart();
  if(isset($_GET['confirmid'])){
	echo "<script>window.location = 'orderdetails.php'</script>";
	$orderId = $_GET['confirmid'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$shifted_confirm = $ct->shifted_confirm($orderId,$time,$price);
}
if(isset($_GET['cancelorderid'])){
	echo "<script>window.location = 'orderdetails.php'</script>";
	$orderId = $_GET['cancelorderid'];
	$time = $_GET['time'];
	$price = $_GET['price'];
	$cancel_order = $ct->cancel_order($orderId,$time,$price);
}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Details Ordered</h2>
					
						<table class="tblone">
							<tr>
                                <th width="5%">No.</th>
								<th width="20%">Product Name</th>
								<th width="5%">Image</th>
								<th width="15%">Price</th>
								<th width="10%">Quantity</th>
                                <th width="15%">Order Date</th>
								<th width="15%">Delivery Date</th>
								<th width="15%">Payment Method</th>
								<th width="20%">Delivery Address</th>
                                <th width="10%">Status</th>
								<!-- <th width="20%">Total Price</th> -->
								<th width="20%">Action</th>
								<th width="10%">Cancel Order</th>
							</tr>
							<?php 
                            $customerId = Session::get('customer_customerId');
							$get_cart_ordered = $ct->get_cart_ordered($customerId);
							if($get_cart_ordered){
								$i = 0;
								$qty = 0;
								while($result = $get_cart_ordered->fetch_assoc()){
                                    $i++;
							?>
							<tr>
                                <td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price'])." "."USD" ?></td>
								<td>									
									   
                                    <?php echo $result['quantity'] ?>
																			
								</td>
                                <td><?php echo $result['date_order'] ?></td>
								<td><?php echo $result['delivery_date'] ?></td>
								<td><?php echo $result['payment_method'] ?></td>
								<td><?php echo $result['address'] ?></td>
								<td>
                                <?php                   
							if($result['status']=='0'){
								echo 'Pending';
                            }elseif($result['status']==1){
                               ?>
							   <span>Shifted</span>
							 
							   <?php
							}elseif($result['status']==3){	
								echo 'Pending';	
							}elseif($result['status']==4){	
								echo 'Cancelled';	
                            }else{//elseif($result['status']==2)
								echo 'Received';
							}
							?>
                            </td>

                                <?php 
                                	if($result['status']=='0'){				
							    ?>
                                <td><?php echo 'N/A'; ?></td>
                                <?php
                    
                                    }elseif($result['status']=='1'){
                                ?>
								<td><a href="?confirmid=<?php echo $customerId ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Confirmed</a></td>
								<?php
								}elseif($result['status']==3){
								?>
								<td><?php echo 'N/A'; ?></td>
								<?php
								}elseif($result['status']==4){
								?>
								<td><?php echo 'Cancelled'; ?></td>
								<?php
								}else{
								?>
								<td><?php echo 'Received'; ?></td>
                                <?php 
                                	}			
							    ?>

                            <?php                   
							if($result['status']=='0'){
                               ?>
							<td><a href="?cancelorderid=<?php echo $customerId ?>&price=<?php echo $result['price'] ?>&time=<?php echo $result['date_order'] ?>">Cancel Order</a></td>
							   <?php
							}elseif($result['status']==3){
								?>
								 <td><?php echo 'Processing...'; ?></td>
					
								 <?php 
                                	}			
							    ?>
                            </tr>
							<?php 
							}
						}
							?>
						</table>
								
					</div>
					
					<style type="text/css">
						a.btn-shopping {
	                    display:block;
	                    width: 33%;
						margin: 6px auto;
                        }
                        </style>
					<a class="btn btn-success btn-shopping" href="index.php">Shopping Now</a>
					<!-- <div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div> -->
					</div>
				</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
	 include 'inc/footer.php';
?>
