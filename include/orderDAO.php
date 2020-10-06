<?php
//require_once 'common.php';
class orderDAO {
  
    public function retrieve_orders_by_user_id($userid){
        $sql = "SELECT * FROM orders WHERE 
        userid = :userid";

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new order($row['order_id'], $row['userid'], $row['food_id'], $row['company_id'], $row['order_date'], $row['order_time'], $row['amount'], $row['collection_type'], $row['review'], $row['rating']);
        }
        return $result;
    }

    
    public function remove_order($order_id){
        $sql = "DELETE * FROM orders WHERE order_id = :order_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':order_id', $order_id, PDO::PARAM_INT);
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