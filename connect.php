<?php                                                                                  
$servername = "localhost";
$username = "panov";
$password = "heslo";
$dbname = "smrcka";
$spojeni = mysqli_connect($servername, $username, $password, $dbname);
 mysqli_set_charset($spojeni, "utf8");
?>
