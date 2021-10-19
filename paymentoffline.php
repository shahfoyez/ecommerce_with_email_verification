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
	if(isset($_GET['orderId']) && $_GET['orderId']=='order'){
		  $cusID=Session::get('cusID');
		  $insertOrder=$ct->orderProduct($cusID);
		  $delCart=$ct->delCustomerCart();
		  header('Location: success.php?orderId=order');
	} 
?>
<style>
.division{width: 50%; float: left;}
.tblone{width: 500px; margin: 0 auto; border: 2px solid #ddd;}
.tblone tr td,.tblone tr th{text-align: justify;}
.tbltwo{float:right;text-align:left;width:60%; border: 2px solid #ddd; margin-right: 14px; margin-top:12px; }
.tbltwo tr{border-bottom: 1px solid #ddd;}
.tbltwo tr td{text-align: justify; padding: 5px 10px; border-right: 1px solid #ddd;}
.ordernow{padding-bottom:30px;}
.ordernow a{width:200px; margin: 10px auto 0; text-align: center; padding: 5px; font-size:30px; display: block; background: #ff0000; border-radius: 3px; color:#fff;}
</style>
<div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="division">
    			<style>
						table.tblone tr th,table.tblone tr td {border-right: 1px solid #e4d3e66b;}
				</style>
				<table class="tblone">
					<tr>
						<th>No</th>
						<th>Product</th>
						<th>Price</th>
						<th>Quantity</th>
						<th>Total Price</th>
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
						<td>$<?php echo $result['price'];?></td>
						<td><?php echo $result['quantity'];?></td>
						<td>$
						<?php 
							$total=$result['price']*$result['quantity'];
							echo $total;
					    ?>
						</td>
					</tr>
					<?php 
						$sum=$sum+$total;
						$qty=$qty+ $result['quantity'];
					?>
				<?php } } ?> 
				</table>	 
			   	<table class='tbltwo'>
					<tr>
						<td>Sub Total</td>
						<td>$<?php echo $sum; ?></td>
					</tr>
					<tr>
						<td>VAT</td>		 
						<td>$<?php 
						$vat= ($sum/100)*10;
						echo $vat; 
						?> (10%)</td>
					</tr>
					<tr>
						<td>Grand Total</td>
						<td>$ <?php echo $sum+$vat;?> </td>
					</tr>
					<tr>
						<td>Quantity</td>
						<td><?php echo $qty;?> </td>
					</tr>
			   </table>
    	    </div>	 
    		<div class="division">
    			<?php
    			$id=Session::get('cusID');
    			$getData=$cmr->getCustomerData($id);
    			if($getData){
    				while($result=$getData->fetch_assoc()){ ?>
		 	<table class="tblone">
		 		<tr>
		 			<td colspan="3"><h2>Your Profile Details</h2></td>
		 		</tr>
		 		<tr>
		 			<td width="20%">Name</td>
		 			<td width="5%">:</td>
		 			<td><?php echo $result['name'];?></td>
		 		</tr>
		 		<tr>
		 			<td>Phone</td>
		 			<td>:</td>
		 			<td><?php echo $result['phone'];?></td>
		 		</tr>
		 		 
		 		<tr>
		 			<td>Address</td>
		 			<td>:</td>
		 			<td><?php echo $result['address'];?> </td>
		 		</tr>
		 		<tr>
		 			<td>City</td>
		 			<td>:</td>
		 			<td><?php echo $result['city'];?></td>
		 		</tr>
		 		<tr>
		 			<td>Zip-Code</td>
		 			<td>:</td>
		 			<td><?php echo $result['zip'];?></td>
		 		</tr>
		 		<tr>
		 			<td>Country</td>
		 			<td>:</td>
		 			<td><?php echo $result['country']?></td>
		 		</tr>
		 		<tr>
		 			<td></td>
		 			<td></td>
		 			<td><a href="editprofile.php">Update Shiping Information</a></td>
		 		</tr>
		 	</table>
				<?php } }?>
    		</div>
 		</div>
 	</div>
 	<div class='ordernow'>
 		<a href='?orderId=order'>Order Confirm</a>
 	</div>
</div>
<?php 
	include 'inc/footer.php';

?>