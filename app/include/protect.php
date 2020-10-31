<?php
//ADD PROTECTION CODE HERE
require_once 'common.php';

if (!isset($_SESSION["user_id"]) && !isset($_SESSION["company_id"])) {
	header("Location: user_login.php");
}

if(isset($_GET['logout'])){
	session_destroy();
	unset($_SESSION);
	header("Location: ../user_login.php");
	echo"hi";
}

/*
$token = '';
if (isset($_REQUEST['token'])) {
	$token = $_REQUEST['token'];
}
elseif (isset($_SESSION['token'])) {
	$token = $_SESSION['token'];
}

# check if token is not valid
# send user back to the login page with the appropirate message
if (!isset($_SESSION['user']) || ($_SESSION['user'] == 'admin' && !verify_token($token)))
    header('location: login.php?error=Please login');
*/
?>