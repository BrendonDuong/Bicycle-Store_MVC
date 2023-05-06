<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>

<?php 
    // if(isset($_GET['cartid'])){
	// 	$cartid = $_GET['cartid'];
	// 	$delcart = $ct->del_product_cart($cartid); 
	// }
    // if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	// 	// The request is using the POST method
	// 	$cartId = $_POST['cartId'];
	// 	$quantity = $_POST['quantity'];
	// 	$update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
	// 	//Quantity of product in cart <=0
	// 	if($quantity<=0){
	// 		$delcart = $ct->del_product_cart($cartId); 
	// 	}
    // }
	if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $customerId = Session::get('customer_customerId');
		$insertOrder = $ct->insertOnlineOrder($customerId);
		$delCart = $ct->del_all_data_cart();
		echo "<script>window.location.href ='success.php';</script>";
		//header('Location:success.php');
	}
?>
<?php //Refresh the Cart page (cart.php)
    // if(!isset($_GET['id'])){
	// 	echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	// }
?>
<style type="text/css">
    .box_left {
    width: 50%;
    border: 1px solid #666;
    float: left;
    padding: 4px;
}
    .box_right {
    width: 45%;
    border: 1px solid #666;
    float: right;
    padding: 4px;
}
</style>    
 <div class="main">
    <div class="content">
    <div class="section group">
        <div class="heading">
    		<h3>Online Payment Gateways</h3>
    		</div>
            
            <div class="clear"></div>
            <div class="box_left">
            <div class="cartpage">
			    	
					<?php
					if(isset($update_quantity_cart)){
					   echo $update_quantity_cart;
					}
					?>
					<?php
					if(isset($delcart)){
					   echo $delcart;
					}
					?>
						<table class="tblone">
							<tr>
                                <th width="5%">Product ID</th>
								<th width="15%">Product Name</th>
								<!-- <th width="10%">Image</th> -->
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<!-- <th width="10%">Action</th> -->
							</tr>
							<?php 
							$get_product_cart = $ct->get_product_cart();
							if($get_product_cart){
								$subtotal = 0;
								$qty = 0;
                                $i = 0;
								while($result = $get_product_cart->fetch_assoc()){
                                    $i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
                                <td><?php echo $result['productName'] ?></td>
								<!-- <td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td> -->
								<td><?php echo $fm->format_currency($result['price'])." "."USD" ?></td>
								<td>
									<!-- <form action="" method="post"> -->
                                    <?php echo $result['quantity'] ?>
									    <!-- <input type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>"/> -->
										<!-- <input type="number" name="quantity" min="0" value="<?php echo $result['quantity'] ?>"/> -->
										<!-- <input type="submit" name="submit" value="Update"/> -->
									<!-- </form> -->
								</td>
								<td><?php 
								$total = $result['price'] * $result['quantity'];
								echo $fm->format_currency($total)." "."USD";
								?></td>
								<!-- <td><a onclick ="return confirm('Are you want to delete?');" href="?cartid=<?php echo $result['cartId'] ?>">Delete</a></td> -->
							</tr>
							<?php 
							$subtotal += $total;
							$qty = $qty + $result['quantity'];
							}
						}
							?>
						</table>
						<?php // 
							$check_cart = $ct->check_cart();
								if($check_cart){								    
								?>
						<table style="float:right;text-align:left;margin:5px;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td><?php //Calculate the total price and quantity of all products in the cart (subtotal = $)
								
								echo $fm->format_currency($subtotal)." "."USD";
								Session::set('sum',$subtotal);
								Session::set('qty',$qty);
								?></td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>10% (<?php echo $vat = $subtotal * 0.1; ?>)</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td><?php //Calculate the total price and quantity of all products in the cart (subtotal = $) plus 0.1(10%) tax.
								$vat = $subtotal * 0.1;
								$gtotal = $subtotal + $vat;
								echo $fm->format_currency($gtotal)." "."USD";
								?></td>
							</tr>
                            
					   </table>
					   <?php
					   }else{
						echo 'Your Cart is Empty! Please, Shopping Now!';
					   }
					   ?>
					</div>
            </div>
            <div class="box_right">
            <table class="tblone" width="500px">
        <?php
        $customerId = Session::get('customer_customerId');
        $get_customers = $cs->show_customers($customerId);
        if($get_customers){
            while($result = $get_customers->fetch_assoc()){  
        ?>
            <tr>
                <td>Customer Name</td>
                <td>:</td>
                <td><?php echo $result['customerName'] ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td>:</td>
                <td><?php echo $result['city'] ?></td>
            </tr>
			<tr>
                <td>Gender</td>
                <td>:</td>
                <td><?php echo $result['gender'] ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?php echo $result['phone'] ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $result['country'] ?></td>
            </tr>
            <tr>
                <td>Zipcode</td>
                <td>:</td>
                <td><?php echo $result['zipcode'] ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $result['email'] ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $result['address'] ?></td>
            </tr>
            <tr>
                <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                
            </tr>
            
            <?php
            }
        }
            ?>
        </table>
            </div>
 			</div>
					<style type="text/css">
                    a.btn-payment {
	                    display:block;
	                    width: 33%;
						margin: 6px auto;
						background: royalblue;
                        }
						a.btn-shopping {
	                    display:block;
	                    width: 33%;
						margin: 6px auto;
                        }
						.btn-success {
						background: royalblue;
						border-color: royalblue;
                        }
						.btn-danger {
						background: purple;
						border-color: purple;
                        }		
                        </style>
					<!-- <a class="btn btn-success btn-shopping" href="index.php">Shopping Now</a> -->
					<?php
					$check_cart = $ct->check_cart();
					if(Session::get('customer_customerId')==true && $check_cart){
					?>
                    
				<form action="vnpay_paymentgateways.php" method="POST">
                    <input type="hidden" name="total_paymentgateways" value="<?php echo $gtotal ?>"></input>
                <button onclick="window.location='?orderid=order'" class="btn btn-success" name="redirect" id="redirect">Payment with VNPAY</button>
                </form>
				<p></p>
                <!-- <form action="momo_paymentgateways.php" method="POST">
                        <input type="hidden" name="total_paymentgateways" value="<?php echo $gtotal ?>"></input>
                <button onclick="window.location='?orderid=order'" class="btn btn-danger" name="captureWallet">Payment with QR MOMO</button>
                </form>
				<p></p>
                <form action="momo_paymentgateways.php" method="POST">
                        <input type="hidden" name="total_paymentgateways" value="<?php echo $gtotal ?>"></input>
                <button onclick="window.location='?orderid=order'" class="btn btn-danger" name="payWithATM">Payment with MOMO ATM</button>
                </form> -->
					</div>
					<?php
					}else{
					?>
					<a class="btn btn-primary btn-payment" href="cart.php">Back to Cart</a>
					<?php
					}
					?>

					<!-- <div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div> -->
					
    	</div>
		<!-- <style type="text/css">
                    a.purchase {
	                    float: right;
	                    padding: 10px 20px;
						border: 1px solid #ddd;
						background: #414045;
						color: #fff;
						cursor: pointer;
                        }
                        </style>  	 -->
       <div class="clear"></div>
    </div>
 </div>

<?php
	 include 'inc/footer.php';
?>
