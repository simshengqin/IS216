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

  <link rel="stylesheet" href="css/maincss.css">

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
                  <h1 class="text-center font-weight-light"> Profile </h1>
                  </br>
                </div>
                
                <div class="col-md-6 text-center">
                  <img class="mr-2 mb-2" width="200px" src="images/profile_picture/company/<?php echo $company_id ?>.png"></img>
                  <h3> <?php echo $company_name ?></h3>
                  <div> <i class="fas fa-star mr-2"></i> <span> Ratings: <?php echo $company_rating ?></span> </div>
                  <div> <i class="fas fa-users mr-2"></i> <span> Followings: <?php echo $numOfFollowing ?></span> </div>
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
                    <button type="submit" class="btn btn-primary btn-lg btn-block"> Update </button>
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
                    <?php
                          displayProducts($company_id);
                    ?>
                </div>
              <div>

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

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

<?php

    function displayProducts($company_id) {
      $companyProducts = new productDAO();
      $products = $companyProducts->retrieve_product_by_company($company_id);
      foreach($products as $product){
        echo"
          <div class='col-md-4'>
            <div class='card mb-4 shadow-sm'>
              <img class='card-img-top' src='images/{$product->get_type()}/{$product->get_name()}.jpg' width='100%' height='225'>
              <div class='card-body'>
                <h4 class='card-title'> ".str_replace('_', ' ', $product->get_name())."</h4>
                <p class='card-text'> Promotion End: {$product->get_decay_date()}, at {$product->get_decay_time()}</p>
                <p class='card-text font-weight-light'> Before Price: $ {$product->get_price_after()}</p>
                <p class='card-text font-weight-light'> After Price: $ {$product->get_price_before()}</p>
                <p class='card-text'> Quantity Left: {$product->get_quantity()}</p>
                <a class='btn btn-info btn-lg btn-block' role='button' href='company_edit_product.php'> Edit </a>
              </div>
            </div>
          </div>
      ";
      }
    }

?>