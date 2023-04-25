<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<?php 
    if(!isset($_GET['proid']) || $_GET['proid']==NULL){
        echo "<script>window.location ='404.php'</script>";
    }else{
        $id = $_GET['proid'];
    }
	$customerId = Session::get('customer_customerId');
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
		// The request is using the POST method
		$productId = $_POST['productId'];
		$insertCompare = $product->insertCompare($productId, $customerId);
   }
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
	// The request is using the POST method
	$productId = $_POST['productId'];
	$insertWishlist = $product->insertWishlist($productId, $customerId);
}
   if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
	// The request is using the POST method
	$quantity = $_POST['quantity'];
	$insertCart = $ct->add_to_cart($quantity, $id, $customerId);
}
//    if(isset($_POST['comment_submit'])){
// 	$comment_insert = $cs->insert_comment();
// }
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['comment_submit'])) {
	// The request is using the POST method
	$comment_insert = $cs->insert_comment($customerId);
}
if(isset($_GET['commentid'])){
	$commentid = $_GET['commentid'];
	$delcomment = $cs->del_comment_in_product($commentid);
}
?>
<style>
    .button_details input[type=submit]{
	float: left;
	margin: 5px;
}
    .clear{
		clear: both;
	}
	.rating{
		color: #FFD700;
	}
</style> 
 <div class="main">
    <div class="content">
    	<div class="section group">
			<?php 

			$get_product_details = $product->get_details($id);
			if($get_product_details){
				while($result_details = $get_product_details->fetch_assoc()){
			

			?>
				<div class="cont-desc span_1_of_2">				
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result_details['image'] ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result_details['productName'] ?></h2>
					<p><?php echo $fm->textShorten($result_details['product_desc'], 150) ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $fm->format_currency($result_details['price'])." "."USD" ?></span></p>
						<p>Category: <span><?php echo $result_details['catName'] ?></span></p>
						<p>Brand: <span><?php echo $result_details['brandName'] ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1"/>
						<input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
					</form>	
					<?php
						if(isset($AddtoCart)){
							echo '<span style="color:red;font-size:18px;">This Product Already Added Cart Before! Please recheck this product in Cart!</span>';
						}
					?>			
				</div>
				
				<div class="add-cart"> 
				<div class="button_details"> 
				<form action="" method="POST">	
				<!-- <a href="?wlist=<?php echo $result_details['productId'] ?>" class="buysubmit">Save to Wishlist</a> -->
				<!-- <a href="?compare=<?php echo $result_details['productId'] ?>" class="buysubmit">Compare Product</a> -->
				<input type="hidden" name="productId" value="<?php echo $result_details['productId'] ?>"/>
				<?php 
	            $login_check = Session::get('customer_login');
	            if($login_check==true){
		        echo '<input type="submit" class="buysubmit" name="compare" value="Compare Product"/>'.'  ';
				
	            }else{
					echo '';
				}
                ?>
				
				</form>	
			
				<form action="" method="POST">	
				<!-- <a href="?wlist=<?php echo $result_details['productId'] ?>" class="buysubmit">Save to Wishlist</a> -->
				<!-- <a href="?compare=<?php echo $result_details['productId'] ?>" class="buysubmit">Compare Product</a> -->
				<input type="hidden" name="productId" value="<?php echo $result_details['productId'] ?>"/>
				<?php 
	            $login_check = Session::get('customer_login');
	            if($login_check==true){

				echo '<input type="submit" class="buysubmit" name="wishlist" value="Save to Wishlist">';
	            }else{
					echo '';
				}
                ?>
				
				</form>	
				</div>
				<div class="clear"></div>
				<p>
				<?php
				if(isset($insertCart)){
					echo $insertCart;
				}
				?>
				<?php
				if(isset($insertCompare)){
					echo $insertCompare;
				}
				?>
				<?php
				if(isset($insertWishlist)){
					echo $insertWishlist;
				}
				?>
				</p>
				</div>

			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $fm->textShorten($result_details['product_desc'], 3000) ?>
	    </div>
				
	</div>
	<?php
	}
}
	?>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php
						$getall_category = $cat->show_category_frontend(); 
						if($getall_category){
							while($result_allcat = $getall_category->fetch_assoc()){
						?>
				      <li><a href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a></li>
				      <?php
					  }
					}
					  ?>
    				</ul>
    	
 				</div>
 		</div>
		 <div class="comment">
<div class="row">
<div class="col-md-8">
<h2>Product Comments</h2>
<?php
if(isset($comment_insert)){
echo $comment_insert;
}
?>
<form action="" method="POST">
<input type="hidden" value="<?php echo $id ?>" name="productId_comment">
<div class="form-group">
<label for="name">Commenter Name:</label>
<input type="text" placeholder="Enter Name..." class="form-control" name="commenterName">
</div>
<div class="form-group">
<label for="name">Email:</label>
<input type="text" placeholder="Enter Email..." class="form-control" name="email">
</div>
<div class="form-group">
<label for="name">Content Comment:</label>
<textarea rows="5" style="resize: none;" placeholder="Comment..." class="form-control" name="comment"></textarea>
</div>
<div class="form-group">
<label for="name">Rating:</label>
<br>
<div class="rating">
<input type="hidden" name="rating" id="rating_hidden" value="">
<i class="far fa-star rating-star" data-rating="1"></i>
<i class="far fa-star rating-star" data-rating="2"></i>
<i class="far fa-star rating-star" data-rating="3"></i>
<i class="far fa-star rating-star" data-rating="4"></i>
<i class="far fa-star rating-star" data-rating="5"></i>
<br>
</div>
</div>
<div class="form-group">
<br>
<input type="submit" class="btn btn-primary" name="comment_submit" value="Submit">
</div>
</form>
</div>
</div>


<?php
$id = $_GET['proid'];
$show_comments = $cs->show_comment($id);
if($show_comments){
while($result = $show_comments->fetch_assoc()){
?>
<ul>
<li><a href="#"><i class="fas fa-user"></i> <?php echo $result['commentName'] ?> </a></li>
<li><a href="#"><i class="fas fa-clock"></i> <?php echo $result['dated'] ?></a></li>
<li><a href="#">
<?php
for($i=1; $i<=$result['rating']; $i++) {
echo '<i class="fas fa-star" style="color:#FFD700"></i>';
}
?>
</a></li>
</ul>
<p><?php echo $fm->textShorten($result['comment'], 200) ?></p>
<td><a style="color:red" onclick ="return confirm('Are you sure you want to remove this comment from the Product?');" href="?commentid=<?php echo $result['commentId'] ?>">Delete</a></td>
<?php
}
}
?>
</div>



<script>
$(document).ready(function(){
$('.rating-star').click(function(){
$('.rating-star').removeClass('fas').addClass('far');
for(let i=1; i<= $(this).data('rating'); i++) {
$('#rating_hidden').val($(this).data('rating'));
$(`.rating-star:nth-child(${i})`).removeClass('far').addClass('fas');
}
});
});
</script>
	<style>
		.col-md-8 h2 {
			padding: 8px 20px;
    background: #602D8D;
    border: 1px solid #EBE8E8;
    border-radius: 5px;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    -o-border-radius: 5px;
    font-family: 'Monda', sans-serif;
    font-size: 1.2em;
    color: #FFF;
    text-transform: uppercase;
    text-shadow: 0 1px 5px rgba(34, 34, 34, 0.17);
		}
	</style>
	
<?php
	include 'inc/footer.php';
	 
?>