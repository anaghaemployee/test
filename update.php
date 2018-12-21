<?php
	$conn=mysqli_connect("localhost","root","","test");
	$id=$_GET['userId'];	
	$sql="select * from user where userId='".$id."'";
	$res=mysqli_query($conn,$sql);
	$row=mysqli_fetch_assoc($res);
	print_r(json_encode($row));
	
?>
