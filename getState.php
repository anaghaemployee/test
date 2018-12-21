<html>
<?php 
$conn=mysqli_connect("localhost","root","","test");
$sql="select * from state where Country_Id='".$_POST["Country_Id"]."'";
$res=mysqli_query($conn,$sql);
?>
<option>select state</option>
<?php
while($row=mysqli_fetch_assoc($res))
{
if($_POST["stateId"] == $row['State_Id']){
?>
<option value="<?php echo $row['State_Id'];?>" selected><?php  echo $row['StateName'];?> </option>
<?php
}

else{
	?>
	<option value="<?php echo $row['State_Id'];?>"><?php  echo $row['StateName'];?> </option>
	<?php
	}
}
?>
</html>