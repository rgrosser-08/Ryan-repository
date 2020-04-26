<?php
//$a->delete($_GET['id']);
session_start();
if(empty($_SESSION['email'])) 
	die('you are not signed in <a href="../signin.php">Sign in</a>');//check if the user is logged in, if they are not they do not get to see the page
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

$q=$db->prepare('DELETE  FROM users WHERE ID=?');
$q->execute([$_GET['id']]);
header('location: admin.php');

?>


