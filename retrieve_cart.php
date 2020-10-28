<?php
require_once "include\common.php";
if(isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    
    //companyDAO is for retrieving the and company image
    $userDAO = new userDAO();
    $cart_company_id = $userDAO -> retrieve_cart_company_id($user_id);
    $cart = $userDAO -> retrieve_user_cart($user_id);
    
  
    echo "$cart";

}

?>