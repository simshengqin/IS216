<?php
require_once 'include/common.php';
require_once 'include/protect.php';
if(isset($_POST['transaction_id']) && isset($_POST['rating']) && isset($_POST['review'])){
    $transaction_id = $_POST['transaction_id'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
 
    $transactionDAO = new transactionDAO();
    $transactionDAO-> update_transaction_by_transaction_id($transaction_id, $rating, $review, 'true');
    

    echo "Successfully added rating and review!";
}

?>