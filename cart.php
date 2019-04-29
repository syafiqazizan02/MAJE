<?php
	session_start();
	include('interface.php');
	include('function.php');
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
		$user = $_SESSION['user'];
		
		if($user=="admin")
		{
			header('location:admin_area/index.php');
		}
	}
?>
<html>
<head>
<title>MAJE</title>
	<link rel="stylesheet" type="text/css" href="css/MAJE.css">
</head>
<body>
<div class="body">
	<?php
		header_menu();
		header_menubar();
	?>
	<div class="content">
		<div class="sidebar">
			<?php
				sidebar();
			?>
		</div>
		<div class="content_item">
			<div class="bar">
				<?php
					$count= total_value();
	
					if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
					{
						echo 'Welcome <b style="color: yellow;">'.$_SESSION['name'].'</b> ! ';
						
						if($count!=0)
						{
							echo '
							<b style="color:yellow">Shopping Cart -</b> Total Items: '.$count.' Total Price: ';
							total_price();
							echo ' <a href="product.php" style="color:yellow"><u>Back to Collection</u></a> ';
						}
						echo '<a href = "logout.php"><input name="logout" type="button" value="Logout" class="btn3"></a>';
					}
					else
					{
						echo 'Welcome to <b style="color: yellow;">MAJE Online Cothing System</b> ! ';
						
						if($count!=0)
						{
							echo '
							<b style="color:yellow">Shopping Cart -</b> Total Items: '.$count.' Total Price: ';
							total_price();
							echo ' <a href="product.php" style="color:yellow"><u>Back to Collection</u></a> ';
						}
						
						echo '<a href = "login.php"><input name="login" type="button" value="Login" class="btn3"></a>';
					}
				?>
			</div>
			<div class="product">
			<?php
				
			$count= total_value();
			
			if($count==0)
			{
				echo '<center><div class="text">No item into the cart!</div></center>';
			}
			else
			{
			
			?>
				
				<br><h2 align="center">Cart Products</h3><br>
				
				<table align="center" width="750">
					<tr align="center" bgcolor="#FF8C00" height="30">
						<th>Id</th>
						<th>Product</th>
						<th>Price</th>
						<th>Size</th>
						<th>Quantity</th>
						<th>Delete</th>
						<th>Total Price</th>
					</tr>
					
					<?php
					include('dbconnect.php');
	
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
									<td>'.$i.'</td>
									<td>'.$pro_name.'<br>
										<img src="admin_area/product_images/'.$pro_image.'" width="60" height="80"/></td>
									<td>RM '.$pro_price.'</td>
									<td width="100">'.$pro_size.'</td>
									
									<form action="add_cart.php" method="post" enctype="multipart/form-data">
									<input type="hidden" name="id" value="'.$pro_id.'"/>
									<input type="hidden" name="size" value="'.$pro_size.'"/>
									<td width="100"><input type="submit" name="minus" class="btn6" value="-" /><input type="text" name="qty" value="'.$pro_qty.'" readonly="readonly" style="width:35px; height:30px;text-align:center;"/><input type="submit" name="plus" class="btn6" value="+" /></td>
									</form>
									<td><a href ="delete.php?delete_cart='.$pro_id.'&size='.$pro_size.'"><button class="btn-success btn-sm" style="background:red;">Delete</button></a></td>
									<td>RM '.$values.'</td>
								</tr>
								';
						}
					}
					
					$t_total = $total + $t_tax;
					
					echo '
						<tr bgcolor="#ffd199" height="80">
							<td colspan="6" align="right">Subtotal&nbsp;&nbsp;&nbsp;<br><br>Tax&nbsp;&nbsp;&nbsp;</td>
							<td align="center">RM '.$total.'<br><br>RM '.$t_tax.'</td>
						</tr>
						<tr bgcolor="#FF8C00" height="40">
							<td colspan="6" align="right"><b>Total&nbsp;&nbsp;&nbsp;</b></td>
							<td align="center"><b>RM '.$t_total.'</b></td>
						</tr>
						
						<tr>
							<td colspan="7" align="center">
								<br><br><a href="product.php"><button class="btn2"><img src="css/back.png" width="40px" height="40px"/>Back</button></a>
								<a href ="check_out.php"><button class="btn2"><img src="css/update.png" width="40px" height="40px"/>Checkout</button></a><br><br><br>
							</td>
						</tr>';
					
					mysql_close($con);
					?>
				</table>
				
				<?php } ?>
			</div>
	</div>
	<?php
		footer();
	?>
</div>
</body>
</html>