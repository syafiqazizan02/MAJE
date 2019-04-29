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
					<li class="active"><a href="../login.php">My Account</a></li>
					<li><a href="../about.php">About Us</a></li>
				</ul>
			</div>
		</nav>
		
		<div style="margin-top: 65px;">
			
			<?php
					include('../../dbconnect.php');
					
					$email = $_SESSION['email'];
						
					$sql = "select * from customer where email='$email'";
					
					$run = mysql_query($sql);
						
					while($row=mysql_fetch_array($run))
					{	
						$name = $row['name'];
						$image = $row['image'];
						
						echo "<div style='text-align:center;'><br><img src='../../customer/profile_image/$image' width='150px' height='180px'/><h3>$name</h3><br></div>";
					}
					mysql_close($con);
				?>

				<div class="list-group">
				  <a href="account_detail.php" class="list-group-item list-group-item-action">My Account</a>
				  <a href="my_order.php" class="list-group-item list-group-item-action">My Order</a>
				  <a href="edit_account.php" class="list-group-item list-group-item-action">Edit Account</a>
				  <a href="c_password.php" class="list-group-item list-group-item-action">Change Password</a>
				  <a href="../logout.php" class="list-group-item list-group-item-action">Customer Logout</a>
				</div>
			
		</div>
	</div>
</body>
</html>