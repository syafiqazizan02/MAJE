<?php
	
	session_start();
	
	include('function.php');
	
	if (isset($_GET['delete_cart']) && !empty($_GET['delete_cart']) AND isset($_GET['size']) && !empty($_GET['size'])){
		
		include('dbconnect.php');

		$ip = getIp();
		
		$id = $_GET['delete_cart'];
		$size = $_GET['size'];
		
		if($id=='all'){
			$sql = "DELETE from cart where user_ip='$ip'";
			
			$run_delete = mysql_query($sql);
			
			echo "<script>window.open('login.php','_self')</script>";
		}
		else{
			$sql = "DELETE from cart where user_ip='$ip' AND pro_id='$id' AND size='$size'";
		
			$run_delete = mysql_query($sql);
			
			$count= total_value();
			
			if($run_delete){
				echo "<script>alert('Product has been deleted!')</script>";
				if($count==0)
				{
					echo "<script>window.open('index.php','_self')</script>";
				}
				else{
					echo "<script>window.open('cart.php','_self')</script>";
				}
			}
		}
	}
?>