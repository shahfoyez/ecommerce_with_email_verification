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
	      <div class="section group">
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
			<div class="section group">
			<?php
	      		$getNP=$pd->getNewProduct();
	      		if($getNP){
	      			while($result=$getNP->fetch_assoc()){
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?pdodID=<?php echo $result['productID']?>"><img src="admin/<?php echo $result['image']?>" alt="" /></a>
					 <h2><?php echo $result['productName']?></h2>
					 <p><?php echo $fm->textShorten($result['body'], 80)?></p>
					 <p><span class="price">$<?php echo $result['price']?></span></p>  
				     <div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>" class="details">Details</a></span></div>
				</div>
			<?php }} ?>
			</div>
    </div>
 </div>
 <?php 
 	include 'inc/footer.php';
 ?>
 