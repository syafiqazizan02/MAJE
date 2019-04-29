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
	else
	{
		header('location:login.php');
	}
	
	$count= total_value();
	
	if($count==0)
	{
		echo "<script>window.history.go(-1);</script>";
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
							echo ' <a href="#" onClick="history.go(-1);return true;" style="color:yellow"><u>Back to Cart</u></a> ';
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
							echo ' <a href="#" onClick="history.go(-1);return true;" style="color:yellow"><u>Back to Cart</u></a> ';
						}
						
						echo '<a href = "login.php"><input name="login" type="button" value="Login" class="btn3"></a>';
					}
				?>
			</div>
			<div class="product">
				<h3 align="center">Check Products</h3>
				<table align="center" width="750"  border="0">
					<tr align="center" bgcolor="#FF8C00" height="30">
						<th>Id</th>
						<th>Product</th>
						<th>Price</th>
						<th>Size</th>
						<th>Quantity</th>
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
									<td width="100">'.$pro_qty.'</td>
									<td>RM '.$values.'</td>
								</tr>
								';
						}
					}
					
					$t_total = $total + $t_tax;
					
					echo '
						<tr bgcolor="#ffd199" height="80">
							<td colspan="5" align="right">Subtotal&nbsp;&nbsp;&nbsp;<br><br>Tax&nbsp;&nbsp;&nbsp;</td>
							<td align="center">RM '.$total.'<br><br>RM '.$t_tax.'</td>
						</tr>
						<tr bgcolor="#FF8C00" height="40">
							<td colspan="5" align="right"><b>Total&nbsp;&nbsp;&nbsp;</b></td>
							<td align="center"><b>RM '.$t_total.'</b></td>
						</tr>
						
						<tr>
							<td colspan="3" align="right">
								<br><a href ="cart.php"><button class="btn2" style="margin-top:3px;"><img src="css/back.png" width="40px" height="40px"/>Back</button></a>
							</td>
							<td colspan="3" align="left">
							<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
							  <input type="hidden" name="cmd" value="_cart">
							  <input type="hidden" name="upload" value="1">
							  <input type="hidden" name="business" value="cutefox6095-facilitator@gmail.com">
							  <input type="hidden" name="currency_code" value="MYR">';

							$i = 0;
							
							$sql = "select * from cart where user_ip='$ip'";
	
							$run_pro = mysql_query($sql);
							
							while($row_pro = mysql_fetch_array($run_pro)){
							
								$pro_id = $row_pro['pro_id'];
								$pro_size = $row_pro['size'];
								$pro_qty = $row_pro['qty'];
								$i++;
								
								$sql = "select * from products where product_id='$pro_id'";
			
								$run_pro2 = mysql_query($sql);
								
								while($row_pro2 = mysql_fetch_array($run_pro2)){
										
									$pro_name = $row_pro2['product_name'];
									$pro_price = $row_pro2['product_price'];
								
									echo' <input type="hidden" name="item_name_'.$i.'" value="'.$pro_name.'">
										  <input type="hidden" name="on0_'.$i.'" value="Size">
										  <input type="hidden" name="os0_'.$i.'" value="'.$pro_size.'">
										  <input type="hidden" name="amount_'.$i.'" value="'.$pro_price.'">
										  <input type="hidden" name="quantity_'.$i.'" value="'.$pro_qty.'">
										  <input type="hidden" name="tax_'.$i.'" value="2">';
								}
							}
							
								if($ip=="127.0.0.1"){
									echo' <input type="hidden" name="return" value="http://127.0.0.1/MAJEPROJECT/insert_order.php">
										  <input type="hidden" name="cancel_return" value="http://127.0.0.1/MAJEPROJECT/cart.php">';
								}
								else{
									echo' <input type="hidden" name="return" value="http://172.17.26.1/MAJEPROJECT/insert_order.php">
										  <input type="hidden" name="cancel_return" value="http://172.17.26.1/MAJEPROJECT/cart.php">';
								}
								echo'<br><br><button type="submit" class="btn2" name="submit" alt="PayPal - The safer, easier way to pay online"><img src="css/pay.png" width="40px" height="40px"/>Pay</button>
							</form>
							</td>
						</tr>';
					
					mysql_close($con);
					?>
				</table>
			</div>
	</div>
	<?php
		footer();
	?>
</div>
</body>
</html>