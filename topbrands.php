<?php
    include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<?php
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
		echo "<script>window.location ='404.php'</script>";
	}else{
		$id = $_GET['brandid'];
	}
	
	// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// 	// The request is using the POST method
	// 	$catName = $_POST['catName'];
	
	// 	$updateCat = $cat->update_category($catName,$id);
	// }    
?>
 <div class="main">
    <div class="content">
	<?php
		$name_brand = $brand->get_name_by_brand($id);
		if($name_brand){
			while($result_name = $name_brand->fetch_assoc()){
		?>
    	<div class="content_top">
		
    		<div class="heading">
    		<h3>Brand : <?php echo $result_name['brandName'] ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		    <?php
				}
			}
			?>
	      <div class="section group">
			<?php
			$productbybrand = $brand->get_product_by_brand($id);
			if($productbybrand){
				while($result = $productbybrand->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" height="120px" width="180px"/></a>
					 <h2><?php echo $result['productName'] ?></h2>
					 <p><?php echo $fm->textShorten($result['product_desc'],50); ?></p>
					 <p><span class="price"><?php echo $fm->format_currency($result['price'])." "."USD" ?></span></p>
					 <p>Category: <span><?php echo $result['catName'] ?></span></p>
					 <p>Brand: <span><?php echo $result['brandName'] ?></span></p>
				     <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
				</div>
				<?php
				}
			}else{
				echo 'Brand Not Have Available';
			}
				?>
			</div>
    </div>
 </div>

 <?php
	 include 'inc/footer.php';
	 
?>