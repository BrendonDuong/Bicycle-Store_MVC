<?php
    include 'inc/header.php';
	//  include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">
	<?php
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // The request is using the POST method
            $words = $_POST['words'];
            $search_product = $product->search_product($words);
        }    
		?>
    	<div class="content_top">
		
    		<div class="heading">
    		<h3>Search keyword : <?php echo $words ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		    
	      <div class="section group">
			<?php
			if($search_product){
				while($result = $search_product->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" height="120px" width="180px"/></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'],50); ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price'])." "."USD" ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php
				}
			}else{
				echo 'Product Not Have Available';
			}
				?>
			</div>
    </div>
 </div>

 <?php
	 include 'inc/footer.php';
	 
?>