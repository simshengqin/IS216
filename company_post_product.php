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

  <title>Eco</title>

  <!-- Bootstrap core CSS -->
  <link href="startbootstrap-business-frontpage-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="startbootstrap-business-frontpage-gh-pages/css/business-frontpage.css" rel="stylesheet">
  <!-- Roboto Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

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
          <a class="nav-link" href="company_profile.php"> Dashboard </a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="company_post_product.php"> Post <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="#"> Edit </a>
        </li>
      </ul>
    </div>
    </div>
  </nav>



  <!--Company profile  -->
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">

        <h1> Create Promotion </h1>
        </br>

        <form>
            <div class="form-row">

                    
                    <!-- Product Name-->
                    <div class="form-group col-md-6">
                        <input class="form-control form-control-lg" type="text" placeholder="Product Name">
                    </div>

                    <div class="form-group col-md-6">
                        <select class="form-control form-control-lg" id="productType">
                            <option disabled selected> Select Product's type </option>
                        </select>
                    </div>

                    <!-- Product Name-->
                    <div class="form-group col-md-6">
                        <input class="form-control form-control-lg" type="number" placeholder="Quantity">
                    </div>

                    <div class="form-group col-md-6">
                        <select class="form-control form-control-lg" id="modeOfCollection">
                            <option disabled selected> Mode Of Collection</option>
                            <option value="selfcollect"> Self-Collect Only</option>
                            <option value="delivery"> Delivery Only</option>
                            <option value="both"> Self-Collect / Delivery </option>
                        </select>
                    </div>


                    <!-- Before Price -->
                    <div class="input-group form-group col-md-6">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" class="form-control form-control-lg" placeholder="Before Price">                  
                    </div>

                    <!-- After Price -->
                    <div class="input-group form-group col-md-6">
                        <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                        </div>
                            <input type="number" class="form-control form-control-lg" placeholder="After Price">                  
                    </div>

                    <div class="form-group col-md-6">
                        <div class="form-group">
                            <label for="productImageUpload">Select Image to upload</label>
                            <input type="file" class="form-control-file form-control-lg" id="productImageUpload">
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <!-- empty -->
                    </div>


                    <div class="form-group col-md-6">
                        <!-- <label for="dateInput" class="col-form-label"><h5>End Date: </h5></label> -->
                        <span> Promotional End Date</span>
                        <input id="dateInput" class="form-control form-control-lg" type="date">
                    </div>

                    <div class="form-group col-md-6">
                        <!-- empty -->
                    </div>

                    <div class="form-group col-md-6">
                        <span> Promotional End Time</span>
                        <input id="timeInput" class="form-control form-control-lg" type="time">
                    </div>


             </div>

        </form>
        </div>
    </div>
  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <p class="text-center">Copyright &copy; Eco G5T4 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

<?php

?>