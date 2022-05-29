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
    //if(isset($_POST['submit'])){}
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $insertProduct=$product->productInsert($_POST,$_FILES);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Product</h2>
        <div class="block"> 
        <?php
            if(isset($insertProduct)){
                echo  $insertProduct;
            }
        ?>              
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name='productName' placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="catId">
                            <option >Select Category</option>
                        <?php
                            $getCat= $cat->catList();
                            if($getCat){
                                while($result=$getCat->fetch_assoc()){
                        ?>
                            <option value="<?php echo $result['catId'];?>">
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
                            <option value="<?php echo $result['brandID'];?>">
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
                        <textarea type="textarea" name='body'></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Price..." name='price' class="medium" />
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
                            <option value="0">Featured</option>
                            <option value="1">General</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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


