<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';

    $companyDAO = new companyDAO();
    $productDAO = new productDAO();
    
    if (isset($_GET["company_id"])) {
        $company_id = $_GET["company_id"];   
    }
    else {
      $company_id = "1";
    }

    //if(isset($_POST["productid"]) && isset($_POST["decay_date"]) && isset($_POST["decay_time"]) && isset($_POST["price_after"]) && isset($_POST["quantity"]))
    if(isset($_POST['editProduct']))
    {
      $id = $_POST["productid"];
      $decay_date = $_POST["decay_date"];
      $decay_time = $_POST["decay_time"];
      $price_after = $_POST["price_after"];
      $quantity = $_POST["quantity"];
      $result = $productDAO->update_product_by_productid($id, $decay_date, $decay_time, $price_after, $quantity);
      if($result){
        header("Location: company_edit_product.php#{$id}");
      }
    }
    if(isset($_POST['deleteProduct']))
    {
      $id = $_POST["productid"];
      $result = $productDAO->remove_product($id);;
      if($result){
        header("Location: company_edit_product.php");
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Eco</title>

  <!-- Bootstrap core CSS -->
  <link href="startbootstrap-business-frontpage-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="startbootstrap-business-frontpage-gh-pages/css/business-frontpage.css" rel="stylesheet">
  <!-- Roboto Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

  <link rel="stylesheet" href="css/maincss.css">

  <style>

  </style>

</head>

<body>

<!-- Navigation Bar -->
<!--
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
    <a class="navbar-brand" href="mainpage.html">Eco</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active mr-4">
          <a class="nav-link" href="company_profile.php"> Dashboard <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="company_post_product.php"> Post </a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="company_edit_product.php"> Edit </a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
-->
<?php include 'include/company_navbar.php';?>

  <!--Company profile  -->
  <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                  </br>
                  <h1 class="text-center font-weight-light"> Edit </h1>
                  </br>
                  </br>
                </div>
            </div>

            <div class='row'>

                    <?php displayProducts($company_id) ?>

            </div>

        </div>
    </div>

    <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <p class="text-center">Copyright &copy; Eco G5T4 2020</p>
    </div>
    <!-- /.container -->
  </footer>    

  <script>



document.addEventListener("DOMContentLoaded", function(event) { 
    var singaporeDateUnmodified = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"}).split(',')[0];
      
      var singaporeDate = "";
      singaporeDate += singaporeDateUnmodified.split('/')[2]; // Year
      singaporeDate += "-";                         
      singaporeDate += singaporeDateUnmodified.split('/')[0]; // Month
      singaporeDate += "-";   
      singaporeDate += singaporeDateUnmodified.split('/')[1]; // Date

      var results = document.getElementsByClassName("dateInput");
      for(var ele of results){
        ele.setAttribute('min', singaporeDate);
      }

      var time = document.getElementsByClassName("timeInput");
      for(var ele of time){
        var timeUnmodified = ele.getAttribute('value')
        var hour = timeUnmodified.split(':')[0];
        var min = timeUnmodified.split(':')[1];
        var newTime = hour + ":" + min;
        ele.setAttribute('value', newTime);
      }

});





  </script>    

  </body>

<?php 
  function displayProducts($company_id) {
      $companyProducts = new productDAO();
      $products = $companyProducts->retrieve_product_by_company($company_id);
      foreach($products as $product){
        $time = convertTime($product->get_decay_time());
        echo"
        <div class='col-md-12 text-center' id='{$product->get_product_id()}'>
          <h1 style='visibility: hidden;'>  - </h1>
        </div>

        <div class='col-md-6 text-center' style='padding-bottom: 30px;'>
            <!-- <img class='.img-fluid' style='max-width: 75%; height: auto' src='images/{$product->get_category()}/{$product->get_name()}.jpg'> -->
            <img class='.img-fluid' style='max-width: 75%; height: auto' src='{$product->get_image_url()}'>
        </div>

        <div class='col-md-6'>
        <form action='company_edit_product.php' method='POST'>

            <h3 class='card-title font-weight-light'>".strtoupper(str_replace('_', ' ', $product->get_name()))."</h3>

            <input type='hidden' name='errorBugBlock' value={$product->get_product_id()}>

            <input type='hidden' name='productid' value={$product->get_product_id()}>

            <div class='form-group'>
                <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text' id='{$product->get_product_id()}date'> End Date </span>
                    </div>
                    <input class='form-control form-control-lg dateInput' id='{$product->get_product_id()}_decay_date' name='decay_date' type='date' value='{$product->get_decay_date()}' aria-describedby='{$product->get_product_id()}date'>
                    <p id='errorQuantity' style='visibility: hidden; color: red;'> </p>
                </div>
            </div>

            <div class='form-group'>
                <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text' id='{$product->get_product_id()}time'> End Time </span>
                    </div>
                    <input class='form-control form-control-lg timeInput' id='{$product->get_product_id()}_decay_time' name='decay_time' type='time' value='{$time}' min='00:00:00' max='23:59:59' aria-describedby='{$product->get_product_id()}time'>
                    <p id='errorQuantity' style='visibility: hidden; color: red;'> </p>
                </div>
            </div>

            
            <h4 class='card-text font-weight-light'> Before Price: $ {$product->get_price_before()}</h4>


            <div class='form-group'>
                <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text' id='{$product->get_product_id()}afterprice'> After Price $</span>
                    </div>
                    <input class='form-control form-control-lg' id='{$product->get_product_id()}_price_after' name='price_after' type='double' value='{$product->get_price_after()}' aria-describedby='{$product->get_product_id()}afterprice'>
                    <p id='errorQuantity' style='visibility: hidden; color: red;'> </p>
                </div>
            </div>


            <div class='form-group'>
                <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text' id='{$product->get_product_id()}qty'> Quantity </span>
                    </div>
                    <input class='form-control form-control-lg' id='{$product->get_product_id()}_quantity' name='quantity' type='double' value='{$product->get_quantity()}' aria-describedby='{$product->get_product_id()}qty'>
                    <p id='errorQuantity' style='visibility: hidden; color: red;'> </p>
                </div>
            </div>


            <button type='submit' class='btn btn-info btn-lg btn-block' name='editProduct' style='left: 0%;'> Update </button>
            <button type='submit' class='btn btn-danger btn-lg btn-block ' name='deleteProduct'style='left: 0%;'> Delete </button>
        </form>
        </div>

        <div class='col-md-12'>
            </br>
            </br>
        </div>  
      ";
      }
    }

    function convertTime($time){
        $tempTime = explode(".",$time);
        $newTime = $tempTime[0];
        return $newTime;
    }
?>