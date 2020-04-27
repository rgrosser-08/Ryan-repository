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
if($record['role']!='a')
	die('You are not an Admin. <a href="../">Home Page</a>');

$q=$db->query("SELECT * FROM nonprofits");
echo '<h1>Edit Non-Profits</h1>';
while($group=$q->fetch()){
	echo '<hr>';
	echo '<h4>'.$group['name'].'</h4>';
	echo 'Edit:<a href="adminNonProfEdit.php?id='.$group['id'].'">EDIT</a><br>';
	echo 'Delete: <a href="adminNonProfDelete.php?id='.$group['id'].'">DELETE</a><br>';
}
echo '<h2><a href="adminNonProfCreate.php">Create New non-profit</a><h2>';

$q=$db->query("SELECT * FROM users");
echo '<h1>Registered Users</h1>';
while($user=$q->fetch()){
	echo '<hr>';
	echo '<h4>'.$user['email'].'</h4>';
	echo 'Edit:<a href="adminUserEdit.php?id='.$user['id'].'">EDIT</a><br>';
	echo 'Delete: <a href="adminUserDelete.php?id='.$user['id'].'">DELETE</a><br>';
}
echo '<h2><a href="adminUserCreate.php">Create New User</a><h2>';


echo '<br><br><a href="../">Home</a>';
