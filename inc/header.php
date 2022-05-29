 <?php
    include 'lib/Session.php';
    Session::init();
    include 'lib/Database.php';
	include 'helpers/Format.php';
	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});
	$db=new Database();
	$fm=new Format();
	$pd=new Product();
    $ct=new Cart();
    $cat=new Catagory();
    $cmr=new Customer();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<!DOCTYPE HTML>
<head>
<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>

<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  	<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<h1 style="font-weight: bold;
					font-size: 40px;
					color: #920bff;
					padding-top: 15px;
					padding-left: 40px;"
				>
					HB SHOP
				</h1>
				<a href="index.php"><img src="images/logo.png" alt="" /></a>
			</div>
			<div class="header_top_right">
			    <div class="search_box">
				    <form>
				    	<input class="" type="text" value="Search for Products" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Products';}"><input class="" type="submit" value="SEARCH">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title text">Cart</span>
								<span class="no_product text">
								<?php
									$getdata=$ct->checkCartTable();
									if($getdata){
										$sum=Session::get("sum");
										$items=Session::get("items");
										echo "(".$items.") $".$sum;
									}else{
										echo "(Empty)";
									}
								?></span>
							</a>
						</div>
			      </div>
				<?php
					if(isset($_GET['cID'])){
						$cusID=$_GET['cID'];
						$deldata=$ct->delCustomerCart();
						$delCompareProduct=$pd->delCompareProduct($cusID);
						Session::destroy();
					}
				?>
			<div class="login">
				<?php 
					$login=Session::get('cuslogin');
					if($login==false){ ?>
						<a href="login.php" type="button" class="btn btn-success">
					Login</a>
					<?php }else {?>
						<a href="?cID=<?php echo Session::get("cusID");?>" class="btn btn-warning"style="color: #fdfdfd;
							background-color: #6a3496;
							border-color: #ffffff;"
						>Logout</a>
			<?php } ?>
			</div>
			<div class="clear"></div>
		</div>
	 	<div class="clear"></div>
 	</div>
	 <!--------nav Bar--------->
	<div class="menu" style="margin-top:15px">
	<!-- <nav class="navbar navbar-expand navbar-light bg-white topbar shadow" style="height:30px;"> -->
		<ul class="dc_mm-orange">  
			<!-- //class="dc_mm-orange" -->
			<li><a class="" href="index.php" style="border-left: 0px;">Home</a></li>
			<li><a href="topbrands.php">Top Brands</a></li>

			<?php
				$chkCheckCart=$ct->checkCartTable();
				if($chkCheckCart){ ?>
					<li><a href="cart.php">Cart</a></li>
					<li><a href="payment.php">Payment</a></li>
			<?php }?>
			<?php
				$cusID=Session::get('cusID');
				$checkOrder=$ct->checkOrderTable($cusID);
				if($checkOrder){ ?>
					<li><a href="orderdetails.php">Orders</a></li>
			<?php }?>
			<?php 
				$cusID=Session::get('cusID');
				$getCompareProd=$pd->getCompareProduct($cusID);
				if($getCompareProd){?>
					<li><a href="compare.php">Compare</a> </li>
			<?php }?>
			<?php
				$getWishlistProd=$pd->getWishlistProduct($cusID);
				if($getWishlistProd){?>
				<li><a href="wishlist.php">WishList</a> </li>
			<?php }?>
			<li><a href="contact.php">Contact</a></li>
			<?php
				$login=Session::get('cuslogin');
				if($login==true) {?>
					<li><a href="profile.php">Profile</a></li>
			<?php } ?>
			<div class="clear"></div>
		</ul>
	<!-- </nav> -->
	</div>
	<!--------nav Bar--------->
	<style>
		.ol, ul {
			padding-left: 0rem;
		}
		.dl, ol, ul {
			margin-top: 0;
			margin-bottom: 1rem;
		}
	</style>