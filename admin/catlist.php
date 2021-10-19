<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Catagory.php';?>
 
<?php
    $cat=new Catagory();
?>
<?php
	if(isset($_GET['catId']) && $_GET['catId']!=NULL){
		$delid=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['catId']);//filtering
		 $delCat=$cat->delCatbyId($delid);	 
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php
                	if(isset($delCat)){
                		echo $delCat;
                	}
                ?>
                <div class="block">     
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=0;
							$getcat=$cat->catList();
							if($getcat){
								while($result=$getcat->fetch_assoc()){	
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['catName'];?></td>
							<td>
								<a href="catedit.php?catid=<?php echo $result['catId'];?>">Edit</a> || 
								<a onclick="return confirm('Are you sure to confirm?')" href="?catId=<?php echo $result['catId'];?>">Delete</a>
							</td>
						</tr>
					<?php } }
					else{
						echo "<span class='error'>Catagory Not Found<span>";
					}?>
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

