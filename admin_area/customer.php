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
					
					<?php
						if(!isset($_POST['name'])){
							$_POST['name'] = "";
						}
					?>
					
					<br><h2 align="center">Customer</h2><br>
					
					<table align='center' border='0' width="80%">
					<tr>
						<td colspan="6">
						<form method="post" action="customer.php" enctype="multipart/form-data" class="search">
						<input type="text" name="name" value="<?php echo $_POST['name']; ?>" placeholder="Search by Email or Ic"/>
						<input type="submit" name="search" value="Search"/>
						</form>	
						</td>
					</tr>
					
					
					<?php
					include('../dbconnect.php');
					
					if(isset($_POST['search'])){
						
						$name = $_POST['name'];
						
						$sql = "select * from customer where email like '%$name%' OR ic like '%$name%'";
					}
					else{
						$sql = "select * from customer";
					}
					
					$i = 0;
					
					$run = mysql_query($sql);
					
					$count = mysql_num_rows($run);
		
					if($count==0){
						echo "</table><div class='text'><br><br><br>No customer where found!</div>";
					}else{
						
						echo' <tr  bgcolor="#FF8C00" height="30">
									<th>Image</th>
									<th>Email</th>
									<th>Ic</th>
									<th>Gender</th>
									<th>Phone</th>
									<th>Detail</th>
								</tr>';
					while($row=mysql_fetch_array($run))
					{
						$c_id = $row['c_id'];
						$email = $row['email'];
						$gender = $row['gender'];
						$ic = $row['ic'];
						$image =$row['image'];
						$city = $row['city'];
						$phone1 = $row['phone1'];
						$phone2 = $row['phone2'];
						
						$i++;
						
						if($i%2==0)
						{
							$color = "#CCCCCC";
						}
						else
						{
							$color = "#ebebe0";
						}
						
						echo "
							<tr align='center' bgcolor='".$color."'>
								<td  width='100px'><img src='../customer/profile_image/$image' width='80px' height='100px'/></td>
								<td width='200px'>$email</td>
								<td width='150px'>$ic</td>
								<td width='80px'>$gender</td>
								<td width='130px'>$phone1<br>$phone2</td>
								<td width='80px'><a href='customer_info.php?c_id=$c_id'><button>View</button></a></td>
							</tr>";
					}
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
</html>