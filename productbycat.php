<?php 
    include 'inc/header.php';
?>
<?php
    if(!isset($_GET['catID']) || $_GET['catID']==NULL){
        //header("Location: catlist.php");
        echo "<script>window.location='404.php'</script>";
    }else{
        $catID= preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['catID']);
    }
?>
<div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
		<?php
			$catName=$cat->getCatbyId($catID);
			if($catName){
			while($result=$catName->fetch_assoc()){ 
		?>
    		<h3><?php echo $result['catName'];?></h3>
    	<?php }} ?>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group">
	    	<?php
	    		$getCatProd=$pd->getProdByCat($catID);
	    		if($getCatProd){
	    			while($result=$getCatProd->fetch_assoc()){ ?>
			<div class="grid_1_of_4 images_1_of_4">
				 <a href="preview-3.html"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
				 <h2><?php echo $result['productName'];?></h2>
				 <p><?php echo $fm->textShorten($result['body'], $limit = 80);?></p>
				 <p><span class="price">$<?php echo $result['price'];?></span></p>
			     <div class="button"><span><a href="details.php?pdodID=<?php echo $result['productID']?>">Details</a></span></div>
			</div>	 
		<?php }}else{ ?>
			<div class="content_top">
				<div class="heading">
				 	<h3><?php echo "No Product Available!"; ?></h3>
				 </div>
				 <div class="clear"></div>
			</div>
		<?php } ?>

		</div>
    </div>
 </div>
 
 <?php 
 	include 'inc/footer.php';

 ?>

