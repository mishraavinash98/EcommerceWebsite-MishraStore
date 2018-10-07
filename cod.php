
<?php

session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
	
	$product_id = $row["product_id"];
	$product_title = $row["product_title"];
	$product_price = $row["product_price"];

	$cart_item_id = $row["id"];
	$qty = $row["qty"];
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>MISHRA Store</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">MISHRA Store</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
				<li><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span><?php echo "Hi,".$_SESSION["name"]; ?></a>
					<ul class="dropdown-menu">
						<li><a href="cart.php" style="text-decoration:none; color:blue;"><span class="glyphicon glyphicon-shopping-cart">Cart</a></li>
						<li class="divider"></li>
						<li><a href="customer_order.php" style="text-decoration:none; color:blue;">Orders</a></li>
						<li class="divider"></li>
						<li><a href="userinfo.php" style="text-decoration:none; color:blue;">User Info </a></li>
						<li class="divider"></li>
						<li><a href="logout.php" style="text-decoration:none; color:blue;">Logout</a></li>
					</ul>
				</li>
				
			</ul>
		</div>
	</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="cart_msg">
				<!--Cart Message--> 
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Cart Checkout Using COD</div>
					<div class="panel-body">
						<table cellpadding="2" cellspacing="2" border="2" class="table table-bordered">
						<tr>
						<th>Sr.No</th>
						<th>Product Name</th>    
						<th>Quantity</th>  
						<th>Product Price</th>                  
						</tr>
						<?php
						require 'db.php';   //include connection
						
						
						$data = mysqli_query($con, "SELECT a.product_id,a.product_title,a.product_price,a.product_image,b.id,b.qty FROM products a,cart b WHERE a.product_id=b.p_id AND b.user_id='$_SESSION[uid]'");

						if($data === FALSE) { 
						die(mysql_error()); // TODO: better error handling
						}
						

						$total=0;$count=1;
						while($row = mysqli_fetch_array($data)) {?>
						<tr>
						<td><?PHP echo $count?></td>
						<td><?php echo  $row['product_title'];?></td>
						<td><?PHP echo  $row['qty']; ?></td> 
						<td><?PHP echo  $row['product_price']; ?></td> 
						<?PHP 
						$total=$total+$row['product_price'];
						$count++;	
						?>
					
						</tr>
						
						<?php } ?>
						

						</table>
						<div  align="right" style="font-size:20px;"><b>TOTAL AMOUNT = <?PHP echo  $total;?></b></div>
						
					<div align="center">
						<a href="printinvoice.php" class="btn btn-warning" >
						CONFIRM COD</br></a>
					</div>

					</div> 
					
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
			
		</div>
</body>	
</html>
















		