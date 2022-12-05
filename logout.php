<?php
 # Logout script

 
session_start();
$_SESSION = array();
session_destroy();
if ($_SESSION["user_is_logged"])
	echo "FATAL ERROR: Cannot terminate session!";
else
	header("Location: index.php");
?>  
