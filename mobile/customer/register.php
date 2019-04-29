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
			
			<br><h3><center>Register New Account</h3></center><br>
			
			<?php
					// define variables and set to empty values
					$nameErr = $emailErr = $pswErr = $c_pswErr = $genderErr = $icErr = $imageErr = $addressErr = $poscodeErr = $cityErr = $stateErr = $phone1Err = $phone2Err ="";
					$name = $email = $psw = $c_psw = $gender = $ic = $address = $poscode = $city = $state = $phone1 = $phone2 ="";

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
							include('../../dbconnect.php');
							$query=mysql_query("select * from customer where email='$email'");
							$res=mysql_fetch_row($query);
							if($res){
								$emailErr = "This email already be used"; 
							}
						}
					  }
					  
					  if (empty($_POST["psw"])) {
						$pswErr = "Password is required";
					  }

					  if (empty($_POST["c_psw"])) {
						$c_pswErr = "Password is required";
					  }
					  
					  if(!empty($_POST["psw"]) AND !empty($_POST["c_psw"])){
						  $psw = test_input($_POST["psw"]); 
						  $c_psw = test_input($_POST["c_psw"]);
						  
						  if($psw!=$c_psw){
							$c_pswErr = "Your password are no same";
						  }
					  }
					 
					  if (empty($_POST["gender"])) {
						$genderErr = "Gender is required";
					  } else {
						$gender = test_input($_POST["gender"]);
					  }
					  
					  if (empty($_POST["ic"])) {
						$icErr = "IC Number is required";
					  } else {
						$ic = test_input($_POST["ic"]);
						 if (!preg_match('/^[0-9]{12}$/', $ic)) {
							 $icErr = "Invalid IC Number format";
						 }
					  }
					  
					  if (empty($_FILES['image']['name'])) {
						$imageErr = "Profile image is required";
					  }
					  
					  if (empty($_POST["address"])) {
						$addressErr = "Address is required";
					  } else {
						$address = test_input($_POST["address"]);
					  }
					
					 if (empty($_POST["poscode"])) {
						$poscodeErr = "Poscode is required";
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
					<tr>
						<td width='120px' style='color: #808080;'>Profile Image</td>
						<td width='10px' style='color: #808080;'>:</td>
						<td><input type="file" name="image" accept="image/*" /></td>
						<td  width='5px'><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $imageErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Name</td>
						<td style='color: #808080;'>:</td>
						<td><input type='text' name='name' value='<?php echo $name; ?>' class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $nameErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Email</td>
						<td style='color: #808080;'>:</td>
						<td><input type='text' name='email' value='<?php echo $email; ?>' class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $emailErr; ?> e.g : example@email.com</font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Password</td>
						<td style='color: #808080;'>:</td>
						<td><input type="password" name="psw" class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $pswErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Comfirm Password</td>
						<td style='color: #808080;'>:</td>
						<td><input type="password" name="c_psw" class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $c_pswErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Gender</td>
						<td style='color: #808080;'>:</td>
						<td>
							<select name="gender" style="width: 160px;" class='form-control'>
								<option value="">Select Gender</option>
								<option value="Men" <?php if($gender == 'Men'){ echo"selected"; } ?> >Men</option>
								<option value="Women" <?php if($gender == 'Women'){ echo"selected"; } ?>>Women</option>
							</select>
						</td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $genderErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>IC Number</td>
						<td style='color: #808080;'>:</td>
						<td><input type='text' name='ic' value='<?php echo $ic; ?>' class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $icErr; ?> e.g : 770102095030</font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Address</td>
						<td style='color: #808080;'>:</td>
						<td><textarea name='address' class='form-control' aria-describedby='basic-addon1'><?php echo $address; ?></textarea></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $addressErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Postcode</td>
						<td style='color: #808080;'>:</td>
						<td><input type='text' name='poscode' value='<?php echo $poscode; ?>' class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $poscodeErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>City</td>
						<td style='color: #808080;'>:</td>
						<td><input type='text' name='city' value='<?php echo $city; ?>' class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $cityErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>State</td>
						<td style='color: #808080;'>:</td>
						<td><input type='text' name='state' value='<?php echo $state; ?>' class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $stateErr; ?></font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Phone Number 1</td>
						<td style='color: #808080;'>:</td>
						<td><input type='text' name='phone1' value='<?php echo $phone1; ?>' class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $phone1Err; ?> e.g : 0123456789</font></td>
					</tr>
					<tr>
						<td colspan='4'><br><td>
					</tr>
					<tr>
						<td style='color: #808080;'>Phone Number 2</td>
						<td style='color: #808080;'>:</td>
						<td><input type='text' name='phone2' value='<?php echo $phone2; ?>' class='form-control' aria-describedby='basic-addon1'/></td>
						<td><font class='error'>*</font></td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td colspan='2'><font class='error'><?php echo $phone2Err; ?> e.g : 0123456789</font></td>
					</tr>
					<tr>
						<td colspan='4'>
							<br>
						</td>
					</tr>
					<tr>
						<td colspan='4'>
							<center><input type="submit" name="register" value="Register" class='btn4'/>
							<input type="submit" name="back" value="Back" class='btn4'/></center>
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</body>
</html>			

<?php

	if (isset($_POST['register'])){
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$psw = $_POST['psw'];
		$c_psw = $_POST['c_psw'];
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
		
		if($nameErr == "" AND $emailErr == "" AND $pswErr == "" AND $c_pswErr == "" AND $genderErr == "" AND $icErr == "" AND $imageErr == "" AND $addressErr == "" AND $poscodeErr == "" AND $cityErr == "" AND $phone1Err == "" AND $phone2Err == ""){
			include('../../dbconnect.php');

			$sql= "INSERT INTO customer (email, psw, name, gender, ic, image, address, pos_code, city, state, phone1, phone2) VALUES ('$email', '$psw', '$name', '$gender', '$ic', '$image', '$address', '$poscode', '$city', '$state', '$phone1', '$phone2')";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				move_uploaded_file($image_tmp,"../../customer/profile_image/$image");
				echo "<script>alert('Account Has been Register!')</script>";
				mysql_close($con);
				echo "<script>window.open('../login.php','_self')</script>";
				
			}
		}
	}
	else if(isset($_POST['back']))
	{
		echo "<script>window.open('../login.php','_self')</script>";
	}
?>	