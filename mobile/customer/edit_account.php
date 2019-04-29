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
			
			<br><h3><center>Edit Account</h3></center><br>
			
			<div>
				<?php
					// define variables and set to empty values
					$nameErr = $emailErr = $icErr = $addressErr = $poscodeErr = $cityErr = $stateErr = $phone1Err = $phone2Err ="";
					$name = $email = $ic = $address = $poscode = $city = $state = $phone1 = $phone2 ="";

					if ($_SERVER["REQUEST_METHOD"] == "POST") {
					  if (empty($_POST["name"])) {
						$nameErr = "Name is required";
					  } else {
						$name = test_input($_POST["name"]);
					  }
					  
					  if (empty($_POST["email"])) {
						$emailErr = "Email is required";
					  } else {
						$email = test_input($_POST["email"]);
						// check if e-mail address is well-formed
						if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
						  $emailErr = "Invalid email format"; 
						}
						else{
							$my_email = $_SESSION['email'];
							
							if($email!=$my_email){
								include('../dbconnect.php');
								$query=mysql_query("select * from customer where email='$email'");
								$res=mysql_fetch_row($query);
								if($res){
									$emailErr = "This email already be used"; 
								}
							}
						}
					  }
					  
					  if (empty($_POST["ic"])) {
						$icErr = "IC Number is required";
					  } else {
						$ic = test_input($_POST["ic"]);
						 if (!preg_match('/^[0-9]{12}$/', $ic)) {
							 $icErr = "Invalid IC Number format";
						 }
					  }
					  
					  if (empty($_POST["address"])) {
						$addressErr = "Address is required";
					  } else {
						$address = test_input($_POST["address"]);
					  }
					
					 if (empty($_POST["poscode"])) {
						$poscodeErr = "Postcode is required";
					  } else{
						$poscode = test_input($_POST["poscode"]);
						 if (!preg_match('/^[0-9]{5}$/', $poscode)) {
							 $poscodeErr = "Invalid postcode format";
						 }
					  }
					
					 if (empty($_POST["city"])) {
						$cityErr = "City is required";
					  } else {
						$city = test_input($_POST["city"]);
						if (!preg_match("/^[a-zA-Z ]*$/",$city)){
						$cityErr = "Only letters and white space allowed"; 
						}
					  }
					 
					 if (empty($_POST["state"])) {
						$stateErr = "State is required";
					  } else {
						$state = test_input($_POST["state"]);
						if (!preg_match("/^[a-zA-Z ]*$/",$state)){
						$stateErr = "Only letters and white space allowed"; 
						}
					  }

					  if (empty($_POST["phone1"])) {
						$phone1Err = "Phone Number is required";
					  } else {
						$phone1 = test_input($_POST["phone1"]);
						 if (!preg_match('/^[0-9]{9,11}$/', $phone1)) {
							 $phone1Err = "Invalid Phone Number format";
						 }
					  }
					  if (!empty($_POST["phone2"])) {
						$phone2 = test_input($_POST["phone2"]);
						 if (!preg_match('/^[0-9]{9,11}$/', $phone2)) {
							 $phone2Err = "Invalid Phone Number format";
						 }
					  }
					}

					function test_input($data) {
					  $data = trim($data);
					  $data = stripslashes($data);
					  $data = htmlspecialchars($data);
					  return $data;
					}
				?>
				
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data"/>
					
					<table align='center' border='0' width="96%" style="max-width:450px;">
					
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
						
						echo "
							<tr>
								<td colspan='3'>
									<img src='../../customer/profile_image/$image' width='150px' height='180px'/>
									<input type='file' name='image' accept='image/*'><br><br>
								</td>
							</tr>
							<tr>
								<td width='110px' style='color: #808080;'>Name</td>
								<td width='10px' style='color: #808080;'>:</td>
								<td><input type='text' name='name' value='$name' class='form-control' aria-describedby='basic-addon1'/></td>
								<td width='5px'><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$nameErr</font></td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>Email</td>
								<td style='color: #808080;'>:</td>
								<td><input type='text' name='email' value='$email' class='form-control' aria-describedby='basic-addon1'/></td>
								<td><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$emailErr</font></td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>Gender</td>
								<td style='color: #808080;'>:</td>
								<td>";
								
							if($gender == 'Men')
							{
								echo"<select name='gender' style='width: 120px;' class='form-control'>
										<option value='Men'>Men</option>
										<option value='Women'>Women</option>
									</select>";
							}
							else
							{
								echo"<select name='gender' style='width: 120px;' class='form-control'>
										<option value='Women'>Women</option>
										<option value='Men'>Men</option>
									</select>";
							}	
						echo"	</td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>IC Number</td>
								<td style='color: #808080;'>:</td>
								<td><input type='text' name='ic' value='$ic' class='form-control' aria-describedby='basic-addon1'/></td>
								<td><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$icErr</font></td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>Address</td>
								<td style='color: #808080;'>:</td>
								<td><textarea name='address' class='form-control' aria-describedby='basic-addon1'>$address</textarea></td>
								<td><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$addressErr</font></td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>Postcode</td>
								<td style='color: #808080;'>:</td>
								<td><input type='text' name='poscode' value='$poscode' class='form-control' aria-describedby='basic-addon1'/></td>
								<td><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$poscodeErr</font></td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>City</td>
								<td style='color: #808080;'>:</td>
								<td><input type='text' name='city' value='$city' class='form-control' aria-describedby='basic-addon1'/></td>
								<td><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$cityErr</font></td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>State</td>
								<td style='color: #808080;'>:</td>
								<td><input type='text' name='state' value='$state' class='form-control' aria-describedby='basic-addon1'/></td>
								<td><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$stateErr</font></td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>Phone Number 1</td>
								<td style='color: #808080;'>:</td>
								<td><input type='text' name='phone1' value='$phone1' class='form-control' aria-describedby='basic-addon1'/></td>
								<td><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$phone1Err</font></td>
							</tr>
							<tr>
								<td colspan='4'><br><td>
							</tr>
							<tr>
								<td style='color: #808080;'>Phone Number 2</td>
								<td style='color: #808080;'>:</td>
								<td><input type='text' name='phone2' value='$phone2' class='form-control' aria-describedby='basic-addon1'/></td>
								<td><font class='error'>*</font></td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td colspan='2'><font class='error'>$phone2Err</font></td>
							</tr>
							<tr>
								<td colspan='3'>
									<div style='text-align:center;'><br><br><input type='submit' name='update' value='Update' class='btn4' style='width:120px;'/>
									<input type='submit' name='cancel' value='Cancel' class='btn4' style='width:120px;'/><br><br></div>
								</td>
							</tr>
							";
							
					}
					mysql_close($con);
					?>
					</table>
				</form>
			</div>
		</div>
	</div>
</body>
</html>
<?php
	if(isset($_POST['cancel'])){
		echo "<script>window.open('index.php','_self')</script>";
	}
	else if(isset($_POST['update'])){
		
		$name = $_POST['name'];
		$e_email = $_POST['email'];
		$gender = $_POST['gender'];
		$ic = $_POST['ic'];
		$address = $_POST['address'];
		$poscode = $_POST['poscode'];
		$city = $_POST['city'];
		$state = $_POST['state'];
		$phone1 = $_POST['phone1'];
		$phone2 = $_POST['phone2'];
		
		//getting image
		$image = $_FILES['image']['name'];
		$image_tmp = $_FILES['image']['tmp_name'];
		

		if($nameErr == "" AND $emailErr == "" AND $icErr == "" AND $addressErr == "" AND $poscodeErr == "" AND $cityErr == "" AND $stateErr == "" AND $phone1Err == "" AND $phone2Err == "" AND $image==""){
			include('../../dbconnect.php');
			
			$email=$_SESSION['email'];

			$sql= "UPDATE customer SET email='$e_email', name='$name', gender='$gender', ic='$ic', address='$address', pos_code='$poscode', city='$city', state='$state', phone1='$phone1', phone2='$phone2' WHERE email='$email'";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				if($e_email==$email)
				{	
					echo "<script>alert('Account Has been Update!')</script>";
					mysql_close($con);
					echo "<script>window.open('index.php','_self')</script>";
				}
				else
				{
					echo "<script>alert('Account Has been Update!')</script>";
					mysql_close($con);
					echo "<script>window.open('../logout.php','_self')</script>";
				}
			}
		}
		else if($nameErr == "" AND $emailErr == "" AND $icErr == "" AND $addressErr == "" AND $poscodeErr == "" AND $cityErr == "" AND $stateErr == "" AND $phone1Err == "" AND $phone2Err == ""){
			include('../../dbconnect.php');
			
			$email=$_SESSION['email'];

			$sql= "UPDATE customer SET email='$e_email', name='$name', gender='$gender', ic='$ic', image='$image', address='$address', pos_code='$poscode', city='$city', state='$state', phone1='$phone1', phone2='$phone2' WHERE email='$email'";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				move_uploaded_file($image_tmp,"../../customer/profile_image/$image");
				echo "<script>alert('Account Has been Update!')</script>";
				mysql_close($con);
				echo "<script>window.open('index.php','_self')</script>";
				
			}
		}
	}	
?>	