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
				<h2 align="center">History</h2>
				
				<p align="center">Mata Air Jaya Enterprise is a clothing company that was established in 2010 by Mr Adam Oii Bin Abdullah.</p>
				<p align="center">Our company provide tailoring service, printing service and selling clothing.</p><br>
				<h2 align="center">Contact</h2>
				<p align="center">+601124269778 (Office)</p><br>
				
				<h2 align="center">Location</h2>
				<p align="center">No.3B, Bangunan Kedai Taman Vistana Indah, Jalan Langgar, 06500 Alor Setar, KEDAH.</p><br>
				
				
				<h2 align="center">Maps</h2>
				<center><div id="map" style="width: 80%; height: 400px;"></div></center>
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
	<?php
		footer();
	?>
</div>
</body>
</html>