<?php
require_once('class.php');
$a = new userAction("data.json"); 
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
	$a->create($_POST);
	header('location: index.php');

} 
?>