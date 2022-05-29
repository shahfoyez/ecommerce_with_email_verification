<?php 
	include 'inc/header.php';
?>
<?php 
	 $login=Session::get('cuslogin');
	 if($login==false){
	 	header('Location: login.php');
	 }
?>
<?php
	if(isset($_GET['delwishProdID'])){
		//cusID is declared in header
		$productID=$_GET['delwishProdID'];
		$delwishProd=$pd->delWishlistProduct($productID, $cusID);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
		    	<h2>WishList</h2>
		    	<?php
					if(isset($delwishProd)){
						echo $delwishProd;
					}
				?>
	    	    <style>
						table.tblone tr th,table.tblone tr td {border-right: 1px solid #e4d3e66b;}
				</style>
				<table class="tblone Large shadow" >
					<tr>
						<th >SL</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
					<?php
						//cusID is declared in header
						$wishlistProd=$pd->getWishlistProduct($cusID);
						if($wishlistProd){
							$i=0;
							while($result=$wishlistProd->fetch_assoc()){
								$i++;
					?>
					<tr>
						<td ><?php echo $i;?></td>
						<td ><?php echo $result['productName'];?></td>
						<td >$<?php echo $result['price'];?></td>
						<td ><img src="<?php echo "admin/".$result['image'];?>" alt=""/></td>
						<td >
							<a class="btn btn-primary btn-sm" href="details.php?pdodID=<?php echo $result['productID']?>">Buy</a>
							<a class="btn btn-danger btn-sm" href="?delwishProdID=<?php echo $result['productID']?>">Remove</a>
						</td>
						 
					</tr>
					 
				<?php } } ?> 
			   </table>
			</div>	
        <div class="shopping">
				<div class="shopleft" style="width: 100%; text-align: center;">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			</div>
    	</div>  	
        <div class="clear"></div>
    </div>
 </div>
 <?php
 	include 'inc/footer.php';
 ?>