<?php

class productDAO {

    /*public function add($product_id, $company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $type, $mode_of_collection) */
    public function add($company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $type, $mode_of_collection){
        /*$sql = 'INSERT INTO product (product_id, company_id, decay_date, decay_time, name, posted_date, posted_time, price_after, price_before, quantity, type, mode_of_collection) 
                    VALUES (:product_id, :company_id, :decay_date, :decay_time, :name, :posted_date, :posted_time, :price_after, :price_before, :quantity, :type, :mode_of_collection)';*/
        
        $sql = 'INSERT INTO product (company_id, decay_date, decay_time, name, posted_date, posted_time, price_after, price_before, quantity, type, mode_of_collection) 
                    VALUES (:company_id, :decay_date, :decay_time, :name, :posted_date, :posted_time, :price_after, :price_before, :quantity, :type, :mode_of_collection)';
        

        $connMgr = new ConnectionManager();       
        $conn = $connMgr->getConnection();
         
        $stmt = $conn->prepare($sql); 

        //$stmt->bindParam(':product_id', $company_id, PDO::PARAM_INT);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_INT);
        $stmt->bindParam(':decay_date', $decay_date, PDO::PARAM_STR);
        $stmt->bindParam(':decay_time', $decay_time, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':posted_date', $posted_date, PDO::PARAM_STR);
        $stmt->bindParam(':posted_time', $posted_time, PDO::PARAM_STR);
        $stmt->bindParam(':price_after', $price_after, PDO::PARAM_STR);
        $stmt->bindParam(':price_before', $price_before, PDO::PARAM_STR);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        $stmt->bindParam(':mode_of_collection', $mode_of_collection, PDO::PARAM_STR);

        $isAddOK = False;
        if ($stmt->execute()) {
            $isAddOK = True;
        }

        return $isAddOK;
    }


    public function retrieve_all(){
        $sql = 'select * from product';

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new product($row['product_id'], $row['company_id'], $row['decay_date'], $row['decay_time'], $row['name'], $row['posted_date'], $row['posted_time'], $row['price_after'], $row['price_before'], $row['quantity'], $row['type'], $row['mode_of_collection']);
        }
        return $result;
    }

    public function retrieve_product($product_id){
        $sql = "SELECT * FROM product WHERE product_id = :product_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new product($row['product_id'], $row['company_id'], $row['decay_date'], $row['decay_time'], $row['name'], $row['posted_date'], $row['posted_time'], $row['price_after'], $row['price_before'], $row['quantity'], $row['type'], $row['mode_of_collection']);
        }
        return $result;
    }
    
    public function retrieve_product_by_company($company_id){
        $sql = "SELECT * FROM product WHERE company_id = :company_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new product($row['product_id'], $row['company_id'], $row['decay_date'], $row['decay_time'], $row['name'], $row['posted_date'], $row['posted_time'], $row['price_after'], $row['price_before'], $row['quantity'], $row['type'], $row['mode_of_collection']);
        }
        return $result;
    }
    public function remove_product($product_id){
        $sql = "DELETE * FROM product WHERE product_id = :product_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $status = $stmt->execute();
        return $status;
    }

    public function removeAll(){
        $sql = 'TRUNCATE TABLE student';
        
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        $count = $stmt->rowCount();
    }


    public function updateEDollar($userid,$edollar){
        $sql = "UPDATE student SET edollar =:edollar WHERE userid =:userid";
        $connMgr = new ConnectionManager();    
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->bindParam(':edollar', $edollar, PDO::PARAM_STR);
        $stmt->execute();
    }


    public function retrieve_product_type(){
        $sql = "SELECT DISTINCT type FROM product";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row["type"];
        }
        
        return $result;
    }


    
}






?>