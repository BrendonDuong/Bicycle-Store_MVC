<?php
     include 'inc/header.php';
	//  include 'inc/slider.php';
?>
<?php
$customerId = Session::get('customer_customerId');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['feedback_submit'])) {
	// The request is using the POST method
	$feedback_insert = $feedback->insert_feedback($customerId);
}
?>
<style>
    .button_details input[type=submit]{
	float: left;
	margin: 5px;
}
    .clear{
		clear: both;
	}
</style> 
 <div class="main">
    <div class="content">
    	<div class="support">
  			<div class="support_desc">
  				<!-- <h3>Live Support</h3>
  				<p><span>24 hours | 7 days a week | 365 days a year &nbsp;&nbsp; Live Technical Support</span></p>
  				<p> It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p> -->
  			
			</div>
  				<img src="web/images/contact.png" alt="" />
  			<div class="clear"></div>
  		</div>
		<div class="feedback">
		<div class="row">
		   <div class="col-md-8"> 
				  	<h2>Contact Us</h2>
					  <?php
				if(isset($feedback_insert)){
					echo $feedback_insert;
				}
				?>
					  <form action="" method="POST">
		              <!-- <p><input type="hidden" value="<?php echo $id ?>" name="productId_feedback"></p>	 -->
		              <p><input type="text" placeholder="Enter Name..." class="form-control" name="customerName"></p>
					  <p><input type="text" placeholder="Enter Email..." class="form-control" name="email"></p>
					  <p><input type="text" placeholder="Enter Phone..." class="form-control" name="phone"></p>
		              <p><textarea rows="5" style="resize: none;" placeholder="Feedback..." class="form-control" name="content" ></textarea></p>
		              <p><input type="submit" name="feedback_submit" class="btn btn-success" value="Submit feedback"></p>
		            </div>
		          </div>
		         </textarea>
		        </div>
				<!-- <div class="col span_1_of_3">
      			<div class="company_address">
				     	<h2>Company Information :</h2>
						    	<p>500 Lorem Ipsum Dolor Sit,</p>
						   		<p>22-56-2-9 Sit Amet, Lorem,</p>
						   		<p>USA</p>
				   		<p>Phone:(00) 222 666 444</p>
				   		<p>Fax: (000) 000 00 00 0</p>
				 	 	<p>Email: <span>info@mycompany.com</span></p>
				   		<p>Follow on: <span>Facebook</span>, <span>Twitter</span></p>
				   </div>
				 </div> -->
			  </div>    	
    </div>
 </div>
 
 <?php
	 include 'inc/footer.php';
	 
?>