<?php
session_start();
require 'db.php';
	
$user_id = $_SESSION["uid"];

	
	$mobile = $_POST['mobile'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];


  // Attempt update query execution

$sql = "UPDATE user_info SET  mobile='$mobile', address1='$address1',address2='$address2' WHERE user_id='$user_id'";

if(mysqli_query($con, $sql)){

 
    //header("Location:profile.php");
	include('userinfo.php');
	echo " Records were updated successfully.";

} else {	

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);

} 

?>






