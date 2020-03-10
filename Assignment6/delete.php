<?php
require_once('class.php');
//require_once('data.json');
$a = new userAction("data.json");
$a->delete($_GET['id']);
header('location: index.php');

?>


