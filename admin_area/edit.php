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
				<center>Welcome <b style="color: yellow;font-size: 20px;">BOSS</b> ! </center>
			</div>
			<div class="product">
				<?php
					$product_nameErr = $product_priceErr = $product_detailErr = $xsErr = $sErr = $mErr = $lErr = $xlErr = "";
					$product_name = $product_price = $product_detail = $xs = $s = $m = $l = $xl = "";
					
					if ($_SERVER["REQUEST_METHOD"] == "POST") {
						
						if (empty($_POST["product_name"])) {
							$product_nameErr = "Product name is required";
						}
						else{
							$product_name = test_input($_POST["product_name"]);
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
						
						if (!empty($_POST["xs"])) {
							$xs = test_input($_POST["xs"]);
							if (!preg_match('/^[0-9,-]*$/', $xs)) {
								$xsErr = "Invalid quantiti format";
							}
						}
						
						if (!empty($_POST["s"])) {
							$s = test_input($_POST["s"]);
							if (!preg_match('/^[0-9,-]*$/', $s)) {
								$sErr = "Invalid quantiti format";
							}
						}
						
						if (!empty($_POST["m"])) {
							$m = test_input($_POST["m"]);
							if (!preg_match('/^[0-9,-]*$/', $m)) {
								$mErr = "Invalid quantiti format";
							}
						}
						
						if (!empty($_POST["l"])) {
							$l = test_input($_POST["l"]);
							if (!preg_match('/^[0-9,-]*$/', $l)) {
								$lErr = "Invalid quantiti format";
							}
						}
						
						if (!empty($_POST["xl"])) {
							$xl = test_input($_POST["xl"]);
							if (!preg_match('/^[0-9,-]*$/', $xl)) {
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
				
				if(isset($_GET['id']) && !empty($_GET['id'])){
					include('../dbconnect.php');
		
					$id = $_GET['id'];
					
					$sql = "select * from products where product_id = '$id'";
					
					$run_pro = mysql_query($sql);
					
					while($row_pro=mysql_fetch_array($run_pro))
					{	
						$pro_name = $row_pro['product_name'];
						$pro_gender = $row_pro['product_gender'];
						$pro_category = $row_pro['product_category'];
						$pro_price = $row_pro['product_price'];
						$pro_image = $row_pro['product_image'];
						$pro_detail = $row_pro['product_detail'];
						$xs = $row_pro['XS'];
						$s = $row_pro['S'];
						$m = $row_pro['M'];
						$l = $row_pro['L'];
						$xl = $row_pro['XL'];

						echo "<div class='single_product'>
								<div class='detail_img'>
									<img src='product_images/$pro_image' width='300px' height='400px'/>
								</div>
								<div class='detail_text'>
									<form action='edit.php?id=$id' method='post' enctype='multipart/form-data'>
									<table align='center' border='0' class='table'>
									<tr>
										<td style='color: #808080;'>Product Image</td>
										<td style='color: #808080;'>:</td>
										<td><input type='file' name='image' size='50' accept='image/*' /></td>
									</tr>
									<tr>
										<td width='160' style='color: #808080;'>Product Name</td>
										<td width='15' style='color: #808080;'>:</td>
										<td width='250'><input type='text' name='product_name' style='width:250px;' value='$pro_name'/><td><font class='error'>*</font></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td><font class='error'>$product_nameErr</font></td>
									</tr>
									<tr>
										<td style='color: #808080;'>Product Gender</td>
										<td style='color: #808080;'>:</td>
										<td>";
											if($pro_gender == 'Men')
											{
												echo"<select name='gender' style='width: 120px;'>
														<option value='Men'>Men</option>
														<option value='Women'>Women</option>
													</select>";
											}
											else
											{
												echo"<select name='gender' style='width: 120px;'>
														<option value='Women'>Women</option>
														<option value='Men'>Men</option>
													</select>";
											}
								echo"	</td>
									</tr>
									<tr>
										<td style='color: #808080;'>Product Category</td>
										<td style='color: #808080;'>:</td>
										<td>
											<select name='category' style='width: 120px;'>
												<option value='".$pro_category."'>".$pro_category."</option>";
														
												$sql = "select * from category";
			
												$run_pro = mysql_query($sql);
												
												while($row_pro=mysql_fetch_array($run_pro))
												{	
													$cat_name = $row_pro['cat_name'];
												
													if($pro_category!=$cat_name)
													echo"<option value='".$cat_name."'>".$cat_name."</option>";
												}
												
								echo"		</select>
										</td>
									</tr>
									<tr>
										<td style='color: #808080;'>Product Description</td>
										<td style='color: #808080;'>:</td>
										<td height='100'><textarea name='product_detail' style='width:250px;height:80px;'>$pro_detail</textarea><font class='error'>*</font></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td><font class='error'>$product_detailErr</font></td>
									</tr>
									<tr>
										<td style='color: #808080;'>Product Price</td>
										<td style='color: #808080;'>:</td>
										<td>RM&nbsp;&nbsp;<input type='text' name='product_price' value='$pro_price'/><font class='error'>*</font></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td><font class='error'>$product_priceErr</font></td>
									</tr>
									<tr>
										<td style='color: #808080;'>Product Size</td>
										<td style='color: #808080;'>:</td>
										<td><table align='left' border='0' class='table' style='font-size:16px;'>
											<tr align='center'>
												<td style='color: #808080;'>XS</td>
												<td width='35px' style='color: #808080;'>x</td>
												<td>".$xs." </td>
												<td width='30px'>+<td>
												<td><input type='text' name='xs' size='2'/></td>
											</tr>
											<tr>
												<td colspan='5'><font class='error'> $xsErr</font></td>
											</tr>
											<tr align='center' >
												<td style='color: #808080;'>S</td>
												<td style='color: #808080;'>x</td>
												<td>".$s." </td>
												<td width='30px'>+<td>
												<td><input type='text' name='s' size='2'/></td>
											</tr>
											<tr>
												<td colspan='5'><font class='error'> $sErr</font></td>
											</tr>
											<tr align='center'>
												<td style='color: #808080;'>M</td>
												<td style='color: #808080;'>x</td>
												<td>".$m."</td>
												<td width='30px'>+<td>
												<td><input type='text' name='m' size='2'/></td>
											</tr>
											<tr>
												<td colspan='5'><font class='error'> $mErr</font></td>
											</tr>
											<tr align='center'>
												<td style='color: #808080;'>L</td>
												<td style='color: #808080;'>x</td>
												<td>".$l."</td>
												<td width='30px'>+<td>
												<td><input type='text' name='l' size='2'/></td>
											</tr>
											<tr>
												<td colspan='5'><font class='error'> $lErr</font></td>
											</tr>
											<tr align='center'>
												<td style='color: #808080;'>XL</td>
												<td style='color: #808080;'>x</td>
												<td>".$xl."</td>
												<td width='30px'>+<td>
												<td><input type='text' name='xl' size='2'/></td>
											</tr>
											<tr>
												<td colspan='5'><font class='error'> $xlErr</font></td>
											</tr>
											</table></td>
									</tr>
									<tr>
										<td colspan='3'>
											<br>
											<input type='hidden' name='id' value='$id'/>
											<center>
												<button type='submit' name='back' class='btn8' style='width:150px;'><img src='../css/back.png' width='40px' height='40px'/>Back</button>
												<button type='submit' name='update' class='btn8'><img src='../css/update.png' width='40px' height='40px'/>Update</button>
												<button type='submit' name='delete' class='btn9' onclick='return confirm(\"Are you sure you want to delete?\")'><img src='../css/delete.png' width='40px' height='40px'/>Delete</button>
											</center>
										</td>
									</tr>
								</table>
							  </div>";
					}
					mysql_close($con);
				}
				?>
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
	if (isset($_POST['update'])){

		$id = $_POST['id'];
		$product_name = $_POST['product_name'];
		$product_gender = $_POST['gender'];
		$product_category = $_POST['category'];
		$product_price = $_POST['product_price'];
		$product_detail = $_POST['product_detail'];
		$p_xs = $_POST['xs'];
		$p_s = $_POST['s'];
		$p_m = $_POST['m'];
		$p_l = $_POST['l'];
		$p_xl = $_POST['xl'];
		
		$product_image = $_FILES['image']['name'];
		$product_image_tmp = $_FILES['image']['tmp_name'];
		
		$total_xs = $xs + $p_xs;
		
		if($total_xs < 0){
			$total_xs = 0;
		}
		
		$total_s = $s + $p_s;
		
		if($total_s < 0){
			$total_s = 0;
		}
		
		$total_m = $m + $p_m;
		
		if($total_m < 0){
			$total_m = 0;
		}
		
		$total_l = $l + $p_l;
		
		if($total_l < 0){
			$total_l = 0;
		}
		
		$total_xl = $xl + $p_xl;
		
		if($total_xl < 0){
			$total_xl = 0;
		}
		
		
		if($product_nameErr == "" AND $product_priceErr == "" AND $product_detailErr == "" AND $xsErr == "" AND $sErr == "" AND $mErr == "" AND $lErr == "" AND $xlErr == "" AND $product_image==""){
			include('../dbconnect.php');

			$sql= "UPDATE products SET product_gender='$product_gender', product_category='$product_category', product_name='$product_name', product_price='$product_price', product_detail='$product_detail', XS='$total_xs', S='$total_s', M='$total_m', L='$total_l', XL='$total_xl' WHERE product_id='$id'";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				
				echo "<script>alert('Product Has been update!')</script>";
				mysql_close($con);
				echo "<script>window.open('index.php?pro_id=$id','_self')</script>";
			}
		}
		else if($product_nameErr == "" AND $product_priceErr == "" AND $product_detailErr == "" AND $xsErr == "" AND $sErr == "" AND $mErr == "" AND $lErr == "" AND $xlErr == ""){
			include('../dbconnect.php');

			$sql= "UPDATE products SET product_gender='$product_gender', product_category='$product_category', product_name='$product_name', product_price='$product_price', product_image='$product_image', product_detail='$product_detail', XS='$total_xs', S='$total_s', M='$total_m', L='$total_l', XL='$total_xl' WHERE product_id='$id'";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				move_uploaded_file($product_image_tmp,"product_images/$product_image");
				echo "<script>alert('Product Has been update!')</script>";
				mysql_close($con);
				echo "<script>window.open('index.php?pro_id=$id','_self')</script>";
				
			}
		}
	}
	else if(isset($_POST['delete'])){
		include('../dbconnect.php');
		
		$id = $_POST['id'];
		
		$sql = "DELETE from products WHERE product_id='$id'";
					
		$run = mysql_query($sql);
			
		if($run){
			
			echo "<script>alert('Product Has been Delete!')</script>";
			mysql_close($con);
			echo "<script>window.open('index.php','_self')</script>";
			
		}
	}
	else if(isset($_POST['back'])){
		$id = $_POST['id'];
		
		echo "<script>window.open('index.php?pro_id=$id','_self')</script>";
	}
?>
