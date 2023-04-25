<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
 <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check==false){
		echo "<script>window.location.href ='login.php';</script>";
        //header('Location:login.php');
	}
?>
<?php 
//     if(!isset($_GET['proid']) || $_GET['proid']==NULL){
//         echo "<script>window.location ='404.php'</script>";
//     }else{
//         $id = $_GET['proid'];
//     }
// 	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
// 		// The request is using the POST method
// 		$quantity = $_POST['quantity'];
// 		$AddtoCart = $ct->add_to_cart($quantity, $id);
//    }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
		<div class="content_top">
    		<div class="heading">
    		<h3>Profile Customers</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <table class="tblone" width="500px">
        <?php
        $customerId = Session::get('customer_customerId');
        $get_customers = $cs->show_customers($customerId);
        if($get_customers){
            while($result = $get_customers->fetch_assoc()){  
        ?>
            <tr>
                <td>Customer Name</td>
                <td>:</td>
                <td><?php echo $result['customerName'] ?></td>
            </tr>
            <tr>
                <td>City</td>
                <td>:</td>
                <td><?php echo $result['city'] ?></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:</td>
                <td><?php echo $result['gender'] ?></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><?php echo $result['phone'] ?></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><?php echo $result['country'] ?></td>
            </tr>
            <tr>
                <td>Zipcode</td>
                <td>:</td>
                <td><?php echo $result['zipcode'] ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $result['email'] ?></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><?php echo $result['address'] ?></td>
            </tr>
            <tr>
                <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                
            </tr>
            
            <?php
            }
        }
            ?>
        </table>
 		</div>
 	</div>
	
<?php
	include 'inc/footer.php';
	 
?>