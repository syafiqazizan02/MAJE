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
					<li><a href="index.php">Home</a></li>
					<li><a href="product.php?gender=&category=">All Collection</a></li>
					<li><a href="cart.php">Shopping Cart</a></li>
					<li><a href="login.php">My Account</a></li>
					<li><a href="about.php">About Us</a></li>
				</ul>
			</div>
		</nav>
		
		<div style="margin-top: 65px;">

		<?php
			include('../dbconnect.php');
				
			$id = $_GET['pro_id'];
			
			$sql = "select * from products where product_id = '$id'";
			
			$run_pro = mysql_query($sql);
			
			while($row_pro=mysql_fetch_array($run_pro))
			{	
				$pro_name = $row_pro['product_name'];
				$pro_gender = $row_pro['product_gender'];
				$pro_category = $row_pro['product_category'];
				$pro_price = $row_pro['product_price'];
				$pro_image = $row_pro['product_image'];
				$pro_detail = $row_pro['product_detail'];
				$xs = $row_pro['XS'];
				$s = $row_pro['S'];
				$m = $row_pro['M'];
				$l = $row_pro['L'];
				$xl = $row_pro['XL'];
				
				$stock = $xs + $s +$m + $l + $xl;
				
				echo "<div class='box'>
						<div class='detail_img_box'>
							<center><img src='../admin_area/product_images/$pro_image' class='detail_img'/><br/><br/></center>
						</div>
						<div class='detail_text'>
							<table align='center' border='0'>
							<tr>
								<td style='color: #808080;'>Product Name</td>
								<td width='15px' style='color: #808080;'>:</td>
								<td>&nbsp;$pro_name</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Product Gender</td>
								<td style='color: #808080;'>:</td>
								<td>&nbsp;$pro_gender</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Product Category</td>
								<td style='color: #808080;'>:</td>
								<td>&nbsp;$pro_category</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Product Description</td>
								<td style='color: #808080;'>:</td>
								<td>&nbsp;".preg_replace('/\r\n|\r/', '<br/>&nbsp;',$pro_detail)."</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Product Price</td>
								<td style='color: #808080;'>:</td>
								<td>&nbsp;RM&nbsp;$pro_price</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Product Size</td>
								<td style='color: #808080;'>:</td>
								<td>";
								
								if($xs>0){
									echo"<button onclick='xs()' class='pro_btn' id='xs'>XS</button>";
								}
								if($s>0){
									echo"<button onClick='s()' class='pro_btn' id='s'>S</button>";
								}
								if($m>0){
									echo"<button onClick='m()' class='pro_btn' id='m'>M</button>";
								}
								if($l>0){
									echo"<button onClick='l()' class='pro_btn' id='l'>L</button>";
								}
								if($xl>0){
									echo"<button onClick='xl()' class='pro_btn' id='xl'>XL</button>";
								}
								
								
								
							echo"							
									<input type='hidden' id='stock_xs' value='$xs'/>
									<input type='hidden' id='stock_s' value='$s'/>
									<input type='hidden' id='stock_m' value='$m'/>
									<input type='hidden' id='stock_l' value='$l'/>
									<input type='hidden' id='stock_xl' value='$xl'/>
									
									<script>
									function xs() {
										this.reset();
										document.getElementById('xs').style.color = '#FF4300';
										document.getElementById('xs').style.border = '2px solid #FF4300';
										document.getElementById('size').value = 'XS';
										var x = document.getElementById('stock_xs').value;
										document.getElementById('db_stock').value = x;
										document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
									}
									function s() {
										this.reset();
										document.getElementById('s').style.color = '#FF4300';
										document.getElementById('s').style.border = '2px solid #FF4300';
										document.getElementById('size').value = 'S';
										var x = document.getElementById('stock_s').value;
										document.getElementById('db_stock').value = x;
										document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
									}
									function m() {
										this.reset();
										document.getElementById('m').style.color = '#FF4300';
										document.getElementById('m').style.border = '2px solid #FF4300';
										document.getElementById('size').value = 'M';
										var x = document.getElementById('stock_m').value;
										document.getElementById('db_stock').value = x;
										document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
									}
									function l() {
										this.reset();
										document.getElementById('l').style.color = '#FF4300';
										document.getElementById('l').style.border = '2px solid #FF4300';
										document.getElementById('size').value = 'L';
										var x = document.getElementById('stock_l').value;
										document.getElementById('db_stock').value = x;
										document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
									}
									function xl() {
										this.reset();
										document.getElementById('xl').style.color = '#FF4300';
										document.getElementById('xl').style.border = '2px solid #FF4300';
										document.getElementById('size').value = 'XL';
										var x = document.getElementById('stock_xl').value;
										document.getElementById('db_stock').value = x;
										document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
									}
									function reset(){
										
										var stock_xs = document.getElementById('stock_xs').value;
										var stock_s = document.getElementById('stock_s').value;
										var stock_m = document.getElementById('stock_m').value;
										var stock_l = document.getElementById('stock_l').value;
										var stock_xl = document.getElementById('stock_xl').value;
										
										if(stock_xs>0){
											document.getElementById('xs').style.color = '#000000';
											document.getElementById('xs').style.border = '1px solid #CCCCCC';
										}
										if(stock_s>0){
											document.getElementById('s').style.color = '#000000';
											document.getElementById('s').style.border = '1px solid #CCCCCC';
										}
										if(stock_m>0){
											document.getElementById('m').style.color = '#000000';
											document.getElementById('m').style.border = '1px solid #CCCCCC';
										}
										if(stock_l>0){
											document.getElementById('l').style.color = '#000000';
											document.getElementById('l').style.border = '1px solid #CCCCCC';
										}
										if(stock_xl>0){
											document.getElementById('xl').style.color = '#000000';
											document.getElementById('xl').style.border = '1px solid #CCCCCC';
										}
										document.getElementById('stock').value = '1';
										document.getElementById('in_stock').value = '1';
									}
									</script>
								</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Product Stock</td>
								<td style='color: #808080;'>:</td>
								<td id='s_stock'>&nbsp;$stock left</td>
							</tr>
							<tr height='50'>
								<td style='color: #808080;'>Quantity</td>
								<td style='color: #808080;'>:</td>
								<td><div class='input-group' style='width:auto; max-width:130px'>
												<span class='input-group-btn'>
													<button class='btn btn-default' onClick='minus()' style='background:#FF8C00; color:#FFFFFF;'>-</button>
												</span>
													<input type='text' name='qty' class='form-control' value='1' readonly='readonly' max='$stock' style='text-align:center; background:#FFFFFF;' id='stock'>
												<span class='input-group-btn'>
													<button class='btn btn-default' onClick='plus()' style='background:#FF8C00; color:#FFFFFF;'>+</button>
												</span>
											</div>
								</td>
								
								<input type='hidden' name='qty' value='$stock' id='db_stock'/>
								
								<script>
								function plus() {
									var x =document.getElementById('stock').value;
									var y = Number(x) + 1;
									
									var z =document.getElementById('db_stock').value;
									
									if(y>z)
									{
										y=1;
									}

									document.getElementById('stock').value = y;
									document.getElementById('in_stock').value = y;
								}
								function minus() {
									var x =document.getElementById('stock').value;
									var y = Number(x) - 1;
									
									var z =document.getElementById('db_stock').value;
									
									if(z==0)
									{
										y=0;
									}
									else if(y<1)
									{
										y=z;
									}
									document.getElementById('stock').value = y;
									document.getElementById('in_stock').value = y;
								}
								</script>
							</tr>
						</table>
					  </div>
					</div>
					  <div style='float:left; width:100%;'>
						<form action='add_cart.php' method='post' enctype='multipart/form-data'>
							<input type='hidden' name='id' value='$id'/>
							<input type='hidden' name='size' value='' id='size'/>
							<input type='hidden' name='qty' value='1' id='in_stock'/>
							<br>
							<center>
							  <button type='submit' name='back' class='btn2'><img src='../css/back.png' width='40px' height='40px'/>Back</button>
							  <button type='submit' name='add_cart' class='btn2'><img src='../css/new.png' width='40px' height='40px'/>Add to Cart</button>
							</center>
							</from>	
					  </div>";
			}		
			mysql_close($con);
		?>
	</div>
</body>
</html>