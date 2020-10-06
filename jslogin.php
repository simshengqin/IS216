<?php
    session_start();
    require_once 'include/common.php';
    require_once 'include/protect.php';
    

    $username = $_POST["username"];
    $password = $_POST["password"];

    $userDAO = new userDAO();
    $result = (int)$userDAO->get_user($username,$password);
    
    if( $result ) {
        echo "1";
        $_SESSION['login'] = $user;    
    
     } else{
        echo "error";
    }
?>