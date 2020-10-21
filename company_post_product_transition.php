<?php
header("Access-Control-Allow-Origin: *");

require_once 'include/common.php';
require_once 'include/protect.php';



if(isset($_POST["data"])){
    $phpObj = json_decode($_POST["data"]);
    $product = $phpObj->data;

    $name = $product["productName"];
    $type = $product["productType"];
    $qty = $product["productQty"];
    $modeOfCollection = $product["productModeOfCollection"];
    $beforePrice = $product["productBeforePrice"];
    $afterPrice = $product["productAfterPrice"];
    $dateInput = $product["productDateInput"];
    $TimeInput = $product["productTimeInput"];

/*
    $product = $data["data"];
    $productName = $product["productName"];
    */
    
    

    $jsonObj = json_encode($result);
    echo $jsonObj;
    
  }

?>
