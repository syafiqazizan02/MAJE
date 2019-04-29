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
		<form method="get" action="index.php" enctype="multipart/form-data" class="search">
			<input type="text" name="pro_name" placeholder="Search a Product"/>
			<input type="submit" name="search" value="Search"/>
		</form>
	</div>
	<div class="content">
		<div class="content_item">
			<div class="bar2">
				<center>Welcome <b style="color: yellow;">BOSS</b> ! </center>
			</div>
			<div class='detail_text' style="float:none;">
				<?php
					$product_nameErr = $genderErr = $categoryErr = $product_priceErr = $product_detailErr = $imageErr = $xsErr = $sErr = $mErr = $lErr = $xlErr = "";
					$product_name = $gender = $category = $product_price = $product_detail = $image = $xs = $s = $m = $l = $xl = "";
					
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						
						if (empty($_POST["product_name"])) {
							$product_nameErr = "Product name is required";
						}
						else{
							$product_name = test_input($_POST["product_name"]);
						}
						
						if (empty($_POST["gender"])) {
							$genderErr = "Product gender is required";
						}
						else {
							$gender = test_input($_POST["gender"]);
						}
						
						if (empty($_POST["category"])) {
							$categoryErr = "Product category is required";
						}
						else {
							$category = test_input($_POST["category"]);
						}
					  
						if (empty($_POST["product_price"])) {
							$product_priceErr = "Product price is required";
						}
						else {
							$product_price = test_input($_POST["product_price"]);
							
							if(!preg_match('/^[0-9]+(\.[0-9]{1,2})?$/', $product_price)) {
								 $product_priceErr = "Invalid product price format";
							}
						}
						
						if (empty($_POST["product_detail"])) {
							$product_detailErr = "Product detail is required";
						}
						else{
							$product_detail = test_input($_POST["product_detail"]);
						}
						
						if (empty($_FILES['image']['name'])) {
							$imageErr = "Product image is required";
						}
						
						if (!empty($_POST["xs"])) {
							$xs = test_input($_POST["xs"]);
							if (!preg_match('/^[0-9]*$/', $xs)) {
								$xsErr = "Invalid quantiti format";
							}
						}
						
						if (!empty($_POST["s"])) {
							$s = test_input($_POST["s"]);
							if (!preg_match('/^[0-9]*$/', $s)) {
								$sErr = "Invalid quantiti format";
							}
						}
						
						if (!empty($_POST["m"])) {
							$m = test_input($_POST["m"]);
							if (!preg_match('/^[0-9]*$/', $m)) {
								$mErr = "Invalid quantiti format";
							}
						}
						
						if (!empty($_POST["l"])) {
							$l = test_input($_POST["l"]);
							if (!preg_match('/^[0-9]*$/', $l)) {
								$lErr = "Invalid quantiti format";
							}
						}
						
						if (!empty($_POST["xl"])) {
							$xl = test_input($_POST["xl"]);
							if (!preg_match('/^[0-9]*$/', $xl)) {
								$xlErr = "Invalid quantiti format";
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
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
					<table align='center' border='0' class='table'>
					<tr>
						<td style='color: #808080;'>Product Image</td>
						<td style='color: #808080;'>:</td>
						<td><input type="file" name="image" size="50" accept="image/*" /><font class="error">* <?php echo $imageErr;?></font></td>
					</tr>
					<tr>
						<td width='160' style='color: #808080;'>Product Name</td>
						<td width='15' style='color: #808080;'>:</td>
						<td width='280'><input type="text" name="product_name" size="50" value="<?php echo $product_name; ?>"/><font class="error">* <?php echo $product_nameErr;?></font></td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Gender</td>
						<td style='color: #808080;'>:</td>
						<td>
							<select name="gender" style="width: 120px;">
								<option value="">Select Gender</option>
								<option value="Men" <?php if($gender == 'Men'){ echo"selected"; } ?>>Men</option>
								<option value="Women" <?php if($gender == 'Women'){ echo"selected"; } ?>>Women</option>
							</select><font class="error">* <?php echo $genderErr;?></font>
						</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Category</td>
						<td style='color: #808080;'>:</td>
						<td>
							<select name="category" style="width: 120px;">
								<option value="">Select Category</option>
								<?php
									include('../dbconnect.php');
		
									$sql = "select * from category";
								
									$run_pro = mysql_query($sql);
									
									while($row_pro=mysql_fetch_array($run_pro))
									{	
										$cat_name = $row_pro['cat_name'];
										
										if($cat_name==$category){
											echo'<option value="'.$cat_name.'" selected/>'.$cat_name.'</option>';
										}
										else{
											echo'<option value="'.$cat_name.'"/>'.$cat_name.'</option>';
										}
									}
									mysql_close($con);
								?>
							</select><font class="error">* <?php echo $categoryErr;?></font>
						</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Description</td>
						<td style='color: #808080;'>:</td>
						<td><textarea name='product_detail' cols="45" rows="8"><?php echo $product_detail; ?></textarea><font class="error">* <?php echo $product_detailErr;?></font></td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Price</td>
						<td style='color: #808080;'>:</td>
						<td>RM&nbsp;&nbsp;<input type="text" name="product_price" value="<?php echo $product_price; ?>"/><font class="error">* <?php echo $product_priceErr;?></font></td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Size</td>
						<td style='color: #808080;'>:</td>
						<td>
							<table align='left' border='0' class='table' style='font-size:16px;'>
							<tr align='center'>
								<td style='color: #808080;'>XS</td>
								<td width='50px' style='color: #808080;'>x</td>
								<td><input type="text" name="xs" size="2" value="<?php echo $xs; ?>"/></td>
								<td><font class="error"> <?php echo $xsErr;?></font><td>
							</tr>
							<tr align='center'>
								<td style='color: #808080;'>S</td>
								<td style='color: #808080;'>x</td>
								<td><input type="text" name="s" size="2" value="<?php echo $s; ?>"/></td>
								<td><font class="error"> <?php echo $sErr;?></font><td>
							</tr>
							<tr align='center'>
								<td style='color: #808080;'>M</td>
								<td style='color: #808080;'>x</td>
								<td><input type="text" name="m" size="2" value="<?php echo $m; ?>"/></td>
								<td><font class="error"> <?php echo $mErr;?></font><td>
							</tr>
							<tr align='center'>
								<td style='color: #808080;'>L</td>
								<td style='color: #808080;'>x</td>
								<td><input type="text" name="l" size="2" value="<?php echo $l; ?>"/></td>
								<td><font class="error"> <?php echo $lErr;?></font><td>
							</tr>
							<tr align='center'>
								<td style='color: #808080;'>XL</td>
								<td style='color: #808080;'>x</td>
								<td><input type="text" name="xl" size="2" value="<?php echo $xl; ?>"/></td>
								<td><font class="error"> <?php echo $xlErr;?></font><td>
							</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan='3'>
							<br><br><center>
							<button type="submit" name="back" class="btn2" style="width:260px;"><img src="../css/back.png" width="40px" height="40px"/>Back</button>
							<button type="submit" name="insert_post" class="btn2" style="width:260px;"><img src="../css/new.png" width="40px" height="40px"/>Insert Product Now</button>
							</center>
						</td>
					</tr>
					</table>
				</form>
			</div>
		</div>
	</div>
	<div class="sidebar">
		<?php
			sidebar();
		?>
	</div>
	<?php
		footer();
	?>
</div>
</body>
</html>

<?php

	if (isset($_POST['insert_post'])){
		
		$product_name = $_POST['product_name'];
		$product_gender = $_POST['gender'];
		$product_category = $_POST['category'];
		$product_price = $_POST['product_price'];
		$product_detail = $_POST['product_detail'];
		$xs = $_POST['xs'];
		$s = $_POST['s'];
		$m = $_POST['m'];
		$l = $_POST['l'];
		$xl = $_POST['xl'];
		
		$product_image = $_FILES['image']['name'];
		$product_image_tmp = $_FILES['image']['tmp_name'];
		
		if($product_nameErr == "" AND $genderErr == "" AND $categoryErr == "" AND $product_priceErr == "" AND $product_detailErr == "" AND $imageErr == "" AND $xsErr == "" AND $sErr == "" AND $mErr == "" AND $lErr == "" AND $xlErr == ""){
			include('../dbconnect.php');

			$sql= "INSERT INTO products (product_id, product_gender, product_category, product_name, product_price, product_image, product_detail, XS, S, M, L, XL) VALUES (NULL, '$product_gender', '$product_category', '$product_name', '$product_price', '$product_image', '$product_detail','$xs','$s','$m','$l','$xl')";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				move_uploaded_file($product_image_tmp,"product_images/$product_image");
				echo "<script>alert('Product Has been inserted!')</script>";
				mysql_close($con);
				echo "<script>window.open('insert_product.php','_self')</script>";
				
			}
		}
	}
	else if(isset($_POST['back'])){
		echo "<script>window.open('index.php','_self')</script>";
	}	
?>	