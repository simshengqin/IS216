<?php

    require_once 'include/common.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    //$userDAO = new userDAO();
    //$companyDAO = new companyDAO();
    $connMgr = new ConnectionManager();       
    $conn = $connMgr->getConnection();

    //$sql = "SELECT * FROM user where email= ? and password = ? limit 1";
    $sql = "SELECT user.user_id, user.cart_company_id, user.name as username, company.name as cart_company_name FROM user JOIN company
             ON user.email= ? AND user.password= ? AND user.cart_company_id=company.company_id";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$username,$password]);
         
    if( $result ) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);  
        if( $stmt->rowCount()> 0 ){
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['cart_company_id'] = $user['cart_company_id'];
            $_SESSION['cart_company_name'] = $user['cart_company_name'];
            $_SESSION['name'] = $user['username'];
            echo"1";
        } else {
            "There is no user";
        }
    
     } else{
        echo "error";
    }
?>