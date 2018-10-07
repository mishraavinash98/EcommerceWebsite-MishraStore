<script>
function forprint(){
if (!window.print){

return
}
window.print()
}
</script>

<?php
include('codconf.php');

$user_id = $_SESSION["uid"];

$trx_id=$_SESSION["trx_id"] ;

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
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="cart_msg">
			<div style="clear: both">
				<h1 style="float: left">MISHRA Store </h1><br>
				<h3 style="float: right">INVOICE </h3><br><br><br>
				<h5 style="float: left"><?php
						
						
						require 'db.php';   //include connection
						$data = mysqli_query($con, "SELECT order_id ,order_date from orders WHERE user_id='$_SESSION[uid]'and p_status='COD' and trx_id='$trx_id'");
					
						if($data === FALSE) { 
						die(mysql_error()); // TODO: better error handling
						}
						$var='';
						while($row = mysqli_fetch_array($data)) {?>
						
						<?php $var= $var.$row['order_id'];?>
						<?php $date=$row['order_date'];?>
						
						<?php } ?> BILL ID :&nbsp;<?php echo $var;?>&nbsp;&nbsp;&nbsp;Transaction ID : &nbsp;<?php echo $trx_id;?>
					</h5>
				
				<h6 style="float: right"><?php echo $date; ?></h6>
			</div>
			
			
			</div>
			<div class="col-md-2"></div>
			
		</div>
		<br>
		<div class="row"> 
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">SHIPMENT INFORMATION</div>
					<div class="panel-body">
						
						<?php
						
						
						require 'db.php';   //include connection
						$data = mysqli_query($con, "SELECT * from user_info WHERE user_id='$_SESSION[uid]'");

						if($data === FALSE) { 
						die(mysql_error()); // TODO: better error handling
						}
						
						while($row = mysqli_fetch_array($data)) {?>
						<tr>
						
						<td><?php echo "To: ", $row['first_name'];?></td>
						<td><?PHP echo  $row['last_name']; ?></td> 
						<br>
						<td><?PHP echo "Email: ",$row['email']; ?></td> 
						<br>
						<td><?PHP echo "Phone: " ,$row['mobile']; ?></td> 
						<br>
						<td><?PHP echo "Adress Line 1: " ,$row['address1']; ?></td> 
						<br>
						<td><?PHP echo "Adress Line 2: ",$row['address2']; ?></td> 
					
						</tr>
						
						<?php } ?>
						
						
					</div> 
					
					</div>
				</div>
			</div>
			
		
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">PRODUCT INFORMATION</div>
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
						
						
						$data = mysqli_query($con,"SELECT * FROM products ,orders  WHERE products.product_id=orders.product_id AND orders.user_id='$user_id' AND orders.p_status='COD'and trx_id='$trx_id'");

					
						if($data === FALSE) { 
						die(mysqli_error()); // TODO: better error handling
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
						
					

					</div> 
					
				</div>
					<div align="center">
						<a href="javascript:forprint()" class="btn btn-warning" >
						PRINT INVOICE</br></a>
						
					</div><br><br><br>
					<div align="center" class="panel-footer">THANKYOU FOR VISTING..WE ARE GLAD TO DO BUSINESS WITH YOU
					<br>MISHRA Store &copy; 2018 Kurla West,Mumbai,Maharashtra 400070,mishratest@gmail.com</div>
				</div>
			</div>
			<div class="col-md-2"></div>
			
		</div>
</body>	
</html>















		