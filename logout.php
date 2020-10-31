<?php
   if(isset($_SESSION['id'])){
	session_destroy();
	unset($_SESSION['id']);
	unset($_SESSION['name']);
	header("Location: user_login.php");
	echo"hi";
}

?>