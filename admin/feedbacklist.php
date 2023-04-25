<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/feedback.php';?>
<?php 
    $feedback = new feedback();
	if(isset($_GET['delid'])){
		$id = $_GET['delid'];
		$delfeedback = $feedback->del_feedback($id);
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Feedback List</h2>
                <div class="block">    

				 <?php 
                if(isset($delfeedback)){
                   echo $delfeedback;

                }
                ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
                            <th>Date Update</th>
							<th>Customer Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Content</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
                    $feedback = new feedback();
                    $fm = new Format();
					$show_feedback = $feedback->show_feedback();
					if($show_feedback){
						$i = 0;
						while($result = $show_feedback->fetch_assoc()){
							$i++;
					    
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $fm->formatDate($result['date_update']) ?></td>
                            <td><?php echo $result['customerName'] ?></td>
                            <td><?php echo $result['email'] ?></td>
                            <td><?php echo $result['phone'] ?></td>
                            <td><?php echo $result['content'] ?></td>
							<td>
								<!-- <a href="brandedit.php?brandid=<?php echo $result['brandId'] ?>">Edit</a> ||  -->
							<a onclick ="return confirm('Are you sure you want to remove this Feedback from the Feedback List Page?')" href="?delid=<?php echo $result['feedbackId'] ?>">Delete</a></td>
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

