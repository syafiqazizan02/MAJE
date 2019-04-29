<?php
	session_start();
	include('interface.php');
	include('function.php');
	
	if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
		$user = $_SESSION['user'];
		
		if($user=="customer")
		{
			header('location:../index.php');
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
	</div>
	<div class="content">
		<div class="content_item1">
			<div class="bar">
				<center>Welcome <b style="color: yellow;">BOSS</b> ! </center>
			</div>

					<br><h2 align="center">Order</h2><br>
					
					<?php
						if(!isset($_POST['name'])){
							$_POST['name'] = "";
						}
					?>
					
					<table align="center" border="0" width="80%">
					<tr>
						<td colspan="3">
						<form method="post" action="order.php" enctype="multipart/form-data" class="search">
						<input type="text" name="name" value="<?php echo $_POST['name']; ?>" placeholder="Search by Transaction ID"/>
						<input type="submit" name="search" value="Search"/>
						</form>	
						</td>
					</tr>
					
					<?php
					
					include('../dbconnect.php');
					
					if(!isset($_GET['page'])){
						$page=1;
					}
					else if(empty($_GET['page'])){
						$page=1;
					}
					else if($_GET['page']<1){
						$page=1;
					}
					else{
						$page = $_GET['page'];
					}
					////refer
					if(isset($_POST['search'])){
						
						$name = $_POST['name'];
						
						$sql = "select * from payment where trx_id like '%$name%' ORDER BY date DESC";
					}
					else{
						$sql = "select * from payment ORDER BY date DESC";
					}
					
					$run = mysql_query($sql);
					
					$count1 = mysql_num_rows($run);
					
					
		//***********************************************************
		
		
		
					if($count1==0){
						mysql_close($con);
						echo "</table><div class='text'><br><br><br>No order!</div>";
					}
					else{
						
						$max_page = intval($count1 / 10);
						$remainder = $count1 % 10;
						
						if($remainder!=0){
							$max_page += 1;
						}
						
						if($page>$max_page){
							$page = $max_page;
						}
						
						echo'
							<tr bgcolor="#FF8C00" height="35">
								<th>Description</th>
								<th><center>Status</center></th>
								<th><center>Print</center></th>
							</tr>';
							
						$i = 0;
						$x = 0;
						
						while($row=mysql_fetch_array($run))
						{
							$payment_id = $row['payment_id'];
							$trx_id = $row['trx_id'];
							$total = $row['amount'];
							$date = $row['date'];
							$c_id = $row['c_id'];
							$status = $row['status'];
							$x++;
							
							$min = ($page - 1) * 10;
							$max = $min + 11;
							
							if($x>$min && $x<$max){
								$i++;
								
								if($i%2==0)
								{
									$color = "#CCCCCC";
								}
								else
								{
									$color = "#ebebe0";
								}
								
								$sql2 = "select * from customer WHERE c_id='$c_id'";
						
								$run2 = mysql_query($sql2);
								
								while($row2=mysql_fetch_array($run2))
								{
									$email = $row2['email'];
								}
								
								$sql3 = "select * from c_order WHERE payment_id='$payment_id'";
							
								$run3 = mysql_query($sql3);
								
								$count = mysql_num_rows($run3);
								
								echo '<tr bgcolor="'.$color.'">
										<td><br>&nbsp;Date : '.$date.'<br>
											&nbsp;Transaction ID : '.$trx_id.'<br>
											&nbsp;Email : '.$email.'<br><br><table  border="0" width="50%">';

								while($row3=mysql_fetch_array($run3))
								{
									$pro_name = $row3['pro_name'];
									$pro_size = $row3['pro_size'];
									$pro_price = $row3['pro_price'];
									$pro_qty = $row3['qty'];
									
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
										<form action="order.php" method="post" enctype="multipart/form-data">
											<td width="80px">
												<input type="hidden" name="id" value="<?php echo $payment_id; ?>">
												<center>
												<?php
													if($status==1){
														echo '<button type="submit" name="cancel" class="btn-success btn-sm" style="background:red;">Cancel</button>';
													}
													else{
														echo '<button type="submit" name="process" class="btn-success btn-sm">Process</button>';
													}
												?>
												</center>
											</td>
										</form>
										<form action="receipt.php" method="post" enctype="multipart/form-data" target="print_popup"  onsubmit="window.open('about:blank','print_popup','width=700,height=800');">
											<td width="80px">
												<input type="hidden" name="id" value="<?php echo $payment_id; ?>">
												<center><button type="submit" name="submit" class="btn-success btn-sm"><img src="../css/print.png" width="15px" height="15px"> Print</button></center>
											</td>
										</form>
									</tr>
				<?php	
							}
						}
						mysql_close($con);
					
					?>
			</table>
			<br>
			<br>
			<center>
				<?php
					if($page>1)
					{
				?>
						<a href="order.php?page=<?php echo $page-1; ?>"><button>Prev</button></a>
				<?php
					}
				?>
				<?php
					if($page>2)
					{
				?>
					<a href="order.php?page=<?php echo $page-2; ?>"><button><?php echo $page-2; ?></button></a>
				<?php
					}
					
					if($page>1)
					{
				?>
					<a href="order.php?page=<?php echo $page-1; ?>"><button><?php echo $page-1; ?></button></a>
				<?php
					}
					if($max_page!=1){
				?>
					<a href="order.php?page=<?php echo $page; ?>"><button><?php echo $page; ?></button></a>
				<?php
					}
					
					$p1 = $page + 1;
					if($p1<=$max_page)
					{
				?>
					<a href="order.php?page=<?php echo $page+1; ?>"><button><?php echo $page+1; ?></button></a>
				<?php
					}
					
					$p2 = $page + 2;
					if($p2<=$max_page)
					{
				?>
					<a href="order.php?page=<?php echo $page+2; ?>"><button><?php echo $page+2; ?></button></a>
				<?php
					}
					
					if($page<$max_page)
					{
				?>
						<a href="order.php?page=<?php echo $page+1; ?>"><button>Next</button></a>
				<?php
					}
				}
				?>
			</center>
			<br>
			<br>
		</div>
	</div>
	<?php
		footer();
	?>
</div>
</body>
</html>
<?php
	if(isset($_POST['process'])){
		
		include('../dbconnect.php');
		
		$id = $_POST['id'];
		
		$sql = "UPDATE payment SET status ='1' WHERE payment_id = '$id'";
					
		$run = mysql_query($sql);
			
		if($run){
			
			echo "<script>alert('Status Has been Update!')</script>";
			echo "<script>window.open('order.php','_self')</script>";
			mysql_close($con);
			
			
		}
		
	}
	if(isset($_POST['cancel'])){
		
		include('../dbconnect.php');
		
		$id = $_POST['id'];
		
		$sql = "UPDATE payment SET status ='0' WHERE payment_id = '$id'";
					
		$run = mysql_query($sql);
			
		if($run){
			
			echo "<script>alert('Status Has been Update!')</script>";
			echo "<script>window.open('order.php','_self')</script>";
			mysql_close($con);
			
			
		}
		
	}
?>