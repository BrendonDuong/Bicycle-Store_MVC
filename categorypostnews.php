<?php
    include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<?php
    if(!isset($_GET['postid']) || $_GET['postid']==NULL){
		echo "<script>window.location ='404.php'</script>";
	}else{
		$id = $_GET['postid'];
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
		$name_post = $post->getnewsbypostcatId($id);
		if($name_post){
			while($result_name = $name_post->fetch_assoc()){
		?>
    	<div class="content_top">
		
    		<div class="heading">
    		<h3>News Category : <?php echo $result_name['title'] ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
		    <?php
				}
			}
			?>
	      <div class="section group">
			<?php
			$postbycat = $post->get_post_by_cat($id);
			if($postbycat){
				while($result = $postbycat->fetch_assoc()){
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details_news.php?newsid=<?php echo $result['newsId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" width="200px" alt="" /></a>
					 <h2><?php echo $result['title'] ?></h2>
					 <p><?php echo $fm->textShorten($result['description'],150); ?></p>
				     <div class="button"><span><a href="details_news.php?newsid=<?php echo $result['newsId'] ?>" class="details">News Details</a></span></div>
				</div>
				<?php
				}
			}else{
				echo 'News not available in this category';
			}
				?>
			</div>
    </div>
 </div>

 <?php
	 include 'inc/footer.php';
	 
?>