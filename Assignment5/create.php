<?php
require_once('json.php');
$array=readJSON('data.json');

?>

<html>
<form action="create.php" method="POST">
Name
<input type="text" name="name"><br>
Location
<input type="text" name="location"><br>
Type
<input type="text" name="type"><br>
About
<textarea name="about"></textarea><br>
Enter a link to a picture
<input type="text" name="picture"><br>
Enter a link to their website
<input type="text" name="website"><br>
<button type="submit" value="Submit">Submit</button>
<br>
</form>
</html>
<?php
if(!empty($_POST)){
	$array[count($array)]=$_POST;
	writeJSON('data.json',$array);
	header('location: index.php');

} 
?>