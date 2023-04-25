<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<style>
    input.grey{
	font-size: 19px;
	/* background: #fff; */
	
	}
	.changepassword_panel{
	float:left;
	width: 245px;
	margin-right: 10px;
	padding:20px;
	background:#FFF;
	border:1px solid #C0BEBE;
    -moz-border-radius: 3px; -webkit-border-radius: 3px; border-radius: 3px;
}
.changepassword_panel input[type="text"],.changepassword_panel input[type="password"]{
	font-size:12px;
	color:#B3B1B1;
	padding:8px;
	outline:none;
	margin:6px 0;
	width:92%;
}
.changepassword_panel form{
	margin:15px 0;
}
.changepassword_panel p{
	font-size:12px;
	color:#888;
}
</style>  
<?php
$customerId = Session::get('customer_customerId');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['confirm'])) {
    // The request is using the POST method

    $confirmAndChangePassword = $cs->confirmAndChangePassword($_POST, $customerId);
}
?>
 <div class="main">
    <div class="content">
    	 <div class="changepassword_panel">
        	<h3>Confirm Change Password</h3>
        	<p>Confirm Change Password with the form below.</p>
            <?php
      if(isset($confirmAndChangePassword)){
         echo $confirmAndChangePassword;
      }
   ?>
        	<form action="" method="POST" >
                    <input type="hidden" name="customer_Id" value="<?php echo $result['customer_Id'] ?>">
                	<!-- <input type="text" name="email" id="email" class="field" placeholder="Enter Email..."> -->
                    <input type="password" name="new_password" id="new_password" class="field" placeholder="Enter New Password...">
                    <input type="password" name="confirm_new_password" id="confirm_new_password" class="field" placeholder="Enter Confirm New Password...">
                 
                 <!-- <p class="note">Forgot Password. If you forgot your passoword just enter your email and click <a href="changepassword.php">here</a></p> -->
                    <div class="buttons"><div><input type="submit" name="confirm" class="grey" value="Confirm"></div></div>
			</form>
        </div>
		<?php
		   
		?>
       <div class="clear"></div>
    </div>
 </div>

<?php
	 include 'inc/footer.php';
	 
?>