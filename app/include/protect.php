<?php
//ADD PROTECTION CODE HERE
require_once 'common.php';

if (!isset($_SESSION["user_id"]) && !isset($_SESSION["company_id"])) {
	header("Location: user_login.php");
}

if(isset($_GET['logout'])){
	
	if (isset($_SESSION["company_id"])) {
		session_destroy();
		unset($_SESSION);
		header("Location: ../company_login.php");
	}
	else {
		session_destroy();
		unset($_SESSION);
		header("Location: ../user_login.php");
	}
	
	echo"hi";
}


?>