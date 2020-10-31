<?php

class companyDAO {

    public function add($company_id, $password, $name, $school, $edollar) {
        $sql = 'INSERT INTO student (userid, password, name, school, edollar) 
                    VALUES (:userid, :password, :name, :school, :edollar)';
        
        $connMgr = new ConnectionManager();       
        $conn = $connMgr->getConnection();
         
        $stmt = $conn->prepare($sql); 

        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':school', $school, PDO::PARAM_STR);
        $stmt->bindParam(':edollar', $edollar, PDO::PARAM_STR);

        $isAddOK = False;
        if ($stmt->execute()) {
            $isAddOK = True;
        }

        return $isAddOK;
    }


    public function retrieve_all(){
        $sql = 'select * from company';

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new company($row['company_id'], $row['address'], $row['latitude'],$row['longtitude'], $row['description'], $row['following'], $row['joined_date'], $row['mode_of_collection'], $row['name'], $row['password'], $row['rating'],  $row['special_description']);
        }
        return $result;
    }
    public function retrieve_unique_special_description(){
        $sql = 'SELECT DISTINCT special_description FROM company';

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if ($row['special_description'] != "") {
                $result[] = $row['special_description'];
            }           
        }
        return $result;
    }
    public function retrieve_products_by_special_description($special_description){
        $sql = "SELECT * FROM company WHERE special_description = :special_description";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':special_description', $special_description, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new company($row['company_id'], $row['address'], $row['latitude'],$row['longtitude'], $row['description'], $row['following'], $row['joined_date'], $row['mode_of_collection'], $row['name'], $row['password'], $row['rating'],  $row['special_description']);
        }
        return $result;
    }
    public function retrieve_top_rated_companies(){
        $sql = "SELECT * FROM company WHERE rating > 4.69";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new company($row['company_id'], $row['address'], $row['latitude'],$row['longtitude'], $row['description'], $row['following'], $row['joined_date'], $row['mode_of_collection'], $row['name'], $row['password'], $row['rating'],  $row['special_description']);
        }
        return $result;
    }
    public function retrieve_companies(){
        $sql = "SELECT * FROM company";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new company($row['company_id'], $row['address'], $row['latitude'],$row['longtitude'], $row['description'], $row['following'], $row['joined_date'], $row['mode_of_collection'], $row['name'], $row['password'], $row['rating'],  $row['special_description']);
        }
        return $result;
    }
    public function retrieve_company($company_id){
        $sql = "SELECT * FROM company WHERE company_id = :company_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new company($row['company_id'], $row['address'], $row['latitude'],$row['longtitude'], $row['description'], $row['following'], $row['joined_date'], $row['mode_of_collection'], $row['name'], $row['password'], $row['rating'],  $row['special_description']);
        }
        return $result;
    }
    public function retrieve_company_name($company_id){
        $sql = "SELECT * FROM company WHERE company_id = :company_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = $row['name'];
        }
        return $result;
    }
    public function retrieve_company_address($company_id){
        $sql = "SELECT * FROM company WHERE company_id = :company_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = $row['address'];
        }
        return $result;
    }
    public function retrieve_company_from_company_name($name){
        $sql = "SELECT * FROM company WHERE name = :name";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new company($row['company_id'], $row['address'], $row['latitude'],$row['longtitude'], $row['description'], $row['following'], $row['joined_date'], $row['mode_of_collection'], $row['name'], $row['password'], $row['rating'],  $row['special_description']);
        }
        return $result;
    }
    public function remove_company($company_id){
        $sql = "DELETE * FROM company WHERE company_id = :company_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':company_id', $company_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $status = $stmt->execute();
        return $status;
    }

    public function removeAll(){
        $sql = 'TRUNCATE TABLE company';
        
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

    public function updateCompanyProfile($id, $description, $address) {
        // STEP 1
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();

        // STEP 2
        $sql = "UPDATE company SET description = :description, address = :address WHERE company_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);

        // STEP 3
        if( $stmt->execute() ) {
            // STEP 4
            $stmt = null;
            $conn = null;
            return true;
        }

        // STEP 4
        return false;
    }

    
}






?>