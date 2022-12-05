<?php
session_start();
header("Cache-control: private");

if ($_SESSION["admin"] != 1)
{
	echo "<h2>You don't have administrator rights</h2>";
	exit();
}

require 'setup.php';  
$connection = mysqli_connect($host, $user, $password, $dbname);
if($connection == false)
{
	echo 'Unable to connect to database!<br>';
	echo mysqli_connect_error();
	exit();
}

if (isset($_POST['adding']))
{
	if ($_POST['title'] != '' && $_POST['name'] != '')
	{
		$res = mysqli_query($connection, "SELECT * FROM `categories` WHERE `name` = '".$_POST['name']."'");
		if(mysqli_num_rows($res) > 0)
		{
			$data = mysqli_fetch_assoc($res);
			$author = $data['a_id'];
		}		
		
		$res = mysqli_query($connection,"INSERT INTO `photos` (`id`, `category`, `link`, `name`)
										 VALUES ('0','{$_POST['genre']}','{$_POST['title']}','{$_POST['name']}')");

		if($res)
		{
			echo '<h4 style="color:#00cc00">Photo successfully added</h4>';
		}
		else
		{
			echo 'Error:'. mysqli_error($connection);
		}

	}
	else echo '<p style="color:#ff0000">Fill in all fields of the form</p>';
	
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Adding a new photo</title>
</head>
<link href="background.css" rel="stylesheet" type="text/css">
<body>
<h1>Adding a new photo</h1>
<form action="pridat.php" method="POST">
	<table border="0">
	<tbody>
	<tr>
		<td>Link:</td>
		<td><input type="text" name="title" size="50"></td>
	</tr>
	<tr>
		<td>Name:</td>
		<td><input type="text" name="name" size="50"></td>
	</tr>
	<tr>
		<td>Category</td>
		<td>
			<select name="genre" size="1">
				<?php 
					$result = mysqli_query($connection, "SELECT * FROM `categories` ORDER BY `name`");
					if(mysqli_num_rows($result) > 0)
					{
						while( $data = mysqli_fetch_assoc($result) )
						{
							echo '<option select value="'.$data['id'].'">'.$data['name'];
						}
					}

				 ?>
			</select>
		</td>
	</tr>
	</tbody>
	</table>
	<br>
	<input type="SUBMIT" value="Add" name="adding">
</form>
<br>
<a href="index.php">Back</a>
</body>
</html>