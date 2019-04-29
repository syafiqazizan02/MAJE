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
				<form action="c_password.php" method="post" enctype="multipart/form-data"/>
				
					<br><h2 align="center">Change Password</h2><br>
					
					<table align='center' border='0' class='table'>
						<tr>
							<td colspan='3'>
								<br>
							</td>
						</tr>
						<tr>
							<td style='color: #808080;'>Current Password</td>
							<td style='color: #808080;'>:</td>
							<td><input type='password' name='psw' size='50'/></td>
						</tr>
						<tr>
							<td style='color: #808080;'>New Password</td>
							<td style='color: #808080;'>:</td>
							<td><input type='password' name='n_psw' size='50'/></td>
						</tr>
						<tr>
							<td style='color: #808080;'>Comfirm Password</td>
							<td style='color: #808080;'>:</td>
							<td><input type='password' name='c_psw' size='50'/></td>
						</tr>
						<tr>
							<td colspan='3'>
								<div style='text-align:center;'>
									<br><br><input type='submit' name='cancel' value='Cancel' class='btn4'/>
									<input type='submit' name='update' value='Update' class='btn4'/><br><br>
								</div>
							</td>
						</tr>
					</table>
				</form>
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

<?php
	if(isset($_POST['cancel'])){
		echo "<script>window.open('index.php','_self')</script>";
	}
	else if(isset($_POST['update'])){
		
		$psw = $_POST['psw'];
		$n_psw = $_POST['n_psw'];
		$c_psw = $_POST['c_psw'];
		
		include('../dbconnect.php');
					
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
			include('../dbconnect.php');
			
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