<?php
session_start();
if(empty($_SESSION['email'])) 
  die('you are not signed in <a href="signin.php">Sign in</a>');//check if the user is logged in, if they are not they do not get to see the page
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
?>

<html>
<form action="adminNonProfCreate.php" method="POST">
Name
<input type="text" name="name"><br>
City
<input type="text" name="city"><br>
State
<input type="text" name="state"><br>
Type
<input type="text" name="type"><br>
About
<textarea name="about"></textarea><br>
Enter a link to a picture
<input type="text" name="picture"><br>
Enter a link to their website
<input type="text" name="url"><br>
<button type="submit" value="Submit">Submit</button>
<br>
</form>
</html>
<?php
if(!empty($_POST)){
	$q=$db->prepare('INSERT INTO nonprofits(name,city,state,type,picture,url,about) VALUES(?,?,?,?,?,?,?)');
	$q->execute([$_POST['name'],$_POST['city'],$_POST['state'],$_POST['type'],$_POST['picture'],$_POST['url'],$_POST['about']]);

	header('location: admin.php');

} 
?>