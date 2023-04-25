<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php 
    $post = new post();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		// The request is using the POST method
		$catName = $_POST['catName'];
        $catDesc = $_POST['catDesc'];
        $catStatus = $_POST['catStatus'];
		$insertCatePost = $post->insert_news_category_post($catName,$catDesc,$catStatus);
   }
?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New News Category</h2>
                
               <div class="block"> 
               <?php 
                if(isset($insertCatePost)){
                   echo $insertCatePost;

                }
                ?>
                 <form autocomplete="off" action="postadd.php" method="post"> 
                    <table class="form">					
                        <tr>
                        <td>
                        <label>Title</label>
                        </td>
                            <td>
                                <input type="text" name ="catName" placeholder="Please, add news category title ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                        <label>Description</label>
                        </td>
                            <td>
                                <input type="text" name ="catDesc" placeholder="Please, add news category description ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                        <label>News Category Status</label>
                        </td>
                            <td>
                                <select name="catStatus">
                                    <option value="0">Display</option>
                                    <option value="1">Hide</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>