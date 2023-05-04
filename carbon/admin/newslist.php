<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/post.php';?>
<?php include '../classes/news.php';?>
<!-- <?php include_once '../helpers/format.php';?> -->
<?php 
// $fm = new Format();
$news = new news();
if(isset($_GET['newsid'])){
	$id = $_GET['newsid'];
	$delnews = $news->del_news($id); 
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>News List</h2>
        <div class="block">  
			<?php 
			if(isset($delnews)){
				echo $delnews;
			}
			?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>News Title</th>
					<th>Description</th>
                    <th>Image</th>
                    <th>Post News Category</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				
				$newslist = $news->show_news();
				if($newslist){
					$i = 0;
					while($result = $newslist->fetch_assoc()){
						$i++;
					
				?>
				<tr class="odd gradeX">
					<td><?php echo $i ?></td>
					<td><?php echo $result['news_title'] ?></td>
					<td><?php echo $result['description'] ?></td>
                    <td><img src="uploads/<?php echo $result['image'] ?>" width="80"></td>
					<td><?php echo $result['title'] ?></td>
					<td><?php 
					if($result['status']==0){
						echo 'Display';
					} else{
						echo 'Hide';
					}
					?></td>
					
					<td><a href="newsedit.php?newsid=<?php echo $result['newsId'] ?>">Edit</a> || 
					<a onclick ="return confirm('Are you sure you want to remove this News from the News List Page?')" href="?newsid=<?php echo $result['newsId'] ?>">Delete</a></td>
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
