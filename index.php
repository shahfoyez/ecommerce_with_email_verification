<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    			<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="card-section group">
	      	<?php
	      		$getFP=$pd->getFeaturedProduct();
	      		if($getFP){
	      			while($result=$getFP->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?pdodID=<?php echo $result['productID']?>"><img src="admin/<?php echo $result['image']?>" alt="" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['body'], 80)?></p>
					 <p><span class="price">$<?php echo $result['price']?></span></p>  
				     <div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>" class="details">Details</a></span></div>
				</div>
			<?php } } ?>
		</div>

		<div class="content_bottom">
			<div class="heading">
			<h3>New Products</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="card-section group">
				<?php
					$getNP=$pd->getNewProduct();
					if($getNP){
						while($result=$getNP->fetch_assoc()){
				?>
				<div class="grid_1_of_4 images_1_of_4">
					<a href="details.php?pdodID=<?php echo $result['productID']?>"><img src="admin/<?php echo $result['image']?>" alt="" /></a>
					<h2><?php echo $result['productName']?></h2>
					<p><?php echo $fm->textShorten($result['body'], 80)?></p>
					<p><span class="price">৳<?php echo $result['price']?></span></p>  
					<div class="button">
						<span>
							<a href="details.php?pdodID=<?php echo $result['productID']?>" class="details">
								Details
							</a>
						</span>
					</div>
				</div>
			<?php }} ?>
		</div>
		<style>
			.brand{
				margin: 26px;
			}
		</style>
		<div class="content_bottom">
			<div class="text-center">
				<h3 style="color: #ae4cff;" >TOP BRANDS</h3>
			</div>
			<div class="clear"></div>
		</div>
		<div class="container mt-4">
			<div class="owl-carousel mb-5 owl-simple">
				<a href="#" class="brand">
					<img src="images/brands/1.png" alt="Brand Name" height="34" width="101">
				</a>

				<a href="#" class="brand">
					<img src="images/brands/2.png" alt="Brand Name" height="34" width="101">
				</a>

				<a href="#" class="brand">
					<img src="images/brands/3.png" alt="Brand Name" height="34" width="101">
				</a>

				<a href="#" class="brand">
					<img src="images/brands/4.png" alt="Brand Name" height="34" width="101">
				</a>

				<a href="#" class="brand">
					<img src="images/brands/5.png" alt="Brand Name" height="34" width="101">
				</a>

				<a href="#" class="brand">
					<img src="images/brands/6.png" alt="Brand Name" height="34" width="101">
				</a>

				<a href="#" class="brand">
					<img src="images/brands/7.png" alt="Brand Name" height="34" width="101">
				</a>
			</div><!-- End .owl-carousel -->
		</div><!-- End .container -->
    </div>
</div>
 <?php 
 	include 'inc/footer.php';
 ?>
 