<?php
	session_start();
	include('interface.php');
	include('function.php');
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
		$user = $_SESSION['user'];
		
		if($user=="admin")
		{
			header('location:admin_area/index.php');
		}
	}
?>
<html>
<head>
<title>MAJE</title>
	<link rel="stylesheet" type="text/css" href="css/MAJE.css">
</head>
<body>
<div class="body">
	<?php
		header_menu();
		header_menubar();
	?>
	<div class="content">
		<div class="sidebar">
			<?php
				sidebar();
			?>
		</div>
		<div class="content_item">
			<div class="bar">
				<?php
					bar();
				?>
			</div>
			<div class="product">
				<?php
					getPro();
				?>
			</div>
		</div>
	</div>
	<?php
		footer();
	?>
</div>
</body>
</html>
