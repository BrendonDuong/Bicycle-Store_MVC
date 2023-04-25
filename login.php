<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<style>
    input.grey{
	font-size: 19px;
	/* background: #fff; */
	
	}
	.register_account {
    background: #fff none repeat scroll 0 0;
    border: 1px solid #c0bebe;
    border-radius: 3px;
    float: left;
    height: 290px;
    padding: 20px;
    width: 765px;
}
</style>  
<?php
	$login_check = Session::get('customer_login');
	if($login_check){
		echo "<script>window.location.href ='index.php';</script>";
		//header('Location:order.php');
	}
?>
<?php 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		// The request is using the POST method

		$insertCustomers = $cs->insert_customers($_POST);
   }
?>
<?php 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		// The request is using the POST method

		$login_Customers = $cs->login_customers($_POST);
   }
?>
 <div class="main">
    <div class="content">
    	 <div class="login_panel">
        	<h3>Existing Customers</h3>
        	<p>Sign in with the form below.</p>
			<?php
		   if(isset($login_Customers)){
			echo $login_Customers;
		}
		    ?>
        	<form action="" method="POST" >
                	<input type="text" name="email" class="field" placeholder="Enter Email...">
                    <input type="password" name="password" class="field" placeholder="Enter Password...">
                 
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons"><div><input type="submit" name="login" class="grey" value="Sign In"></div></div>
			</form>
        </div>
		<?php
		   
		?>
    	<div class="register_account">
    		<h3>Register New Account</h3>
			<?php
			if(isset($insertCustomers)){
				echo $insertCustomers;
			}
			?>
    		<form action="" method="POST">
		   			 <table>
		   				<tbody>
						<tr>
						<td>
						<div>
							<input type="text" name="customerName" placeholder="Enter Name..." >
						</div>
						<div>
							<input type="text" name="city" placeholder="Enter City...">
						</div>
						<div>
						<select id="gender" name="gender" onchange="change_gender(this.value)" class="frm-field required">
							<option value="null">Select a Gender</option> 
							<option value="male">Male</option> 
							<option value="female">Female</option>
							<option value="other">Other</option>	
		         </select>
				 </div>
						<div>
							<input type="text" name="zipcode" placeholder="Enter Zipcode...">
						</div>
						<div>
							<input type="text" name="email" placeholder="Enter Email...">
						</div>
		    			 </td>
		    			<td>
						<div>
							<input style="margin: 6px;" type="text" name="address" placeholder="Enter Address...">
						</div>
		    		<div>
						<select style="margin: 6px;" id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option> 
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option value="france">France</option>
							<option value="hongkong">Hong Kong</option>
							<option value="india">India</option>
							<option value="indonesia">Indonesia</option>
							<option value="japan">Japan</option>
							<option value="laos">Laos</option>
							<option value="malaysia">Malaysia</option>
							<option value="mexico">Mexico</option>
							<option value="newzealand">New Zealand</option>
							<option value="philippines">Philippines</option>
							<option value="russia">Russia</option>
							<option value="southkorea">South Korea</option>
							<option value="spain">Spain</option>
							<option value="taiwan">Taiwan</option>
							<option value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>			
		         </select>
				 </div>		        
	
		           <div>
		          <input style="margin: 6px;" type="text" name="phone" placeholder="Enter Phone...">
		          </div>
				  
				  <div>
					<input style="margin: 5px;" type="text" name="password" placeholder="Enter Password...">
				</div>
				<div>
					<input style="margin: 5px;" type="text" name="confirm_password" placeholder="Enter Confirm Password...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search"><div><input type="submit" name="submit" class="grey" value="Create Account"></div></div>
		    <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
	 include 'inc/footer.php';
	 
?>