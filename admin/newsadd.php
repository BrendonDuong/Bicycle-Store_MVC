<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php include '../classes/news.php';?>
<?php 
    $news = new news();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		// The request is using the POST method

		$insertNews = $news->insert_news($_POST, $_FILES);
   }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New News</h2>
        <div class="block">       
        <?php 
                if(isset($insertNews)){
                   echo $insertNews;

                }
                ?>        
         <form action="newsadd.php" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" placeholder="Enter Title..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Post Category</label>
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
                            <option value="<?php echo $result['cate_post_newsId'] ?>"><?php echo $result['title'] ?></option>
                            
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
                        <textarea name="news_desc" class="tinymce"></textarea>
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="content" class="tinymce"></textarea>
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
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
                            <option value="0">Display</option>
                            <option value="1">Hide</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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


