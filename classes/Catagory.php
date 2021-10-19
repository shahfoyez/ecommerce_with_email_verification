 <?php
	$filepath= realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class Catagory{
		private $db;
		private $fm;
		public function __construct(){  //object in constructor can be used within the whole class
			$this->db=new Database();
			$this->fm=new Format();
		}
		public function CatInsert($catName){
			$catName =$this->fm->validation($catName);
			$catName= mysqli_real_escape_string($this->db->link, $catName);//filtering

			if(empty($catName)){
					$msg="<span class='error'>Catagory must not be empty</span>";
					return $msg;
			}else{
				$query="INSERT into tbl_catagory(catName) Values('$catName')";
				$catInsert=$this->db->insert($query);
				if($catInsert !=false){
					$msg="<span class='success'>Catagory Inserted Successfully</span>";
					return $msg;
				}else{
					$msg="<span class='error'>Catagory not Inserted</span>";
					return $msg;
				}
			}
		}

		public function catList(){
			$query="select * from tbl_catagory order by catId ASC";
			$getCat=$this->db->select($query);
			return $getCat;
		}
		public function getCatbyId($catid){
			$query="select * from tbl_catagory WHERE catId='$catid'";
			$getCat=$this->db->select($query);
			return $getCat;
		}
		public function CatUpdate($catName,$catid){
			$catName =$this->fm->validation($catName);
			$catName= mysqli_real_escape_string($this->db->link, $catName);
			$catid= mysqli_real_escape_string($this->db->link, $catid);
			if(empty($catName)){
					$msg="<span class='error'>Field must not be empty</span>";
					return $msg;
			}else{
				$query="UPDATE tbl_catagory 
				SET 
				catName='$catName'
				WHERE catId='$catid'";
				$catEdit=$this->db->update($query);
				if($catEdit){
					$msg="<span class='success'>Catagory Updated Successfully</span>";
					return $msg;
				}else{
					$msg="<span class='success'>Catagory Can not be Updated</span>";
					return $msg;
				}
			}
		}
		public function delCatbyId($delid){
			$delid= mysqli_real_escape_string($this->db->link, $delid);
			$query="Delete from tbl_catagory WHERE catId='$delid'";
			$delCat=$this->db->delete($query);
			if($delCat){
				//return "<span class='success'>Catagory deleted Successfully</span>";
				return $msg="<span class='success'>Catagory deleted Successfully</span>";
			}else{
				//return "<span class='error'>Catagory not Deleted</span>";
				return $msg="<span class='error'>Catagory not Deleted</span>";
			}
			 
		}


	}
	 
?>