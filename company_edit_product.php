<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';

    $companyDAO = new companyDAO();
    
    if (isset($_GET["company_id"])) {
        $company_id = $_GET["company_id"];   
    }
    else {
      $company_id = "1";
    }

    if(isset($_POST)){
      var_dump(count($_POST));
      foreach($_POST as $key => $value)
      {
          var_dump("the key: $key and it's vlaue: $value");
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
        <div class='col-md-6 text-center'>
            <img class='.img-fluid' style='max-width: 60%; height: auto' src='images/{$product->get_type()}/{$product->get_name()}.jpg'>
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
                    <input class='form-control form-control-lg' id='{$product->get_product_id()}_decay_date' name='decay_date' type='date' value='{$product->get_decay_date()}' aria-describedby='{$product->get_product_id()}date'>
                    <p id='errorQuantity' style='visibility: hidden; color: red;'> </p>
                </div>
            </div>

            <div class='form-group'>
                <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text' id='{$product->get_product_id()}time'> End Time </span>
                    </div>
                    <input class='form-control form-control-lg' id='{$product->get_product_id()}_decay_time' name='decay_time' type='time' value='{$time}' aria-describedby='{$product->get_product_id()}time'>
                    <p id='errorQuantity' style='visibility: hidden; color: red;'> </p>
                </div>
            </div>

            
            <h4 class='card-text font-weight-light'> Before Price: $ {$product->get_price_before()}</h4>


            <div class='form-group'>
                <div class='input-group mb-3'>
                    <div class='input-group-prepend'>
                        <span class='input-group-text' id='{$product->get_product_id()}afterprice'> After Price $</span>
                    </div>
                    <input class='form-control form-control-lg' id='{$product->get_product_id()}_price_after' name='price_after' type='number' value='{$product->get_price_after()}' aria-describedby='{$product->get_product_id()}afterprice'>
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


            <button type='submit' class='btn btn-info btn-lg btn-block'> Update </button>
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