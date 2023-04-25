<?php
    include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<?php
    if(!isset($_GET['newsid']) || $_GET['newsid']==NULL){
		echo "<script>window.location ='404.php'</script>";
	}else{
		$id = $_GET['newsid'];
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
		$news_detail = $news->getnewsbyId($id);
		if($news_detail){
			while($result = $news_detail->fetch_assoc()){
		?>
    	<div class="content_top">
		
    		<div class="heading">
    		<h3>News Title : <?php echo $result['title'] ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	
	      <div class="section group">
				<div class="col-md-12">
					 
					 <h2><?php echo $result['title'] ?></h2>
					 <!-- <p><?php echo $fm->textShorten($result['description'],150); ?></p> -->
                     <p><?php echo $result['content'] ?></p>
				    
				</div>
	
			</div>
            <?php
                }
            }
			?>
    </div>
 </div>

 <?php
	 include 'inc/footer.php';
	 
?>