<?php 
session_start();
$conn=mysqli_connect("localhost","root","","test");
if(isset($_POST['email']) && isset($_POST['pass']))
{
	$email=$_POST['email'];
	$password=$_POST['pass'];
	$query = "SELECT * FROM registration WHERE email='$email' and password='$password'";
	$result = mysqli_query($conn, $query) or die(mysqli_error($connection));
	$row = mysqli_fetch_assoc($result);
	
	$count = mysqli_num_rows($result);
	if ($count == 1){
		$_SESSION['regId'] = $row['regId'];
	}
	else{
		echo "Invalid Login Credentials.";
	}
}
if (isset($_SESSION['regId']))
{
	$regId= $_SESSION['regId'];	
	header('Location: student.php?regId='.$regId);
}
else{
}

?>

<html>
	<head>
		<title>Php Developer</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>	
	</head>
	<script type="text/javascript">
function ValidateForm(){
	
	var email=document.Myform.email.value;
	if(email == null ||email == "")
	{
		alert("email id cannot be blank");
		return false;
	}
	else{
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)))
		  {
		   alert("You have entered an invalid email address!")
		    return false;
		  }
	}
	
	var password=document.Myform.pass.value;
	if(password == null ||password == "")
	{
		alert("Please enter password");
		return false;
	}	
	if(password.length < 3 || password.length >8)
	{
		alert(" password contain atleast 3 chracters and does not contain morethan 10characters");
		return false;
	}
	
}
</script>
	<body>
		<div class="limiter">
		<div class="container-login100">
			<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>

			<div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
				<form class="login100-form validate-form" action="" method="POST" name="Myform" onSubmit="return ValidateForm()">
					<span class="login100-form-title p-b-59">
						Sign in
					</span>

					<div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email addess...">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>

					

					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									Remember Me
									</a>
								</span>
							</label>
						</div>					
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn">
								Sign in
							</button>
						</div>

						<a href="index.html" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Sign Up
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	</body>
</html>