<?php

require_once('class.php');
$array=json::readJSON("data.json");
$a = new userAction("data.json");
if(!empty($_POST)){
	$a->modify($_POST['id']);
	header('location: index.php');
} 
?>
<html>
<form action="modify.php" method="POST">
Name
<input type="text" name="name" value="<?= $array[$_GET['id']]['name'] ?>" ><br>
Location
<input type="text" name="location" value="<?= $array[$_GET['id']]['location'] ?>"><br>
Type
<input type="text" name="type" value="<?= $array[$_GET['id']]['type'] ?>"><br>
About
<textarea name="about" ><?= $array[$_GET['id']]['about'] ?></textarea><br>
Enter a link to a picture
<input type="text" name="picture" value="<?= $array[$_GET['id']]['picture'] ?>"><br>
Enter a link to their website
<input type="text" name="website" value="<?= $array[$_GET['id']]['website'] ?>"><br>
<input type="hidden" name="id" value="<?=(isset($_GET)) ? $_GET['id'] : count($array)?>">
<button type="submit" value="Submit">Submit</button>
<br>
</form>
</html>
