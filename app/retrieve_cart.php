<?php
require_once "include/common.php";
if(isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    //companyDAO is for retrieving the and company image
    $userDAO = new userDAO();
    $cart = $userDAO -> retrieve_user_cart($user_id);
    
  
    echo "$cart";

}

?>