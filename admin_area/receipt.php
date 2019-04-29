<?php
	if(isset($_POST['submit'])){
		$id = $_POST['id'];
		
		include('../dbconnect.php');
		
		$sql = "select * from payment where payment_id = '$id'";
		
		$run = mysql_query($sql);
		
		while($row=mysql_fetch_array($run))
		{
			$c_id = $row['c_id'];
			$trx_id = $row['trx_id'];
			$total = $row['amount'];
			$date = $row['date'];
		}
		
		$sql2 = "select * from customer where c_id='$c_id'";
					
		$run2 = mysql_query($sql2);
			
		while($row2=mysql_fetch_array($run2))
		{
			$email = $row2['email'];
			$name = $row2['name'];
			$address = $row2['address'];
			$phone1 = $row2['phone1'];
		}
?>
<html>
<head>
	<title>MAJE</title>
</head>
<body>
	<div>
		<center><img src="../mobile/css/logo.png" width="200px" height="80px"/><br>
		<b>Mata Air Jaya Enterprise</b><br>
		No.3B, Bangunan Kedai Taman Vistana Indah, Jalan Langgar,<br>
		06500 Alor Setar,<br>
		Kedah.<br>
		Contact : 01124269778</center>
		<br>
		<br>
	</div>
	
	<div style="float:right;">
		<b>Date :</b><br>
		<?php echo $date; ?>
		<br>
		<br>
		<b>Transaction ID :</b><br>
		<?php echo $trx_id; ?>
		<br>
		<br>
	</div>
	
	<div style="float:left;">
		<b><?php echo $name; ?></b><br>
		<?php echo $address; ?><br>
		Contact : <?php echo $phone1; ?><br>
		Email : <?php echo $email; ?>
		<br>
		<br>
		<br>
	</div>

	<table border="0" width="100%">
		<tr align="right">
			<th align="left">Description</th>
			<th width="120px">Price (RM)</th>
			<th width="80px">Quantity</th>
			<th width="120px">Amount (RM)</th>
		</tr>
		<tr>
			<td colspan="4"><hr></td>
		</tr>
		<?php 
		
			$sql3 = "select * from c_order WHERE payment_id='$id'";
							
			$run3 = mysql_query($sql3);
			
			$t_value=0;
			
			while($row3=mysql_fetch_array($run3))
			{
				$pro_name = $row3['pro_name'];
				$pro_size = $row3['pro_size'];
				$pro_price = $row3['pro_price'];
				$pro_qty = $row3['qty'];
				
				$value = $pro_price * $pro_qty;
				$t_value += $value;
				
				echo'<tr align="right">
						<td align="left">'.$pro_name.'</td>
						<td>'.number_format($pro_price, 2).'</td>
						<td>'.$pro_qty.'</td>
						<td>'.number_format($value, 2).'</td>
					</tr>';
			}
			mysql_close($con);
			
			$tax = $total - $t_value;
	}		
		?>
		<tr>
			<td colspan="4"><hr></td>
		</tr>
		<tr align="right">
			<td colspan="3">Subotal&nbsp;</td>
			<td><?php echo number_format($t_value, 2); ?></td>
		</tr>
		<tr align="right">
			<td colspan="3">Tax&nbsp;</th>
			<td><?php echo number_format($tax, 2); ?></td>
		</tr>
		<tr>
			<td colspan="4"><hr></td>
		</tr>
		<tr align="right">
			<th colspan="3">Total&nbsp;</th>
			<th><?php echo number_format($total, 2); ?></th>
		</tr>
		<tr>
			<td colspan="4"><hr></td>
		</tr>
	</table>

	<script>
		window.print();
	</script>
</body>
</html>
