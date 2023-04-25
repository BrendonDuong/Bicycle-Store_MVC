<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>View Profile Admin</h2>
                
               <div class="block copyblock"> 
              
                <?php
                    $cs = new customer();
                    $get_admin = $cs->show_admin();
                    if($get_admin){
                        while($result = $get_admin->fetch_assoc()){

                        
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>Admin Name</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['adminName'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td>Admin Email</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['adminEmail'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Admin Username</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['adminUser'] ?>" name ="catName" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Admin Password</td>
                            <td>:</td>
                            <td>
                                <input type="text" readonly="readonly" value ="<?php echo $result['adminPass'] ?>" name ="catName" class="medium" />
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