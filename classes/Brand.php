 <?php
	$filepath= realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class brand{
		private $db;
		private $fm;
		public function __construct(){  //object in constructor can be used within the whole class
			$this->db=new Database();
			$this->fm=new Format();
		}
		public function brandInsert($brandName){
			$brandName =$this->fm->validation($brandName);
			$brandName= mysqli_real_escape_string($this->db->link, $brandName);//filtering

			if(empty($brandName)){
				return "<span class='error'>Brand must not be empty</span>";
			}else{
					$query="INSERT into tbl_brands(brandName) Values('$brandName')";
					$catInsert=$this->db->insert($query);
					if($catInsert !=false){
						$msg="<span class='success'>Brand Inserted Successfully</span>";
						return $msg;
					}else{
						$msg="<span class='error'>Brand not Inserted</span>";
						return $msg;
					}
			}
		}
		public function brandList(){
			$query="select * from tbl_brands order by brandID ASC";
			$getbrands=$this->db->select($query);
			return $getbrands;
		}
		public function delBrandbyId($delid){
			$delid= mysqli_real_escape_string($this->db->link, $delid);
			$query="Delete from tbl_brands WHERE brandID='$delid'";
			$delBrand=$this->db->delete($query);
			if($delBrand){
				//return "<span class='success'>Catagory deleted Successfully</span>";
				return $msg="<span class='success'>Brand deleted Successfully</span>";
			}else{
				//return "<span class='error'>Catagory not Deleted</span>";
				return $msg="<span class='error'>Brand not Deleted</span>";
			}
		}
		public function getBrandbyId($brandid){
			$query="select * from tbl_brands WHERE brandID='$brandid'";
			$getbrand=$this->db->select($query);
			return $getbrand;
		}
		public function brandUpdate($brandName,$brandid){
			$brandName =$this->fm->validation($brandName);
			$brandName= mysqli_real_escape_string($this->db->link, $brandName);
			$brandid= mysqli_real_escape_string($this->db->link, $brandid);
			if(empty($brandName)){
					$msg="<span class='error'>Brand Name Field must not be empty</span>";
					return $msg;
			}else{
					$query="UPDATE tbl_brands 
					SET 
					brandName='$brandName'
					WHERE brandID='$brandid'";
					$brandEdit=$this->db->update($query);
					if($brandEdit){
						$msg="<span class='success'>Brand Name Updated Successfully</span>";
						return $msg;
					}else{
						$msg="<span class='success'>Brand Name Can not be Updated</span>";
						return $msg;
					}
			}
		}
	}
?>