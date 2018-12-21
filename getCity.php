<html>
<?php 
$conn=mysqli_connect("localhost","root","","test");
$sql="select * from city where State_Id='".$_POST["State_Id"]."'";
$res=mysqli_query($conn,$sql);
?>
<option> select city</option>
<?php
while($row=mysqli_fetch_assoc($res))
{
	if($_POST["cityId"] == $row['City_Id']){
?>
<option value="<?php echo $row['City_Id'];?>" selected> <?php echo $row['CityName'];?> </option>
<?php
	}
	else{
		?>
		<option value="<?php echo $row['City_Id'];?>"> <?php echo $row['CityName'];?> </option>
		<?php
	}
}
?>
</html>