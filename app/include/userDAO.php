<?php

class userDAO {

    public function add( $password, $name, $email, $phoneNumber, $cart, $cart_company_id, $preferences) {
        $sql = 'INSERT INTO user ( password, name, email, phoneNumber, cart, cart_company_id, preferences) 
                    VALUES ( :password, :name, :email, :phoneNumber, :cart, :cart_company_id ,:preferences)';
        
        $connMgr = new ConnectionManager();       
        $conn = $connMgr->getConnection();
         
        $stmt = $conn->prepare($sql); 

  
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phoneNumber', $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(':cart', $cart, PDO::PARAM_STR);
        $stmt->bindParam(':cart_company_id', $cart_company_id, PDO::PARAM_INT);
        $stmt->bindParam(':preferences', $preferences, PDO::PARAM_STR);

        $isAddOK = False;
        if ($stmt->execute()) {
            $isAddOK = True;
        }

        return $isAddOK;
    }

    public function get_user( $username, $password ){
        $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
        $connMgr = new ConnectionManager();
        $conn = $connMgr ->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam( ":email", $username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->execute();
        
        
        return $result;
    }


    public function retrieve_all(){
        $sql = 'select * from user';

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new user($row['user_id'], $row['cart']);
        }
        return $result;
    }

    public function retrieve_user($user_id){
        $sql = "SELECT * FROM user WHERE user_id = :user_id";

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new user($row['user_id'], $row['cart'], $row['cart_company_id'], $row['name'], $row['email'], $row['phoneNumber'], $row['preferences']);
        }
        return $result;
    }
    public function retrieve_user_cart_and_cart_company_id($user_id){
        $sql = "SELECT * FROM user WHERE user_id = :user_id";

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = [$row['cart'],$row['cart_company_id']];
        }
        return $result;
    }
    
    public function retrieve_user_preferences($user_id){
        $sql = "SELECT * FROM user WHERE user_id = :user_id";

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = $row['preferences'];
        }
        return $result;
    }
    public function retrieve_user_cart($user_id){
        $sql = "SELECT * FROM user WHERE user_id = :user_id";

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = $row['cart'];
        }
        return $result;
    }

    public function retrieve_cart_company_id($user_id){
        $sql = "SELECT * FROM user WHERE user_id = :user_id";

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = $row['cart_company_id'];
        }
        return $result;
    }

    public function update_user_cart($userid, $cart){
        $sql = "UPDATE user SET cart =:cart WHERE user_id =:user_id";
        $connMgr = new ConnectionManager();    
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userid, PDO::PARAM_STR);
        $stmt->bindParam(':cart', $cart, PDO::PARAM_STR);
        $status = $stmt->execute();
        return $status;
    }
    public function update_user_cart_company_id($userid, $cart_company_id){
        $sql = "UPDATE user SET cart_company_id =:cart_company_id WHERE user_id =:user_id";
        $connMgr = new ConnectionManager();    
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userid, PDO::PARAM_STR);
        $stmt->bindParam(':cart_company_id', $cart_company_id, PDO::PARAM_STR);
        $status = $stmt->execute();
        return $status;
    }

    public function update_preferences($userid, $preferences){
        $sql = "UPDATE user SET preferences =:preferences WHERE user_id =:user_id";
        $connMgr = new ConnectionManager();    
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userid, PDO::PARAM_STR);
        $stmt->bindParam(':preferences', $preferences, PDO::PARAM_STR);
        $status = $stmt->execute();
        return $status;
    }


    public function retrieveStudent($userid){
        $sql = "SELECT * FROM student WHERE userid = :userid";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':userid', $userid, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = "";

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new Student($row['userid'], $row['password'],$row['name'], $row['school'], $row['edollar']);
        }
        return $result;
    }


    public function removeAll(){
        $sql = 'TRUNCATE TABLE student';
        
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        $count = $stmt->rowCount();
    }



    
}






?>