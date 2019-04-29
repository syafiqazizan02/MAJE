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
				<br><h2 align="center">Categories</h2>
					
					<table align='center' border='0'>
					
					<tr align="center" bgcolor="#FF8C00" height="35">
						<th width="30px">Id</th>
						<th width="300px">Category</th>
						<th width="360px">Edit</th>
					</tr>
					
					<?php
					include('../dbconnect.php');
					
					$sql = "select * from category";
					
					$run = mysql_query($sql);
					
					$i = 0;
					
					while($row=mysql_fetch_array($run))
					{
						$id = $row['cat_id'];
						$name = $row['cat_name'];
						$i++;

						if($i%2==0)
						{
							$color = "#CCCCCC";
						}
						else
						{
							$color = "#ebebe0";
						}
						
						echo '<form action="edit_category.php" method="post" enctype="multipart/form-data">
							  <tr align="center" bgcolor="'.$color.'" height="70px">
								<input type="hidden" name="id" value="'.$id.'"/>
								<td>'.$i.'</td>
								<td>'.$name.'</td>
								<td align="left">
									<input type="text" name="category" size="25"/>
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
						
						echo '<form action="edit_category.php" method="post" enctype="multipart/form-data">
							  <tr align="center" bgcolor="'.$color.'" height="70px">
								<td></td>
								<td colspan="2">
									<input type="hidden" name="id" value="'.$id.'"/>
									<input type="text" name="category" size="25"/>
									<button type="submit" name="insert" class="btn8"><img src="../css/new.png" width="40px" height="40px"/>Add Category</button>
								</td>
							  </tr>';
					
					mysql_close($con);
					?>
					</table>
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
	if(isset($_POST['update'])){
		$id = $_POST['id'];
		$category = $_POST['category'];
		
		include('../dbconnect.php');
		
		if($category!=""){
			
			$sql= "UPDATE category SET cat_name='$category' WHERE cat_id='$id'";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				
				echo "<script>alert('Category Has been update!')</script>";
				mysql_close($con);
				echo "<script>window.open('edit_category.php','_self')</script>";
			}
		}
		
	}
	else if(isset($_POST['delete'])){
		$id = $_POST['id'];
	
		include('../dbconnect.php');
		
		$sql = "DELETE from category WHERE cat_id='$id'";
					
		$run = mysql_query($sql);
			
		if($run){
			
			echo "<script>alert('Category Has been Delete!')</script>";
			mysql_close($con);
			echo "<script>window.open('edit_category.php','_self')</script>";
			
		}
	}
	else if(isset($_POST['insert'])){
		$id = $_POST['id'];
		$category = $_POST['category'];
		
		include('../dbconnect.php');
		
		if($category!=""){
			
			$sql = "INSERT INTO category (cat_name) VALUES ('$category')";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				
				echo "<script>alert('Category Has been inserted!')</script>";
				mysql_close($con);
				echo "<script>window.open('edit_category.php','_self')</script>";
			}
		}
	}
?>