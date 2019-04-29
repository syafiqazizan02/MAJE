<?php
function getPro(){
	if(isset($_GET['pro_id']) && !empty($_GET['pro_id'])){
		showDetail();
	}
	else if(isset($_GET['gender']) && empty($_GET['gender']) AND isset($_GET['category']) && !empty($_GET['category'])){
		$category = $_GET['category'];
	
		$sql = "select * from products where product_category = '$category' ORDER BY product_id DESC";
		showPro($sql);
	}
	else if(isset($_GET['gender']) && !empty($_GET['gender']) AND isset($_GET['category']) && !empty($_GET['category'])){
		$gender = $_GET['gender'];
		$category = $_GET['category'];
	
		$sql = "select * from products where product_gender = '$gender' AND product_category = '$category' ORDER BY product_id DESC";
		showPro($sql);
	}
	else if (isset($_GET['gender'])){
		$gender = $_GET['gender'];
	
		$sql = "select * from products where product_gender = '$gender' ORDER BY product_id DESC";
		showPro($sql);
	}	
	else if (isset($_GET['search'])){
		$search = $_GET['pro_name'];
	
		if($search==""){
			echo "<script>alert('Please enter the product name!')</script>";
			echo "<div class='text'>No clothing where found!</div>";
		}
		else{
			$sql = "select * from products where product_name like '%$search%' ORDER BY product_id DESC";
			showPro($sql);
		}
	}
	else{
		$sql = "select * from products ORDER BY product_id DESC";
		showPro($sql);
	}
}

function showDetail(){
	include('dbconnect.php');
		
	$id = $_GET['pro_id'];
	
	$sql = "select * from products where product_id = '$id'";
	
	$run_pro = mysql_query($sql);
	
	while($row_pro=mysql_fetch_array($run_pro))
	{	
		$pro_name = $row_pro['product_name'];
		$pro_gender = $row_pro['product_gender'];
		$pro_category = $row_pro['product_category'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];
		$pro_detail = $row_pro['product_detail'];
		$xs = $row_pro['XS'];
		$s = $row_pro['S'];
		$m = $row_pro['M'];
		$l = $row_pro['L'];
		$xl = $row_pro['XL'];
		
		$stock = $xs + $s +$m + $l + $xl;
		
		echo "<div class='single_product'>
				<div class='detail_img'>
					<img src='admin_area/product_images/$pro_image' width='300px' height='400px'/>
				</div>
				<div class='detail_text'>
					<table align='center' border='0' class='table'>
					<tr>
						<td width='160' style='color: #808080;'>Product Name</td>
						<td width='15' style='color: #808080;'>:</td>
						<td width='280'>&nbsp;$pro_name</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Gender</td>
						<td style='color: #808080;'>:</td>
						<td>&nbsp;$pro_gender</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Category</td>
						<td style='color: #808080;'>:</td>
						<td>&nbsp;$pro_category</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Description</td>
						<td style='color: #808080;'>:</td>
						<td>&nbsp;".preg_replace('/\r\n|\r/', '<br/>&nbsp;',$pro_detail)."</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Price</td>
						<td style='color: #808080;'>:</td>
						<td>&nbsp;RM&nbsp;$pro_price</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Size</td>
						<td style='color: #808080;'>:</td>
						<td>";
						
						if($xs>0){
							echo"<button onclick='xs()' class='btn5' id='xs'>XS</button>";
						}
						if($s>0){
							echo"<button onClick='s()' class='btn5' id='s'>S</button>";
						}
						if($m>0){
							echo"<button onClick='m()' class='btn5' id='m'>M</button>";
						}
						if($l>0){
							echo"<button onClick='l()' class='btn5' id='l'>L</button>";
						}
						if($xl>0){
							echo"<button onClick='xl()' class='btn5' id='xl'>XL</button>";
						}
						
						
						
					echo"							
							<input type='hidden' id='stock_xs' value='$xs'/>
							<input type='hidden' id='stock_s' value='$s'/>
							<input type='hidden' id='stock_m' value='$m'/>
							<input type='hidden' id='stock_l' value='$l'/>
							<input type='hidden' id='stock_xl' value='$xl'/>
							
							<script>
							function xs() {
								this.reset();
								document.getElementById('xs').style.color = '#FF4300';
								document.getElementById('xs').style.border = '2px solid #FF4300';
								document.getElementById('size').value = 'XS';
								var x = document.getElementById('stock_xs').value;
								document.getElementById('db_stock').value = x;
								document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
							}
							function s() {
								this.reset();
								document.getElementById('s').style.color = '#FF4300';
								document.getElementById('s').style.border = '2px solid #FF4300';
								document.getElementById('size').value = 'S';
								var x = document.getElementById('stock_s').value;
								document.getElementById('db_stock').value = x;
								document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
							}
							function m() {
								this.reset();
								document.getElementById('m').style.color = '#FF4300';
								document.getElementById('m').style.border = '2px solid #FF4300';
								document.getElementById('size').value = 'M';
								var x = document.getElementById('stock_m').value;
								document.getElementById('db_stock').value = x;
								document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
							}
							function l() {
								this.reset();
								document.getElementById('l').style.color = '#FF4300';
								document.getElementById('l').style.border = '2px solid #FF4300';
								document.getElementById('size').value = 'L';
								var x = document.getElementById('stock_l').value;
								document.getElementById('db_stock').value = x;
								document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
							}
							function xl() {
								this.reset();
								document.getElementById('xl').style.color = '#FF4300';
								document.getElementById('xl').style.border = '2px solid #FF4300';
								document.getElementById('size').value = 'XL';
								var x = document.getElementById('stock_xl').value;
								document.getElementById('db_stock').value = x;
								document.getElementById('s_stock').innerHTML = '&nbsp;'+x+' left';
							}
							function reset(){
								
								var stock_xs = document.getElementById('stock_xs').value;
								var stock_s = document.getElementById('stock_s').value;
								var stock_m = document.getElementById('stock_m').value;
								var stock_l = document.getElementById('stock_l').value;
								var stock_xl = document.getElementById('stock_xl').value;
								
								if(stock_xs>0){
									document.getElementById('xs').style.color = '#000000';
									document.getElementById('xs').style.border = '1px solid #CCCCCC';
								}
								if(stock_s>0){
									document.getElementById('s').style.color = '#000000';
									document.getElementById('s').style.border = '1px solid #CCCCCC';
								}
								if(stock_m>0){
									document.getElementById('m').style.color = '#000000';
									document.getElementById('m').style.border = '1px solid #CCCCCC';
								}
								if(stock_l>0){
									document.getElementById('l').style.color = '#000000';
									document.getElementById('l').style.border = '1px solid #CCCCCC';
								}
								if(stock_xl>0){
									document.getElementById('xl').style.color = '#000000';
									document.getElementById('xl').style.border = '1px solid #CCCCCC';
								}
								document.getElementById('stock').value = '1';
								document.getElementById('in_stock').value = '1';
							}
							</script>
						</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Stock</td>
						<td style='color: #808080;'>:</td>
						<td id='s_stock'>&nbsp;$stock left</td>
					</tr>
					<tr height='50'>
						<td style='color: #808080;'>Quantity</td>
						<td style='color: #808080;'>:</td>
						<td>&nbsp;<button onClick='minus()' class='btn6'>-</button><input type='text' name='qty' min='1' value='1' readonly='readonly' max='$stock' style='width:35px; height:30px;text-align:center;' id='stock'/><button onClick='plus()' class='btn6'>+</button></td>
						
						<input type='hidden' name='qty' value='$stock' id='db_stock'/>
						
						<script>
						function plus() {
							var x =document.getElementById('stock').value;
							var y = Number(x) + 1;
							
							var z =document.getElementById('db_stock').value;
							
							if(y>z)
							{
								y=z;
							}
							document.getElementById('stock').value = y;
							document.getElementById('in_stock').value = y;
						}
						function minus() {
							var x =document.getElementById('stock').value;
							var y = Number(x) - 1;
							
							var z =document.getElementById('db_stock').value;
							
							if(z==0)
							{
								y=0;
							}
							else if(y<1)
							{
								y=1;
							}
							document.getElementById('stock').value = y;
							document.getElementById('in_stock').value = y;
						}
						</script>
					</tr>
					<tr>
						<td colspan='3'>
							<form action='add_cart.php' method='post' enctype='multipart/form-data'>
							<input type='hidden' name='id' value='$id'/>
							<input type='hidden' name='size' value='' id='size'/>
							<input type='hidden' name='qty' value='1' id='in_stock'/>
							<br>
							<button type='submit' name='back' class='btn2'><img src='css/back.png' width='40px' height='40px'/>Back to Collection</button></a>
							<button type='submit' name='add_cart' class='btn2'><img src='css/new.png' width='40px' height='40px'/>Add to Cart</button></a>
						</td>
					</tr>
					</from>
				</table>
			  </div>";
	}		
	mysql_close($con);
}

function showPro($sql){
	
	if(!isset($_GET['page'])){
		$page=1;
	}
	else if(empty($_GET['page'])){
		$page=1;
	}
	else if($_GET['page']<1){
		$page=1;
	}
	else{
		$page = $_GET['page'];
	}
	
	include('dbconnect.php');

	$run_pro = mysql_query($sql);
	
	$count = mysql_num_rows($run_pro);
		
	if($count==0){
		mysql_close($con);
		echo "<div class='text'>No clothing where found!</div>";
	}
	else{
		$max_page = intval($count / 16);
		$remainder = $count % 16;
						
		if($remainder!=0){
			$max_page += 1;
		}
						
		if($page>$max_page){
			$page = $max_page;
		}
	
		$x = 0;
		
		$min = ($page - 1) * 16;
		$max = $min + 17;
		
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
				$x++;
				
				if($x>$min && $x<$max){
					echo "<div class='product_box'>
							 <a href='product.php?pro_id=$pro_id'><img src='admin_area/product_images/$pro_image' width='160px' height='200px'/>
							 <br><br><b>$pro_name</b>
							 <br><font color='red'><b>RM $pro_price</b></font></a>
						  </div>";
				}
			}
		}		
		mysql_close($con);
	?>
	</div>
	<div style="width:870px; float:left;">
			<center>
			<br><br>
				<?php
					if($page>1)
					{
				?>
						<a href="product.php?page=<?php echo $page-1; ?>"><button>Prev</button></a>
				<?php
					}
				?>
				<?php
					if($page>2)
					{
				?>
					<a href="product.php?page=<?php echo $page-2; ?>"><button><?php echo $page-2; ?></button></a>
				<?php
					}
					
					if($page>1)
					{
				?>
					<a href="product.php?page=<?php echo $page-1; ?>"><button><?php echo $page-1; ?></button></a>
				<?php
					}
					if($max_page!=1){
				?>
					<a href="product.php?page=<?php echo $page; ?>"><button><?php echo $page; ?></button></a>
				<?php
					}
					
					$p1 = $page + 1;
					if($p1<=$max_page)
					{
				?>
					<a href="product.php?page=<?php echo $page+1; ?>"><button><?php echo $page+1; ?></button></a>
				<?php
					}
					
					$p2 = $page + 2;
					if($p2<=$max_page)
					{
				?>
					<a href="product.php?page=<?php echo $page+2; ?>"><button><?php echo $page+2; ?></button></a>
				<?php
					}
					
					if($page<$max_page)
					{
				?>
						<a href="product.php?page=<?php echo $page+1; ?>"><button>Next</button></a>
				<?php
					}
				}
				?>
			</center>

<?php
}

function total_value(){

	include('dbconnect.php');

	$ip = getIp();
	
	$sql = "select * from cart where user_ip='$ip'";
	
	$run_pro = mysql_query($sql);	
	
	$count = mysql_num_rows($run_pro);
	
	mysql_close($con);
	
	return $count;
}

function total_price(){
	
	include('dbconnect.php');
	
	$ip = getIp();
	
	$total = 0;
	
	$sql = "select * from cart where user_ip='$ip'";
	
	$run_pro = mysql_query($sql);
		
	while($p_price=mysql_fetch_array($run_pro)){
			
		$pro_id = $p_price['pro_id'];
		$pro_qty = $p_price['qty'];
			
		$sql = "select * from products where product_id='$pro_id'";
		
		$run_pro_price = mysql_query($sql);
		
		while($pp_price = mysql_fetch_array($run_pro_price)){
				
			$product_price = $pp_price['product_price'];
			
			$values = $product_price * $pro_qty;
			
			$total += $values;
		}
	}
	
	echo "RM ".$total;

}

function getIp(){
	
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['REMOTE_ADDR'];
	}
 
    return $ip;
}
?>