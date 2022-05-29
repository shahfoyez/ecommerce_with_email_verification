 <?php 
     include 'inc/header.php';
 ?>
 <?php 
     $login=Session::get('cuslogin');
     if($login==true){
     	header('Location: order.php');
     }
 ?>
 <?php
     if($_SERVER['REQUEST_METHOD']=='POST'){
    	if(isset($_POST['login'])){
       		$customerLog=$cmr->customerLogin($_POST);
  	    }
     }
 ?>
 <div class="main">
    <div class="content">
    	<div class="login_panel Larger shadow">
			<?php
				if(isset($customerLog)){?>
				<div class="alert alert-warning" role="alert">
					<?php echo $customerLog; ?>
				</div>
				<?php }
			?>
        	<h3 class="text-success">Existing Customers</h3>
        	<p>Sign in with the form below.</p>
        	<form action="" method="post" id="member">
				<div class="form-group">
					<input name="email" class="form-control" type="text" placeholder="E-Mail"/>								 
				</div>
				<div class="form-group">
					<input name="password"  class="form-control" type="password" placeholder="Passworde"/>							 
				</div>
                <div><button class="btn btn-success" name="login">Sign In</button></div>
            </form> 
			<div><a href="admin/login.php"class="btn btn-success btn-sm" name="register">Admin Login</a></div>   
        </div>
			<?php
				if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){
						$customerReg=$cmr->customerRegistration($_POST);
				}
			?>
			<div class="register_account Larger shadow">
			<?php
				if(isset($customerReg)){?>
				<div class="alert alert-warning" role="alert">
					<?php echo $customerReg; ?>
				</div>
				<?php }
			?>
    		<h3 class="text-success">Register New Account</h3>
    		<form action="" method="post">
	   			 <table><tbody>
					<tr>
						<td>
							<div class="form-group">
								<input type="text" class="form-control" name='name' placeholder="Name"/>									 
							</div>
							
							<div class="form-group">
							   <input type="text" class="form-control" name='city' placeholder="City"/>
							</div>
							
							<div class="form-group">
								<input type="text" class="form-control" name='zip' placeholder="Zip-Code"/>
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name='email' placeholder="E-Mail"/>
							</div>
		    			</td>
		    			<td>
							<div class="form-group">
								<input type="text" class="form-control" name='address' placeholder="Address"/>									 
							</div>
							<div class="form-group">
								<input type="text" class="form-control" name='country' placeholder="Country"/>
							</div>
				            <div class="form-group">
				            	<input type="text" class="form-control" name='phone' placeholder="Phone"/>
				            </div>
						    <div class="form-group">
								<input type="text" class="form-control" name='password' placeholder="Passworde"/>
						    </div>
		    	        </td>
	   				</tr> 
	    		</tbody>
			</table> 
			 	<div><button class="btn btn-success" name="register">Create Account</button></div>
			    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>
 <?php 
 	include 'inc/footer.php';
 ?>

