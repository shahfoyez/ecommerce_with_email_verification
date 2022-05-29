<div class="header_bottom">
	<div class="header_bottom_left">
		<div class="section group">
			<?php
				$getIphone=$pd->latestFromIphone();
				if($getIphone){
					While($result=$getIphone->fetch_assoc()){ 
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						<a href="details.php?pdodID=<?php echo $result['productID']?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						<h2>Iphone</h2>
						<p><?php echo $result['productName']?></p>
						<div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>">Add to cart</a></span></div>
				</div>
			</div>	
			<?php } }?>
		
			<?php
				$getIphone=$pd->latestFromIphone();
				if($getIphone){
					While($result=$getIphone->fetch_assoc()){ 
			?>
				<div class="listview_1_of_2 images_1_of_2">
					<div class="listimg listimg_2_of_1">
						<a href="details.php?pdodID=<?php echo $result['productID']?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					</div>
					<div class="text list_2_of_1">
						<h2><?php $result['productName']?></h2>
						<p><?php echo $result['productName']?></p>
						<div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>">Add to cart</a></span></div>
				</div>
			</div>	
			<?php } }?>

			<?php
				$getSamsung=$pd->latestFromSamsung();
				if($getSamsung){
					While($result=$getSamsung->fetch_assoc()){ 
			?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					<a href="details.php?pdodID=<?php echo $result['productID']?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
				</div>
				<div class="text list_2_of_1">
					<h2>Samsung</h2>
					<p><?php echo $result['productName']?></p>
					<div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>">Add to cart</a></span></div>
				</div>
			</div>
			<?php } }?>

			<?php
				$getSamsung=$pd->latestFromSamsung();
				if($getSamsung){
					While($result=$getSamsung->fetch_assoc()){ 
			?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					<a href="details.php?pdodID=<?php echo $result['productID']?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
				</div>
				<div class="text list_2_of_1">
					<h2>Samsung</h2>
					<p><?php echo $result['productName']?></p>
					<div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>">Add to cart</a></span></div>
				</div>
			</div>
			<?php } }?>
			</div>

			<div class="section group">
			<?php
				$getAcer=$pd->latestFromAcer();
				if($getAcer){
					While($result=$getAcer->fetch_assoc()){ 
			?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
						<a href="details.php?pdodID=<?php echo $result['productID']?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
				</div>
				<div class="text list_2_of_1">
						<h2>Acer</h2>
						<p><?php echo $result['productName']?></p>
						<div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>">Add to cart</a></span></div>
				</div>
			</div>	
		<?php } }?>



	   <?php
		$getCanon=$pd->latestFromCanon();
		if($getCanon){
			While($result=$getCanon->fetch_assoc()){ 
		?>
			<div class="listview_1_of_2 images_1_of_2">
				<div class="listimg listimg_2_of_1">
					  <a href="details.php?pdodID=<?php echo $result['productID']?>"> <img src="admin/<?php echo $result['image'];?>" alt="" /></a>
				</div>
				<div class="text list_2_of_1">
					  <h2>Canon</h2>
					  <p><?php echo $result['productName']?></p>
					  <div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>">Add to cart</a></span></div>
				</div>
			</div>
		<?php } }?>
		</div>
		<div class="clear"></div>
	</div>
	
		 <div class="header_bottom_right_images">
	   <!-- FlexSlider -->
		<section class="slider">
			  <div class="flexslider">
				<ul class="slides">
					<li><img src="images/1.jpg" alt=""/></li>
					<li><img src="images/2.jpg" alt=""/></li>
					<li><img src="images/3.jpg" alt=""/></li>
					<li><img src="images/01.jpg" alt=""/></li>
					<li><img src="images/02.jpg" alt=""/></li>
					<li><img src="images/03.jpg" alt=""/></li>
					<li><img src="images/04.jpg" alt=""/></li>
			    </ul>
			    </ul>
			  </div>
      </section>
<!-- FlexSlider -->
    </div>
  <div class="clear"></div>
</div>