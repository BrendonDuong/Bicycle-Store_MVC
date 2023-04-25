<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
 <?php 
	  $login_check = Session::get('customer_login');
	  if($login_check==false){
		echo "<script>window.location.href ='login.php';</script>";//header('Location:login.php');
	}
	  ?>
<?php 
    // if(!isset($_GET['proid']) || $_GET['proid']==NULL){
    //     echo "<script>window.location ='404.php'</script>";
    // }else{
    //     $id = $_GET['proid'];
    // }
    $customerId = Session::get('customer_customerId');
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
		// The request is using the POST method
		
		$UpdateCustomers = $cs->update_customers($_POST, $customerId);
   }
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
		<div class="content_top">
    		<div class="heading">
    		<h3>Update Profile Customers</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
        <form action="" method="post">
        <table class="tblone" width="500px">
            
                <?php
                if(isset($UpdateCustomers)){
                    echo '<td colspan="3">'.$UpdateCustomers.'</td>';
                }
                ?>
        
        <?php
        $customerId = Session::get('customer_customerId');
        $get_customers = $cs->show_customers($customerId);
        if($get_customers){
            while($result = $get_customers->fetch_assoc()){ 
        ?>
            <tr>
                <td>Customer Name</td>
                <td>:</td>
                <td><input type="text" name="customerName" value="<?php echo $result['customerName'] ?>"></td>
            </tr>
            <tr>
                <td>City</td>
                <td>:</td>
                <td><input type="text" name="city" value="<?php echo $result['city'] ?>"></td>
            </tr>
            <tr>
                <td>Gender</td>
                <td>:</td>
                <td><select id="select" name="gender">
							<option value="null">Select a Gender</option> 
                            <?php 
                            if($result['gender']=='male'){
                            ?>
                            <option selected value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                            <?php 
                            }
                            ?>
                            <?php
                            if($result['gender']=='female'){
                            ?>
                            <option value="male">Male</option>
                            <option selected value="female">Female</option>
                            <option value="other">Other</option>
                            <?php
                            }
                            ?>
                            <?php
                            if($result['gender']=='other'){
                            ?>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option selected value="other">Other</option>
                            <?php
                            }
                            ?>
		         </select></td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>:</td>
                <td><input type="text" name="phone" value="<?php echo $result['phone'] ?>"></td>
            </tr>
            <tr>
                <td>Country</td>
                <td>:</td>
                <td><select id="select" name="country">
							<option value="null">Select a Country</option> 
                            <?php 
                            if($result['country']=='australia'){
                            ?>
							<option selected value="australia">Australia</option> 
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='cambodia'){
                            ?>
							<option value="australia">Australia</option> 
							<option selected value="cambodia">Cambodia</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='canada'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option selected value="canada">Canada</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='china'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option selected value="china">China</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='france'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option selected value="france">France</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='france'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option selected value="france">France</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='hongkong'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option value="france">France</option>
							<option selected value="hongkong">Hong Kong</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='india'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option value="france">France</option>
							<option value="hongkong">Hong Kong</option>
							<option selected value="india">India</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='indonesia'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option value="france">France</option>
							<option value="hongkong">Hong Kong</option>
							<option value="india">India</option>
							<option selected value="indonesia">Indonesia</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='japan'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option value="france">France</option>
							<option value="hongkong">Hong Kong</option>
							<option value="india">India</option>
							<option value="indonesia">Indonesia</option>
							<option selected value="japan">Japan</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='laos'){
                            ?>
							<option value="australia">Australia</option> 
							<option value="cambodia">Cambodia</option>
							<option value="canada">Canada</option>
							<option value="china">China</option>
							<option value="france">France</option>
							<option value="hongkong">Hong Kong</option>
							<option value="india">India</option>
							<option value="indonesia">Indonesia</option>
							<option value="japan">Japan</option>
							<option selected value="laos">Laos</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='malaysia'){
                            ?>
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
							<option selected value="malaysia">Malaysia</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='mexico'){
                            ?>
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
							<option selected value="mexico">Mexico</option>
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
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='newzealand'){
                            ?>
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
							<option selected value="newzealand">New Zealand</option>
							<option value="philippines">Philippines</option>
							<option value="russia">Russia</option>
							<option value="southkorea">South Korea</option>
							<option value="spain">Spain</option>
							<option value="taiwan">Taiwan</option>
							<option value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='philippines'){
                            ?>
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
							<option selected value="philippines">Philippines</option>
							<option value="russia">Russia</option>
							<option value="southkorea">South Korea</option>
							<option value="spain">Spain</option>
							<option value="taiwan">Taiwan</option>
							<option value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='russia'){
                            ?>
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
							<option selected value="russia">Russia</option>
							<option value="southkorea">South Korea</option>
							<option value="spain">Spain</option>
							<option value="taiwan">Taiwan</option>
							<option value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='southkorea'){
                            ?>
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
							<option selected value="southkorea">South Korea</option>
							<option value="spain">Spain</option>
							<option value="taiwan">Taiwan</option>
							<option value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='spain'){
                            ?>
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
							<option selected value="spain">Spain</option>
							<option value="taiwan">Taiwan</option>
							<option value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='taiwan'){
                            ?>
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
							<option selected value="taiwan">Taiwan</option>
							<option value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='thai'){
                            ?>
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
							<option selected value="thai">Thailand</option>
							<option value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='unitedkingdom'){
                            ?>
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
							<option selected value="unitedkingdom">United Kingdom</option>
							<option value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='unitedstates'){
                            ?>
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
							<option selected value="unitedstates">United States</option>
							<option value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
                            <?php 
                            if($result['country']=='vietnam'){
                            ?>
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
							<option selected value="vietnam">Vietnam</option>		
                            <?php 
                            }
                            ?>
		         </select></td>
            </tr>
            <tr>
                <td>Zipcode</td>
                <td>:</td>
                <td><input type="text" name="zipcode" value="<?php echo $result['zipcode'] ?>"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><input type="text" name="email" value="<?php echo $result['email'] ?>"></td>
            </tr>
            <tr>
                <td>Address</td>
                <td>:</td>
                <td><input type="text" name="address" value="<?php echo $result['address'] ?>"></td>
            </tr>
            <tr>
                <td colspan="3"><input type="submit" name="save" value="Save"></td>
                
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