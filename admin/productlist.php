<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Catagory.php';
    include '../classes/Brand.php';
    include '../classes/Product.php';
?>
<?php
    $product=new Product();
    $fm=new Format();
?>
<?php
    $cat=new Catagory();
?>
<?php
	if(isset($_GET['delid']) && $_GET['delid']!=NULL){
		$delid=preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delid']);//filtering
		 $delProduct=$product->delProductbyId($delid);	 
	}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block">  
        <?php
        	if(isset($delProduct)){
        		echo $delProduct;
        	}
        ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Price</th>
					<th>Image</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i=0;
					$products=$product->productList();
					if($products){
                        while($result=$products->fetch_assoc()){
                        	$i++;     
				?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $result['productName'];?></td>
					<td><?php echo $result['catName'];?></td>
					<td><?php echo $result['brandName'];?></td>
					<td><?php echo$fm->textShorten($result['body'], 40);?></td>
					<td>$<?php echo $result['price'];?></td>
					<td ><img style="height: 45px; width: 40px; padding-left:15px;" src="<?php echo $result['image'];?>"/></td>
					<td>
						<?php  
						 if($result['type']==0){
						 	echo "Featured";
						 }else{
						 	echo "General";
						 }
						 ?>
							
					</td>
					<td>
						<a href="editproduct.php?editid=<?php echo $result['productID'];?>">Edit</a> || 
						<a onclick="return confirm('Are you sure?')" href="?delid=<?php echo $result['productID'];?>">Delete</a>
					</td>
				</tr>
			<?php } }?>
				 
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
