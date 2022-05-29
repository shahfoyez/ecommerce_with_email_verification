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
    if(isset($_GET['cancelID'])){
        $cancelID=$_GET['cancelID'];
        $orderCancel=$ct->cancelOrder($cancelID);
    }
 ?>
 <?php 
    if(isset($_GET['deleteID'])){
        $deleteID=$_GET['deleteID'];
        $orderdelete=$ct->deleteOrder($deleteID);
    }
 ?>
 <div class="main">
    <div class="content">
    	<div class="section group">
			<div class='order'>
				<h2>Your Order Details</h2>
                <?php
                    if(isset($orderCancel)){
                        echo $orderCancel;
                    }
                    if(isset($orderdelete)){
                        echo $orderdelete;
                    }
                ?>
                <style>
                        table.tblone tr th,table.tblone tr td {border-right: 1px solid #e4d3e66b; text-align: justify;}
                </style>
                <table class="tblone Large shadow">
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        $sum=0;
                        $cusID=session::get('cusID');
                        $orderProd=$ct->getOrderProduct($cusID);
                        if($orderProd){
                            $i=0;
                            while($result=$orderProd->fetch_assoc()){
                                $i++;
                    ?>
                    <tr>
                        <td ><?php echo $i;?></td>
                        <td ><?php echo $result['productName'];?></td>
                        <td ><img src="<?php echo "admin/".$result['image'];?>" alt=""/></td>
                        <td ><?php echo $result['quantity'];?></td>
                        <td >$<?php echo $result['price'] ?></td>
                        <td ><?php echo $fm->formatDate($result['date']);?></td>
                        <td >
                        <?php 
                            if($result['status']=='0'){
                                echo "<span style='color:  #a21d1d; font-weight: bold;'>Pending</span>";
                            }elseif($result['status']=='1'){
                                 echo "<span style='color: green;font-weight: bold;'>Order Confirmed</span>";
                            }elseif($result['status']=='2'){
                                 echo "<span style='color: red;font-weight: bold;'>Order Cancelled</span>";
                            }elseif($result['status']=='3'){
                                 echo "<span style='color: green;font-weight: bold;'>Order Shiped</span>";
                            }elseif($result['status']=='4'){
                                 echo "<span style='color: green;font-weight: bold;'>Order Delivered</span>";
                            }
                        ?>
                        </td>
                        <style>
                            .buysubmit{
                                background: red repeat scroll 0 0;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 5px; color: #fff;font-size: 1.1em; padding: 2px 7px; cursor: pointer; outline: none;width: 100px;
                            }
                        </style>
                        <?php
                            if($result['status']=='0' || $result['status']=='1'){ ?>
                                <td><a class="btn btn-warning btn-sm" onclick="return confirm('Are You Sure To Cancel!');" href="?cancelID=<?php echo $result['orderID']?>"> Cancel</a></td>
                           <?php }elseif($result['status']=='2'||  $result['status']=='4'){ ?>
                                <td><a class="btn btn-danger btn-sm" onclick="return confirm('Are You Sure To Cancel!');" href="?deleteID=<?php echo $result['orderID']?>"> Delete</a></td>
                            <?php }else{?>
                                <td style='font-weight: bold;'>N/A</td>
                            <?php }?>
                    </tr>
                <?php } } ?> 
                </table>
			</div>	
 		</div>
 	</div>
	</div>
 
 <?php 
 	include 'inc/footer.php';

 ?>

