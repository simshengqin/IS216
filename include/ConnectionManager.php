<?php

class ConnectionManager {
   
    public function getConnection() {
        
        $host = "localhost";
        $username = "root";
        if (PHP_OS == 'Linux')
            $password = '6LNDUXQRTKCb';
        else
            $password = "";  
<<<<<<< HEAD
            $dbname = "is216";
            $port = 3306;    
=======
        $dbname = "is216";
        $port = 3306;    
>>>>>>> b618f26f411b2199ed4a5fece58414668bdc4bd0

        $url  = "mysql:host={$host};dbname={$dbname};port={$port}";
        
        $conn = new PDO($url, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $conn;  
<<<<<<< HEAD
    
        
        // $host = "is216.cotlwptbe0ig.ap-southeast-1.rds.amazonaws.com";
        // $username = "admin";
        // $password = "is216eco123";
        // $db_name = "is216";
        
        // return new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
=======
        
        /*
        $host = "is216.cotlwptbe0ig.ap-southeast-1.rds.amazonaws.com";
        $username = "admin";
        $password = "is216eco123";
        $db_name = "is216";
        */
        return new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
>>>>>>> b618f26f411b2199ed4a5fece58414668bdc4bd0
        
    }
    
}
