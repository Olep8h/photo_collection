<?php
require 'setup.php';
$connection = mysqli_connect($host, $user, $password, $dbname);
?>


<HTML>

<HEAD>
    <TITLE>Edit</TITLE>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</HEAD>

<BODY>

<?php
$sql = "select * from photos where id=$_GET[id]";
$vysledek = mysqli_query($connection, $sql);


$radeks = mysqli_fetch_assoc($vysledek);


echo $radeks["name"];
?>
<H1>Edit</H1>
<!-- vypsani polozek zaznamu do formulare pro upravy -->
<FORM ACTION="update.php" METHOD=GET>
    <table>
        <TR>
            <TD>Name:
            <TD><INPUT NAME=name value="<?php echo $radeks["name"] ?>">
        <TR>
            <TD>Category:
            <TD><select size="1" name="category" value="<?php echo $radeks["category"] ?>">
                    <?php
                    $sql2 = "SELECT * from categories";
                    $vysledek2 = mysqli_query($connection, $sql2);



                    while ($manufacturer = mysqli_fetch_assoc($vysledek2)) : ?>
                        <option value="<?php echo $manufacturer["id"] ?>" <?php $selected = "";
                        $radeks["category"] == $manufacturer["id"] ? $selected = "selected" : $selected = "";
                        echo $selected; ?>><?php echo $manufacturer["name"] ?></option>
                    <?php endwhile; ?>
                </select>
        <TR>
            <TD>Link:
            <TD><INPUT NAME=link value="<?php echo $radeks["link"] ?>">
        <TR>
        
    </TABLE>
    <INPUT TYPE=hidden name=id VALUE="<?php echo $radeks["id"]; ?>">

    <INPUT TYPE=SUBMIT VALUE="Send">
</FORM>

<FORM ACTION="index.php">
    <INPUT TYPE=SUBMIT VALUE="Back">
</FORM>
<?php
mysqli_close($connection);
?>
</BODY>

</HTML>