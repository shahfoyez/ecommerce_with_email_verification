 <?php
 	$filepath= realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Session.php');
	Session::checkLogin();
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class adminLogin{
		private $db;
		private $fm;
		public function __construct(){  //object in constructor can be used within the whole class
			$this->db=new Database();
			$this->fm=new Format();
		}
		public function AdminLogin($username, $password){

			$username =$this->fm->validation($username);
			$password =$this->fm->validation($password);
			$username= mysqli_real_escape_string($this->db->link, $username);
			$password= mysqli_real_escape_string($this->db->link, $password);

			if(empty($username) || empty($password)){
				$loginmsg="username or password must not be empty";
				return $loginmsg;
			}else{
				$password=md5($password);
				$query="select * from tbl_admin WHERE adminUser='$username' AND adminPass='$password'";
				$result=$this->db->select($query);
				if($result !=false){
					$value=$result->fetch_assoc();
					Session::set("adminLogin", true);
					Session::set("adminId", $value['adminId']);
					Session::set("adminUser", $value['adminUser']);
					Session::set("adminName", $value['adminName']);
					header('Location: dashboard.php');

				}else{
					$loginmsg="Username or Password not matched";
					return $loginmsg;
				}
			}
		}
	}
?>