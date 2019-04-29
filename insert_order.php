<?php
	session_start();
	include('function.php');
	
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true)
	{
		$user = $_SESSION['user'];
		
		if($user=="admin")
		{
			header('location:admin_area/index.php');
		}
	}
	else
	{
		header('location:login.php');
	}
	
	$amount = $_GET['amt'];
	$currency = $_GET['cc'];
	$trx_id = $_GET['tx'];
	
	include('dbconnect.php');
	
	$query=mysql_query("select * from payment where trx_id= '$trx_id'");
	$res=mysql_fetch_row($query);
	if($res){
		echo "<script>window.open('customer/my_order.php','_self')</script>";
	}
	else{
		$sql = "select * from customer where email='".$_SESSION['email']."'";
						
		$run = mysql_query($sql);
				
		while($row=mysql_fetch_array($run)){
			$id = $row['c_id'];
		}
		
		$sql = "INSERT INTO payment (c_id, amount, currency, trx_id, date ,status) VALUES ('$id', '$amount', '$currency', '$trx_id', NOW() ,'0')";
				
		$insert_pro=mysql_query($sql);
		
		$sql = "select * from payment where c_id='$id' AND trx_id= '$trx_id'";
						
		$run = mysql_query($sql);
				
		while($row=mysql_fetch_array($run)){
			$payment_id = $row['payment_id'];
		}
		
		$ip = getIp();
		
		$sql = "select * from cart where user_ip='$ip'";
		
		$run_pro = mysql_query($sql);

		while($row_pro = mysql_fetch_array($run_pro)){
		
			$pro_id = $row_pro['pro_id'];
			$pro_size = $row_pro['size'];
			$pro_qty = $row_pro['qty'];
		
			$sql = "select * from products where product_id='$pro_id'";
			
			$run_pro2 = mysql_query($sql);
			
			while($row_pro2 = mysql_fetch_array($run_pro2)){
			
				$pro_name = $row_pro2['product_name'];
				$pro_price = $row_pro2['product_price'];
				$stock = $row_pro2["$pro_size"];

			
				$values = $pro_price * $pro_qty;
				
				$left = $stock - $pro_qty;
				
				$sql= "UPDATE products SET $pro_size = '$left' WHERE product_id='$pro_id'";
			
				$update_pro=mysql_query($sql);
				
				$sql = "INSERT INTO c_order (payment_id	,c_id, pro_name, pro_size, pro_price, qty, date) VALUES ('$payment_id', '$id', '$pro_name', '$pro_size', '$pro_price', '$pro_qty', NOW())";
				
				$insert_pro=mysql_query($sql);
				
				if($insert_pro){
					$sql = "DELETE from cart where user_ip='$ip'";
					$run_delete = mysql_query($sql);
					
					echo "<script>window.open('customer/my_order.php','_self')</script>";
				}
			}
		}
	}
	mysql_close($con);
?>