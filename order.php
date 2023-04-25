<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<!-- <?php
	$login_check = Session::get('customer_login');
	if($login_check==false){
		echo "<script>window.location.href ='login.php';</script>";
		//header('Location:login.php');
	}
?> -->
<style>
    .order_page {
    font-size: 30px;
    color: red;
    font-weight: bold;
}
</style>    
<div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    <div class="order_page">
                    <h3>Order Page</h3>
                </div>
			</div>
					
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php
	include 'inc/footer.php';
	 
?>