<?php
	session_start();
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
		$user = $_SESSION['user'];
			
		if($user=="admin")
		{
			header('location:../../admin_area/index.php');
		}
	}
	else
	{
		header('location:../login.php');
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MAJE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../bootstrap-3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="../bootstrap-3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/mobile.css">
  <script src="../js/jquery.js"></script>
  <script src="../bootstrap-3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div style='min-width:285px;'>
		<nav class="navbar navbar-custom navbar-fixed-top" style='min-width:285px;' id="my-navbar">
			<div class="navbar-header">
			
				<a href="../index.php"><img src="../css/logo.png" width="150px" height="50px"/></a>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="../index.php">Home</a></li>
					<li><a href="../product.php?gender=&category=">All Collection</a></li>
					<li><a href="../cart.php">Shopping Cart</a></li>
					<li><a href="../login.php">My Account</a></li>
					<li><a href="../about.php">About Us</a></li>
				</ul>
			</div>
		</nav>
		
		<div style="margin-top: 65px;">
			
			<br><h3><center>My Order</h3></center><br>
		
			<?php
					include('../../dbconnect.php');
					
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
						
						echo'<table align="center" border="0" class="cart">
						
							<tr align="center" bgcolor="#FF8C00" height="35">
								<th><center>Description</center></th>
								<th width="68px"><center>Print</center></th>
							</tr>';
							
						$i = 0;
						
						while($row=mysql_fetch_array($run))
						{
							$payment_id = $row['payment_id'];
							$trx_id = $row['trx_id'];
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
							
							echo '<tr bgcolor="'.$color.'">
									<td><br>&nbsp;Date : '.date_format($date, 'd-m-Y').'<br>
										&nbsp;Transaction ID : '.$trx_id.'<br><br><table  border="0" width="100%">';
							
							$j = 0;
							
							while($row3=mysql_fetch_array($run3))
							{
								$pro_name = $row3['pro_name'];
								$pro_size = $row3['pro_size'];
								$pro_price = $row3['pro_price'];
								$pro_qty = $row3['qty'];
								$j++;
								
								echo'
										<tr>
											<td>&nbsp;'.$pro_name.'</td>
											<td width="50px" align="center">'.$pro_size.'</td>
											<td width="60px">x '.$pro_qty.'</td>
										</tr>
									';
							}
							echo'</table>
									<br>&nbsp;Status : ';
										if($status==1){
											echo '<font color="#47AA19"><b>Delivered</b></font>';
										}
										else{
											echo '<font color="red"><b>In Progress</b></font>';
										}
							echo'	<br>&nbsp;Total : RM '.$total.'<br><br></td>'; ?>
									<td>
										<form action="../../customer/receipt.php" method="post" enctype="multipart/form-data" target="print_popup"  onsubmit="window.open('about:blank','print_popup','width=700,height=800');">
										<input type="hidden" name="id" value="<?php echo $payment_id; ?>">
										<button type="submit" name="submit" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-print"></span> Print</button>
										</form>
									</td>
								</tr>
					<?php	}
						mysql_close($con);
					}
					?>
					</table>
		</div>
	</div>
</body>
</html>