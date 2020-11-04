<?php

    require_once 'include/common.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $userDAO = new userDAO();
    $connMgr = new ConnectionManager();       
    $conn = $connMgr->getConnection();

    $sql = "SELECT * FROM user where email= ? limit 1";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$username]);
    if( $result ) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);   
        if (password_verify($password, $user['password'])) {
             if( $stmt->rowCount()> 0 ){
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['cart_company_id'] = $user['cart_company_id'];
                echo"1";
            } else {
                "There is no user";
            }
        }
       
    
     } else{
        echo "error";
    }
?>