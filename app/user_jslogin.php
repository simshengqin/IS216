<?php

    require_once 'include/common.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $userDAO = new userDAO();
    $connMgr = new ConnectionManager();       
    $conn = $connMgr->getConnection();

    $sql = "SELECT * FROM user where email= ? and password = ? limit 1";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$username,$password]);
         
    if( $result ) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);  
        if( $stmt->rowCount()> 0 ){
            $_SESSION['id'] = $user['user_id'];
            $_SESSION['name'] = $user['name'];
            echo"1";
        } else {
            "There is no user";
        }
    
     } else{
        echo "error";
    }
?>