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

$db = new PDO('mysql:host='.$settings['host'].';dbname='.$settings['db'].';charset=utf8mb4',$settings['user'],$settings['pass'],$opt);
function signup($db){

		// check if email is valid
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			return 'The email you entered is not valid';
		}
		$_POST['email']=strtolower($_POST['email']);
		
		// check if password is valid and check if password meets requirements
		$_POST['password']=trim($_POST['password']);
		if(strlen($_POST['password'])<8){
			return 'The password must be at least 8 characters';
		}
		
		// if the database does not exist, we create it!!
		
		// check if email is already there
		$q=$db->prepare('SELECT * FROM users WHERE email=?');
		$q->execute([$_POST['email']]);
		$record=$q->fetch();
		if(isset($record['id']))
			return 'This email is already registered';
		// encrypt password
		$_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		//append the data to the record
		$q=$db->prepare('INSERT INTO users(email,password) VALUES(?,?)');
		$q->execute([$_POST['email'],$_POST['password']]);	
		// welcome the user with a warm and cheerful message.
		echo 'You successfully registered your account. Now you can <a href="signin.php">Sign in</a>.';
		return '';
}

if(count($_POST)>0){ // when user submits form:
	$error=signup($db);
	if(isset($error{0})) echo $error;
}
?>
<h1>Sign up</h1>
<form action="signup.php" method="POST">
E-mail
<input type="email" name="email" required /><br />
Password
<input type="password" name="password" required minlength="8" /><br />
<button type="submit">Create account</button>
</form>