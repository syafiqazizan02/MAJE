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
			<div class='detail_text2'>
				<br><h2 align="center">Customer Detail</h2><br>
					
					<table align='center' border='0' class='table'>
					
					<?php
					include('../dbconnect.php');
					
					$sql = "select * from customer where c_id='".$_GET['c_id']."'";
					
					$run = mysql_query($sql);
			
					while($row=mysql_fetch_array($run))
					{
						$c_id = $row['c_id'];
						$name = $row['name'];
						$email = $row['email'];
						$gender = $row['gender'];
						$ic = $row['ic'];
						$image =$row['image'];
						$address = $row['address'];
						$poscode = $row['pos_code'];
						$city = $row['city'];
						$phone1 = $row['phone1'];
						$phone2 = $row['phone2'];
						
						echo "
							<tr>
								<td colspan='3'>
									<div style='text-align:center;'><br><img src='../customer/profile_image/$image' width='150px' height='180px'/><br><br></div>
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
									<br><br>";?>
									<form action="" method="post" enctype="multipart/form-data"/>
									<center>
										<input type='hidden' name='c_id' value='<?php echo $c_id; ?>'/>
										<button type='submit' name='back' class='btn8' style='width:180px;'><img src='../css/back.png' width='40px' height='40px'/>Back</button>
										<button type='submit' name='delete' class='btn9' style='width:180px;' onclick="return confirm('Are you sure you want to delete?')"><img src='../css/delete.png' width='40px' height='40px'/>Delete</button>
									</center>
									</form>
						<?php
							echo"
								</td>
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
	</div>
	<?php
		footer();
	?>
</div>
</body>
<?php
	if(isset($_POST['back'])){
		echo "<script>window.open('customer.php','_self')</script>";
	}
	else if(isset($_POST['delete'])){
		
		include('../dbconnect.php');
		
		$c_id = $_POST['c_id'];
		
		$sql = "DELETE from customer where c_id='".$c_id."'";
					
		$run = mysql_query($sql);
			
		if($run){
			echo "<script>alert('Account Has been Delete!')</script>";
			mysql_close($con);
			echo "<script>window.open('customer.php','_self')</script>";
		}
	}	
?>	
</html>