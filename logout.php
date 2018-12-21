<?php
session_start();
if(isset($_GET['regId']))
{
	
session_destroy();
}
header('Location:signin.php');
?>