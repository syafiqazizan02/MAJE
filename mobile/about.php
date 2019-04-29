<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
{
	$user = $_SESSION['user'];
		
	if($user=="admin")
	{
		header('location:../admin_area/index.php');
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MAJE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.css">
  <link rel="stylesheet" href="bootstrap-3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/mobile.css">
  <script src="js/jquery.js"></script>
  <script src="bootstrap-3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<div style='min-width:285px;'>
		<nav class="navbar navbar-custom navbar-fixed-top" style='min-width:285px;' id="my-navbar">
			<div class="navbar-header">
			
				<a href="index.php"><img src="css/logo.png" width="150px" height="50px"/></a>

				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			
			<div class="collapse navbar-collapse" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="index.php">Home</a></li>
					<li><a href="product.php?gender=&category=">All Collection</a></li>
					<li><a href="cart.php">Shopping Cart</a></li>
					<li><a href="login.php">My Account</a></li>
					<li class="active"><a href="about.php">About Us</a></li>
				</ul>
			</div>
		</nav>
		
		<div style="margin-top: 70px;">
		
			<h2 align="center">History</h2>
			<center>Mata Air Jaya Enterprise is a clothing company that was established in 2010 by Mr Adam Oii Bin Abdullah.
				<br>Our company provide tailoring service, printing service and selling clothing.</center>
				
			<h2 align="center">Contact</h2>
			<center>+601124269778 (Office)</center>
				
			<h2 align="center">Location</h2>
			<center>No.3B, Bangunan Kedai Taman Vistana Indah, Jalan Langgar, 06500 Alor Setar, KEDAH.</center>
				
			<h2 align="center">Maps</h2>
			<center><div id="map" style="width: 100%; height: 350px;"></div></center>
			<script>
			  function initMap() {
				var mapDiv = document.getElementById('map');
				var map = new google.maps.Map(mapDiv, {
					center: {lat: 6.151280, lng:100.408430},
					zoom: 15
				});
				
				var marker = new google.maps.Marker({
						position:{lat: 6.151280, lng:100.408430},	
						title: "Hello world!"
					});       
					marker.setMap(map);
			  }
			</script>
			<script async defer
				src="https://maps.googleapis.com/maps/api/js?key=AIzaSyACtxK0rMnltF8U6OFq3N7pX3A6qI83Ero&callback=initMap">
			</script>
			
		</div>
	</div>
</body>
</html>