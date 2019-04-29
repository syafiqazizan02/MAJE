<?php

function header_menu(){
	echo'<div class="header">
			<a href="../index.php"><img id="logo" src="../css/logo.png"  width="1100" height="150"/></a>
		</div>';
}

function header_menubar(){
	echo'<div class="menubar">

			<div class="menu"><a href="../index.php">Home</a></div>
			<div class="menu"><a href="../product.php">All Collection</a></div>
			<div class="menu"><a href="../cart.php">Shopping Cart</a></div>
			<div class="menu"><a href="index.php">My Account</a></div>
			<div class="menu"><a href="../about.php">About Us</a></div>
			
			<form method="get" action="../product.php" enctype="multipart/form-data" class="search">
				<input type="text" name="pro_name" placeholder="Search a Product"/>
				<input type="submit" name="search" value="Search"/>
			</form>
			
		</div>';
}

function sidebar(){
	
	if(isset($_GET['gender']) AND isset($_GET['category'])){

		$gender=$_GET['gender'];
		$category=$_GET['category'];
		
		if($gender=="Men"){
			echo'<div class="sidebar_title">GENDER</div>
					<div class="sidebar_item">
						<a href="../product.php?gender=Men&category='.$category.'"><b><font color="#FF8C00">Men</font></b></a>
					</div>
					<div class="sidebar_item">
						<a href="../product.php?gender=Women&category='.$category.'">Women</a>
					</div>
				<div class="sidebar_title">CATEGORIES</div>';
		}
		else if($gender=="Women"){
			echo'<div class="sidebar_title">GENDER</div>
					<div class="sidebar_item">
						<a href="../product.php?gender=Men&category='.$category.'">Men</a>
					</div>
					<div class="sidebar_item">
						<a href="../product.php?gender=Women&category='.$category.'"><b><font color="#FF8C00">Women</font></b></a>
					</div>
				<div class="sidebar_title">CATEGORIES</div>';
		}
		else{
			echo'<div class="sidebar_title">GENDER</div>
					<div class="sidebar_item">
						<a href="../product.php?gender=Men&category='.$category.'">Men</a>
					</div>
					<div class="sidebar_item">
						<a href="../product.php?gender=Women&category='.$category.'">Women</a>
					</div>
				<div class="sidebar_title">CATEGORIES</div>';
		}
		
		include('../dbconnect.php');
		
		$sql = "select * from category";
	
		$run_pro = mysql_query($sql);
		
		while($row_pro=mysql_fetch_array($run_pro))
		{	
			$cat_name = $row_pro['cat_name'];
		
			if($category==$cat_name){
				echo'<div class="sidebar_item">
						<a href="../product.php?gender='.$gender.'&category='.$cat_name.'"><b><font color="#FF8C00">'.$cat_name.'</font></b></a>
					</div>';
			}
			else{
				echo'<div class="sidebar_item">
						<a href="../product.php?gender='.$gender.'&category='.$cat_name.'">'.$cat_name.'</a>
					</div>';
			}
		}
		mysql_close($con);
	}
	else{
		echo'<div class="sidebar_title">GENDER</div>
				<div class="sidebar_item">
					<a href="../product.php?gender=Men&category=">Men</a>
				</div>
				<div class="sidebar_item">
					<a href="../product.php?gender=Women&category=">Women</a>
				</div>
			<div class="sidebar_title">CATEGORIES</div>';
				
			include('../dbconnect.php');
		
			$sql = "select * from category";
		
			$run_pro = mysql_query($sql);
			
			while($row_pro=mysql_fetch_array($run_pro))
			{	
				$cat_name = $row_pro['cat_name'];
			
				echo'<div class="sidebar_item">
						<a href="../product.php?gender=&category='.$cat_name.'">'.$cat_name.'</a>
					</div>';
			}
			mysql_close($con);
	}
}

function bar(){
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
		echo '<center>Welcome <b style="color: yellow;">'.$_SESSION['name'].'</b> ! </center>';
	}
	else
	{
		echo 'Welcome to <b style="color: yellow;">MAJE Online Cothing System</b> ! ';
		echo '<a href = "../login.php"><input name="login" type="button" value="Login" class="btn3"></a>';
	}
}

function footer(){
	echo'<div class="footer">
			<h3>&copy; 2016 by MAJE ONLINE CLOTHING</h3>
		</div>';
}

?>