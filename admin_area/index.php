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
			<div class="product">
				<?php
					getPro();
				?>
			</div>
		</div>
	</div>
	<div class="sidebar">
		<?php
			sidebar();
		?>
		<div style="text-align:right; color:blue;"><a href="edit_category.php" ><u><br>Edit Categorise</u></a></div>
	</div>
	<?php
		footer();
	?>
</div>
</body>
</html>
