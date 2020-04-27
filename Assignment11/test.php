<?php
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

//Must Create a PDO object in order to query from database
$db = new PDO('mysql:host='.$settings['host'].';dbname='.$settings['db'].';charset=utf8mb4',$settings['user'],$settings['pass'],$opt);

$result=$db->query('SELECT id,name FROM nonprofits');//Execute Query



while ($row=$result->fetch()) {//Process Result
	print_r($row);
	echo '<hr>';
}
echo $result->rowCount();//Method to find number of rows in query
$db->query('AlTER TABLE nonprofits AUTO_INCREMENT='.$result->rowCount());//This Query resets the Auto Increment of Tables

$result=$db->query('SELECT id,name FROM nonprofits WHERE id=3');//Execute Query selecting only one record
$row=$result->fetch();
echo '<h1>'.$row['name'].'</h1>';


/* CREATE */

//$db->query('INSERT INTO nonprofits(name,city,state,type,picture,url,about) VALUES("test","test","test","test","test","test","test")');
//Creates a test record
echo '<br>';
//echo $db->lastInsertId();//gets last inserted id
/*MODIFY*/
//$db->query('UPDATE nonprofits SET id=8 WHERE name="test"');
//Modifies a record in the database
/*DELETE*/
//$db->query('DELETE FROM nonprofits WHERE name="test"');

/*Prepared Statements*/
/*$q=$db->prepare('INSERT INTO nonprofits(name,city,state,type,picture,url,about) VALUES(?,?,?,?,?,?,?)');
$q->execute(["test","test","test","test","test","test","test"]);
*/
