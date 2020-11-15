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

  $totalProducts = $productDAO->retrieve_product_by_company($company_id);
  $uniqueNum = count($totalProducts);
  $uniqueNum += 1;
 
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
  
  var_dump("Source: ".$source);
  var_dump("Destination: ".$destination);

  if(!copy($source, $destination)){
    $diplayOutput_copy = "was not able to copy file to destination";
  } else {
    $diplayOutput_copy = "file copied to destination";
    copy($source, $destination);
    
    rename($destination, $dir."/".$_POST["productName"]."_".$uniqueNum.'.jpg');
    
    $image_url = "./".$dir."/".$_POST["productName"]."_".$uniqueNum.'.jpg';
  }

  var_dump("directory: ". $dir );
  var_dump("destination:". $destination);
  var_dump("Image url: ".$image_url);

  $visible = "true";

  $output = $productDAO->add( $company_id, $decay_date, $decay_time, $name, 
      $posted_date, $posted_time, $afterPrice, $beforePrice, $qty, $category, $modeOfCollection, $image_url, $visible);



header("Location: company_edit_product.php");
exit();




?>
