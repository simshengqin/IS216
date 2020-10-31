<?php
    //session_start();
    require_once 'include/common.php';
    require_once 'include/protect.php';

    $name = $_POST["name"];
    $password = $_POST["password"];

    $companyDAO = new companyDAO();
    $connMgr = new ConnectionManager();       
    $conn = $connMgr->getConnection();

    $sql = "SELECT * FROM company where name= ? and password = ? limit 1";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute([$name,$password]);
         
    if( $result ) {
        $company = $stmt->fetch(PDO::FETCH_ASSOC);  
        if( $stmt->rowCount()> 0 ){
            $_SESSION["company_id"] = $company['company_id'];
            echo"1";
        } else {
            "There is no user";
        }
    
     } else{
        echo "error";
    }
?>