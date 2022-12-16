<HTML>

<HEAD>
  <TITLE>Edit info</TITLE>

  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</HEAD>

<BODY>

  <?php
  require 'setup.php';
  $connection = mysqli_connect($host, $user, $password, $dbname);

  $sql = "UPDATE photos SET category = '$_GET[category]', link = '$_GET[link]', name = '$_GET[name]' WHERE id='$_GET[id]'";

  if (mysqli_query($connection, $sql)) {
    echo "Successful adding changes";
  } else {
    echo "Error with editing: " . mysqli_error($connection);
  }

  mysqli_close($connection);

  ?>

  <BR><BR>
  <A HREF="index.php">Back and see all photos in photo collection</A>

</body>

</html>