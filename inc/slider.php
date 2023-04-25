<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php
				$getLastestKona = $product->getLastestKona();
				if($getLastestKona){
					while($resultkona = $getLastestKona->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $resultkona['productId'] ?>"> <img src="admin/uploads/<?php echo $resultkona['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Kona</h2>
						<p><?php echo $resultkona['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultkona['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php
			   }
			}
			   ?>
			   <?php
				$getLastestCannondale = $product->getLastestCannondale();
				if($getLastestCannondale){
					while($resultcannondale = $getLastestCannondale->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $resultcannondale['productId'] ?>"><img src="admin/uploads/<?php echo $resultcannondale['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Cannondale</h2>
						  <p><?php echo $resultcannondale['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resultcannondale['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   }
			}
			   ?>
			</div>
			<div class="section group">
			<?php
				$getLastestSpecialized = $product->getLastestSpecialized();
				if($getLastestSpecialized){
					while($resultspecialized = $getLastestSpecialized->fetch_assoc()){
				?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?proid=<?php echo $resultspecialized['productId'] ?>"> <img src="admin/uploads/<?php echo $resultspecialized['image'] ?>" alt="" /></a>
					</div>
				    <div class="text list_2_of_1">
						<h2>Specialized</h2>
						<p><?php echo $resultspecialized['productName'] ?></p>
						<div class="button"><span><a href="details.php?proid=<?php echo $resultspecialized['productId'] ?>">Add to cart</a></span></div>
				   </div>
			   </div>
			   <?php
			   }
			}
			   ?>
			   <?php
				$getLastestTrek = $product->getLastestTrek();
				if($getLastestTrek){
					while($resulttrek = $getLastestTrek->fetch_assoc()){
				?>			
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						  <a href="details.php?proid=<?php echo $resulttrek['productId'] ?>"><img src="admin/uploads/<?php echo $resulttrek['image'] ?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						  <h2>Trek</h2>
						  <p><?php echo $resulttrek['productName'] ?></p>
						  <div class="button"><span><a href="details.php?proid=<?php echo $resulttrek['productId'] ?>">Add to cart</a></span></div>
					</div>
				</div>
				<?php
			   }
			}
			   ?>
			</div>
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
						<?php
						$get_slider = $product->show_slider();
						if($get_slider){
							while($result_slider = $get_slider->fetch_assoc()){

						?>
						<li><img src="admin/uploads/<?php echo $result_slider['slider_image'] ?>" alt="<?php echo $result_slider['sliderName'] ?>" height="120px" width="200px"/></li>
						<?php
						}
					}
						?>
				    </ul>
				  </div>
	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>