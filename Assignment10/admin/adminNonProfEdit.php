<?php
session_start();
if(empty($_SESSION['email'])) 
	die('you are not signed in <a href="signin.php">Sign in</a>');//check if the user is logged in, if they are not they do not get to see the page

include('functions.php');
require_once('class.php');

$settings=[
  'host'=>'localhost',
  'db'=>'nonprofits',
  'user'=>'root',
  'pass'=>''
];
$opt=[
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

$db = new PDO('mysql:host='.$settings['host'].';dbname='.$settings['db'].';charset=utf8mb4',$settings['user'],$settings['pass'],$opt);

$q=$db->prepare("SELECT * FROM users WHERE email=?");
$q->execute([$_SESSION['email']]);
$record=$q->fetch();
echo '<br>';
if($record['admin']=='n')
	die('You are not an Admin. <a href="../">Home Page</a>');

$q=$db->prepare("SELECT * FROM nonprofits WHERE ID=?");
$q->execute([$_GET['id']]);
$record=$q->fetch();
$org = new org($record['id'],$record['name'],$record['city'],$record['state'],$record['type'],$record['picture'],$record['about'],$record['url']);


if(!empty($_POST)){
	$q=$db->prepare("UPDATE nonprofits SET name = ?,city = ?, state = ?, type = ?, picture = ?, url = ?, about = ? WHERE nonprofits.ID = ?");
	$q->execute([$_POST['name'],$_POST['city'],$_POST['state'],$_POST['type'],$_POST['picture'],$_POST['url'],$_POST['about'],$org->getId()]);
	header('location: admin.php');

} 
?>
<html>
<form action="adminNonProfEdit.php?id=<?=$_GET['id']?>" method="POST">
Name
<input type="text" name="name" value="<?= $org->getName() ?>" ><br>
City
<input type="text" name="city" value="<?= $org->getCity() ?>"><br>
State
<input type="text" name="state" value="<?= $org->getState() ?>"><br>
Type
<input type="text" name="type" value="<?= $org->getType() ?>"><br>
About
<textarea name="about" ><?= $org->getAbout() ?></textarea><br>
Enter a link to a picture
<input type="text" name="picture" value="<?= $org->getPicture() ?>"><br>
Enter a link to their website
<input type="text" name="url" value="<?= $org->getUrl() ?>"><br>
<button type="submit" value="Submit">Submit</button>
<br>
</form>
<p>*It may take 2 clicks of submit to change values in the form, Items are changed in the database from 1 click though.</p> 
<a href="admin.php">Admin Page</a>
</html>
