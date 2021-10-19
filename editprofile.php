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
  	$cusID=Session::get('cusID');
	if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit'])){
			$editProfile=$cmr->editCustomerProfile($_POST,$cusID); 
	}
?>
 <style>
 .tblone{width: 550px; margin: 0 auto; border: 2px solid #ddd;}
 .tblone tr td{text-align: justify;}
 .tblone input[type="text"]{width: 400px; padding: 5px; font-size: 15px;}
 table.tblone input[type="submit"] {
    background: #e43030 none repeat scroll 0 0;border: 1px solid #000;border-radius: 3px;color: #fff;cursor: pointer;font-size: 20px;padding: 2px 10px;
}
 </style>
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<?php
    			$id=Session::get('cusID');
    			$getData=$cmr->getCustomerData($id);
    			if($getData){
    				while($result=$getData->fetch_assoc()){ ?>
    					<form ation="" method="post">
		 	<table class="tblone">
		 		<?php 
			 		if(isset($editProfile)){ ?>
			 			<tr><td colspan="2"><?php echo $editProfile;?></td></tr>
			 	<?php }?>
		 		<tr>
		 			<td colspan="2"><h2>Edit Profile Details</h2></td>
		 		</tr>
		 		<tr>
		 			<td width="20%">Name</td>
		 			<td><input type="text" name="name" value="<?php echo $result['name']?>"></td>
		 		</tr>
		 		<tr>
		 			<td>Phone</td>
		 			<td><input type="text" name="phone" value="<?php echo $result['phone']?>"></td>
		 		</tr>
		 		<tr>
		 			<td>Email</td>
		 			<td><input type="text" name="email" value="<?php echo $result['email']?>"></td>
		 		</tr>
		 		<tr>
		 			<td>Address</td>
		 			<td><input type="text" name="address" value="<?php echo $result['address']?>"></td>
		 		</tr>
		 		<tr>
		 			<td>City</td>
		 			<td><input type="text" name="city" value="<?php echo $result['city'];?>"></td>
		 		</tr>
		 		<tr>
		 			<td>Zip-Code</td>
		 			<td><input type="text" name="zip" value="<?php echo $result['zip'];?>"></td>
		 		</tr>
		 		<tr>
		 			<td>Country</td>
		 			<td><input type="text" name="country" value="<?php echo $result['country']?>"></td>
		 			 
		 		</tr>
		 		<tr>
		 			<td></td>
		 			<td><input type="submit" name="submit" value="Save"></td>
		 		</tr>
		 	</table>
		 </form>
		 <?php } }?>
 		</div>
 	</div>
</div>
 
 <?php 
 	include 'inc/footer.php';

 ?>

