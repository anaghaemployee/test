<?php 
if(isset($_POST['submit']))
{
	$conn = mysqli_connect("localhost",'root','','test');	
	$fname=$_POST['firstname'];
	$mname=$_POST['middlename'];
	$lname=$_POST['lastname'];
	$email=$_POST['email'];
	$pass=$_POST['pass'];
	$mobile=$_POST['phone'];
	$createdDate=date('Y-m-d H:i:s');
	$updatedDate=date('Y-m-d H:i:s');
	$query= "SELECT * FROM registration WHERE email='$email'";
	$res= mysqli_query($conn, $query);
	$data=mysqli_num_rows($res);
	if($data !==0)
	{
		echo "existing user";
		header('Location: index.html');
	}
	else
	{
		$sql="insert into registration(regFirstname,regMiddilename,regLastname,email,password,mobile,createdDate,updatedDate)
		values('$fname','$mname','$lname','$email','$pass','$mobile','$createdDate','$updatedDate')";
		$result=mysqli_query($conn,$sql);
		//print_r($result);exit();
		if($result)
		{
			header('Location: signin.php');
		}
	}
	
}
?>