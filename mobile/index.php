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
		<nav class="navbar navbar-custom navbar-fixed-top" style='min-width:285px;' id="my-navbar">
			<div class="navbar-header">
			
				<a href="index.php"><img src="css/logo.png" width="150px" height="50px"/></a>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php">Home</a></li>
					<li><a href="product.php?gender=&category=">All Collection</a></li>
					<li><a href="cart.php">Shopping Cart</a></li>
					<li><a href="login.php">My Account</a></li>
					<li><a href="about.php">About Us</a></li>
				</ul>
			</div>
		</nav>
	
	<div class="slider">
		<div style="margin-top: 65px;">
			<?php
				include('../dbconnect.php');
				
				$sql = "select * from slide ORDER BY id DESC";
			
				$run_pro = mysql_query($sql);
				
				while($row_pro=mysql_fetch_array($run_pro))
				{	
					$image = $row_pro['image'];
				
					echo'<a href="product.php"><img class="mySlides1" style="width:100%;" src="../admin_area/slide_images/'.$image.'"></a>';
				}
				mysql_close($con);
				
			?>
		
			<script>
			var myIndex1 = 0;
			carousel();

			function carousel() {
				var i;
				var x = document.getElementsByClassName("mySlides1");
				for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";
				}
					
					myIndex1++;
					if (myIndex1 > x.length) {myIndex1 = 1}
					x[myIndex1-1].style.display = "block";
					setTimeout(carousel, 3000);
				}
			</script>
		</div>
	</div>
	
	<div class="home">
		<div class="item">
			<div class="sidebar_title">MEN</div>
			
			<div class="items-container">
				<ul class="group-items">
					<?php
						include('../dbconnect.php');
						
						$sql = "select * from products where product_gender = 'Men' ORDER BY product_id DESC";

						$run_pro = mysql_query($sql);
						
						$count = mysql_num_rows($run_pro);
						
						$i=0;
							
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
									$i++;
									
									if($i<=6){
										echo "<li class='product_box'";
												if($i==1){
													echo" style='margin-left:-40px;'";
												} 
												echo">
												
												 <a href='product_detail.php?pro_id=$pro_id'><img src='../admin_area/product_images/$pro_image' width='130px' height='180px'/>
												 <br><br><b>$pro_name</b>
												 <br><font color='red'><b>RM $pro_price</b></font></a>
											  </li>";
									}
								}
							}		
							mysql_close($con);
						}
					?>
				</ul>
			</div>
		</div>
		
		<div class="item">
			<div class="sidebar_title">WOMEN</div>
			
			<div class="items-container">
				<ul class="group-items">
					<?php
						include('../dbconnect.php');
						
						$sql = "select * from products where product_gender = 'Women' ORDER BY product_id DESC";

						$run_pro = mysql_query($sql);
						
						$count = mysql_num_rows($run_pro);
						
						$i=0;
							
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
									$i++;
									
									if($i<=6){
										echo "<li class='product_box'";
												if($i==1){
													echo" style='margin-left:-40px;'";
												} 
												echo">
												
												 <a href='product_detail.php?pro_id=$pro_id'><img src='../admin_area/product_images/$pro_image' width='130px' height='180px'/>
												 <br><br><b>$pro_name</b>
												 <br><font color='red'><b>RM $pro_price</b></font></a>
											  </li>";
									}
								}
							}		
							mysql_close($con);
						}
					?>
				</ul>
			</div>
		</div>
	</div>
	</div>
</body>
</html>