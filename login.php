<?php
 $login="test"; //Username
 $pass="test"; //Password

 //Pokud byl odeslán formulář (v proměnné action je hodnota validace)
 if ($_GET['action']=='validate'){
  //a pokud odpovídají přihlašovací údaje
   if(($_POST['user']==$login)&&($_POST['passwd']==$pass)){

     session_start();
     header("Cache-control: private"); // požadováno u některých prohlížečů

     //zaregistruje proměnou user_is_logged a nastaví ji na 1
     $_SESSION["admin"] = 1;
     //a pošlena úvodní soubor chráněné sekce
     header("Location: index.php");
   
     exit();
   }
 }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Photo Collection</title>
</head>
<link href="background.css" rel="stylesheet" type="text/css">

<body> 
<form action="./login.php?action=validate" method="post">
  <table>
    <tr><td>Username (test)</td><td><input type="text" name="user" /></td></tr>
    <tr><td>Password (test)</td><td><input type="password" name="passwd" /></td></tr>
    <tr><td colspan="2"><input type="submit" value="Login" />
    <input type="reset" value="Clear" /></td></tr>
  </table>
</form>
<br>
<a href="index.php">Back</a>
 </body>
</html>
