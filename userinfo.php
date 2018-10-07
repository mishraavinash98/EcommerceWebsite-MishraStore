<?php

session_start();
if(!isset($_SESSION["uid"])){
	
	
	header("location:index.php");
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
		<style>
			@media screen and (max-width:480px){
				#search{width:80%;}
				#search_btn{width:30%;float:right;margin-top:-32px;margin-right:10px;}
			}
		</style>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only"> navigation toggle</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="#" class="navbar-brand">MISHRA Store</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
				<li style="width:300px;left:10px;top:10px;"><input type="text" class="form-control" id="search"></li>
				<li style="top:10px;left:20px;"><button class="btn btn-primary" id="search_btn">Search</button></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#" id="cart_container" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span>Cart<span class="badge">0</span></a>
					<div class="dropdown-menu" style="width:400px;">
						<div class="panel panel-success">
							<div class="panel-heading">
								<div class="row">
									<div class="col-md-3 col-xs-3">Sl.No</div>
									<div class="col-md-3 col-xs-3">Product Image</div>
									<div class="col-md-3 col-xs-3">Product Name</div>
									<div class="col-md-3 col-xs-3">Price in $.</div>
								</div>
							</div>
							<div class="panel-body">
								<div id="cart_product">
								<!--<div class="row">
									<div class="col-md-3">Sl.No</div>
									<div class="col-md-3">Product Image</div>
									<div class="col-md-3">Product Name</div>
									<div class="col-md-3">Price in $.</div>
								</div>-->
								</div>
							</div>
							<div class="panel-footer"></div>
						</div>
					</div>
				</li>
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
	<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">USER PROFILE</div>
					<div class="panel-body">
					<table cellpadding="2" cellspacing="2" border="2" class="table table-bordered">
						<tr>
						<th>First name</th>    
						<th>Last name</th>
						<th>Email</th>
						<th>Mobile no</th>
						<th>Address Line 1</th>
						<th>Address Line 2</th>
						</tr>
						<?php
						require 'db.php';   //include connection//include connection
						$data = mysqli_query($con,"Select * from user_info where user_id = '$_SESSION[uid]'");  //mysql query for specific username            
						 if($data === FALSE) { 
						die(mysqli_error()); // TODO: better error handling
						}
						while($row = mysqli_fetch_array($data)) {?>
						<tr>
						
						<td><?php echo  $row['first_name'];?></td>
						<td><?PHP echo  $row['last_name']; ?></td> 
						<td><?php echo  $row['email'];?></td>
						<td><?PHP echo  $row['mobile']; ?></td>                
						<td><?PHP echo  $row['address1']; ?></td>
						<td><?PHP echo  $row['address2'];?></td>
						

						</tr>
						<?php } ?>

						</table>
					<div align="center">
						<a href="updateuserinfo.php" class="btn btn-warning" >
						UPDATE USER INFO</br></a>
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
















































