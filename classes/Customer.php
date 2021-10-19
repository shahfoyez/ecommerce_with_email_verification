 <?php
	$filepath= realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php 
	class Customer{
		private $db;
		private $fm;
		public function __construct(){  //object in constructor can be used within the whole class
			$this->db=new Database();
			$this->fm=new Format();
		}
		public function customerRegistration($data){
			$name =$this->fm->validation($data['name']);
			$name= mysqli_real_escape_string($this->db->link, $data['name']); 
	        $city=$this->fm->validation($data['city']);
	        $city= mysqli_real_escape_string($this->db->link, $data['city']); 
	        $zip=$this->fm->validation($data['zip']);
	        $zip= mysqli_real_escape_string($this->db->link, $data['zip']); 
	        $email=$this->fm->validation($data['email']);
	        $email= mysqli_real_escape_string($this->db->link, $data['email']); 
	        $address=$this->fm->validation($data['address']);
	        $address= mysqli_real_escape_string($this->db->link, $data['address']); 
	        $country=$this->fm->validation($data['country']);
	        $country= mysqli_real_escape_string($this->db->link, $data['country']); 
	        $phone=$this->fm->validation($data['phone']);
	        $phone= mysqli_real_escape_string($this->db->link, $data['phone']); 
	        $password=$this->fm->validation($data['password']);
	        $password= mysqli_real_escape_string($this->db->link, md5($data['password'])); 
	        if($name=="" || $city=="" ||$zip=="" || $email=="" || $address=="" || $country=="" || $phone=="" || $password==""){
				$msg= "<span class='error'>Please fill all the fields!</span>";
				return $msg;
			}
			$mailquery="SELECT * from tbl_customer WHERE email='$email' LIMIT 1";
			$mailCheck=$this->db->select($mailquery);
			if($mailCheck){
				$msg= "<span class='error'>Email Address Alreay Exist!</span>";
				return $msg;
			}else{
				$query="INSERT into tbl_customer(name, address,	city, country, zip, phone, email, password) 
						values('$name', '$address','$city','$country',$zip,'$phone','$email','$password')";
				$customerReg=$this->db->insert($query);
				if($customerReg){
					return "<span class='success'>Registration Successfully.</span>";
				}
				else {
					return "<span class='error'>Can not register your Account!</span>";
				}
			}
		}
		public function customerLogin($data){
			$email=$this->fm->validation($data['email']);
			$password=$this->fm->validation($data['password']);
	        if(empty($email) || empty($password)){
				$msg= "<span class='error'>Fields must not be empty!</span>";
				return $msg;
			}
			$email= mysqli_real_escape_string($this->db->link, $data['email']);
			$password= mysqli_real_escape_string($this->db->link, md5($data['password'])); 

			$query="SELECT * from tbl_customer WHERE email='$email' && password='$password' LIMIT 1";
			$check=$this->db->select($query);
			if($check){
				$value=$check->fetch_assoc();
				Session::set("cuslogin", true);
				Session::set("cusID", $value['customerID']);
				Session::set("cusName", $value['name']);
				header('Location: cart.php');
			}else{
				$msg= "<span class='error'>Email or Password Not Matched!</span>";
				return $msg;
			}
		}
		public function getCustomerData($id){
			$query="SELECT * from tbl_customer WHERE customerID='$id'";
			$check=$this->db->select($query);
			return $check;
		}
		public function editCustomerProfile($data, $cusID){
			$name =$this->fm->validation($data['name']);
			$name= mysqli_real_escape_string($this->db->link, $data['name']); 
	        $city=$this->fm->validation($data['city']);
	        $city= mysqli_real_escape_string($this->db->link, $data['city']); 
	        $zip=$this->fm->validation($data['zip']);
	        $zip= mysqli_real_escape_string($this->db->link, $data['zip']); 
	        $email=$this->fm->validation($data['email']);
	        $email= mysqli_real_escape_string($this->db->link, $data['email']); 
	        $address=$this->fm->validation($data['address']);
	        $address= mysqli_real_escape_string($this->db->link, $data['address']); 
	        $country=$this->fm->validation($data['country']);
	        $country= mysqli_real_escape_string($this->db->link, $data['country']); 
	        $phone=$this->fm->validation($data['phone']);
	        $phone= mysqli_real_escape_string($this->db->link, $data['phone']); 
	        if($name=="" || $city=="" ||$zip=="" || $email=="" || $address=="" || $country=="" || $phone==""){
				$msg= "<span class='error'>Please fill all the fields!</span>";
				return $msg;
			}
			else{
				$query="UPDATE tbl_customer 
				SET 
				name='$name',
				address='$address',
				city='$city',
				country='$country',
				zip='$zip',
				phone='$phone',
				email='$email'
				WHERE customerID='$cusID'";
				$editProfile=$this->db->update($query);
				if($editProfile){
					$msg="<span class='success'>Profile Updated Successfully</span>";
					return $msg;
				}else{
					$msg="<span class='error'>Profile Can not be Updated</span>";
					return $msg;
				}
			}
		}
	}
?>