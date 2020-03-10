<?php
function signup($database_file){
	if(count($_POST)>0){ // when user submits form:
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
		if(!file_exists($database_file)){
			$h=fopen($database_file,'w+');
			fwrite($h,'<?php die() ?>'."\n");
			fclose($h);
		}
		// check if email is already there
		$h=fopen($database_file,'r');
		while(!feof($h)){
			$line=fgets($h);
			if(strstr($line,$_POST['email'])) return 'The email is already registered.';
		}
		fclose($h);
		
		// encrypt password
		$_POST['password']=password_hash($_POST['password'], PASSWORD_DEFAULT);
		
		//append the data to a file
		$h=fopen($database_file,'a+');
		fwrite($h,implode(';',[$_POST['email'],$_POST['password']])."\n");
		fclose($h);
		
		// welcome the user with a warm and cheerful message.
		echo 'You successfully registered your account. Now you can <a href="signin.php">Sign in</a>.';
		return '';
	}
}
if(count($_POST)>0){ // when user submits form:
	$error=signup("user_data.csv.php");
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