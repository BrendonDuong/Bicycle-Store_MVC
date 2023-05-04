
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
		echo "<script>window.location.href ='login.php';</script>";//header('Location:login.php');
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
 
 

<?php
	 include 'inc/footer.php';
?>
