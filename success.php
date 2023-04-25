<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<?php 
     if(isset($_GET['orderid']) && $_GET['orderid']=='order'){
        $customerId = Session::get('customer_customerId');
		$insertOrder = $ct->insertOrder($customerId);
		$delCart = $ct->del_all_data_cart();
		echo "<script>window.location.href ='success.php';</script>";
		//header('Location:success.php');
	}
	// if(isset($_GET['partnerCode'])){
	// 	$data_momo = [

	// 	];
	// }
?>
<style type="text/css">
    h2.success_order {
    text-align: center;
    color: royalblue;
}
    p.success_note{
	text-align: center;
	padding: 8px;
	font-size: 17px;
}
</style>    
<form action="" method="POST">	
 <div class="main">
    <div class="content">
    	<div class="section group">
            <h2 class="success_order">Online Ordered Successfully</h2>
			<?php
			$customerId = Session::get('customer_customerId');
			$get_amount = $ct->getAmountPrice($customerId);
			if($get_amount){
				$amount = 0;
				while($result = $get_amount->fetch_assoc()){
					 $price = $result['price'];
					 $amount += $price;
				}
			}
			?>
			<p class="success_note">Total Price You Have Bought From Our Smokeless Bicycle Store (SBS) : <?php $vat = $amount * 0.1; 
			$total = $vat + $amount; 
			echo $fm->format_currency($total)." "."USD"; ?></P>
			<p class="success_note">Note: Thank you for using our online payment service through VNPay. Your payment for this order is complete. The rest, you just need to wait for us to confirm the online order and deliver it to you. Thank you very much!</p>
			<p class="success_note">We will contact as soon as possible. Please view your order details here. <a href="orderdetails.php">Click here</a></P>
 			</div>
			
 		</div>
        
 	</div>
    </form>	
<?php
	include 'inc/footer.php';
	 
?>