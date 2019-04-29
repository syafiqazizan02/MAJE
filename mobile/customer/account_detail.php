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
			
			<br><h3><center>My Account</h3></center><br>
				
			<?php
			include('../../dbconnect.php');
			
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
				
				echo "	<table align='center' border='0'>
							<tr>
								<td colspan='3'>
									<center><img src='../../customer/profile_image/$image' width='150px' height='180px'/><br/><br/></center>
								</td>
							</tr>
							<tr>
								<td width='110px' style='color: #808080;'>Name</td>
								<td width='10px' style='color: #808080;'>:</td>
								<td>$name</td>
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
								<td>".preg_replace('/\r\n|\r/', '<br/>', $address)."</td>
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
							</table>";
					}
					mysql_close($con);
			?>
		</div>
	</div>
</body>
</html>