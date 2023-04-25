<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<style>
    h3.payment {
    text-align: center;
    font-size: 20px;
    text-decoration: underline;
    font-weight: bold;
}
    .wrapper_method {
    text-align: center;
    width: 550px;
    margin: 0 auto;
    border: 1px solid #666;
    padding: 20px;
    background: cornsilk;
    /* margin: 20px; */
}
    .wrapper_method a {
    color: #fff;
    padding: 10px;
    background: royalblue;
}
    .wrapper_method h3 {
    margin-bottom: 20px;
}
</style>
 <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check==false){
		echo "<script>window.location.href ='login.php';</script>";
        //header('Location:login.php');
	}
	  ?>
<?php 
//     if(!isset($_GET['proid']) || $_GET['proid']==NULL){
//         echo "<script>window.location ='404.php'</script>";
//     }else{
//         $id = $_GET['proid'];
//     }
// 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
// 		// The request is using the POST method
// 		$quantity = $_POST['quantity'];
// 		$AddtoCart = $ct->add_to_cart($quantity, $id);
//    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
		<div class="content_top">
    		<div class="heading">
    		<h3>Online Payment Method</h3>
    		</div>

    		<div class="clear"></div>
            <div class="wrapper_method">
            <h3 class="payment">Choose Your Online Payment Method</h3>
            <!-- <form action="onlinepaymentorders.php" method="POST">
           <button class="btn btn-success" name="redirect" id="redirect">Payment VNPAY</button>
           </form> -->
           <p><a class="btn btn-primary" href="onlinepaymentorders.php">Payment VNPAY</a></p>
           <p><a class="btn btn-danger" href="onlinepaymentorders.php">Payment MOMO</a></p>

           <!-- <p>In development, please wait...</p> -->
           <a style="background:grey" href="cart.php"><< Previous</a>
            </div>
 		</div>
    	</div>
 	</div>
     <style type="text/css">
                    a.btn-danger {
						background: purple;
                        }
                        </style>	
<?php
	include 'inc/footer.php';
	 
?>