<?php
session_start();
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
function signin($db){
		// check if email is valid
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			return 'The email you entered is not valid';
		}
		$_POST['email']=strtolower($_POST['email']);
		

		
		// check if email is already there
		$q=$db->prepare('SELECT * FROM users WHERE email=?');
		$q->execute([$_POST['email']]);
		$record=$q->fetch();
		if(isset($record['id'])){
			//$_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);

			if(!password_verify($_POST['password'], $record['password'])){
				return 'Incorrect Password Try again';
			}
			$_SESSION['email']=$_POST['email'];
			$_SESSION['id']=$record['id'];
			return '';

		}
		else
			return 'email is not registered';
			


		/*$h=fopen($database_file,'r');
		while(!feof($h)){
			$line=preg_replace('/\n/','',fgets($h));
			if(strstr($line,$_POST['email'])){
				$line=explode(';',$line);
				if(!password_verify($_POST['password'],$line[1])){
					fclose($h);
					return 'The password you entered does not match the stored password';
				}
				// passwords match!
				$_SESSION[$userid_field]=$_POST['email'];
				fclose($h);
				return '';
				
			}
		}
		fclose($h);
		return 'The email you entered is not associated with any user account. Please <a href="signup.php">Sign up</a>';*/
	
}
if(count($_POST)>0){ // when user submits form:
	$error=signin($db);
	if(isset($error{0})) echo $error;
	else echo 'Successful';
	echo '<br>';
}
?>
<h1>Sign in</h1>
<form action="signin.php" method="POST">
E-mail
<input type="email" name="email" required /><br />
Password
<input type="password" name="password" required minlength="8" /><br />
<button type="submit">Access account</button>
</form>
<br>
<a href="index.php">Home</a>
<?php
if(!empty($_SESSION['email']))
	echo '<br><a href="admin/admin.php">Admin Page</a>';
