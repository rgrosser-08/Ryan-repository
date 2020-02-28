<?php
require_once('json.php');
//require_once('data.json');

$array=readJSON('data.json');
unset($array[$_GET['id']]);
$array2=array_values($array);
writeJSON('data.json',$array2);
header('location: index.php');

?>


