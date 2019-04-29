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
					<li class="active"><a href="cart.php">Shopping Cart</a></li>
					<li><a href="login.php">My Account</a></li>
					<li><a href="about.php">About Us</a></li>
				</ul>
			</div>
		</nav>
		
		<div style="margin-top: 65px;">
				
			<?php
			
			include('../function.php');
			
			$count= total_value();
			
			if($count==0)
			{
				echo '<center><div class="text">No item into the cart!</div></center>';
			}
			else
			{
			
			?>
				
				<table align="center" class="cart" border="0">
					<tr bgcolor="#FF8C00" height="30">
						<th><center>Id</center></th>
						<th colspan="2"><center>Product</center></th>
						<th></th>
					</tr>
					
					<?php
					include('../dbconnect.php');
	
					$ip = getIp();
	
					$total = 0;
					
					$i = 0;
	
					$sql = "select * from cart where user_ip='$ip'";
	
					$run_pro = mysql_query($sql);
					
					$tax = 0;
					$t_tax = 0;
					
					while($row_pro = mysql_fetch_array($run_pro)){
						
						$pro_id = $row_pro['pro_id'];
						$pro_size = $row_pro['size'];
						$pro_qty = $row_pro['qty'];
						$i++;
						
						$sql = "select * from products where product_id='$pro_id'";
		
						$run_pro2 = mysql_query($sql);
						
						$tax = $pro_qty * 2;
						$t_tax += $tax;
						
						while($row_pro2 = mysql_fetch_array($run_pro2)){
								
							$pro_name = $row_pro2['product_name'];
							$pro_price = $row_pro2['product_price'];
							$pro_image = $row_pro2['product_image'];
							
							$values = $pro_price * $pro_qty;
							
							$total += $values;
							
							if($i%2==0)
							{
								$color = "#CCCCCC";
							}
							else
							{
								$color = "#ebebe0";
							}
						
							echo '
								<tr align="center" bgcolor="'.$color.'">
									<td width="30px">'.$i.'</td>
									<td class="table_img">
										<img src="../admin_area/product_images/'.$pro_image.'"  class="table_img_size"/>
									</td>
									<td align="left">
										<font color="blue"><b>'.$pro_name.'</font><br>
										<font color="red">RM '.$pro_price.'</font><br>
										Size : '.$pro_size.'<br>
									
									
									<form action="add_cart.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="id" value="'.$pro_id.'"/>
									<input type="hidden" name="size" value="'.$pro_size.'"/>
									Quantity : <br>
													<div class="input-group" style="width:100px;">
													  <span class="input-group-btn">
														<button class="btn btn-default" type="submit" name="minus" style="background:#FF8C00; color:#FFFFFF;">-</button>
													  </span>
													  <input type="text" name="qty" class="form-control" readonly="readonly" value="'.$pro_qty.'" style="text-align:center; background:#FFFFFF;">
													  <span class="input-group-btn">
														<button class="btn btn-default" type="submit" name="plus" style="background:#FF8C00; color:#FFFFFF;">+</button>
													  </span>
													</div>
									</form>
									Total : RM '.$values.'</b></td>
									<td class="table_delete"><a href ="delete.php?delete_cart='.$pro_id.'&size='.$pro_size.'" class="table_delete_size"><span class="glyphicon glyphicon-remove"></span></a></td>
								</tr>
								';
						}
					}
					
					$t_total = $total + $t_tax;
					
					echo '
						<tr bgcolor="#ffd199" height="60">
							<td colspan="4"  align="right">
								<table>
								<tr align="right">
									<td>Subotal</td>
									<td width="20px" align="center">:</td>
									<td>RM '.$total.'</td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>
								<tr align="right">
									<td>Tax</td>
									<td width="20px" align="center">:</td>
									<td>RM '.$t_tax.'</td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
								</tr>
								</table>
							</td>
						</tr>
						<tr bgcolor="#FF8C00" height="40">
							<td colspan="4"  align="right"><b>Total&nbsp;:&nbsp;&nbsp;RM '.$t_total.'</b>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>
						
						<tr>
							<td colspan="7" align="center">
								<br><br><a href="product.php"><button class="btn2"><img src="../css/back.png" width="40px" height="40px"/>Back</button></a>
								<a href ="check_out.php"><button class="btn2"><img src="../css/update.png" width="40px" height="40px"/>Checkout</button></a><br><br><br>
							</td>
						</tr>';
						
				mysql_close($con);
			}
			?>
			</table>
		</div>
	</div>
</body>
</html>