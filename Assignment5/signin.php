<?php
function signin($database_file,$userid_field){
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
		
		// check if email is already there
		$h=fopen($database_file,'r');
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
		return 'The email you entered is not associated with any user account. Please <a href="signup.php">Sign up</a>';
	}
}
if(count($_POST)>0){ // when user submits form:
	$error=signin('user_data.csv.php',$_POST['email']);
	if(isset($error{0})) echo $error;
	else echo 'Successful';
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