<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
 
<?php
    $brand=new brand();
?>
<?php
	if(isset($_GET['brandId']) && $_GET['brandId']!=NULL){
		$delid=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['brandId']);//filtering
		 $delbrand=$brand->delBrandbyId($delid);	 
	}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Category List</h2>
                <?php
                	if(isset($delbrand)){
                		echo $delbrand;
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
							$getbrands=$brand->brandList();
							if($getbrands){
								while($result=$getbrands->fetch_assoc()){	
									$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i;?></td>
							<td><?php echo $result['brandName'];?></td>
							<td>
								<a href="brandedit.php?brandid=<?php echo $result['brandID'];?>">Edit</a> || 
								<a onclick="return confirm('Are you sure to confirm?')" href="?brandId=<?php echo $result['brandID'];?>">Delete</a>
							</td>
						</tr>
					<?php } }
					else{
						echo "<span class='error'>Brands Not Found<span>";
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

