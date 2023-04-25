<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<style type="text/css">
    .cartpage h2 {
    width: 500px;
}
    .shopleft img{
		outline: none;
		display: block;
		margin: 0 auto;
	}
</style>  
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
	if(isset($_GET['proid'])){
        $customerId = Session::get('customer_customerId');
		$proid = $_GET['proid'];
		$del_compare = $product->del_compare($proid, $customerId); 
	}
?>
<!-- <?php //Refresh the Cart page (cart.php)
    if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?> -->
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Compare Product</h2>
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
								<th width="10%">No.</th>
								<th width="20%">Product Name</th>
								<th width="20%">Image</th>
								<th width="15%">Price</th>
								<th width="15%">Action</th>																
							</tr>
							<?php 
							$customerId = Session::get('customer_customerId');
							$get_compare = $product->get_compare($customerId);
							if($get_compare){
								$i = 0;
								while($result = $get_compare->fetch_assoc()){
									$i++;
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $result['productName'] ?></td>
								<td><img src="admin/uploads/<?php echo $result['image'] ?>" alt=""/></td>
								<td><?php echo $fm->format_currency($result['price'])." "."USD" ?></td>
								
								<!-- <td><a onclick ="return confirm('Are you want to delete?');" href="?proid=<?php echo $result['productId'] ?>">Delete</a></td> -->
								<td><a href="details.php?proid=<?php echo $result['productId'] ?>">View</a> ||
                                    <a onclick ="return confirm('Are you sure you want to remove this product from the Compare Page?');" href="?proid=<?php echo $result['productId'] ?>">Remove</a></td>
								
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
					
					</div> -->
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
	 include 'inc/footer.php';
?>
