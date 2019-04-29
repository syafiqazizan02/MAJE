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
				<form action="c_password.php" method="post" enctype="multipart/form-data"/>
				
					<br><h3><center>Change Password</h3></center><br><br>
					
					<table align='center' border='0' width="96%" style="max-width:400px;">
						<tr>
							<td style='color: #808080;' width="120px">Current Password</td>
							<td style='color: #808080;' width="10px">:</td>
							<td><input type='password' name='psw' class="form-control" placeholder="Current Password" aria-describedby="basic-addon1"></td>
						</tr>
						<tr>
							<td colspan="3"><br><td>
						</tr>
						<tr>
							<td style='color: #808080;'>New Password</td>
							<td style='color: #808080;'>:</td>
							<td><input type='password' name='n_psw' class="form-control" placeholder="New Password" aria-describedby="basic-addon1"></td>
						</tr>
						<tr>
							<td colspan="3"><br><td>
						</tr>
						<tr>
							<td style='color: #808080;'>Comfirm Password</td>
							<td style='color: #808080;'>:</td>
							<td><input type='password' name='c_psw' class="form-control" placeholder="Comfirm Password" aria-describedby="basic-addon1"></td>
						</tr>
						<tr>
							<td colspan='3'>
								<div style='text-align:center;'>
									<br><br>
									<input type='submit' name='update' value='Update' class='btn4' style="width:130px;"/>
									<input type='submit' name='cancel' value='Cancel' class='btn4' style="width:130px;"/>
								</div>
							</td>
						</tr>
					</table>
				</form>
		</div>
	</div>
</body>
</html>

<?php
	if(isset($_POST['cancel'])){
		echo "<script>window.open('index.php','_self')</script>";
	}
	else if(isset($_POST['update'])){
		
		$psw = $_POST['psw'];
		$n_psw = $_POST['n_psw'];
		$c_psw = $_POST['c_psw'];
		
		include('../../dbconnect.php');
					
		$sql = "select * from customer where email='".$_SESSION['email']."'";
					
		$run = mysql_query($sql);
			
		while($row=mysql_fetch_array($run))
		{
			$password = $row['psw'];
		}
		mysql_close($con);
		
		if($psw == "" OR $n_psw == "" OR $c_psw == ""){
			echo "<script>alert('Please fill in all the data!')</script>";
		}
		else if($psw!=$password){
			echo "<script>alert('Your current password is Incorrect!')</script>";
		}
		else if($n_psw!=$c_psw){
			echo "<script>alert('Your password are no same!')</script>";
		}
		else{
			include('../../dbconnect.php');
			
			$email=$_SESSION['email'];

			$sql= "UPDATE customer SET psw='$n_psw' WHERE email='$email'";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				
				echo "<script>alert('Account Password Has been Update!')</script>";
				mysql_close($con);
				echo "<script>window.open('../logout.php','_self')</script>";
				
			}
		}
	}	
?>	