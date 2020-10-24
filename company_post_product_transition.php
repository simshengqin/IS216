<?php
header("Access-Control-Allow-Origin: *");

require_once 'include/common.php';
require_once 'include/protect.php';

$productDAO = new productDAO();

$phpObj = json_decode($_POST["data"],true);
$product = $phpObj['result'];


  //$productId = $product["product_id"];
  $companyID = $product["company_id"];
  $name = $product["productName"];
  $type = $product["productType"];
  $qty = $product["productQty"];
  $modeOfCollection = $product["productModeOfCollection"];
  $beforePrice = $product["productBeforePrice"];
  $afterPrice = $product["productAfterPrice"];
  $decay_date = $product["decay_date"];
  $decay_time = $product["decay_time"];
  $posted_date = $product["posted_date"];
  $posted_time = $product["posted_time"];
  
  

  // Check if the directory exsit, else create new directory
  $dir = 'images/'.$type;
  if(is_dir($winDir)){
    $diplayOutput_directoryExist = "directory exist";
  } else{
    $diplayOutput_directoryExist = "directory does not exist";
    mkdir($dir);
  }

  $source = $product["image_path_source"];
  $destination = $dir;
  if(!copy($source, $destination)){
    $diplayOutput_copy = "was not able to copy file to destination";
  } else {
    $diplayOutput_copy = "file copied to destination";
  }


  //$output = $productDAO->add($productId, $companyID, $decay_date, $decay_time, $name, $posted_date, $posted_time, $afterPrice, $beforePrice, $qty, $type, $modeOfCollection);
  $output = $productDAO->add( $companyID, $decay_date, $decay_time, $name, $posted_date, $posted_time, $afterPrice, $beforePrice, $qty, $type, $modeOfCollection);

  $result = array("result" =>  $diplayOutput_copy);
  $jsonObj = json_encode($result);
  echo $jsonObj;

?>
