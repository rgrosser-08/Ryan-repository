<?php
session_start();
if(empty($_SESSION['email'])) 
	die('you are not signed in <a href="signin.php">Sign in</a>');
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

$q=$db->prepare("SELECT * FROM nonprofits WHERE author_id=?");
$q->execute([$_SESSION['id']]);
echo '<h1>Edit Non-Profits Created by you</h1>';
while($group=$q->fetch()){
	echo '<hr>';
	echo '<h4>'.$group['name'].'</h4>';
	echo 'Edit:<a href="Edit.php?id='.$group['id'].'">EDIT</a><br>';
	echo 'Delete: <a href="Delete.php?id='.$group['id'].'">DELETE</a><br>';
}
echo '<a href="../">Home</a>';