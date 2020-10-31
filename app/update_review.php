<?php
require_once 'include/common.php';
require_once 'include/protect.php';
if(isset($_POST['user_id']) && isset($_POST['rating']) && isset($_POST['review'])){
    $user_id = $_POST['user_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
 
    $transactionDAO = new transactionDAO();
    $transactionDAO-> update_transaction($user_id, $rating, $review, 'true');
    
    //echo "$user_id"."  $rating"."  $review";
    echo "Successfully updated your completed orders!";
}

?>