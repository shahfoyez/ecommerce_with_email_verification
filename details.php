 <?php 
     include 'inc/header.php';
 ?>
 <?php
    if(isset($_GET['pdodID'])){
        $pdodID= preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['pdodID']);
    }
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
        $quantity=$_POST["quantity"];
        $addCart=$ct->AddToCart($quantity,$pdodID);
    }
?>
<?php
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['compare'])){
			$cmpProductID=$_POST['productID'];
			$compareProdInsert=$pd->insertCompareProduct($cmpProductID,$cusID);
	}
?>
<?php
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['wishList'])){
			$wishProdInsert=$pd->insertWishProduct($pdodID,$cusID);//$peodID is already taken.
	}
?>
<style>
	.mybutton{
		width: 130px; float: left;
	}
</style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
				$getProd=$pd->getSingleProduct($pdodID);
				if($getProd){
					while($result=$getProd->fetch_assoc()){
			?>
			<div class="cont-desc span_1_of_2">	
				<div class="grid images_3_of_2">
					<a href="details.php?prodID=<?php echo $result['productID']?>"><img src="admin/<?php echo $result['image']?>" alt="" /></a>
				</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']?></h2>
					<div class="price">
						<p>Price: <span>$<?php echo $result['price']?></span></p>
						<p>Category: <span><?php echo $result['catName']?></span></p>
						<p>Brand:<span><?php echo $result['brandName']?></span></p>
					</div>
					<div class="add-cart">
						<form action="" method="post">
							<input type="number" class="buyfield" name="quantity" value="1"/>
							<input type="submit" class="buysubmit"  name="submit" value="Buy Now"/>
						</form>				
					</div>
					<?php
						if(isset($addCart)){ ?>
						<br/><span class="buysubmit" style='color: red; font-size: 18px; font-weight: bold;'>
							<?php echo $addCart; ?></span>
					<?php } ?>
					<!--<?php if(isset($addCart)){ echo $addCart; }?>-->
					<?php
						if(isset($compareProdInsert)){
							echo $compareProdInsert;
						}
					?>
					<?php
						if(isset($wishProdInsert)){
							echo $wishProdInsert;
						}
					?>
				<?php 
		        $login=Session::get('cuslogin');
		        if($login==true){ ?>
					<div class="add-cart">
						<div class="mybutton">
				 
							<form action="" method="post">
							  <input type="hidden" class="buysubmit" name="productID" value="<?php echo $result['productID']?>"/>
							  <input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>	
							</form>
					    </div>
					    <div class="mybutton">
							<form action="" method="post">
							  <input type="submit" class="buysubmit" name="wishList" value="WishList"/>	
							</form>	
						</div>	
					</div>
				<?php }?>
				</div>
				<div class="product-desc">
					<h2>Product Details</h2>
					<p><?php echo $result['body']?></p>		
		        </div>
		<?php } }else{
			echo "<script>window.location='404.php'</script>";
		}?>
			</div>
			<div class="rightsidebar span_3_of_1">
				<h2>CATEGORIES</h2>
				<ul>
				<?php
					$getCatagory=$cat->catList();//$getCatagory=getAllCat();
					if($getCatagory){
						while($result=$getCatagory->fetch_assoc()){ ?>
			
			      <li><a href="productbycat.php?catID=<?php echo $result['catId'];?>"><?php echo $result['catName'];?></a></li>
			      <?php } }?>
				</ul>
			</div>
		 
 		</div>
 	</div>
</div>
 
 <?php 
 	include 'inc/footer.php';

 ?>

