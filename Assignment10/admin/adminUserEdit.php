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

$q=$db->prepare("SELECT * FROM users WHERE ID=?");
$q->execute([$_GET['id']]);
$user=$q->fetch();

if(!empty($_POST)){
	/*$q=$db->prepare("UPDATE nonprofits SET name = ?,city = ?, state = ?, type = ?, picture = ?, url = ?, about = ? WHERE nonprofits.ID = ?");
	$q->execute([$_POST['name'],$_POST['city'],$_POST['state'],$_POST['type'],$_POST['picture'],$_POST['url'],$_POST['about'],$org->getId()]);
	header('location: admin.php');
	*/
	if(!empty($_POST['password'])){
		$_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);

		$q=$db->prepare("UPDATE users SET email = ?,password = ?, admin = ?  WHERE users.ID = ?");
		$q->execute([$_POST['email'],$_POST['password'],$_POST['admin'],$_GET['id']]);
		
		header('location: admin.php');
	}
	
	$q=$db->prepare("UPDATE users SET email = ?, admin = ?  WHERE users.ID = ?");
	$q->execute([$_POST['email'],$_POST['admin'],$_GET['id']]);
	header('location: admin.php');

} 
?>
<html>
<form action="adminUserEdit.php?id=<?=$_GET['id']?>" method="POST">
Email:
<input type="text" name="email" value="<?= $user['email'] ?>" ><br>
Password
<input type="password" name="password" ><br>
Admin: Enter "y" if you wish to grant admin status.
<input type="text" name="admin" value="<?= $user['admin'] ?>"><br>

<button type="submit" value="Submit">Submit</button>
<br>
</form>
<a href="admin.php">Admin Page</a>
</html>
