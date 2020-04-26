<?php
session_start();
if((empty($_SESSION['email']))) die("<a href='index.php>home</a>'");//check if the user is logged in
session_destroy();//if they are destroy the session to log them out
?>
<a href="index.php">home</a>