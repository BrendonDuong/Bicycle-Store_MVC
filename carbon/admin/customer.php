<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
?>
<?php 
if(!isset($_GET['customerid']) || $_GET['customerid']==NULL){
    echo "<script>window.location ='inbox.php'</script>";
}else{
    $customerId = $_GET['customerid'];
}
$cs = new customer();
// if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     // The request is using the POST method
//     $catName = $_POST['catName'];

//     $updateCat = $cat->update_category($catName,$id);
// }    

?>
<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>View Profile Customer</h2>
                
               <div class="block copyblock"> 
              
                <?php
                    $get_customer = $cs->show_customers($customerId);
                    if($get_customer){
                        while($result = $get_customer->fetch_assoc()){

                        
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['customerName'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>City</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['city'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Gender</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['gender'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['phone'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['country'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['zipcode'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['email'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['address'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['password'] ?>" name ="catName" class="medium" />
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