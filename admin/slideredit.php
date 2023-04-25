<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/product.php';?>
<?php 
    $product = new product();

    if(!isset($_GET['sliderid']) || $_GET['sliderid']==NULL){
        echo "<script>window.location ='sliderlist.php'</script>";
    }else{
        $id = $_GET['sliderid'];
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		// The request is using the POST method
		

		$updateSlider = $product->update_slider($_POST, $_FILES, $id);
   }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Slider</h2>
    <div class="block">   
        <?php
        if(isset($updateSlider)){
            echo $updateSlider;

         }
        ?>
        <?php 
        $get_slider_by_id = $product->getsliderbyId($id);
            if($get_slider_by_id){
                while($result_slider = $get_slider_by_id->fetch_assoc()){
        ?>                
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="sliderName"  value="<?php echo $result_slider['sliderName'] ?>" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $result_slider['slider_image'] ?>" height="120px" width="200px"><br>
                        <input type="file" name="slider_image"/>
                    </td>
                </tr>

                <tr>
                    <td>
                        <!-- <label>Type</label> -->
                    </td>
                    <!-- <td>
                        <select name="type">
                            <option value ="1">On</option>
                            <option value ="0">Off</option>
                        </select>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <?php 
                            if($result_slider['type']==1){
                            ?>
                            <option selected value="0">Off</option>
                            <option value="1">On</option>
                            <?php 
                            }else{
                                ?>
                            <option value="0">Off</option>
                            <option selected value="1">On</option>
                            <?php
                            }
                            ?>
                        </select>
                    </td> -->
                </tr>
               
				<tr>
                    <td></td>
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