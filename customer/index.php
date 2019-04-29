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
					
					<br><h2 align="center">My Account</h2><br>
					
					<table align='center' border='0' class='table'>
					
					<?php
					include('../dbconnect.php');
					
					$sql = "select * from customer where email='".$_SESSION['email']."'";
					
					$run = mysql_query($sql);
			
					while($row=mysql_fetch_array($run))
					{
						$name = $row['name'];
						$email = $row['email'];
						$gender = $row['gender'];
						$ic = $row['ic'];
						$image =$row['image'];
						$address = $row['address'];
						$poscode = $row['pos_code'];
						$city = $row['city'];
						$state = $row['state'];
						$phone1 = $row['phone1'];
						$phone2 = $row['phone2'];
						
						echo "
							<tr>
								<td colspan='3'>
									<div style='text-align:center;'><br><img src='profile_image/$image' width='150px' height='180px'/><br><br></div>
								</td>
							</tr>
							<tr>
								<td width='160' style='color: #808080;'>Name</td>
								<td width='15' style='color: #808080;'>:</td>
								<td width='280'>$name</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Email</td>
								<td style='color: #808080;'>:</td>
								<td>$email</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Gender</td>
								<td style='color: #808080;'>:</td>
								<td>$gender</td>
							</tr>
							<tr>
								<td style='color: #808080;'>IC Number</td>
								<td style='color: #808080;'>:</td>
								<td>$ic</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Address</td>
								<td style='color: #808080;'>:</td>
								<td><br/>".preg_replace('/\r\n|\r/', '<br/>', $address)."<br/><br/></td>
							</tr>
							<tr>
								<td style='color: #808080;'>Postcode</td>
								<td style='color: #808080;'>:</td>
								<td>$poscode</td>
							</tr>
							<tr>
								<td style='color: #808080;'>City</td>
								<td style='color: #808080;'>:</td>
								<td>$city</td>
							</tr>
							<tr>
								<td style='color: #808080;'>State</td>
								<td style='color: #808080;'>:</td>
								<td>$state</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Phone Number 1</td>
								<td style='color: #808080;'>:</td>
								<td>$phone1</td>
							</tr>
							<tr>
								<td style='color: #808080;'>Phone Number 2</td>
								<td style='color: #808080;'>:</td>
								<td>$phone2</td>
							</tr>
							<tr>
								<td colspan='3'>
									<br><br>
								</td>
							</tr>
							";
							
					}
					mysql_close($con);
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