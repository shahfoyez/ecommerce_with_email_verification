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
	.profile-table{width: 800px; margin: 0 auto; border: 2px solid #ddd;}
	.profile-table tr td{text-align: justify; padding-left: 100px}
	.profile-table input[type="text"]{width: 590px; padding: 10px; font-size: 15px;}
	table.profile-table input[type="submit"] {
		background: #e43030 none repeat scroll 0 0;border: 1px solid #000;border-radius: 3px;color: #fff;cursor: pointer;font-size: 20px;padding: 2px 10px;
	}
	table tr{
		border-color: white;
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
		 	<table class="table profile-table">
		 		<?php 
			 		if(isset($editProfile)){ ?>
			 			<tr><td colspan="2"><?php echo $editProfile;?></td></tr>
			 	<?php }?>
		 		<tr style="border-color: inherit";>
		 			<td colspan="2"><h2>Edit Profile Details</h2></td>
		 		</tr>
		 		<tr style="border-color: white">
		 			<td width="20%">Name</td>
		 			<td>
						<div class="form-group">
							<input type="text" class="form-control" name="name" value="<?php echo $result['name']?>">									 
						</div>
					</td>
		 		</tr>
		 		<tr>
		 			<td>Phone</td>
		 			<td>
						<div class="form-group">
							<input type="text" name="phone" class="form-control" value="<?php echo $result['phone']?>">		
						</div>  
					</td>
		 		</tr>
		 		<tr>
		 			<td>Email</td>
		 			<td>
						<div class="form-group">
						 	<input type="text" name="email"  class="form-control" value="<?php echo $result['email']?>">	
						</div>  
					</td>
		 		</tr>
		 		<tr>
		 			<td>Address</td>
		 			<td>
					 	<div class="form-group">
						 <input type="text" name="address" class="form-control" value="<?php echo $result['address']?>"></td>	
						</div>  
		 		</tr>
		 		<tr>
		 			<td>City</td>
		 			<td>
						<div class="form-group">
							<input type="text" name="city" class="form-control" value="<?php echo $result['city'];?>">	
						</div>  
					</td>
		 		</tr>
		 		<tr>
		 			<td>Zip-Code</td>
		 			<td>
					 	<div class="form-group">
							<input type="text" class="form-control" name="zip" value="<?php echo $result['zip'];?>">	
						</div>  
					</td>
		 		</tr>
		 		<tr>
		 			<td>Country</td>
		 			<td>
					 	<div class="form-group">
							<input type="text" class="form-control" name="country" value="<?php echo $result['country']?>">	
						</div> 
					</td>
		 			 
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

