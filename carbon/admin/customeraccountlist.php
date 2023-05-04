<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/customer.php';?>
<?php
 $cs = new customer();
if(isset($_GET['type_customer']) && isset($_GET['type'])){
	$id = $_GET['type_customer'];
	$type = $_GET['type'];
	$update_type_customer = $cs->update_type_customer($id,$type); 
}
if(isset($_GET['del_customer'])){
	$id = $_GET['del_customer'];
	$del_customer = $cs->del_customer($id); 
}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Account List</h2>
        <div class="block">  
		<?php 
			if(isset($del_customer)){
				echo $del_customer;
			}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
                    <th>Date Create</th>
					<th>Customer Name</th>
					<th>Email</th>
					<th>Type</th>
                    <th>View Profile</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
                        $fm = new Format();
			            $cs = new customer();
                        // $customerId = Session::get('customer_customerId');
						$get_customer = $cs->show_customers_list();
						if($get_customer){
							$i = 0;
							while($result_customer = $get_customer->fetch_assoc()){
								$i++;

						?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
                    <td><?php echo $fm->formatDate($result_customer['date_create']) ?></td>
					<td><?php echo $result_customer['customerName'] ?></td>
                    <td><?php echo $result_customer['email'] ?></td>
					<td>
						<?php
						if($result_customer['type']==1){
						?>
						<a href="?type_customer=<?php echo $result_customer['customerId'] ?>&type=0">Off</a> 
						<?php
						}else{
						?>
						<a href="?type_customer=<?php echo $result_customer['customerId'] ?>&type=1">On</a> 
						<?php
						}
						?>
					</td>	
                    <td><a href="customer.php?customerid=<?php echo $result_customer['customerId'] ?>">View Customer</a></td>		
				<td>
					<!-- <a href="slideredit.php?sliderid=<?php echo $result_customer['customerId'] ?>">Edit</a> || -->
					<a onclick="return confirm('Are you sure you want to remove this Customer Account from the Customer Account List Page?');" href="?del_customer=<?php echo $result_customer['customerId'] ?>">Delete</a> 
				</td>
					</tr>	
					<?php
						}
					}
						?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
