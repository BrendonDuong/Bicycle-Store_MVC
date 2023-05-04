<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/cart.php';?>
<?php 
$ct = new cart();
if(!isset($_GET['orderid']) || $_GET['orderid']==NULL){
    echo "<script>window.location ='orderlist.php'</script>";
}else{
    $id = $_GET['orderid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // The request is using the POST method
    $delivery_date = $_POST['delivery_date'];

    $updateOrder = $ct->update_order($delivery_date, $id);
}    

?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Delivery Date Order</h2>
                
               <div class="block"> 
               <?php 
                if(isset($updateOrder)){
                   echo $updateOrder;

                }
                ?>
                <?php
                    $get_order = $ct->getorderbyId($id);
                    if($get_order){
                        while($result = $get_order->fetch_assoc()){

                        
                ?>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <!-- <tr>
                            <td>
                              <label>Product Name</label>
                            </td>
                            <td>
                                <input type="text" value ="<?php echo $result['productName'] ?>" name ="productName" readonly class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <label>Quantity</label>
                            </td>
                            <td>
                                <input type="text" value ="<?php echo $result['quantity'] ?>" name ="quantity" readonly class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                              <label>Price</label>
                            </td>
                            <td>
                                <input type="text" value ="<?php echo $result['price'] ?>" name ="price" readonly class="medium" />
                            </td>
                        </tr> -->
                        <tr>
                             <td>
                              <label>Delivery Date Order</label>
                            </td>
                            <td>
                                <input type="datetime" id="delivery_date" value ="<?php echo $result['delivery_date'] ?>" name ="delivery_date"  class="medium" />
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