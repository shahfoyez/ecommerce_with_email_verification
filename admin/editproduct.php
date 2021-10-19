<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
    include '../classes/Catagory.php';
    include '../classes/Brand.php';
    include '../classes/Product.php';
?>
<?php
    $cat=new Catagory();
    $brand=new Brand();
    $product=new Product();
?>
<?php
    if(!isset($_GET['editid']) || $_GET['editid']==NULL){
        //header("Location: catlist.php");
        echo "<script>window.location='productlist.php'</script>";
    }else{
        $editid= preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['editid']);
    }
     if($_SERVER['REQUEST_METHOD']=='POST'){
        $updateProduct=$product->productUpdate($_POST, $_FILES, $editid);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Product</h2>
        <div class="block"> 
        <?php
            if(isset($updateProduct)){
                echo  $updateProduct;
            }
        ?>   
        <?php
            $getdata=$product->getProductById($editid);
            if($getdata){
                while($value=$getdata->fetch_assoc()){
        ?>         
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Product Name</label>
                    </td>
                    <td>
                        <input type="text" name='productName' value="<?php echo $value['productName'];?>" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option>Select Category</option>
                        <?php
                            $getCat= $cat->catList();
                            if($getCat){
                                while($result=$getCat->fetch_assoc()){
                        ?>
                            <option 
                            <?php 
                                if($value['catId']==$result['catId']){ ?>
                                    selected="echo $result['catName']";
                                 <?php } ?>
                            value="<?php echo $result['catId'];?>">
                                <?php echo $result['catName'];?>
                            </option>
                        <?php }}?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brandID">
                            <option>Select Brand</option>
                        <?php
                            $getBrand= $brand->brandList();
                            if($getBrand){
                                while($result=$getBrand->fetch_assoc()){
                        ?>
                            <option
                                <?php 
                                    if($value['brandID']==$result['brandID']){ ?>
                                        selected="echo $result['brandName']";
                                <?php } ?>
                                 value="<?php echo $result['brandID'];?>">
                                    <?php echo $result['brandName'];?>
                            </option>
                        <?php }}?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea class="tinymce" name='body'><?php echo $value['body']?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $value['price'];?>"  name='price' class="medium" />
                    </td>
                </tr>
                 <tr>
                    <td>
                        
                    </td>
                    <td>
                         <img src="<?php echo $value['image'];?>" height: '35px' width='50px'/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                       
                        <input name='image' type="file" />
                    </td>
                </tr>
               
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option value="">Select Type</option>
                         <?php if($value['type']==0){ ?>
                            <option selected ="selected" value="0">Featured</option>
                            <option value="1">General</option>
                         <?php }elseif($value['type']==1){ ?>
                            <option  value="0">Featured</option>
                            <option selected ="selected" value="1">General</option>
                         <?php }else{?>
                             <option  value="0">Featured</option>
                            <option   value="1">General</option>
                        <?php }?>
                                     
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        <?php }} ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


