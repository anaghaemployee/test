<?php
	$conn=mysqli_connect("localhost","root","","test");
	$id=$_GET['userId'];	
	$sql="delete from user where userId ='".$id."'";	
	$result=mysqli_query($conn,$sql);	
		if($result)
		{
			return "record deleted succesffully";
		}
		else
		{
			return "not deleted";
		}
		
?>
