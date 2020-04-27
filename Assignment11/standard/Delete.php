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

$q=$db->prepare("SELECT * FROM nonprofits WHERE ID=?");
$q->execute([$_GET['id']]);
$record=$q->fetch();
if($record['author_id']!=$_SESSION['id'])
  die('This post was not created by you');

$group=$db->prepare('DELETE  FROM nonprofits WHERE ID=?');
$group->execute([$_GET['id']]);
header('location: index.php');

?>


