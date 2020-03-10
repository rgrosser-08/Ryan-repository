<?php
include('functions.php');
require_once('class.php');
$groups=jsonToArray('data.json');

if(!isset($_GET['id'])){
  echo 'Please enter the id of a group or visit the <a href="index.php">index page</a>.';
  die();
}
if($_GET['id']<0 || $_GET['id']>count($groups)-1){
  echo 'Please enter the id of a group or visit the <a href="index.php">index page</a>.';
  die();
}

$org = new org($groups[$_GET['id']]['name'],$groups[$_GET['id']]['location'],$groups[$_GET['id']]['type'],$groups[$_GET['id']]['picture'],$groups[$_GET['id']]['about'],$groups[$_GET['id']]['website']);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title><?= $groups[$_GET['id']]['name'] ?></title>
  </head>
  <body>
    <div class="container">
    <h1><?= $org->getName() ?></h1>
    <p>Location: <?= $org->getLocation() ?></p>
    <p>Type: <?= $org->getType() ?></p>
    <p><a href="<?= $org->getWebsite() ?>">Website</a></p> 
    <img src="<?= $org->getPicture() ?>" width="500">
    <p><?= $org->getAbout() ?></p>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>