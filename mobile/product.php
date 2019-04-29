<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
	$user = $_SESSION['user'];
		
	if($user=="admin")
	{
		header('location:../admin_area/index.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MAJE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/mobile.css">
  <script src="js/jquery.js"></script>
  <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div style='min-width:285px;'>
		<nav class="navbar navbar-custom navbar-fixed-top"  style='border-width: 0 0 0; min-width:285px;' id="my-navbar">
			<div class="navbar-header">
			
				<a href="index.php"><img src="css/logo.png" width="150px" height="50px"/></a>
				
				
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				
				<button type="button" class="navbar-toggle" style="color:#fff; width:45px;" data-toggle="collapse" data-target="#demo"><span class="glyphicon glyphicon-search"></span></button>
			</div>
			
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li class="active"><a href="product.php?gender=&category=">All Collection</a></li>
					<li><a href="cart.php">Shopping Cart</a></li>
					<li><a href="login.php">My Account</a></li>
					<li><a href="about.php">About Us</a></li>
				</ul>
			</div>
			
			<?php
				if(isset($_GET['category'])){
					
				}
				else if(isset($_GET['gender'])){
					
				}else{
					$_GET['category']="";
					$_GET['gender']="";
				}
			?>
			
			<div style="background:#FFFFFF; border-bottom: 1px solid #C60000;">
				<div class="bs-docs-example">
					<ul class="nav nav-pills">
						<li class="dropdown" id="abc">
							<a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="product.php?gender=<?php echo $_GET['gender']; ?>&category="><?php if(isset($_GET['category']) && !empty($_GET['category'])){ echo $_GET['category']; }else{ echo "All Category"; } ?><b class="caret"></b></a>
							<ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
								<?php
								include('../dbconnect.php');
								
								$sql = "select * from category";
							
								$run_pro = mysql_query($sql);
								
								if(isset($_GET['category']) && !empty($_GET['category'])){
									echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="product.php?gender='.$_GET["gender"].'&category=">All Category</a></li>';
								}
								
								while($row_pro=mysql_fetch_array($run_pro))
								{	
									$cat_name = $row_pro['cat_name'];
									
									if($cat_name!=$_GET['category']){
										echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="product.php?gender='.$_GET["gender"].'&category='.$cat_name.'">'.$cat_name.'</a></li>';
									}
								}
								mysql_close($con);
								?>	
							</ul>
						</li>
						
						<li class="dropdown" id="abc">
							<a class="dropdown-toggle" id="drop4" role="button" data-toggle="dropdown" href="product.php?gender=&category=<?php echo $_GET['category']; ?>"><?php if(isset($_GET['gender']) && !empty($_GET['gender'])){ echo $_GET['gender']; }else{ echo "All Gender"; } ?><b class="caret"></b></a>
							<ul id="menu1" class="dropdown-menu" role="menu" aria-labelledby="drop4">
								<?php
									if(isset($_GET['gender']) && !empty($_GET['gender'])){
										echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="product.php?gender=&category='.$_GET["category"].'">All Gender</a></li>';
									}
									
									if($cat_name!="Men"){
										echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="product.php?gender=Men&category='.$_GET["category"].'">Men</a></li>';
									}
									
									if($cat_name!="Women"){
										echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="product.php?gender=Women&category='.$_GET["category"].'">Women</a></li>';
									}
								?>
							</ul>
						</li>
					</ul>
				</div>
			</div>
			
			<div class="collapse" style='padding-top:10px; padding-bottom:10px; background:#FFFFFF; border-bottom:1px solid #C60000;' id="demo">
			  <div class="col-lg-6" style='width:80%; margin-left:auto; margin-right:auto;'>
				<form method="get" action="product.php" enctype="multipart/form-data">
				<div class="input-group">
				  <input type="hidden" name="gender" value="">
				  <input type="hidden" name="category" value="">
				  <input type="text" name="pro_name" class="form-control" placeholder="Search for...">
				  <span class="input-group-btn">
					<button class="btn btn-default" type="submit">Search</button>
				  </span>
				</div>
				</form>
			  </div>
			</div>
		
		</nav>

		<div style='margin-top:120px;'>
		<?php
		
			if (isset($_GET['pro_name']) && empty($_GET['pro_name'])){
				
				echo "<div class='text'>Please enter the product name!</div>";
			}
			else if (isset($_GET['pro_name']) && !empty($_GET['pro_name'])){
				
				$search = $_GET['pro_name'];
			
				$sql = "select * from products where product_name like '%$search%' ORDER BY product_id DESC";
				showPro($sql);
			}			
			else if(isset($_GET['gender']) && empty($_GET['gender']) AND isset($_GET['category']) && empty($_GET['category'])){	
				$sql = "select * from products ORDER BY product_id DESC";
				showPro($sql);
			}
			else if(isset($_GET['gender']) && !empty($_GET['gender']) AND isset($_GET['category']) && empty($_GET['category'])){
				
				$gender = $_GET['gender'];
				
				$sql = "select * from products WHERE product_gender = '$gender' ORDER BY product_id DESC";
				showPro($sql);
			}
			else if(isset($_GET['gender']) && empty($_GET['gender']) AND isset($_GET['category']) && !empty($_GET['category'])){
				
				$category = $_GET['category'];
				
				$sql = "select * from products WHERE product_category = '$category' ORDER BY product_id DESC";
				showPro($sql);
			}
			else if(isset($_GET['gender']) && !empty($_GET['gender']) AND isset($_GET['category']) && !empty($_GET['category'])){
				
				$gender = $_GET['gender'];
				$category = $_GET['category'];
				
				$sql = "select * from products WHERE product_gender = '$gender' AND product_category = '$category' ORDER BY product_id DESC";
				showPro($sql);
			}
			
			function showPro($sql){
				
				include('../dbconnect.php');
				
				$run_pro = mysql_query($sql);
					
				$count = mysql_num_rows($run_pro);
					
				if($count==0){
					mysql_close($con);
					echo "<div class='text'>No clothing where found!</div>";
				}
				else{
					
					while($row_pro=mysql_fetch_array($run_pro))
					{	
						$pro_id = $row_pro['product_id'];
						$pro_name = $row_pro['product_name'];
						$pro_price = $row_pro['product_price'];
						$pro_image = $row_pro['product_image'];
						$xs = $row_pro['XS'];
						$s = $row_pro['S'];
						$m = $row_pro['M'];
						$l = $row_pro['L'];
						$xl = $row_pro['XL'];
					
						$stock = $xs + $s +$m + $l + $xl;
						
						if($stock>0)
						{
							echo "<div class='item_list'>	
									<div>
										<a href='product_detail.php?pro_id=$pro_id'><img src='../admin_area/product_images/$pro_image' width='100%' height='180px' style='max-width:130px;'/>
									</div>
									<div style='right: 0;bottom: 0;left: 0; height:65px; padding:5px;'>
										<b>$pro_name</b>
										<br><font color='red'><b>RM $pro_price</b></font></a>
									</div>
								  </div>";
						}
					}		
					mysql_close($con);
				}
			}
		?>
		</div>
		
	</div>
</body>
</html>