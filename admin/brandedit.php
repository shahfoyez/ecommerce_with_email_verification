
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php';?>
<?php
    if(!isset($_GET['brandid']) || $_GET['brandid']==NULL){
        //header("Location: catlist.php");
        echo "<script>window.location='brandlist.php'</script>";
    }else{
        $brandid= preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['brandid']);
    }
    $brand=new brand();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $brandName=$_POST["brandupdate"];
        $brandupdate=$brand->brandUpdate($brandName,$brandid);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
                <div class="block copyblock"> 
                 <?php
                    if(isset($brandupdate)){
                        echo $brandupdate;
                    }
                ?>
                <?php
                    $getbrand=$brand->getBrandbyId($brandid);
                    if($getbrand){
                        while($result=$getbrand->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandupdate" value="<?php echo $result['brandName'];?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                <?php }} ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>