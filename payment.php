 <?php 
     include 'inc/header.php';
 ?>
   <?php 
     $login=Session::get('cuslogin');
     if($login==false){
     	header('Location: login.php');
     }
 ?>
 <style>
  .payment{width: 650px;min-height: 300px; text-align: center; border: 1px solid #ddd; margin: 0 auto; padding: 50px;margin-top: 60px;}
  .payment h2{    border-bottom: 1px solid #ddd;margin-bottom: 60px; padding-bottom: 10px;}
  .payment a{border-radius: 5px;border-radius: 5px;background: #42d562 none repeat scroll 0 0;color: #fff;font-size: 24px;padding: 5px 30px;text-decoration: none;}
  .back a{width: 650px;
    margin: 10px auto 0;
    padding: 2px 0px;
    text-align: center;
    display: block;
    background: #a641f9;
    border: 1px solid #fff;
    color: #fff;
    border-radius: 5px;
    font-size: 23px;
    text-decoration: none;
}
 </style>
 <div class="main">
    <div class="content">
    	<div class="section group">
 			<div class='payment'>
 				<h2>Chose Payment Option</h2>
 				<a href="paymentoffline.php"><i class="fas fa-money-bill-wave"></i> Cash On Delivery</a>
 				<a href="paymentonline.php"><i class="fab fa-bitcoin"></i> Digital Payment</a>
 			</div>
    		<div class='back'>
    			<a href="cart.php"><i class="fas fa-backspace"></i> Go Back</a>
    		</div>
 		</div>
 	</div>
</div>
 
 <?php 
 	include 'inc/footer.php';

 ?>

