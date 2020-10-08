<?php

class ConnectionManager {
   
    public function getConnection() {
        /*
        $host = "localhost";
        $username = "root";
        if (PHP_OS == 'Linux')
            $password = '6LNDUXQRTKCb';
        else
            $password = "";  
        $dbname = "is216";
        $port = 3308;    

        $url  = "mysql:host={$host};dbname={$dbname};port={$port}";
        
        $conn = new PDO($url, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        return $conn;  
        */
        
        $host = "is216.cotlwptbe0ig.ap-southeast-1.rds.amazonaws.com";
        $username = "admin";
        $password = "is216eco123";
        $db_name = "is216";
        
        return new PDO('mysql:host=' . $host . ';dbname=' . $db_name, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        
    }
    
}
