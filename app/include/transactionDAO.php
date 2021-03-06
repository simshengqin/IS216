<?php

class transactionDAO {
  
    public function retrieve_transactions_by_user_id($userid){
        $sql = "SELECT * FROM transactions WHERE 
        userid = :userid ORDER BY transaction_id DESC";#order_date, order_time DESC";
        
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new transactions($row['transaction_id'], $row['userid'], $row['cart'], $row['company_id'], $row['order_date'], $row['order_time'], $row['amount'], $row['collection_type'], $row['review'], $row['rating'], $row['collected']);
        }
        return $result;
    }
    public function retrieve_unrated_transactions_by_user_id($userid){
        //rating = 0 means not rated yet, rating = -1 means customer dont want to review
        $sql = "SELECT * FROM transactions WHERE 
        userid = :userid AND rating = 0 ORDER BY transaction_id DESC";#order_date, order_time DESC";
        
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new transactions($row['transaction_id'], $row['userid'], $row['cart'], $row['company_id'], $row['order_date'], $row['order_time'], $row['amount'], $row['collection_type'], $row['review'], $row['rating'], $row['collected']);
        }
        return $result;
    }
    public function retrieve_rated_transactions_by_user_id($userid){
        $sql = "SELECT * FROM transactions WHERE 
        userid = :userid AND rating != 0 ORDER BY transaction_id DESC";#order_date, order_time DESC";
        
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new transactions($row['transaction_id'], $row['userid'], $row['cart'], $row['company_id'], $row['order_date'], $row['order_time'], $row['amount'], $row['collection_type'], $row['review'], $row['rating'], $row['collected']);
        }
        return $result;
    }
    public function retrieve_transactions_by_company_id($company_id){
        $sql = "SELECT * FROM transactions WHERE 
        company_id = :company_id ORDER BY transaction_id DESC";#order_date, order_time DESC";
        
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new transactions($row['transaction_id'], $row['userid'], $row['cart'], $row['company_id'], $row['order_date'], $row['order_time'], $row['amount'], $row['collection_type'], $row['review'], $row['rating'], $row['collected']);
        }
        return $result;
    }



    public function add($userid, $cart, $company_id, $order_date, $order_time, $amount, $collection_type, $review, $rating, $collected){       
        $sql = 'INSERT INTO transactions (userid, cart, company_id, order_date, order_time, amount, collection_type, review, rating, collected) 
                    VALUES (:userid, :cart, :company_id, :order_date, :order_time, :amount, :collection_type, :review, :rating, :collected)';
        
        $connMgr = new ConnectionManager();       
        $conn = $connMgr->getConnection();
         
        $stmt = $conn->prepare($sql); 

      
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindParam(':cart', $cart, PDO::PARAM_STR);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
        $stmt->bindParam(':order_date', $order_date, PDO::PARAM_STR);
        $stmt->bindParam(':order_time', $order_time, PDO::PARAM_STR);
        $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
        $stmt->bindParam(':collection_type', $collection_type, PDO::PARAM_STR);
        $stmt->bindParam(':review', $review, PDO::PARAM_STR);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':collected', $collected, PDO::PARAM_STR);
        

        $isAddOK = False;
        if ($stmt->execute()) {
            $isAddOK = True;
        }

        return $isAddOK;
    }


    
    public function remove_transaction($transaction_id){
        $sql = "DELETE * FROM transactions WHERE transaction_id = :transaction_id";
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

    public function update_transaction($userid, $rating, $review, $collected){
        $sql = "UPDATE transactions SET rating = :rating, review =:review, collected=:collected WHERE userid =:userid AND (collected='false')";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_STR);
        $stmt->bindParam(':review', $review, PDO::PARAM_STR);
        $stmt->bindParam(':collected', $collected, PDO::PARAM_STR);
        return $stmt->execute();   
    }

    public function update_transaction_by_transaction_id($transaction_id, $rating, $review, $collected){
        $sql = "UPDATE transactions SET rating = :rating, review =:review, collected =:collected WHERE transaction_id =:transaction_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':transaction_id', $transaction_id, PDO::PARAM_INT);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_STR);
        $stmt->bindParam(':review', $review, PDO::PARAM_STR);
        $stmt->bindParam(':collected', $collected, PDO::PARAM_STR);
        return $stmt->execute();   
    }





    
}

// $orderDAO = new orderDAO();
// $order = $orderDAO ->retrieve_orders_by_user_id(1);
// var_dump($order);



?>