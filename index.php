<?php 
$err ='';
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
		$err= "existing user";		
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
<html>
	<head>
		<title>Php Developer</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>	
	</head>
<script type="text/javascript">
function ValidateForm(){
	var fname=document.Myform.firstname.value;
	if(fname == null ||fname == "")
	{		
		document.getElementById('firstname').innerHTML="First name cannot be blank";	
		return false;
	}
	if(!isNaN(fname))
	{
		
		document.getElementById('firstname').innerHTML="enter only characters";	
		return false;
	}	
	if(fname.length < 2 || fname.length > 20)
	{
		
		document.getElementById('firstname').innerHTML="First name contain  6 to 20 characters Only";	
		return false;
	}
	
	var lname=document.Myform.lastname.value;
	if(lname == null ||lname == "")
	{
		document.getElementById('lastname').innerHTML="Last name cannot be blank";	
		return false;
	}
	if(!isNaN(lname))
	{
		
		document.getElementById('lastname').innerHTML="enter only characters";	
		return false;
	}	
	if(lname.length < 2 || lname.length > 20)
	{
		
		document.getElementById('lastname').innerHTML="Last name contain  6 to 20 characters Only";	
		return false;
	}

	var email=document.Myform.email.value;
	if(email == null ||email == "")
	{
		
		document.getElementById('email').innerHTML="email id cannot be blank";	
		return false;
	}
	else{
		if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)))
		  {
			document.getElementById('email').innerHTML="You have entered an invalid email address!";	
			return false;
		  }
	}
	
	var phone=document.Myform.phone.value;
	if(phone == null ||phone == "")
	{
		
		document.getElementById('phone').innerHTML="Please enter Mobile number";	
		return false;
	}
	if(phone.length !=10 || isNaN( phone))
	{
		
		document.getElementById('phone').innerHTML="phone number contain 10 digits only";	
		return false;
	}

	var password=document.Myform.pass.value;
	if(password == null ||password == "")
	{
		document.getElementById('pass').innerHTML="Please enter password";
		return false;
	}	
	if(password.length < 3 || password.length >8)
	{
		document.getElementById('pass').innerHTML="password contain atleast 3 chracters and does not contain morethan 10characters";
		return false;
	}
	var rpassword=document.Myform.rpass.value;
	if(rpassword == null ||rpassword == "")
	{
		
		document.getElementById('rpass').innerHTML="Please enter re-enter password";		
		return false;
	}	
	if(password == rpassword)
	{
		return true;
	}
	else
	{
	
		document.getElementById('rpass').innerHTML="password should be same";
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
						Sign Up
					</span>
					<?php if($err != ''){?>
				<span class="error" style="color:red;">* <?php echo $err;?></span>
				<?php }?>
					<div class="wrap-input100 validate-input"  style="margin-bottom:25px;" >
						<span class="label-input100">First Name</span>
						<input class="input100" type="text" name="firstname" placeholder="First Name...">
						<span class="focus-input100"></span>
					</div>
					<p id="firstname" style="color:red;font-size:20px;padding-bottom: 10px;"></p>
					<div class="wrap-input100 validate-input"  style="margin-bottom:25px;" >
						<span class="label-input100">Middle Name</span>
						<input class="input100" type="text" name="middlename" placeholder="Middle Name...">
						
					</div>
					<div class="wrap-input100 validate-input"  style="margin-bottom:25px;">
						<span class="label-input100">Last Name</span>
						<input class="input100" type="text" name="lastname" placeholder="Last Name...">
						<span class="focus-input100"></span>
					</div>
					<p id="lastname" style="color:red;font-size:20px;padding-bottom: 10px;"></p>
					<div class="wrap-input100 validate-input"  style="margin-bottom:25px;" >
						<span class="label-input100">Email</span>
						<input class="input100" type="text" name="email" placeholder="Email addess...">
						<span class="focus-input100"></span>
					</div>
					<p id="email" style="color:red;font-size:20px;padding-bottom: 10px;"></p>
					
					<div class="wrap-input100 validate-input" style="margin-bottom:25px;" >
						<span class="label-input100">Mobile Number</span>
						<input class="input100" type="text" name="phone" placeholder="phone">
						<span class="focus-input100"></span>
					</div>
					<p id="phone" style="color:red;font-size:20px;padding-bottom: 10px;"></p>
					<div class="wrap-input100 validate-input"  style="margin-bottom:25px;">
						<span class="label-input100">Password</span>
						<input class="input100" type="password" name="pass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>
					<p id="pass" style="color:red;font-size:20px;" ></p>
					<div class="wrap-input100 validate-input"   style="margin-bottom:25px;">
						<span class="label-input100">Repeat Password</span>
						<input class="input100" type="password" name="rpass" placeholder="*************">
						<span class="focus-input100"></span>
					</div>
					<p id="rpass" style="color:red;font-size:20px;padding-bottom: 10px;"></p>
					<div class="flex-m w-full p-b-33">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								<span class="txt1">
									I agree to the
									<a href="#" class="txt2 hov1">
										Terms of User
									</a>
								</span>
							</label>
						</div>					
					</div>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="submit">
								Sign Up
							</button>
						</div>

						<a href="signin.php" class="dis-block txt3 hov1 p-r-30 p-t-10 p-b-10 p-l-30">
							Sign in
							<i class="fa fa-long-arrow-right m-l-5"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	</body>
</html>