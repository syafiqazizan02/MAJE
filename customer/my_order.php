<?php
	session_start();
	include('interface.php');
	include('../function.php');
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
		$user = $_SESSION['user'];
		
		if($user=="admin")
		{
			header('location:admin_area/index.php');
		}
		
		$drives = $_SESSION['drives'];
		
		if($drives=="mobile")
		{
			header('location:../mobile/customer/my_order.php');
		}
	}
	else
	{
		header('location:../login.php');
	}
?>
<html>
<head>
<title>MAJE</title>
	<link rel="stylesheet" type="text/css" href="../css/MAJE.css">
</head>
<body>
<div class="body">
	<?php
		header_menu();
		header_menubar();
	?>
	<div class="content">
		
		<div class="content_item">
			<div class="bar2">
				<?php
					bar();
				?>
			</div>
			<div class='detail_text2'>
					
					<br><h2 align="center">My Order</h2><br>
					
					<?php
					include('../dbconnect.php');
					
					$sql = "select * from customer where email='".$_SESSION['email']."'";
					
					$run = mysql_query($sql);
							
					while($row=mysql_fetch_array($run)){
						$id = $row['c_id'];
					}
					
					$sql = "select * from payment where c_id = '$id' ORDER BY date DESC";
					
					$run = mysql_query($sql);
					
					$count = mysql_num_rows($run);
		
					if($count==0){
						mysql_close($con);
						echo "<div class='text'>No order!</div>";
					}
					else{
						
						echo' <table align="center" border="0">
						
							<tr align="center" bgcolor="#FF8C00" height="35">
								<th>Date</th>
								<th>Product Name</th>
								<th>Size</th>
								<th>Quantity</th>
								<th>Total Price</th>
								<th>Status</th>
								<th>Print</th>
							</tr>';
							
						$i = 0;
						
						while($row=mysql_fetch_array($run))
						{
							$payment_id = $row['payment_id'];
							$total = $row['amount'];
							$status = $row['status'];
							$date = date_create($row['date']);
							$i++;
							
							
							if($i%2==0)
							{
								$color = "#CCCCCC";
							}
							else
							{
								$color = "#ebebe0";
							}
							
							$sql3 = "select * from c_order WHERE payment_id='$payment_id'";
						
							$run3 = mysql_query($sql3);
							
							$count = mysql_num_rows($run3);
							
							echo '<tr align="center" bgcolor="'.$color.'" height="28">
									<td width="120" rowspan="'.$count.'">'.date_format($date, 'd-m-Y').'</td>';
							
							$j = 0;
							
							while($row3=mysql_fetch_array($run3))
							{
								$pro_name = $row3['pro_name'];
								$pro_size = $row3['pro_size'];
								$pro_price = $row3['pro_price'];
								$pro_qty = $row3['qty'];
								$j++;
								
								echo'
									<td width="200" align="center" bgcolor="'.$color.'" height="28">'.$pro_name.'</td>
									<td width="60" align="center" bgcolor="'.$color.'" height="28">'.$pro_size.'</td>
									<td width="80" align="center" bgcolor="'.$color.'" height="28">'.$pro_qty.'</td>';
									
								if($j==1){
									echo'<td width="100" align="center" bgcolor="'.$color.'" height="28" rowspan="'.$count.'">RM '.$total.'</td>'; ?>
										<td rowspan="<?php echo $count; ?>" width="100px">
											<?php
											if($status==1){
												echo '<font color="#47AA19"><b>Delivered</b></font>';
											}
											else{
												echo '<font color="red"><b>In Progress</b></font>';
											}
											?>
										</td>
										
										<form action="receipt.php" method="post" enctype="multipart/form-data" target="print_popup"  onsubmit="window.open('about:blank','print_popup','width=700,height=800');">
										<td  width="80" rowspan="<?php echo $count; ?>">
											<input type="hidden" name="id" value="<?php echo $payment_id; ?>">
											<button type="submit" name="submit" class="btn-success btn-sm"><img src="../css/print.png" width="15px" height="15px"> Print</button>
										</td>
										</form>
							<?php		
								}
								
								echo'</tr>';
							}
								
							
						}
						mysql_close($con);
					}
					?>
					</table>
			</div>
		</div>
		<div class="sidebar">
			<div class="sidebar_title">MY ACCOUNT</div>
				<?php
					include('../dbconnect.php');
					
					$email = $_SESSION['email'];
						
					$sql = "select * from customer where email='$email'";
					
					$run = mysql_query($sql);
						
					while($row=mysql_fetch_array($run))
					{	
						$name = $row['name'];
						$image = $row['image'];
						
						echo "<div style='text-align:center;'><br><img src='profile_image/$image' width='150px' height='180px'/><h3>$name</h3><br></div>";
					}
					mysql_close($con);
				?>
				<div class="sidebar_item">
					<a href="my_order.php">My Order</a>
				</div>
				<div class="sidebar_item">
					<a href="edit_account.php">Edit Account</a>
				</div>
				<div class="sidebar_item">
					<a href="c_password.php">Change Password</a>
				</div>
				<div class="sidebar_item">
					<a href="../logout.php">Customer Logout</a>
				</div>
		</div>
	</div>
	<?php
		footer();
	?>
</div>
</body>
</html>