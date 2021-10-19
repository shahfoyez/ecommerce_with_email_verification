 <?php
	$filepath= realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class Cart{
		private $db;
		private $fm;
		public function __construct(){  //object in constructor can be used within the whole class
			$this->db=new Database();
			$this->fm=new Format();
		}
		public function AddToCart($qty, $prodId){
			$quantity =$this->fm->validation($qty);
			$quantity= mysqli_real_escape_string($this->db->link, $quantity);
			$productid= mysqli_real_escape_string($this->db->link, $prodId);
			$sid=session_id();
			$squery="SELECT * from tbl_product where productID='$productid'";
			$result=$this->db->select($squery)->fetch_assoc();
			$productName=$result['productName'];
			$price=$result['price'];
			$image=$result['image'];

			$checkCartProd="SELECT * from tbl_cart where productID='$productid' AND sid='$sid'";
			$checkCart=$this->db->select($checkCartProd);
			if($checkCart){
				$msg="Product Already Added!";
				return $msg;
				/*while($result=$checkCart->fetch_assoc()){
					$qty=$result['quantity']+$quantity;
					$cartID=$result['cartID'];
					$update=$this->updateQuantity($qty,$cartID);
				}*/
		    }else{
				$query="INSERT into tbl_cart(sid,productID, productName, price, quantity, image) Values('$sid','$productid','$productName','$price','$quantity','$image')";
				$cartInsert=$this->db->insert($query);
				if($cartInsert !=false){
					header("Location: cart.php");
				}else{
					header("Location: 404.php");
				}
			}
		}
		public function getCartProduct(){
			$sid=session_id();
			$query="SELECT * from tbl_cart where sid='$sid' order by sid ASC";
			$getbrands=$this->db->select($query);
			return $getbrands;

		}
		public function updateQuantity($qty,$cartID){
			$cartID= mysqli_real_escape_string($this->db->link, $cartID);
			$qty= mysqli_real_escape_string($this->db->link, $qty);
			$query="UPDATE tbl_cart
			SET 
			quantity='$qty'
			WHERE cartID='$cartID'";
			$cartCheck=$this->db->update($query);
			if($cartCheck){
				header('location: cart.php');
			}else{
				$msg="<span class='error'>Cart Can not be Updated</span>";
				return $msg;
			}
		}
		public function delCartProdByCartId($delID){
			$delID= mysqli_real_escape_string($this->db->link, $delID);
			$query="DELETE from tbl_cart WHERE cartID='$delID'";
			$delCartProd=$this->db->delete($query);
			if($delCartProd){
				echo "<script>window.location='cart.php'</script>";
			}else{
				//return "<span class='error'>Catagory not Deleted</span>";
				return $msg="<span class='error'>Cart Product not Deleted</span>";
			}
		}
		public function checkCartTable(){
			$sid=session_id();
			$query="SELECT * from tbl_cart where sid='$sid'";
			$checkCart=$this->db->select($query);
			return $checkCart;
		}
		public function delCustomerCart(){
			$sid=session_id();
			$query="DELETE from tbl_cart WHERE sid='$sid'";
			$delCartProd=$this->db->delete($query);
			return;
		}
		public function orderProduct($cusID){
			$sid=session_id();
			$query="SELECT * from tbl_cart where sid='$sid'";
			$getProduct=$this->db->select($query);
			if($getProduct){
				while($result=$getProduct->fetch_assoc()){
					$productID=$result['productID'];
					$productName=$result['productName'];
					$quantity=$result['quantity'];
					$pr=$quantity*$result['price'];
					$price=$pr+$pr*0.1; 
					$image=$result['image'];
					$query="INSERT into tbl_order(customerID,productID, productName, quantity, price,image) Values('$cusID','$productID','$productName','$quantity','$price','$image')";
					$Insert=$this->db->insert($query); 
				}
			}
		}//Order

		public function payableAmount($cusID){
			$query="SELECT price from tbl_order WHERE customerID='$cusID' && date=now()";
			$getAmount=$this->db->select($query);
			return $getAmount;
			 
		}
		public function getOrderProduct($cusID){
			$query="SELECT * from tbl_order WHERE customerID='$cusID' ORDER BY date DESC";
			$getOrder=$this->db->select($query);
			return $getOrder;
			 
		}
		public function checkOrderTable($cusID){
			$sid=session_id();
			$query="SELECT * from tbl_order where customerID='$cusID'";
			$checkOrder=$this->db->select($query);
			return $checkOrder;
		}
		public function getOrders(){
			$query="SELECT * from tbl_order ORDER BY date DESC";
			$getOrders=$this->db->select($query);
			return $getOrders; 
		}
		 
	    public function confirmOrder($ID){
			$ID= mysqli_real_escape_string($this->db->link, $ID);

			$query="UPDATE tbl_order 
					SET 
					status='1'
					WHERE orderID='$ID'";
					$confirmOrder=$this->db->update($query);
			if($confirmOrder){
				$msg="<span class='success'>Updated Successfully</span>";
				return $msg;
			}else{
				$msg="<span class='success'>Not Updated</span>";
				return $msg;
			}
		}
		public function cancelOrder($ID){
			$ID= mysqli_real_escape_string($this->db->link, $ID);
			$query="UPDATE tbl_order 
					SET 
					status='2'
					WHERE orderID='$ID'";
					$orderCancel=$this->db->update($query);
			if($orderCancel){
				$msg="<span class='success'>Order Cancelled</span>";
				return $msg;
			}else{
				$msg="<span class='success'>Can not Cancel The Order</span>";
				return $msg;
			}
		}
		public function productShifted($ID){
			$ID= mysqli_real_escape_string($this->db->link, $ID);

			$query="UPDATE tbl_order 
					SET 
					status='3'
					WHERE orderID='$ID'";
					$orderShift=$this->db->update($query);
			if($orderShift){
				$msg="<span class='success'>Updated Successfully</span>";
				return $msg;
			}else{
				$msg="<span class='success'>Not Updated</span>";
				return $msg;
			}
		}
		public function productDelivered($ID){
			$ID= mysqli_real_escape_string($this->db->link, $ID);

			$query="UPDATE tbl_order 
					SET 
					status='4'
					WHERE orderID='$ID'";
					$productDelivered=$this->db->update($query);
			if($productDelivered){
				$msg="<span class='success'>Deleted Successfully</span>";
				return $msg;
			}else{
				$msg="<span class='success'>Not Deleted</span>";
				return $msg;
			}
		}
		public function deleteOrder($ID){
			$ID= mysqli_real_escape_string($this->db->link, $ID);
			$query="DELETE from tbl_order WHERE orderID='$ID'";
					$orderDelete=$this->db->delete($query);
			if($orderDelete){
				$msg="<span class='success'>Data Deleted Successfully</span>";
				return $msg;
			}else{
				$msg="<span class='success'>Data Not Deleted</span>";
				return $msg;
			}
		}
	}
?>