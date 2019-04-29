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
					
					<br><h2 align="center">Slider</h2>
					
					<div class="slide">
						<?php
							include('../dbconnect.php');
							
							$sql = "select * from slide ORDER BY id DESC";
						
							$run_pro = mysql_query($sql);
							
							while($row_pro=mysql_fetch_array($run_pro))
							{	
								$image = $row_pro['image'];
							
								echo'<a href="product.php"><img class="mySlides1" style="float:left;" src="slide_images/'.$image.'" width="1100px" height="620px"></a>';
							}
							mysql_close($con);
						?>
					</div>
						
						<script>
						var myIndex1 = 0;
						carousel();

						function carousel() {
							var i;
							var x = document.getElementsByClassName("mySlides1");
							for (i = 0; i < x.length; i++) {
							   x[i].style.display = "none";
							}
							
							myIndex1++;
							if (myIndex1 > x.length) {myIndex1 = 1}
							x[myIndex1-1].style.display = "block";
							setTimeout(carousel, 3000);
						}
						</script>
					
					<table align='center' border='0' width="1000px">
					
					<tr align="center" bgcolor="#FF8C00" height="35">
						<th width="30">Id</th>
						<th>Image</th>
					</tr>
					
					<?php
					include('../dbconnect.php');
					
					$sql = "select * from slide ORDER BY id DESC";
					
					$run = mysql_query($sql);
					
					$i = 0;
					
					while($row=mysql_fetch_array($run))
					{
						$id = $row['id'];
						$image = $row['image'];
						$i++;

						if($i%2==0)
						{
							$color = "#CCCCCC";
						}
						else
						{
							$color = "#ebebe0";
						}
						
						echo '<form action="slide.php" method="post" enctype="multipart/form-data">
							  <tr align="center" bgcolor="'.$color.'">
								<input type="hidden" name="id" value="'.$id.'"/>
								<td>'.$i.'</td>
								<td height="500px">
									<img src="slide_images/'.$image.'" style="border: 2px solid #000000;" width="600px" height="400px">
									<br/><input type="file" name="image" accept="image/*"/>
									<button type="submit" name="update" class="btn8"><img src="../css/update.png" width="40px" height="40px"/>Update</button>
									<button type="submit" name="delete" class="btn9" onclick="return confirm(\'Are you sure you want to delete?\')"><img src="../css/delete.png" width="40px" height="40px"/>Delete</button>
								</td>
							  </tr>
							  </form>';
					}
						
						if($i%2==0)
						{
							$color = "#ebebe0";
						}
						else
						{
							$color = "#CCCCCC";
						}
						
						echo '<form action="slide.php" method="post" enctype="multipart/form-data">
							  <tr align="center" bgcolor="'.$color.'" height="100px">
								<td></td>
								<td>
									<input type="file" name="image" accept="image/*"/>
									<button type="submit" name="insert" class="btn8"><img src="../css/new.png" width="40px" height="40px"/>Add Slider</button>
								</td>
							  </tr>';
					
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
</html>
<?php
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$slide_image = $_FILES['image']['name'];
		$slide_image_tmp = $_FILES['image']['tmp_name'];
			
		move_uploaded_file($slide_image_tmp,"slide_images/$slide_image");
		
		include('../dbconnect.php');
		
		if($slide_image!=""){
			
			$sql= "UPDATE slide SET image='$slide_image' WHERE id='$id'";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				
				echo "<script>alert('Slide Has been update!')</script>";
				mysql_close($con);
				echo "<script>window.open('slide.php','_self')</script>";
			}
		}
		
	}
	else if(isset($_POST['delete'])){
		$id = $_POST['id'];
	
		include('../dbconnect.php');
		
		$sql = "DELETE from slide WHERE id='$id'";
					
		$run = mysql_query($sql);
			
		if($run){
			
			echo "<script>alert('Slide Has been Delete!')</script>";
			mysql_close($con);
			echo "<script>window.open('slide.php','_self')</script>";
			
		}
	}
	else if(isset($_POST['insert'])){
		$slide_image = $_FILES['image']['name'];
		$slide_image_tmp = $_FILES['image']['tmp_name'];
			
		move_uploaded_file($slide_image_tmp,"slide_images/$slide_image");
		
		include('../dbconnect.php');
		
		if($slide_image!=""){
			
			$sql = "INSERT INTO slide (image) VALUES ('$slide_image')";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				
				echo "<script>alert('Slide Has been inserted!')</script>";
				mysql_close($con);
				echo "<script>window.open('slide.php','_self')</script>";
			}
		}
	}
?>