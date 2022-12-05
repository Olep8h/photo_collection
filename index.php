<?php
session_start();
header("Cache-control: private");

if ($_SESSION["admin"] != 1)
echo "<A HREF='login.php'>Login as administrator</A>";
if ($_SESSION["admin"])
echo "<A HREF='logout.php'>Log out</A>";

require 'setup.php';  
$connection = mysqli_connect($host, $user, $password, $dbname);
if($connection == false)
{
	echo 'Unable to connect to database!<br>';
	echo mysqli_connect_error();
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Photo Collection</title>
        <link href="background.css" rel="stylesheet" type="text/css">
</head>

<body>

<h1 align="center">Photo Collection</h1>
 <b>Photo list<BR></b>

<FORM ACTION=index.php method=get>
<INPUT NAME=Nazev SIZE=11 VALUE="<?php echo $_GET[Nazev] ?>">
<INPUT TYPE=SUBMIT VALUE="Find">
</FORM>

<br>
<IMG SRC="img\up.png" WIDTH=20 HIGHT=20>&nbsp;Sort ascending &nbsp;&nbsp;
<IMG SRC="img\down.png" WIDTH=20 HIGHT=20>&nbsp;Sort descending
<HR>

<?php

if ($_GET[Nazev]!="")
    $Podminka="WHERE name LIKE '".AddSlashes($_GET[Nazev])."%'";
else
    $Podminka ="";


if($_GET['orderby']!="")
    $Orderby = "ORDER BY ".urldecode($_GET['orderby']);
else
    $Orderby = "ORDER BY name";
   
$sql = "SELECT * FROM `photos`

		".$Podminka.$Orderby;


$result = mysqli_query($connection, $sql);
if($_SESSION["admin"])
	echo '<a href="pridat.php">Add new photo</a><br>';
?>
<table border="0">
	<tbody>
		<tr valign="TOP" align="CENTER">
			<th bgcolor="#ABB2B9" width=300>
				<a href="index.php">
				<IMG SRC="img\down.png" WIDTH=20 HIGHT=20></a>&nbsp;Name&nbsp;
				<?php echo '<a href="index.php?orderby=', urlencode('name DESC'),'">'; ?>
				<IMG SRC="img\up.png" WIDTH=20 HIGHT=20></a></th>
			<th bgcolor="#ABB2B9" width=200>
				<?php echo '<a href="index.php?orderby=', urlencode('category'),'">'; ?>
				<IMG SRC="img\down.png" WIDTH=20 HIGHT=20></a>&nbsp;Сategory&nbsp;
				<?php echo '<a href="index.php?orderby=', urlencode('category DESC'),'">'; ?>
				<IMG SRC="img\up.png" WIDTH=20 HIGHT=20></a></th>
			<th bgcolor="#ABB2B9" width=100>
				<?php echo '<a href="index.php?orderby=', urlencode('link'),'">'; ?>
				<IMG SRC="img\down.png" WIDTH=20 HIGHT=20></a>&nbsp;Photo&nbsp;
				<?php echo '<a href="index.php?orderby=', urlencode('link DESC'),'">'; ?>
				<IMG SRC="img\up.png" WIDTH=20 HIGHT=20></a></th>
			
			<th></th>
			<th></th>
		</tr>

<?php  
if(mysqli_num_rows($result) > 0)
{
	$i = 0;
	while( $data = mysqli_fetch_assoc($result) )
	{
		if ($i%2==1)    
     		echo "<TR VALIGN=TOP BGCOLOR=>";
		else
      		echo "<TR VALIGN=TOP>";

                $category_id = $data['category'];

                $name_category = "SELECT * FROM `categories` WHERE id=$category_id

		";

                $finale = mysqli_fetch_assoc(mysqli_query($connection, $name_category));


		echo '<td align="CENTER">'.$data['name'].'</td>';
		echo '<td align="CENTER">'.$finale['name'].'</td>';
		echo '<td align="CENTER"><img class="in_table" src="'.$data['link'].'"></td>';
		if ($_SESSION["admin"])
		{
			echo '<td><a href="smazat.php?id='.$data['id'].'">Delete</a></td>';
			//echo '<td><a href="upravit.php?id='.$data['id'].'">Edit</a></td>';
		}
		echo '</tr>';
		
		$i++;
	}
}
else echo '<h4>No records</h4>';

?>
	</tbody>
</table>	

</body>
</html>