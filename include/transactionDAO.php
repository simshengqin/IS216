<?php
//require_once 'common.php';
class transactionDAO {
  
    public function retrieve_transactions_by_user_id($userid){
        $sql = "SELECT * FROM transaction_history WHERE 
        userid = :userid";

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new transaction_history($row['transaction_id'], $row['userid'], $row['product_id'], $row['company_id'], $row['order_date'], $row['order_time'], $row['amount'], $row['collection_type'], $row['review'], $row['rating']);
        }
        return $result;
    }

    
    public function remove_transaction($transaction_id){
        $sql = "DELETE * FROM transaction_history WHERE transaction_id = :transaction_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':transaction_id', $transaction_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $status = $stmt->execute();
        return $status;
    }

    public function removeAll(){
        $sql = 'TRUNCATE TABLE orders';
        
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        $count = $stmt->rowCount();
    }

    
}

// $orderDAO = new orderDAO();
// $order = $orderDAO ->retrieve_orders_by_user_id(1);
// var_dump($order);



?>