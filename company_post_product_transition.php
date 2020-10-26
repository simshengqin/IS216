<?php
header("Access-Control-Allow-Origin: *");

require_once 'include/common.php';
require_once 'include/protect.php';

$productDAO = new productDAO();

if(isset($_POST["productName"]) && isset($_POST["productType"]) && isset($_POST["productQuantity"]) && 
  isset($_POST["modeOfCollection"]) && isset($_POST["beforePrice"]) && isset($_POST["afterPrice"]) && 
  isset($_POST["dateInput"]) && isset($_POST["company_id"]) && isset($_POST["posted_date"]) && 
  isset($_POST["posted_time"]) && isset($_POST["image_path_source"]) && isset($_POST["timeInput"]))
{
  
  $company_id = $_POST["company_id"];
  $name = $_POST["productName"];
  $category = $_POST["productType"];
  $qty = $_POST["productQuantity"];
  $modeOfCollection = $_POST["modeOfCollection"];
  $beforePrice = $_POST["beforePrice"];
  $afterPrice = $_POST["afterPrice"];
  $decay_date = $_POST["dateInput"];
  $decay_time = $_POST["timeInput"];
  $posted_date = $_POST["posted_date"];
  $posted_time = $_POST["posted_time"];

  //var_dump($_POST["image_path_source"]);
  //var_dump($_POST["image_Name"]);
  //var_dump($_FILES["productImageUpload"]["tmp_name"]);
}

/* No longer required, as directory is made when start
// Check if the directory exsit, else create new directory
  $dir = 'images/'.$_POST["productType"];
  if(is_dir($dir)){
    $diplayOutput_directoryExist = "directory exist";
  } else{
    $diplayOutput_directoryExist = "directory does not exist";
    mkdir($dir);
  }
*/

  // Copy the file and rename
  // Php sents a temp file to the www folder, from there it would be use to be uploaded into the Database 
  //$source = "C:/Users/Victor/Desktop/".$_POST["image_path_source"];
  $dir = 'images/product/'.$company_id;
  $source = $_FILES["productImageUpload"]["tmp_name"];
  $destination = $dir."/".$_POST["image_path_source"];  

  if(!copy($source, $destination)){
    $diplayOutput_copy = "was not able to copy file to destination";
  } else {
    $diplayOutput_copy = "file copied to destination";
    copy($source, $destination);
    //echo $source ." to ".$destination;
    rename($destination, $dir."/".$_POST["productName"].'.jpg');
    $image_url = "./".$dir."/".$_POST["productName"].'.jpg';
  }

  var_dump("directory ". $dir );
  var_dump("destination". $destination);
  var_dump("Image url: ".$image_url);

  $output = $productDAO->add( $company_id, $decay_date, $decay_time, $name, 
      $posted_date, $posted_time, $afterPrice, $beforePrice, $qty, $category, $modeOfCollection, $image_url);

  //var_dump($output);

//header("Location: company_edit_product.php");
//exit();



/*
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
  $imgaeName = $product["productImage"];

  
  // Check if the directory exsit, else create new directory
  $dir = 'images/'.$type;
  if(is_dir($dir)){
    $diplayOutput_directoryExist = "directory exist";
  } else{
    $diplayOutput_directoryExist = "directory does not exist";
    mkdir($dir);
  }

  //$source = $product["image_path_source"];
  
  $source = "C:\Users\Victor\Desktop".$imgaeName;
  $destination = $dir;

  if(!copy($source, $destination)){
    $diplayOutput_copy = "was not able to copy file to destination";
  } else {
    $diplayOutput_copy = "file copied to destination";
  }


  //$output = $productDAO->add($productId, $companyID, $decay_date, $decay_time, $name, $posted_date, $posted_time, $afterPrice, $beforePrice, $qty, $type, $modeOfCollection);
  $output = $productDAO->add( $companyID, $decay_date, $decay_time, $name, $posted_date, $posted_time, $afterPrice, $beforePrice, $qty, $type, $modeOfCollection);
  
  $result = array("result" =>  $diplayOutput_copy );
  $jsonObj = json_encode($result);
  echo $jsonObj;
*/
?>
