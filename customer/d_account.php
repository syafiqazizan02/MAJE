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
				<form action="d_account.php" method="post" enctype="multipart/form-data"/>
				
					<br><h2 align="center">Delete Account</h2><br><br><br>
					
					
				<h3 style="text-align:center;">Do you really want to DELETE your account?</h3><br>

				
				<center><input type="submit" name="yes" value="Yes I want" onclick="return confirm('Are you sure you want to delete?')" class='btn4'/>
				<input type="submit" name="no" value="No, I change my mind" class='btn4'/></center>

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
					<a href="d_account.php">Delete Account</a>
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
	if(isset($_POST['no'])){
		echo "<script>window.open('index.php','_self')</script>";
	}
	else if(isset($_POST['yes'])){
		
		include('../dbconnect.php');
					
		$sql = "DELETE from customer where email='".$_SESSION['email']."'";
					
		$run = mysql_query($sql);
			
		if($run){
			
			echo "<script>alert('Your Account Has been Delete!')</script>";
			mysql_close($con);
			echo "<script>window.open('../logout.php','_self')</script>";
			
		}
	}	
?>	