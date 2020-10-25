<?php

class productDAO {

    /*public function add($product_id, $company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $category, $mode_of_collection) */
    public function add($company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $category, $mode_of_collection, $image_url){
        /*$sql = 'INSERT INTO product (product_id, company_id, decay_date, decay_time, name, posted_date, posted_time, price_after, price_before, quantity, category, mode_of_collection) 
                    VALUES (:product_id, :company_id, :decay_date, :decay_time, :name, :posted_date, :posted_time, :price_after, :price_before, :quantity, :category, :mode_of_collection)';*/
        
        $sql = 'INSERT INTO product (company_id, decay_date, decay_time, name, posted_date, posted_time, price_after, price_before, quantity, category, mode_of_collection, image_url) 
                    VALUES (:company_id, :decay_date, :decay_time, :name, :posted_date, :posted_time, :price_after, :price_before, :quantity, :category, :mode_of_collection, :image_url)';
        

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
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->bindParam(':mode_of_collection', $mode_of_collection, PDO::PARAM_STR);
        $stmt->bindParam(':image_url', $mode_of_collection, PDO::PARAM_STR);

        $isAddOK = False;
        if ($stmt->execute()) {
            $isAddOK = True;
        }

        return $isAddOK;
    }


    public function retrieve_all(){
        $sql = 'SELECT * FROM product';

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new product($row['product_id'], $row['company_id'], $row['decay_date'], $row['decay_time'], $row['name'], $row['posted_date'], $row['posted_time'], $row['price_after'], $row['price_before'], $row['quantity'], $row['category'], $row['mode_of_collection'], $row['image_url']);
        }
        return $result;
    }

    public function retrieve_unique_categories_by_company_id($company_id){
        $sql = 'SELECT DISTINCT category FROM product WHERE company_id = :company_id';

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $row['category'];
        }
        return $result;
    }
    public function retrieve_products_by_category($category){
        $sql = "SELECT * FROM product WHERE category = :category";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new product($row['product_id'], $row['company_id'], $row['decay_date'], $row['decay_time'], $row['name'], $row['posted_date'], $row['posted_time'], $row['price_after'], $row['price_before'], $row['quantity'], $row['category'], $row['mode_of_collection'], $row['image_url']);
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
            $result = new product($row['product_id'], $row['company_id'], $row['decay_date'], $row['decay_time'], $row['name'], $row['posted_date'], $row['posted_time'], $row['price_after'], $row['price_before'], $row['quantity'], $row['category'], $row['mode_of_collection'], $row['image_url']);
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
            $result[] = new product($row['product_id'], $row['company_id'], $row['decay_date'], $row['decay_time'], $row['name'], $row['posted_date'], $row['posted_time'], $row['price_after'], $row['price_before'], $row['quantity'], $row['category'], $row['mode_of_collection'], $row['image_url']);
        }
        return $result;
    }

    public function update_product_qty($product_id,$quantity){
        //Checks whether there is sufficient quantity in the database
        $sql = 'SELECT * FROM product WHERE product_id =:product_id';
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_STR);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //return $row['quantity'];
            $current_quantity = $row['quantity'];

        }
        $current_quantity = intval($current_quantity);
        $quantity = intval($quantity);
        if (($current_quantity + $quantity) < 0) {
            #Not enough quantity
            return false;
        } 
        else {
            $quantity = strval($current_quantity + $quantity);
            //return $quantity . " " . $product_id;
            $sql2 = "UPDATE product SET quantity =:quantity WHERE product_id =:product_id";
            $connMgr2 = new ConnectionManager();    
            $conn2 = $connMgr2->getConnection();
            $stmt2 = $conn2->prepare($sql2);
            $stmt2->bindParam(':quantity', $quantity, PDO::PARAM_STR);
            $stmt2->bindParam(':product_id', $product_id, PDO::PARAM_STR);
            return $stmt2->execute();   
                    
        }

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


    public function retrieve_product_category(){
        $sql = "SELECT DISTINCT category FROM product";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $result[] = $row["category"];
        }
        
        return $result;
    }


    
}






?>