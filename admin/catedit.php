 
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Catagory.php';?>
<?php
    if(!isset($_GET['catid']) || $_GET['catid']==NULL){
        //header("Location: catlist.php");
        echo "<script>window.location='catlist.php'</script>";
    }else{
        $catid= preg_replace('/[^-a-zA-Z0-9_]/','',$_GET['catid']);
    }
    $cat=new Catagory();
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $catName=$_POST["catupdate"];
        $catupdate=$cat->CatUpdate($catName,$catid);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Edit Category</h2>
                <div class="block copyblock"> 
                 <?php
                    if(isset($catupdate)){
                        echo $catupdate;
                    }
                ?>
                <?php
                    $getcat=$cat->getCatbyId($catid);
                    if($getcat){
                        while($result=$getcat->fetch_assoc()){
                ?>
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="catupdate" value="<?php echo $result['catName'];?>" class="medium" />
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