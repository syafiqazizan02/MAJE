<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
	$user = $_SESSION['user'];
		
	if($user=="admin")
	{
		header('location:../admin_area/index.php');
	}
	else
	{
		header('location:customer/index.php');
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
					<li class="active"><a href="login.php">My Account</a></li>
					<li><a href="about.php">About Us</a></li>
				</ul>
			</div>
		</nav>
		
		<div style="margin-top: 80px;">
			
			<div style="max-width:285px; background:#CCCCCC; margin-left:auto; margin-right:auto; padding:10px;">
			
			<form action='login.php' method='post'>
				
				<center><h3>Login</h3></center>
				
				<div class="input-group" width="90%">
					<span class="input-group-addon" id="basic-addon1">
						<span class="glyphicon glyphicon-user"></span>
					</span>
					<input type="text" name='email' class="form-control" placeholder="Email" aria-describedby="basic-addon1">
				</div>
				
				<br>
				
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">
						<span class="glyphicon glyphicon-lock"></span>
					</span>
					<input type='password' name='password' class="form-control" placeholder="Password" aria-describedby="basic-addon1">
				</div>
				
				<br><center><input name="login" type="submit" value="Login" class="btn btn-success" style='width:265px;'></center>
			</form>
			
			<br><center><a href="customer/register.php">New Register Here<a/></center>
			
			</div>
		</div>
	</div>
</body>
</html>
<?php

if(isset($_POST['login']))
{
	$email=$_POST['email'];
	$pwd=$_POST['password'];
	if($email!=''&& $pwd!='')
	{
		include('../dbconnect.php');

			$query=mysql_query("select * from customer where email='$email' and psw='$pwd'");
			$res=mysql_fetch_row($query);
			if($res)
			{	
				$query=mysql_query("select * from customer where email='$email' and psw='$pwd'");
				while($row=mysql_fetch_array($query)){
					
					$email = $row['email'];
					$name = $row['name'];

					$_SESSION['loggedin'] = true;
					$_SESSION['email']=$email;
					$_SESSION['name']=$name;
					$_SESSION['user']="customer";
					$_SESSION['drives']="mobile";
				}
				mysql_close($con);
				
				include('../function.php');
				
				$count= total_value();
	
				if($count==0)
				{
					header("location:customer/index.php");
				}
				else
				{
					header('location:check_out.php');
				}
			}
			else
			{
				mysql_close($con);
				echo "<script>alert('Your Email or Password is Incorrect!')</script>";
			}
	}
	else
	{
		 echo "<script>alert('Please enter your Email and Password!')</script>";
	}
}

?>