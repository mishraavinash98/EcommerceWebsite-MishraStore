<?php


require 'db.php';
session_start();
	
$user_id = $_SESSION["uid"];
 $date=date(DATE_RFC822);


  // Attempt update query execution
$sql = "SELECT p_id,qty FROM cart WHERE user_id = '$user_id'";
		$query = mysqli_query($con,$sql);
		if (mysqli_num_rows($query) > 0) {
			# code...
			while ($row=mysqli_fetch_array($query)) {
			$product_id[] = $row["p_id"];
			$qty[] = $row["qty"];
			}
				$var=date_timestamp_get(date_create());
				$trx_id='CODTID'.$user_id.$var;
				
				
			for ($i=0; $i < count($product_id); $i++) { 
				
				$p_st='COD';
				$sql = "INSERT INTO orders (user_id,product_id,qty,trx_id,p_status,order_date) VALUES ('$user_id','".$product_id[$i]."','".$qty[$i]."','$trx_id','$p_st','$date')";
				mysqli_query($con,$sql);
				
			}

			$sql = "DELETE FROM cart WHERE user_id = '$user_id'";
			
  
		if(mysqli_query($con, $sql)){
			echo " Purchase successful.";
			$_SESSION["trx_id"]=$trx_id ;
			
		} else {	

			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);

		}
		}
?>