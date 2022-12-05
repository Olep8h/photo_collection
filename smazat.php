<?php
session_start();
header("Cache-control: private");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Deleting a photo</title>
</head>
<body>
<?php 
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
	if(isset($_POST['del']))
	{
		$result = mysqli_query($connection, "DELETE FROM `photos` WHERE `id`=".$_GET['id']);

		if($result)
		{
			echo 'Photo has been removed. <br>';
		}
		else
		{
			echo 'Error:'. mysqli_error($connection);
		}

		echo '<br>';
		echo '<a href="index.php">Back</a>';
		exit();
	}
 ?>

<h1>Deleting a photo</h1>

<?php 
if(isset($_GET['id']))
{
	$result = mysqli_query($connection, "SELECT `name` FROM `photos` WHERE `id`=".$_GET['id']);
	$data = mysqli_fetch_assoc($result);
	if($data)
	{
		echo '<h4>Do you really want to delete the photo?</h4>';	
		echo 'Name: '.$data['name'].'<br>';
	}
	else
	{
		echo 'Parameter error<br>';
		echo '<br>';
		echo '<a href="index.php">Back</a>';
		exit();
	}
}
else
{
	echo 'Parameter error<br>';
	echo '<br>';
	echo '<a href="index.php">Back</a>';
	exit();
}
?>
<br>
<form action="" method="POST">
<input type="HIDDEN" name="del" value="del">
<input type="SUBMIT" value="Ano">
</form>

<br>
 	<a href="index.php">Back</a>	
</body>
</html>