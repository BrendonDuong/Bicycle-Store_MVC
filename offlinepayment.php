<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<?php 
    if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $customerId = Session::get('customer_customerId');
		$insertOrder = $ct->insertOfflineOrder($customerId);
		$delCart = $ct->del_all_data_cart();
		echo "<script>window.location.href ='successoffline.php';</script>";
		//header('Location:success.php');
	}
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
    a.a_order { 
    padding: 7px 20px;
    /* border: none; */
    background: royalblue;
    font-size: 21px;
    color: #fff;
    /* margin: 10px; */
    /* cursor: pointer; */
    /* border-radius: 5%; */
}
</style>    
<form action="" method="POST">	
 <div class="main">
    <div class="content">
    	<div class="section group">
        <div class="heading">
    		<h3>Offline Payment</h3>
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
					<!-- <?php

                    $date = new DateTime();

                    $date->modify('+3 day');

                    $due_date = $date->format('Y-m-d'); 
                    ?> -->
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
			<!-- <div class="heading">
    		<h3>Shipping Address</h3>
    		</div>	
		<form action="" method="POST">
		<p><input type="hidden" value="<?php echo $id ?>" name="productId_comment"></p>
		<p><input type="text" placeholder="Enter Full Name..." class="form-control" name="fullName"></p>
		<p><input type="text" placeholder="Enter Address..." class="form-control" name="address"></p>
		<p><input type="text" placeholder="Enter City..." class="form-control" name="city"></p>
		<p><input type="text" placeholder="Enter Phone..." class="form-control" name="phone"></p>
		<div>
						<select style="display: block;
                                        width: 100%;
                                        height: 34px;
                                        padding: 6px 12px;
                                        font-size: 14px;
                                        line-height: 1.42857143;
                                        color: #555;
                                        background-color: #fff;
                                        background-image: none;
                                        border: 1px solid #ccc;
										border-radius: 4px;" 
							id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option> 
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option value="france">France</option>
							<option value="hongkong">Hong Kong</option>
							<option value="india">India</option>
							<option value="indonesia">Indonesia</option>
							<option value="japan">Japan</option>
							<option value="laos">Laos</option>
							<option value="malaysia">Malaysia</option>
							<option value="mexico">Mexico</option>
							<option value="newzealand">New Zealand</option>
							<option value="philippines">Philippines</option>
							<option value="russia">Russia</option>
							<option value="southkorea">South Korea</option>
							<option value="spain">Spain</option>
							<option value="taiwan">Taiwan</option>
							<option value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>			
		         </select>
 			</div> -->
			
 		</div>
         <p><center><a href="?orderid=order" class="a_order" >Order Offline Now</a></center></p>
 	</div>
    </form>	
<?php
	include 'inc/footer.php';
	 
?>