
<?php
	$filepath= realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/Database.php');
	include_once ($filepath.'/../helpers/Format.php');
?>
<?php
	class Product{
		private $db;
		private $fm;
		public function __construct(){  //object in constructor can be used within the whole class
			$this->db=new Database();
			$this->fm=new Format();
		}
		public function productInsert($data, $file){
			$productName =$this->fm->validation($data['productName']);
			$productName= mysqli_real_escape_string($this->db->link, $data['productName']);
	        $catId=$this->fm->validation($data['catId']);
	        $catId= mysqli_real_escape_string($this->db->link, $data['catId']); 
	        $brandID=$this->fm->validation($data['brandID']);
	        $brandID= mysqli_real_escape_string($this->db->link, $data['brandID']); 
	        $body=$this->fm->validation($data['body']);
	        $body= mysqli_real_escape_string($this->db->link, $data['body']); 
	        $price=$this->fm->validation($data['price']);
	        $price= mysqli_real_escape_string($this->db->link, $data['price']); 
	        $type=$this->fm->validation($data['type']);
	        $type= mysqli_real_escape_string($this->db->link, $data['type']); 

	        $permitted=array("jpg","png","gif","jpeg");
			$file_name=$file['image']['name']; //foyez.JPG
			$file_size=$file['image']['size'];
			$file_tmp= $file['image']['tmp_name'];

			$div=explode(".", $file_name);
			$file_ext=strtolower(end($div)); //jpg.png
			$unique_name=substr(md5(time()), 0, 10).'.'.$file_ext;
			$upload_image="upload/".$unique_name; //uploads/unique_name
			
			if($productName=="" || $catId=="" ||$brandID=="" || $body=="" || $price=="" || $file_name=="" || $type==""){
				$msg= "<span class='error'>Please fill all the fields!</span>";
				return $msg;
			}
			elseif($file_size>1048567){
				return "<span class='error'>File's size should be less than 1 MB</span>";
			}
			elseif(in_array($file_ext, $permitted)==false){
				return "<span class='error'>Upload ".implode(", ",$permitted)." Only</span>";
			}
			else{
				move_uploaded_file($file_tmp, $upload_image);
				$query="INSERT into tbl_product(productName, catId,	brandID, body, price, image,type) 
						values('$productName', '$catId','$brandID','$body',$price,'$upload_image','$type')";
				$productInsert=$this->db->insert($query);
				if($productInsert){
					return "<span class='success'>Data Inserted Successfully.</span>";
				}
				else {
					return "<span class='error'>Data Not Inserted !</span>";
				}
			}
		}
		public function productList(){
			$query="select  p.*, c.catName,  b.brandName
			From tbl_product as p, tbl_catagory as c, tbl_brands as b
			Where p.catId=c.catId AND p.brandID=b.brandID
			order by p.productID DESC";
			/*
			$query="select tbl_product.*,tbl_catagory.catName, tbl_brands.brandName
			from tbl_product
			INNER JOIN tbl_catagory
			ON tbl_product.catId=tbl_catagory.catId
			INNER JOIN tbl_brands
			ON tbl_product.brandID=tbl_brands.brandID
			order by tbl_product.productID ASC";
			$result=$this->db->select($query);
				*/
			$result=$this->db->select($query);
			return $result;
		}
		public function productUpdate($data, $file, $id){
			$productName =$this->fm->validation($data['productName']);
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']); 
	        $catId       =$this->fm->validation($data['catId']);
	        $catId       = mysqli_real_escape_string($this->db->link, $data['catId']); 
	        $brandID     =$this->fm->validation($data['brandID']);
	        $brandID     = mysqli_real_escape_string($this->db->link, $data['brandID']); 
	        $body        =$this->fm->validation($data['body']);
	        $body        = mysqli_real_escape_string($this->db->link, $data['body']); 
	        $price       =$this->fm->validation($data['price']);
	        $price       = mysqli_real_escape_string($this->db->link, $data['price']); 
	        $type        =$this->fm->validation($data['type']);
	        $type        = mysqli_real_escape_string($this->db->link, $data['type']); 

	        $permitted=array("jpg","png","gif","jpeg");
			$file_name=$file['image']['name']; //foyez.JPG
			$file_size=$file['image']['size'];
			$file_tmp= $file['image']['tmp_name'];

			$div=explode(".", $file_name);
			$file_ext=strtolower(end($div)); //jpg
			$unique_name=substr(md5(time()), 0, 10).'.'.$file_ext;
			$upload_image="upload/".$unique_name; //uploads/unique_name
			
			if($productName=="" || $catId=="" ||$brandID=="" || $body=="" || $price=="" || $type==""){
				$msg= "<span class='error'>Please fill all the fields!</span>";
				return $msg;
				
			}else{
				if(!empty($file_name)){
					if($file_size>1048567){
						return "<span class='error'>File's size should be less than 1 MB</span>";
					}
					elseif(in_array($file_ext, $permitted)==false){
						return "<span class='error'>Upload ".implode(", ",$permitted)." Only</span>";
					}
					else{
						move_uploaded_file($file_tmp, $upload_image);
						$query="UPDATE tbl_product 
						        SET 
						        productName='$productName',
						        catId='$catId',
						        brandID='$brandID ',
						        body='$body',
						        price='$price',
						        image='$upload_image',
						        type='$type'
						        Where productID='$id'";
						$updateProduct =$this->db->insert($query);
						if($updateProduct ){
							return "<span class='success'>Data Updated Successfully.</span>";
						}
						else {
							return "<span class='error'>Data Not IUpdated !</span>";
						}
					}
				}else{
						$query="UPDATE tbl_product 
						        SET 
						        productName='$productName',
						        catId='$catId',
						        brandID='$brandID ',
						        body='$body',
						        price='$price',
						        type='$type'
						        Where productID='$id'";
						$updateProduct =$this->db->insert($query);
						if($updateProduct ){
							return "<span class='success'>Data Updated Successfully.</span>";
						}
						else {
							return "<span class='error'>Data Not IUpdated !</span>";
						}
				}
			}
		}
		public function getProductById($id){
		 	$query="select * from tbl_product WHERE productID='$id'";
			$result=$this->db->select($query);
			return $result;
			
		}
		public function delProductbyId($delid){
		 	$delid= mysqli_real_escape_string($this->db->link, $delid);
		 	$select="SELECT * from tbl_product where productID='$delid'";
		 	$getData=$this->db->select($select);
		 	if($getData){
		 		while($delImg =$getData->fetch_assoc()){
		 			$img=$delImg['image'];
		 			unlink($img);
		 		}
		 	}
			$query="Delete from tbl_product WHERE productID='$delid'";
			$delProduct=$this->db->delete($query);
			if($delProduct){
				return $msg="<span class='success'>Product deleted Successfully</span>";
			}else{
				//return "<span class='error'>Catagory not Deleted</span>";
				return $msg="<span class='error'>Product not Deleted</span>";
			}
		}
		public function getFeaturedProduct(){
			$query="select * from tbl_product WHERE type='0' order by productID ASC LIMIT 4";
			$getFP=$this->db->select($query);
			return $getFP;
		}
		public function getNewProduct(){
			$query="select * from tbl_product order by productID DESC LIMIT 4";
			$getFP=$this->db->select($query);
			return $getFP;
		}
		public function getSingleProduct($id){
			$query="select  p.*, c.catName,  b.brandName
			From tbl_product as p, tbl_catagory as c, tbl_brands as b
			Where p.catId=c.catId AND p.brandID=b.brandID AND p.productID='$id'
			order by p.productID DESC";
			$result=$this->db->select($query);
			return $result;
		}
		public function latestFromIphone(){
			$query="select * from tbl_product where brandID='1' order by productID DESC LIMIT 1";
			$getIphone=$this->db->select($query);
			return $getIphone;
		}
		public function latestFromSamsung(){
			$query="select * from tbl_product where brandID='2' order by productID DESC LIMIT 1";
			$getSamsung=$this->db->select($query);
			return $getSamsung;
		}
		public function latestFromAcer(){
			$query="select * from tbl_product where brandID='3' order by productID DESC LIMIT 1";
			$getAcer=$this->db->select($query);
			return $getAcer;
		}
		public function latestFromCanon(){
			$query="select * from tbl_product where brandID='4' order by productID DESC LIMIT 1";
			$getCanon=$this->db->select($query);
			return $getCanon;
		}
		public function getProdByCat($catID){
			$query="select * from tbl_product where catId='$catID'";
			$getCategoryProduct=$this->db->select($query);
			return $getCategoryProduct;
		}
		public function insertCompareProduct($ProductID,$cusID){
			$ProductID= mysqli_real_escape_string($this->db->link, $ProductID);
			$cusID= mysqli_real_escape_string($this->db->link, $cusID);

			$checkCompareProd="SELECT * from tbl_compare where productID='$ProductID' AND compareID='$cusID'";
			$checkCompare=$this->db->select($checkCompareProd);
			if($checkCompare){
				return $msg="<span class='error'>Product Already Added to Compare!</span>";
				/*while($result=$checkCart->fetch_assoc()){
					$qty=$result['quantity']+$quantity;
					$cartID=$result['cartID'];
					$update=$this->updateQuantity($qty,$cartID);
				}*/
		    }else{
				$query="SELECT * from tbl_product where productID='$ProductID'";
				$result=$this->db->select($query)->fetch_assoc();
				if($result){
					$productID=$result['productID'];
					$productName=$result['productName'];
					$price=$result['price'];
					$image=$result['image'];
					$query="INSERT into tbl_compare(compareID,productID, productName, price, image) Values('$cusID','$productID','$productName','$price', '$image')";
					$Insert=$this->db->insert($query); 
					if($Insert){
					//return "<span class='success'>Catagory deleted Successfully</span>";
					return $msg="<span class='success'>Added to Compare</span>";
				}else{
					//return "<span class='error'>Catagory not Deleted</span>";
					return $msg="<span class='error'>Not Added</span>";
					}
			
				}
			}

		}
		public function getCompareProduct($cusID){
			$query="SELECT * from tbl_compare where compareID='$cusID' order by id DESC";
			$getCompareProduct=$this->db->select($query);
			return $getCompareProduct;
		}
		public function insertWishProduct($ProductID,$cusID){
			$ProductID= mysqli_real_escape_string($this->db->link, $ProductID);
			$cusID= mysqli_real_escape_string($this->db->link, $cusID);

			$checkWishProd="SELECT * from tbl_wishlist where productID='$ProductID' AND customerID='$cusID'";
			$checkWishList=$this->db->select($checkWishProd);
			if($checkWishList){
				return $msg="<span class='error'>Product Already Added to Wishlist!</span>";
		    }

			$query="SELECT * from tbl_product where productID='$ProductID'";
			$result=$this->db->select($query)->fetch_assoc();
			if($result){
				$productID=$result['productID'];
				$productName=$result['productName'];
				$price=$result['price'];
				$image=$result['image'];
				$query="INSERT into tbl_wishlist(customerID,productID, productName, price, image) Values('$cusID','$productID','$productName','$price', '$image')";
				$Insert=$this->db->insert($query); 
				if($Insert){
				//return "<span class='success'>Catagory deleted Successfully</span>";
				return $msg="<span class='success'>Added to WishList</span>";
			}else{
				//return "<span class='error'>Catagory not Deleted</span>";
				return $msg="<span class='error'>Couldn't Added</span>";
			}
			
			}
		}
		public function delCompareProduct($cusID){
		 	$cusID= mysqli_real_escape_string($this->db->link, $cusID);
			$query="DELETE from tbl_compare WHERE compareID='$cusID'";
			$delProduct=$this->db->delete($query);
		}
		public function getWishlistProduct($cusID){
			$query="SELECT * from tbl_wishlist where customerID='$cusID'";
			$getWishlistProduct=$this->db->select($query);
			return $getWishlistProduct;
		}
		public function delWishlistProduct($productID, $cusID){
		 	$productID= mysqli_real_escape_string($this->db->link, $productID);
		 	$cusID= mysqli_real_escape_string($this->db->link, $cusID);

			$query="DELETE from tbl_wishlist WHERE customerID='$cusID' AND productID='$productID'";
			$delProduct=$this->db->delete($query);
			if($delProduct){
				//return "<span class='success'>Catagory deleted Successfully</span>";
				return $msg="<span class='success'>Deleted Successfully</span>";
			}else{
				//return "<span class='error'>Catagory not Deleted</span>";
				return $msg="<span class='error'>Not Deleted</span>";
			}
		}


		
	}
?>