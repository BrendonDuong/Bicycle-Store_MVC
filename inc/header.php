<?php
    include 'lib/session.php';
    Session::init();
    
?>
<link rel="icon" href="images/bicyclestorelogo.png">
<?php
    include  'lib/database.php';
    include  'helpers/format.php';
    
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

	$db = new Database();
	$fm = new Format();
	$ct = new cart();
	$us = new user();
	$cat = new category();
	$brand = new brand();
	$cs = new customer();
	$product = new product();
	$post = new post();
	$news = new news();
	$feedback = new feedback();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?> 
<style>
ul.dropdown-menu{
	width: 300px;
	/* margin-left: -500px; */
}
</style>    
<!DOCTYPE HTML>
<head>
<title>Bicycle Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/bicyclestorelogo.png" alt="" height="220px" width="250px" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" placeholder="Search for Products" name="words">
						<input type="submit" name="search_product" value="Search">
				    </form>
			    </div>
			    <div class="shopping_cart" onclick="window.location='cart.php'">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart:</span>
								<span class="no_product">
									<?php // Calculate the total price and quantity of all products in the cart (subtotal = $) and specify the quantity (Qty: ?)
									$check_cart = $ct->check_cart();
									    if($check_cart){
									       $sum = Session::get("sum");
										   $qty = Session::get("qty");
									       echo $fm->format_currency($sum).' '.'$'.'-'.'Qty:'.$qty ;
								        }else{
										   echo '0';//Empty
									    }
									?>
								</span>
							</a>
						</div>
			      </div>
			<?php //Logout
			if(isset($_GET['customer_customerId'])){
				$customerId = $_GET['customer_customerId'];
				$delCart = $ct->del_all_data_cart();
				$delCompare = $ct->del_compare($customerId);
				Session::destroy();
			}
			?>
		   <div class="login">
			<?php
			$login_check = Session::get('customer_login');
			if($login_check==false){
				echo '<a href="login.php"><i class="fas fa-user"> Login and Register </i></a></div>';
			}else{
				echo '<a>Hello, </a>'.Session::get('customer_customerName').' | <a href="?customer_customerId='.Session::get('customer_customerId').'">Logout</a></div>';
			}
			?>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<nav class="navbar navbar-inverse">
	<div class="container-fluid">
	<ul class="navbar navbar-nav">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li class="active"><a href="index.php">Home</a></li>
	  <!-- <li><a href="products.php">Products</a> </li> -->
	  <li class="dropdown">
	  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		Category Product
		<span class="caret"></span></a>
		<ul class="dropdown-menu" style="margin-left: -110px;">
			<?php
			$cate = $cat->show_category();
			if($cate){
				while($result_new = $cate->fetch_assoc()){

			?>
			<li>
			<a href="productbycat.php?catid=<?php echo $result_new['catId'] ?>"><?php echo $result_new['catName'] ?></a>
			</li>
			<?php
			}
		}
			?>
			</ul>
	</li>
	  <!-- <li><a href="products.php">Category Product</a></li> -->
	  
	  <li class="dropdown">
	  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		Top Brands
		<span class="caret"></span></a>
		<ul class="dropdown-menu" style="margin-left: -330px;">
			<?php
			$brands = $brand->show_brand();
			if($brands){
				while($result_new = $brands->fetch_assoc()){

			?>
			<li>
			<a href="topbrands.php?brandid=<?php echo $result_new['brandId'] ?>"><?php echo $result_new['brandName'] ?></a>
			</li>
			<?php
			}
		}
			?>
			</ul>
	</li>
	  <!-- <li><a href="topbrands.php">Top Brands</a></li> -->

	  <li class="dropdown">
	  <a class="dropdown-toggle" data-toggle="dropdown" href="#">
		News
		<span class="caret"></span></a>
		<ul class="dropdown-menu" style="margin-left: -500px;">
			<?php
			$postcat = $post->show_category_post();
			if($postcat){
				while($result_new = $postcat->fetch_assoc()){

			?>
			<li>
			<a href="categorypostnews.php?postid=<?php echo $result_new['cate_post_newsId'] ?>"><?php echo $result_new['title'] ?></a>
			</li>
			<?php
			}
		}
			?>
			</ul>
	</li>

	<li><a href="cart.php">Cart</a></li>
	  <!-- <?php 
	  $check_cart = $ct->check_cart();
	  if($check_cart==true){
		echo '<li><a href="cart.php">Cart</a></li>';
	}else{
		echo '';
	}
	  ?> -->

<?php 
	  $login_check = Session::get('customer_login');
	  if($login_check==false){
		echo '';
	}else{
		echo '<li><a href="changepassword.php">Change Password</a> </li>';
	}
	  ?>

	   <?php 
	  $customerId = Session::get('customer_customerId');
	  $check_order = $ct->check_order($customerId);
	  if($check_order==true){
		echo '<li><a href="orderdetails.php">Ordered</a></li>';
	}else{
		echo '';
	}
	  ?>

	  <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check==false){
		echo '';
	}else{
		echo '<li><a href="profile.php">Profile</a> </li>';
	}
	  ?>
	  <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check==true){
		echo '<li><a href="compare.php">Compare</a> </li>';
	}
    ?>
	 <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check==true){
		echo '<li><a href="wishlist.php">Wishlist</a> </li>';
	}
    ?>
	  <li><a href="contact.php">Contact</a> </li>
	  
	</ul>
	</ul>
	</div>
</nav>
</div>