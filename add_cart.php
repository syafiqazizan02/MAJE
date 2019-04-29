<?php
session_start();
include('interface.php');
include('function.php');

if (isset($_POST['add_cart'])){
	$id = $_POST['id'];
	$size = $_POST['size'];
	$qty = $_POST['qty'];

	if($size==""){
		echo "<script>alert('Please select your size first!');window.history.go(-1);</script>";
	}
	else if($qty==0){
		echo "<script>alert('Please insert the quantity!');window.history.go(-1);</script>";
	}
	else{
		include('dbconnect.php');
		$ip = getIp();	
			
		$sql="select * from cart where user_ip='$ip' AND pro_id='$id' AND size = '$size'";
			
		$run_pro = mysql_query($sql);

		$count = mysql_num_rows($run_pro);

		if($count==0)
		{
			$sql="INSERT INTO cart (pro_id, user_ip, size, qty) VALUES ('$id', '$ip', '$size', '$qty')";
			
			$insert_pro=mysql_query($sql);
			
			if($insert_pro){
				echo "<script>alert('Product Has Add To Cart!')</script>";
				echo "<script>window.history.go(-1);</script>";
			}
		}
		else
		{	
			echo "<script>alert('Product are already add to cart!')</script>";
			echo "<script>window.history.go(-1);</script>";
		}
		mysql_close($con);
	}
}
else if(isset($_POST['back'])){
	$id = $_POST['id'];
	
	echo "<script>window.open('product.php','_self')</script>";
}	

if (isset($_POST['plus'])){
	$id = $_POST['id'];
	$size = $_POST['size'];
	$qty = $_POST['qty'];
	
	$t_qty = $qty+1;
	
	include('dbconnect.php');
	$ip = getIp();
	
	$sql = "select * from products where product_id='$id'";
		
	$run_pro = mysql_query($sql);
						
	while($row_pro = mysql_fetch_array($run_pro)){
	
		$xs = $row_pro['XS'];
		$s = $row_pro['S'];
		$m = $row_pro['M'];
		$l = $row_pro['L'];
		$xl = $row_pro['XL'];
		
	}
	
	if($size=='XS'){
		$stock=$xs;
	}
	else if($size=='S'){
		$stock=$s;
	}
	else if($size=='M'){
		$stock=$m;
	}
	else if($size=='L'){
		$stock=$l;
	}
	else{
		$stock=$xl;
	}
	
	if($stock==0){
		$sql = "DELETE from cart where user_ip='$ip' AND pro_id='$id' AND size='$size'";
		
		$run_delete = mysql_query($sql);
			
		$count= total_value();
			
		if($run_delete){
			echo "<script>alert('Product are sold out!')</script>";
			if($count==0)
			{
				echo "<script>window.open('product.php','_self')</script>";
			}
			else{
				echo "<script>window.open('cart.php','_self')</script>";
			}
		}
	}
	else if($t_qty>$stock){
		$t_qty=$stock;
	}
	
	$sql="UPDATE cart SET qty='$t_qty' WHERE pro_id='$id' AND user_ip='$ip' AND size='$size'";
			
	$insert_pro=mysql_query($sql);
	
	if($insert_pro){
		echo "<script>window.open('cart.php','_self')</script>";
	}
}
if (isset($_POST['minus'])){
	$id = $_POST['id'];
	$size = $_POST['size'];
	$qty = $_POST['qty'];
	
	$t_qty = $qty-1;
	
	include('dbconnect.php');
	$ip = getIp();
	
	$sql = "select * from products where product_id='$id'";
		
	$run_pro = mysql_query($sql);
						
	while($row_pro = mysql_fetch_array($run_pro)){
	
		$xs = $row_pro['XS'];
		$s = $row_pro['S'];
		$m = $row_pro['M'];
		$l = $row_pro['L'];
		$xl = $row_pro['XL'];
		
	}
	
	if($size=='XS'){
		$stock=$xs;
	}
	else if($size=='S'){
		$stock=$s;
	}
	else if($size=='M'){
		$stock=$m;
	}
	else if($size=='L'){
		$stock=$l;
	}
	else{
		$stock=$xl;
	}
	
	if($stock==0){
		$sql = "DELETE from cart where user_ip='$ip' AND pro_id='$id' AND size='$size'";
		
		$run_delete = mysql_query($sql);
			
		$count= total_value();
			
		if($run_delete){
			echo "<script>alert('Product are sold out!')</script>";
			if($count==0)
			{
				echo "<script>window.open('product.php','_self')</script>";
			}
			else{
				echo "<script>window.open('cart.php','_self')</script>";
			}
		}
	}
	else if($t_qty<1){
		$t_qty=1;
	}
	
	$sql="UPDATE cart SET qty='$t_qty' WHERE pro_id='$id' AND user_ip='$ip' AND size='$size'";
			
	$insert_pro=mysql_query($sql);
	
	if($insert_pro){
		echo "<script>window.open('cart.php','_self')</script>";
	}
}
?>