<?php

  require_once('functions.php');
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
$result=$db->query("SELECT * FROM nonprofits");


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Non-Profit Organizations</title>
  </head>
  <body>
  <div class="container">
    <h1>Non-Profit Organizations</h1>
    <?php
      while($groups=$result->fetch()){
        $org = new Org($groups['id'],$groups['name'],$groups['city'],$groups["state"],$groups['type'],$groups['picture'],$groups['about'],$groups['url']);
        echo showItem($org->getId(),$org->getName(),$org->getCity().','.$org->getState(),$org->getPicture());
        echo '<hr>';
      }

      /*for($i=1;$i<=count($groups);$i++){
        $d = new Org($groups[$i]['name'],$groups[$i]['location'],$groups[$i]['type'],$groups[$i]['picture'],$groups[$i]['about'],$groups[$i]['url']);
        echo showItem($i,$d->getName(),$d->getLocation(),$d->getPicture());
        echo '<hr>';      
      }*/
    ?>
    <div class="jumbotron">
    	<h1 class="display-4">Create Entry</h1>
    	<p class="lead">Create an entry for a Non-Profit Organization</p>
    	<hr class="my-4">
    	
    <a class="btn btn-primary btn-lg" href="create.php" role="button">Click to create</a>
	</div>	
  </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>
