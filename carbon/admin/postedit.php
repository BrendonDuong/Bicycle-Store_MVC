<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php 
if(!isset($_GET['postcatid']) || $_GET['postcatid']==NULL){
    echo "<script>window.location ='postlist.php'</script>";
}else{
    $id = $_GET['postcatid'];
}
$post = new post();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The request is using the POST method
    $catName = $_POST['catName'];
    $catDesc = $_POST['catDesc'];
    $catStatus = $_POST['catStatus'];
    $updateCatePost = $post->update_news_category_post($catName,$catDesc,$catStatus,$id);
}    

?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit News Category</h2>
                
               <div class="block"> 
               <?php 
                if(isset($updateCatePost)){
                   echo $updateCatePost;

                }
                ?>
                <?php
                    $get_post_cate_name = $post->getpostcatbyId($id);
                    if($get_post_cate_name){
                        while($result = $get_post_cate_name->fetch_assoc()){

                        
                ?>
                 <form action="" method="post">
                    <table class="form">					
                    <tr>
                        <td>
                        <label>Title</label>
                        </td>
                            <td>
                                <input type="text" value ="<?php echo $result['title'] ?>" name ="catName" placeholder="Please, add news category title ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                        <label>Description</label>
                        </td>
                            <td>
                                <input type="text" value ="<?php echo $result['description'] ?>" name ="catDesc" placeholder="Please, add news category description ..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                        <td>
                        <label>News Category Status</label>
                        </td>
                            <td>
                                <select name="catStatus">
                            <?php 
                            if($result['status']=='0'){
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
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
<?php include 'inc/footer.php';?>