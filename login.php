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
	else
	{
		header('location:index.php');
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
		<div class = "content_1">
			
			<center><h2>Login or Register to Buy!<h2></center><br>
			
			<form action='login.php' method='post'>
			<table align="center" border="0">
				<tr>
					<th width="100px">Email</th>
					<th width="30px">:</th>
					<td><input name='email' type='text' class="tf" placeholder="example@email.com"></td>
				</tr>
					<th>Password</th>
					<th>:</th>
					<td><input type='password' name='password' class="tf" placeholder="password"></td>
				</tr>
				<tr>
					<td colspan="3">
						<br><center><input name="login" type="submit" value="Login" class = "btn"></center>
					<td>
				</tr>
			</table>
			</form>
		</div>
			<div class="account">
				<br><a href="customer/register.php">New Register Here<a/>
			</div>
	</div>
</div>
	<?php
		footer();
	?>
</div>
</body>
</html>

<?php
if(isset($_POST['signup']))
{
	header('location:customer/register.php');
}
else if(isset($_POST['login']))
{
	$email=$_POST['email'];
	$pwd=$_POST['password'];
	if($email!=''&& $pwd!='')
	{
		include('dbconnect.php');
		$query=mysql_query("select * from admin where id='$email' and password='$pwd'");
		$res=mysql_fetch_row($query);
		if($res){
			$_SESSION['loggedin'] = true;
			$_SESSION['user']="admin";
			$_SESSION['email']=$email;
			mysql_close($con);
			header('location:admin_area/index.php');
		}
		else{
			$query=mysql_query("select * from customer where email='$email' and psw='$pwd'");
			$res=mysql_fetch_row($query);
			if($res)
			{	
				$query=mysql_query("select * from customer where email='$email' and psw='$pwd'");
				while($row=mysql_fetch_array($query)){
					$email = $row['email'];
					$name = $row['name'];
				
					$_SESSION['loggedin'] = true;
					$_SESSION['email']=$email;
					$_SESSION['name']=$name;
					$_SESSION['user']="customer";
					$_SESSION['drives']="pc";
				}
				mysql_close($con);
				
				$count= total_value();
	
				if($count==0)
				{
					header("location:customer/index.php");
				}
				else
				{
					header('location:check_out.php');
				}
			}
			else
			{
				mysql_close($con);
				echo "<script>alert('Your Email or Password is Incorrect!')</script>";
			}
		}
	}
	else
	{
		 echo "<script>alert('Please enter your Email and Password!')</script>";
	}
}

?>