<?php 
	include 'inc/header.php';
?>
<?php
 	if(isset($_GET['delprod'])){
 		$delID= preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['delprod']);
 		$delCartProduct=$ct->delCartProdByCartId($delID);
 	}   
?>
<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		$sid=session_id();
        $quantity=$_POST["quantity"];
        $cartID=$_POST["cartID"];
        if($quantity<=0){
        	$delCartProduct=$ct->delCartProdByCartId($cartID);
        }else{
        	 $updateCart=$ct->updateQuantity($quantity,$cartID);
        }
    }
?>
<?php
	if(!isset($_GET['refid'])){
		echo "<meta http-equiv='refresh' content='0;URL=?refid=foyez'/>";
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
		    	<h2>Your Cart</h2>
		    	<?php
					if(isset($cartUpdate)){
						echo $cartUpdate;
					}if(isset($delCartProduct)){
						echo $delCartProduct;
					}
				?>
	    	    <style>
						table.tblone tr th,table.tblone tr td {border-right: 1px solid #e4d3e66b;}
				</style>
				<table class="tblone">
					<tr>
						<th width="5%">SL</th>
						<th width="25%">Product Name</th>
						<th width="10%">Image</th>
						<th width="15">Price</th>
						<th width="15%">Quantity</th>
						<th width="20%">Total Price</th>
						<th width="10%">Action</th>
					</tr>
					<?php
						$sum=0;
						$cartProd=$ct->getCartProduct();
						if($cartProd){
							$i=0;
							$sum=0;
							$qty=0;
							while($result=$cartProd->fetch_assoc()){
								$i++;
					?>
					<tr>
						<td ><?php echo $i;?></td>
						<td ><?php echo $result['productName'];?></td>
						<td ><img src="<?php echo "admin/".$result['image'];?>" alt=""/></td>
						<td>$<?php echo $result['price'];?></td>
						<td>
				<form action="" method="post">
					<input type="hidden" name="cartID" value="<?php echo $result['cartID'];?>"/>
					<input type="number" name="quantity" value="<?php echo $result['quantity'];?>"/>
					<input type="submit" name="submit" value="Update"/>
				</form>
						</td>
						<td>$<?php 
							$total=$result['price']*$result['quantity'];
							echo $total;
							?>
							</td>
						<td><a onclick="return confirm('Are You Sure To DElete!');" href="?delprod=<?php
						 echo $result['cartID']; ?>">X</a></td>
					</tr>
					<?php 
						$sum=$sum+$total;
						$qty=$qty+ $result['quantity'];
						Session::set("sum", $sum);
						Session::set("items",$qty);

					?>
				<?php } } ?> 
				</table>
				<?php
					$getdata=$ct->checkCartTable();
						if($getdata){ ?>
			   	<table style="float:right;text-align:left;" width="40%">
					<tr>
						<th>Sub Total : </th>
						<td>$<?php echo $sum; ?></td>
					</tr>
					<tr>
						<th>VAT : </th>
						<td>$<?php 
						$vat= ($sum/100)*10;
						echo $vat; 
						?> (10%)</td>
					</tr>
					<tr>
						<th>Grand Total :</th>
						<td>$ <?php echo $sum+$vat;?> </td>
					</tr>
			   </table>
			</div>
			<div class="shopping">
				<div class="shopleft">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
				<div class="shopright">
					<a href="payment.php"> <img src="images/check.png" alt="" /></a>
				</div>
			</div>
			<?php } else{
				header('location: index.php'); 
				//echo "Cart Is Empty!";?>
				<div class="shopright">
					<a href="index.php"> <img src="images/shop.png" alt="" /></a>
				</div>
			<?php }?>
    	</div>  	
        <div class="clear"></div>
    </div>
 </div>
 <?php 
    //$vat= Session::get('sum')*0.1;
    $grandTotal=Session::get('sum');
    echo $grandTotal;
 ?>
 <?php 
 	include 'inc/footer.php';
 ?>