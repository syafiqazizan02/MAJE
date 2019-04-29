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
		<div class="content_item1">
			<div class="bar">
				<?php
					bar();
				?>
			</div>
			<div class="slide">
				<?php
					include('dbconnect.php');
					
					$sql = "select * from slide ORDER BY id DESC";
				
					$run_pro = mysql_query($sql);
					
					while($row_pro=mysql_fetch_array($run_pro))
					{	
						$image = $row_pro['image'];
					
						echo'<a href="product.php"><img class="mySlides1" style="float:left;" src="admin_area/slide_images/'.$image.'" width="1100px" height="620px"></a>';
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
			
			
			<div class="item">
				<div class="sidebar_title">MEN</div>
				<br>
				<div style="margin-left: 50px;">
				<?php
				include('dbconnect.php');
				
				$sql = "select * from products where product_gender = 'Men' ORDER BY product_id DESC";

				$run_pro = mysql_query($sql);
				
				$count = mysql_num_rows($run_pro);
				
				$i=0;
					
				if($count==0){
					mysql_close($con);
					echo "<div class='text'>No clothing where found!</div>";
				}
				else{
					while($row_pro=mysql_fetch_array($run_pro))
					{	
						$pro_id = $row_pro['product_id'];
						$pro_name = $row_pro['product_name'];
						$pro_price = $row_pro['product_price'];
						$pro_image = $row_pro['product_image'];
						$xs = $row_pro['XS'];
						$s = $row_pro['S'];
						$m = $row_pro['M'];
						$l = $row_pro['L'];
						$xl = $row_pro['XL'];
					
						$stock = $xs + $s +$m + $l + $xl;
						
						if($stock>0)
						{
							$i++;
							
							if($i<=5){
								echo "<div class='product_box'>
										 <a href='product.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image' width='160px' height='200px'/>
										 <br><br><b>$pro_name</b>
										 <br><font color='red'><b>RM $pro_price</b></font></a>
									  </div>";
							}
						}
					}		
					mysql_close($con);
				}
			?>
				</div>
			</div>
			<div class="item">
				<div class="sidebar_title">WOMEN</div>
				<br>
				<div style="margin-left: 50px;">
				<?php
				include('dbconnect.php');
				
				$sql = "select * from products where product_gender = 'Women' ORDER BY product_id DESC";

				$run_pro = mysql_query($sql);
				
				$count = mysql_num_rows($run_pro);
				
				$i=0;
					
				if($count==0){
					mysql_close($con);
					echo "<div class='text'>No clothing where found!</div>";
				}
				else{
					while($row_pro=mysql_fetch_array($run_pro))
					{	
						$pro_id = $row_pro['product_id'];
						$pro_name = $row_pro['product_name'];
						$pro_price = $row_pro['product_price'];
						$pro_image = $row_pro['product_image'];
						$xs = $row_pro['XS'];
						$s = $row_pro['S'];
						$m = $row_pro['M'];
						$l = $row_pro['L'];
						$xl = $row_pro['XL'];
					
						$stock = $xs + $s +$m + $l + $xl;
						
						if($stock>0)
						{
							$i++;
							
							if($i<=5){
								echo "<div class='product_box'>
										 <a href='product.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image' width='160px' height='200px'/>
										 <br><br><b>$pro_name</b>
										 <br><font color='red'><b>RM $pro_price</b></font></a>
									  </div>";
							}
						}
					}		
					mysql_close($con);
				}
			?>
				</div>
			</div>
		</div>
	</div>
	<?php
		footer();
	?>
</div>
</body>
</html>