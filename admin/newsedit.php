<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php include '../classes/news.php';?>
<?php 
    $news = new news();
    
    if(!isset($_GET['newsid']) || $_GET['newsid']==NULL){
        echo "<script>window.location ='productlist.php'</script>";
    }else{
        $id = $_GET['newsid'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		// The request is using the POST method

		$updateNews = $news->update_news($_POST,$_FILES, $id);
   }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit News</h2>
        <div class="block">       
        <?php 
                if(isset($updateNews)){
                   echo $updateNews;

        }
        ?> 
        <?php 
        $get_news_by_id = $news->getnewsbyId($id);
            if($get_news_by_id){
                while($result_news = $get_news_by_id->fetch_assoc()){
        ?>       
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $result_news['news_title'] ?>" placeholder="Enter title..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="post_category">
                            <option>------Select Category------</option>
                            <?php 
                            $post = new post();
                            $postlist = $post->show_category_post();

                            if($postlist){
                                while($result = $postlist->fetch_assoc()){

                            ?>

                            <option
                            <?php 
                            if($result['cate_post_newsId'] ==$result_news['cate_post_newsId']){ echo 'selected';   }
                            ?>

                            value="<?php echo $result['cate_post_newsId'] ?>"><?php echo $result['title'] ?></option>
                            

                           <?php 
                              }
                           }
                           ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="news_desc" class="tinymce"><?php echo $result_news['description'] ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="content" class="tinymce"><?php echo $result_news['content'] ?></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_news['image'] ?>" width="100"><br>
                        <input type="file" name="image"/>
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>News Status</label>
                    </td>
                    <td>
                        <select id="select" name="news_status">
                            <option>Select Status</option>
                            <?php 
                            if($result_news['status']==0){
                            ?>
                            <option selected value="0">Display</option>
                            <option value="1">Hide</option>
                            <?php 
                            }else{
                                ?>
                            <option value="0">Display</option>
                            <option selected value="1">Hide</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            <?php 
            }
            }
            ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


