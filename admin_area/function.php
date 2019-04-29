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
			echo "<br><br><br><div class='text'>No clothing where found!</div>";
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
	include('../dbconnect.php');
		
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

		echo "<div class='single_product'>
				<div class='detail_img'>
					<img src='product_images/$pro_image' width='300px' height='400px'/>
				</div>
				<div class='detail_text'>
					<table align='center' border='0' class='table' width='490px'>
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
						<td>&nbsp;".preg_replace("/\r\n|\r/", "<br/>&nbsp;",$pro_detail)."</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Price</td>
						<td style='color: #808080;'>:</td>
						<td>&nbsp;RM&nbsp;$pro_price</td>
					</tr>
					<tr>
						<td style='color: #808080;'>Product Size</td>
						<td style='color: #808080;'>:</td>
						<td><table align='left' border='0' class='table' style='font-size:16px;'>
							<tr align='center'>
								<td style='color: #808080;'>XS</td>
								<td width='50px' style='color: #808080;'>x</td>
								<td>$xs</td>
							</tr>
							<tr align='center' >
								<td style='color: #808080;'>S</td>
								<td style='color: #808080;'>x</td>
								<td>$s</td>
							</tr>
							<tr align='center'>
								<td style='color: #808080;'>M</td>
								<td style='color: #808080;'>x</td>
								<td>$m</td>
							</tr>
							<tr align='center'>
								<td style='color: #808080;'>L</td>
								<td style='color: #808080;'>x</td>
								<td>$l</td>
							</tr>
							<tr align='center'>
								<td style='color: #808080;'>XL</td>
								<td style='color: #808080;'>x</td>
								<td>$xl</td>
							</tr>
							</table></td>
					</tr>
					<tr>
						<td colspan='3'>
							<br><center>
							<a href='index.php'><button class='btn2'><img src='../css/back.png' width='40px' height='40px'/>Back</button></a>
							<a href='edit.php?id=$id'><button class='btn2'><img src='../css/update.png' width='40px' height='40px'/>Edit</button></a>
							</center>
						</td>
					</tr>
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
					
	
	echo "<div class='product_box'>
			 <a href='insert_product.php'><img src='../css/new_pro.png' width='160px' height='200px'/>
			 <br><br><b>New Product</b>
		  </div>";
	
	include('../dbconnect.php');

	$run_pro = mysql_query($sql);
	$run_pro1 = mysql_query($sql);
	
	$count = mysql_num_rows($run_pro);
		
	if($count==0){
		mysql_close($con);
		echo "<div class='text'><br><br><br>No clothing where found in this category!</div>";
	}
	else{
		
		$max_page = intval($count / 15);
		$remainder = $count % 15;
						
		if($remainder!=0){
			$max_page += 1;
		}
						
		if($page>$max_page){
			$page = $max_page;
		}
	
		$x = 0;
		$y = 0;
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
			
			
			$min = ($page - 1) * 15;
			$max = $min + 16;
			
			if($xs<10 OR $s<10 OR $m<10 OR $l<10 OR $xl<10){
			$x++;				
				if($x>$min && $x<$max){
				$y++;
					echo "<div class='product_box' style='background:#F1948A'>
							 <a href='index.php?pro_id=$pro_id'><img src='product_images/$pro_image' width='160px' height='200px'/>
							 <br><br><b>$pro_name</b>
							 <br><font color='red'><b>RM $pro_price</b></font></a>
						  </div>";
				}
			}
		}
		
		$max_page = intval($count / 15);
		$remainder = $count % 15;
						
		if($remainder!=0){
			$max_page += 1;
		}
						
		if($page>$max_page){
			$page = $max_page;
		}
		
		while($row_pro=mysql_fetch_array($run_pro1))
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
			
			
			$min = ($page - 1) * 15;
			$max = $min + 16;
			
			if($xs>=10 AND $s>=10 AND $m>=10 AND $l>=10 AND $xl>=10){
			$x++;
				if($x>$min && $x<$max){
					if($y<15){
						echo "<div class='product_box'>
								 <a href='index.php?pro_id=$pro_id'><img src='product_images/$pro_image' width='160px' height='200px'/>
								 <br><br><b>$pro_name</b>
								 <br><font color='red'><b>RM $pro_price</b></font></a>
							  </div>";
					}
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
						<a href="index.php?page=<?php echo $page-1; ?>"><button>Prev</button></a>
				<?php
					}
				?>
				<?php
					if($page>2)
					{
				?>
					<a href="index.php?page=<?php echo $page-2; ?>"><button><?php echo $page-2; ?></button></a>
				<?php
					}
					
					if($page>1)
					{
				?>
					<a href="index.php?page=<?php echo $page-1; ?>"><button><?php echo $page-1; ?></button></a>
				<?php
					}
					if($max_page!=1){
				?>
					<a href="index.php?page=<?php echo $page; ?>"><button><?php echo $page; ?></button></a>
				<?php
					}
					
					$p1 = $page + 1;
					if($p1<=$max_page)
					{
				?>
					<a href="index.php?page=<?php echo $page+1; ?>"><button><?php echo $page+1; ?></button></a>
				<?php
					}
					
					$p2 = $page + 2;
					if($p2<=$max_page)
					{
				?>
					<a href="index.php?page=<?php echo $page+2; ?>"><button><?php echo $page+2; ?></button></a>
				<?php
					}
					
					if($page<$max_page)
					{
				?>
						<a href="index.php?page=<?php echo $page+1; ?>"><button>Next</button></a>
				<?php
					}
				}
				?>
			</center>

<?php
}
?>