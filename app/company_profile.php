<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';

    $companyDAO = new companyDAO();

    if(isset($_SESSION["company_id"])){
      $company_id = $_SESSION["company_id"];
    } else {
      header("Location: company_login.php");
      exit();
    }
   
  // Check if the directory exsit, else create new directory
  $dir = 'images/product/'.$company_id;
  if(is_dir($dir)){
    $diplayOutput_directoryExist = "directory exist";
  } else{
    $diplayOutput_directoryExist = "directory does not exist";
    mkdir($dir);
  }

    $company = $companyDAO->retrieve_company($company_id);
    
    $company_name = $company->get_name();
    $company_address = $company->get_address();
    $company_description = $company->get_description();
    $company_following = $company->get_following();
    $numOfFollowing = count(explode( ',', $company_following ));
    $company_joined_date = $company->get_joined_date();
    $company_rating = $company->get_rating();

    if(isset($_POST['companyAddress']) && isset($_POST['companyDescription'])) 
    {
      $update_company_address = $_POST['companyAddress'];
      $update_company_description =$_POST['companyDescription'];
      $companyDAO->updateCompanyProfile($company_id, $update_company_description, $update_company_address);
      header("Refresh:0");
    }

  ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">



  <title>Company Profile</title>

  <!-- Roboto Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!--Bootstrap 4 and AJAX-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!--Link to main.css files while contains all the css of this project-->
  <link rel='stylesheet' href='css\maincss.css'>

</head>


<body>

<script>
document.addEventListener("DOMContentLoaded", function(event) { 
  setInterval(function(){ 
    var data = document.getElementsByClassName("dateTimeInputLeft");
    for(var ele of data){
      var id_Date_Time = ele.getAttribute('value');
    
      var productid = id_Date_Time.split("*")[0];
      var decay_date_Unmodified = id_Date_Time.split("*")[1];
      var decay_time_Unmodified = id_Date_Time.split("*")[2];
      // date
      var year = decay_date_Unmodified.split("-")[0];
      var month = decay_date_Unmodified.split("-")[1];
      var day = decay_date_Unmodified.split("-")[2];
      // convert month num into month text
      var monthList = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
      month = month -1;
      var monthText = "";
      for(var i = 0; i < monthList.length; i++){
        if(month == i){
          monthText = monthList[i];
        }
      }
      // time
      var decay_time_Unmodified_without_milliseconds = decay_time_Unmodified.split(".")[0];
      var hour = decay_time_Unmodified_without_milliseconds.split(':')[0];
      var min = decay_time_Unmodified_without_milliseconds.split(':')[1];
      var sec = decay_time_Unmodified_without_milliseconds.split(':')[2];
      // date time input into string format
      var newTime = " " + monthText + " " + day + ", " + year + " " + hour + ":" + min + ":" + sec + "";
      
      var countDownDate = new Date(newTime).getTime();
      var now = new Date().getTime();
      var timeRemaining =  countDownDate - now;

      var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
      var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
      var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

      document.getElementById(productid).innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";

      if (timeRemaining < 0) {
        document.getElementById(productid).innerHTML = "<p style='color:red'> EXPIRED </p>";
      }
    }
  }, 1000);

});

</script>


  <?php include 'include/company_navbar.php';?>

  <!--Company profile  -->
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    </br>
                    <h1 class="text-center font-weight-light"> Profile </h1>
                    </br>
                </div>
                
                <div class="col-md-6 text-center">
                    <img class="mr-2 mb-2 bg-white" width="200px" src="images/profile_picture/company/<?php echo $company_id ?>.png"></img>
                    <h3> <?php echo ucfirst(str_replace('_', ' ', $company_name))?></h3>
                    <div> <i class="fas fa-star mr-2"></i> <span> Rating: <?php echo $company_rating ?></span> </div>
                    
                    </br>
                    
                </div>
                
                <div class="col-md-6">
                  <form action='company_profile.php' method='POST'>
                    <div class="form-group">
                      <label for="companyAddress">Address</label>
                      <textarea rows="1" cols="50" class="form-control form-control-lg" name="companyAddress" id="companyAddress"><?php echo $company_address?></textarea>
                    </div>
                    <div class="form-group">
                      <label for="companyDescription">Description</label>
                      <textarea rows="4" cols="50" class="form-control form-control-lg" name="companyDescription" id="companyDescription"><?php echo $company_description?></textarea>
                    </div>
                    <button type="submit" class="btn btn-info btn-lg btn-block" style="left: 0%;"> Update </button>
                  </form>
                </div>

            </div>
            <!-- Company active products  -->
            <div class="row">
              
              <div class="col-md-12">
                </br>
                <h1 class="text-center font-weight-light"> Active Promotion </h1>
                </br>
              </div>

              <div class="col-md-12">
                <div class="card-deck">
                    <?php displayProducts($company_id); ?>
                </div>
              </div>

            </div>
            <!-- End of Company active products -->

        </div>
    </div>
    
  

  <?php include 'include/footer.php';?>


</body>

<?php

    function displayProducts($company_id) {
      $companyProducts = new productDAO();
      $products = $companyProducts->retrieve_product_by_company($company_id);
      foreach($products as $product){
        echo"
          <div class='col-md-4'>
            <div class='card mb-4 shadow-sm'>
              <!-- <img class='card-img-top' src='images/{$product->get_category()}/{$product->get_name()}.jpg' width='100%' height='225'> -->
              <img class='card-img-top' src='{$product->get_image_url()}' width='100%' height='225'>
              <div class='card-body'>
                <h4 class='card-title'> ".ucfirst(str_replace('_', ' ', $product->get_name()))."</h4>
                <p class='card-text'> Promotion End: </p>
                <input type='hidden' class='dateTimeInputLeft' value='{$product->get_product_id()}*{$product->get_decay_date()}*{$product->get_decay_time()}'>
                <p class='card-text text-center' style='font-size: 22px;' id='{$product->get_product_id()}')>  0:00:00 </p>
                <!-- <p class='card-text font-weight-light' style='margin-bottom: -5px; font-size: 18px;'> Before Price: $  {$product->get_price_after()}</p> -->
                <!-- <p class='card-text font-weight-light' style='font-size: 18px;' value=''> Sale's Price: $ {$product->get_price_before()} </p> -->
                
                <div class='form-group' style='margin-bottom:-30px;'>
                  <div class='input-group mb-3'>
                    <label for='salePrice_{$product->get_product_id()}' class='col-form-label' style='font-size: 20px;'> Sale's Price : $  </label>
                    <input type='text' readonly class='form-control-plaintext' name='salePrice' id='salePrice_{$product->get_product_id()}' value='{$product->get_price_before()}' style='font-size: 20px;'>
                  </div>
                </div>

                <div class='form-group' style='margin-bottom:-15px;'>
                <div class='input-group mb-3'>
                  <label for='Remaining_{$product->get_product_id()}' class='col-form-label' style='font-size: 20px;'> Qty: &nbsp </label>
                  <input type='text' readonly class='form-control-plaintext' id='Remaining_{$product->get_product_id()}' value='{$product->get_quantity()}' style='font-size: 20px;'>
                </div>
              </div>

                <!-- <p class='card-text'> Remaining: {$product->get_quantity()}</p> -->

                <a class='btn btn-info btn-lg btn-block' role='button' href='company_edit_product.php#{$product->get_product_id()}' style='left: 0%;'> Edit </a>
              </div>
            </div>
          </div>
      ";
      }
    }

?>

<script>




var salesPrice = document.getElementsByName("salePrice");
for(var ele of salesPrice){
  var num = ele.getAttribute('value');
  num = parseFloat(num);
  num = num.toFixed(2)
  console.log(num);
  ele.setAttribute('value', num);
}

</script>