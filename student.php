<?php 
if(isset($_POST['submit']))
{
	$conn = mysqli_connect("localhost",'root','','test');	
	$name=$_POST['name'];	
	$email=$_POST['email'];
	$class=$_POST['cls'];
	$year=$_POST['year'];
	$countryId=$_POST['country'];
	$ctry="select * from country where Country_Id='".$_POST['country']."'";
	$res1=mysqli_query($conn,$ctry);
	$row=mysqli_fetch_assoc($res1);
	$country=$row['CountryName'];	
	$stateId=$_POST['state'];
	$sta="select * from state where State_Id='".$_POST['state']."'";
	$res2=mysqli_query($conn,$sta);
	$row2=mysqli_fetch_assoc($res2);
	$state=$row2['StateName'];
	$cityId=$_POST['city'];
	$cit="select * from city where City_Id='".$_POST['city']."'";
	$res3=mysqli_query($conn,$cit);
	$row3=mysqli_fetch_assoc($res3);
	$city=$row3['CityName'];
	$createdDate=date('Y-m-d H:i:s');
	$updatedDate=date('Y-m-d H:i:s');	
	$query= "SELECT * FROM user WHERE email='$email'";
	$res= mysqli_query($conn, $query);	
	if($_POST['userId'] == ''){
		$data=mysqli_num_rows($res);
	if($data !== 0)
	{
		echo "existing user";		
	}
	else
	{ 
		
		$sql="insert into user(name,email,class,year,County_id,country,stateId,state,cityId,city,createdDate,updatedDate)
		values('$name','$email','$class','$year','$countryId','$country','$stateId','$state','$cityId','$city','$createdDate','$updatedDate')";
		
		$result=mysqli_query($conn,$sql);
		
	}
	}
	else{
		$emailid = mysqli_fetch_assoc($res);		
		if($emailid['email'] == $email){
			$sql="update user set name ='$name',email = '$email',class = '$class',
			year='$year',County_id='$countryId',country ='$country',stateId ='$stateId',
			state='$state',cityId='$cityId',city='$city',createdDate='".$emailid['createdDate']."',updatedDate='$updatedDate' where userId='".$_POST['userId']."'";
			$result=mysqli_query($conn,$sql);
		}
		else{
			$query1= "SELECT * FROM user WHERE email='$email'";
			$res1= mysqli_query($conn, $query);			
				$data1=mysqli_num_rows($res1);
				if($data1 !== 0)
				{
					echo "existing user";
				}
				else{
				
					$sql="update user set name ='$name',email = '$email',class = '$class',
					year='$year',County_id='$countryId',country ='$country',stateId ='$stateId',
					state='$state',cityId='$cityId',city='$city',createdDate='".$emailid['createdDate']."',updatedDate='$updatedDate' where userId='".$_POST['userId']."'";
					$result=mysqli_query($conn,$sql);					
				}
		
	}
}
}
?>
<html>
	<head>
		<title>Php Developer</title>
		<link rel="stylesheet" type="text/css" href="style.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
   
	</head>
	<script type="text/javascript">
function ValidateForm(){
	
	var name=document.Myform.name.value;
	if(name == null ||name == "")
	{
		alert("Name cannot be blank");
		return false;
	}
	if(!isNaN(name))
	{
		alert("enter only characters");
		return false;
	}	
	if(name.length < 2 || name.length > 20)
	{
		alert("Name contain  6 to 20 characters Only");
		return false;
	}
	
	
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
	var year=document.Myform.year.value;
	if(year == null ||year == "")
	{
		alert("Year cannot be blank");
		return false;
	}
	var cls=document.Myform.cls.value;
	if(cls == null ||cls == "")
	{
		alert("Class cannot be blank");
		return false;
	}
	
	var country=document.Myform.country.value;
	if(country == null ||country == "")
	{
		alert("Country cannot be blank");
		return false;
	}
	var state=document.Myform.state.value;
	if(state == null ||state == "")
	{
		alert("State cannot be blank");
		return false;
	}
	var city=document.Myform.city.value;
	if(city == null ||city == "")
	{
		alert("City cannot be blank");
		return false;
	}
}
$( function() {
    $( "#datepicker" ).datepicker(
    		{ 
        		dateFormat: 'yy'
             });
  } );

function getState(val,val2)
{
	if(val2 == ''){
	$.ajax({
		type:"POST",
		url:"getState.php",
		data:"Country_Id="+val,
		success:function(data){
			$("#state").html(data);
			
		}
	});
	}
	else{
		$.ajax({
			type:"POST",
			url:"getState.php",
			data:{Country_Id:val,stateId:val2},		
			success:function(data){
			
				$("#state").html(data);
				
			}
		});
	}
}
function getCity(val,val2)
{
	if(val2==''){
	$.ajax({
		type:"POST",
		url:"getCity.php",
		data:"State_Id="+val,
		success:function(data)
		{
			$("#city").html(data);
		}
	});
	}
	else{
		$.ajax({
			type:"POST",
			url:"getCity.php",
			data:{State_Id:val,cityId:val2},
			success:function(data)
			{
				$("#city").html(data);
			}
		});
	}
}
function MethodDelete(val){
	alert('Are you sure you want to delete?');
	$.ajax({
		type:"GET",
		url:"Delete.php",
		data:"userId="+val,
		success:function(res)
		{
			alert("record deleted succesffully");
			window.location.reload();
		}
	});
}
function MethodUpdate(val){
	$.ajax({
		type:"GET",
		url:"update.php",
		data:"userId="+val,
		success:function(data)
		{
			var user = JSON.parse(data);
			$('#userId').val(user.userId);
			$('#name').val(user.name);
			$('#email').val(user.email);
			$('#cls').val(user.class);
			$('#datepicker').val(user.year);
			$('#country').val(user.County_id);					
			$('select[name="state"]').val(user.stateId).prop("selected", true);
			$('#state').html(getState(user.County_id,user.stateId));
			$('#city').html(getCity(user.stateId,user.cityId));	
			
		}
	});
}
</script>
	<body>
	<div class="limiter">
		<div class="container-login100 student">
			<div>
			<ul class="nav nav-tabs">
           			 <li class="active"><a href="#tab-general" data-toggle="tab">Students Dashboard</a></li>
            		<li><a href="logout.php?regId=<?php echo $_GET['regId'];?>" data-toggle="tab">Logout</a></li>
         	 </ul>         	
         	 <div class="tab-content">
         	 	<div class="tab-pane active" id="tab-general" style="background-color: white;margin-top: 100px;margin-left:15px;    margin-bottom: 100px;">
         	 		<?php
		$num_rec_per_page=5;
		$conn=mysqli_connect("localhost","root","","test");
		if(isset($_GET['page']))
		{
			$page=$_GET['page'];
		}
		else
		{
			$page=1;
		}
		$start_from=($page-1) * $num_rec_per_page;
		
		$query="select * from user ORDER BY name ASC LIMIT $start_from,$num_rec_per_page";
		$res=mysqli_query($conn,$query);
		
		echo "<table border='1' class='table table-striped table-bordered'>
		<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Class</th>
		<th>Year</th>
		<th>City</th>
		<th>State</th>
		<th>Country</th>	
		<th colspan='4'>Updation</th>
		</tr>";
	
		while($row=mysqli_fetch_array($res))
		{
			echo "<tr>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['email']."</td>";
			echo "<td>".$row['class']."</td>";
			echo "<td>".$row['year']."</td>";
			echo "<td>".$row['city']."</td>";
			echo "<td>".$row['state']."</td>";
			echo "<td>".$row['country']."</td>";			
			echo "<td>";
		?><?php
			echo "</td>";
			echo "<td>";
			echo "<button  onClick=\"MethodUpdate($row[userId])\">";
			?>
			<img src="images/edit.jpg" style="height:20px;width:10px;">
			<?php
			echo "</a>|"; 
			echo  "<button  onClick=\"MethodDelete($row[userId])\">";
			?>
			<img src="images/delete.jpg" style="height:20px;width:10px;">
			<?php
			echo "</button>";
			echo "</td>"; 
			echo "</tr>";			
		}
		echo "</table>";		
?>
   	 				</div>
         		 </div>
		 	</div>	
		 	<div id="form" style="background-color: white;margin-top:10px;margin-left: 50px;margin-bottom: 0px;position:relative;">
		 	<form class="validate-form" action="#" method="POST" name="Myform" onSubmit="return ValidateForm()">
					<span class="login100-form-title p-b-59" style="padding-left:125px;">
						Student Form
					</span>
					<input class="input100" type="hidden" id="userId" name="userId" value="">
					
					<div class="wrap-input100 validate-input" style="margin-left: 50px;width:75%;" data-validate="Name is required">
						<span class="label-input100">Name</span>
						<input class="input100" id="name" value="" type="text" name="name" placeholder="Name...">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" style="margin-left: 50px;width:75%;" data-validate="Valid email is required: ex@abc.xyz">
						<span class="label-input100">Email</span>
						<input class="input100" type="text" id="email" name="email" placeholder="Email addess...">
						<span class="focus-input100"></span>
					</div>
				
					<div class="wrap-input100 validate-input" style="margin-left: 50px;width:75%;" data-validate="Class is required">
						<span class="label-input100">Class</span>
						<input class="input100" type="text" id="cls" name="cls" placeholder="Class...">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" style="margin-left: 50px;width:75%;" data-validate="Year is required">
						<span class="label-input100">Year</span>
						<input class="input100" type="text" id="datepicker" name="year" placeholder="Year...">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input" style="margin-left: 50px;width:75%;" data-validate="country is required">
						<span class="label-input100">Country</span>
						<select id="country" class="input100" name="country" onChange="getState(this.value);">
							<option value="">Select Country</option>
								<?php
	$conn=mysqli_connect("localhost","root","","test");
	$sql="select * from country";
	$query=mysqli_query($conn,$sql);
	while($row=mysqli_fetch_array($query))
	{
	?>
		<option value="<?php echo $row["Country_Id"];?>"><?php echo $row["CountryName"];?></option>
	<?php
	}
	?>
	</select>
						
					</div>

					<div class="wrap-input100 id_100 validate-input" style="margin-left: 50px;width:75%;" data-validate="state is required">
						<span class="label-input100">State</span>
						<select id="state" class="input100" name="state" onChange="getCity(this.value)">
	<option>Select State</option>
	</select><span class="focus-input100"></span>
					</div>
					
					<div class="wrap-input100 validate-input" style="margin-left: 50px;width:75%;" data-validate="city is required">
						<span class="label-input100">City</span>
						<select id="city" class="input100" name="city" >
	<option value="">Select City</option>
	</select>	<span class="focus-input100"></span>
					</div>
					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn" style="margin-left: 50px;width:75%; margin-bottom: 100px;" >
							<div class="login100-form-bgbtn" ></div>
							<button class="login100-form-btn" style="min-width: 400px;" name="submit">
								Create
							</button>
						</div>

						
					</div>
				</form>
		 	
		 	</div>	
		</div>
	</div>
	</body>
</html>