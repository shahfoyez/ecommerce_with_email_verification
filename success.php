 <?php 
     include 'inc/header.php';
 ?>
 <?php
    if(!isset($_GET['orderId']) || $_GET['orderId']== NULL){
        //header("Location: catlist.php");
        echo "<script>window.location='index.php'</script>";
    }
?>
   <?php 
     $login=Session::get('cuslogin');
     if($login==false){
     	header('Location: login.php');
     }
 ?>
 <style>
  .paymentsuccess{width: 500px; min-height: 200px; text-align: center; border: 1px solid #ddd; margin: 0 auto; padding: 50px;}
  .paymentsuccess h2{    border-bottom: 1px solid #ddd;margin-bottom: 20px; padding-bottom: 10px;}
   .paymentsuccess p{line-height: 25px; font-size:  18px; text-align: left;}
 </style>
 <div class="main">
    <div class="content">
    	<div class="section group">
 			<div class='paymentsuccess'>
 				<h2>Success</h2>
        <?php
            $cusID=Session::get('cusID');
            $amount=$ct->payableAmount($cusID);
            if($amount){
              $sum=0;
              while($result=$amount->fetch_assoc()){
                $price=$result['price'];
                $sum=$sum+$price;
                Session::set("sum",$sum);
              }
            }
        ?>
        <p style="color: red;">Total Payable Amount(Including Vat): $
          <?php 
            //$vat= Session::get('sum')*0.1;
            $grandTotal=Session::get('sum');
            echo $grandTotal;
          ?>
              
        </p>
        <p>Thanks for Purchase. Receive your order Successfully. We will contact you ASAP with delivery details. Here is your order details...<a href='orderdetails.php'>Visit Here...</a></p>
 			</div>
 		</div>
 	</div>
</div>
 
 <?php 
 	include 'inc/footer.php';

 ?>

