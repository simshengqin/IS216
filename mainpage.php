<?php

session_start();
                    

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
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 
  <!-- maincss.css -->
  <link href="css/maincss.css" rel="stylesheet">

  <!-- icon -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>

  <!-- font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

 
</head>

<body>

<!-- Navigation -->
<?php include 'include/customer_navbar.php';?>
<!-- <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
    <a class="navbar-brand" href="mainpage.html"><img src="images/logo/rsz_e (1).png">    <img src="images/logo/rsz_shadow_eco.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active mr-4">
          <a class="nav-link" href="mainpage.html">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mr-4" >
        <a class="nav-link" href="view_products.php">Food</a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="#">Order</a>
        </li>
        <li class="nav-item mr-4">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item mr-4">
            <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item mr-4">
            <a class="nav-link" href="#">Login/Register</a>
        </li>
      </ul>
    </div>
    </div>
  </nav> -->
  
  <!-- Header -->
  <header class="header-img" style="margin: 0px 0px 10px;">
        <div class="container align-items-center justify-items-center" style="height: auto;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="mb-3" style="text-align: center; color: white; margin-top: 100px;">Buy surplus food at a discount</h1>
                    <div style="text-align: center; color: white;">Grabbing worthy deals and reducing food waste at the same time!</div>
                    <br><br>
                </div>
            </div>
            <div class ='row'>
                <div class="col-lg-8" style="margin: 30px 0px 30px;">
                <form action="view_companies.php" method="get">
                <!-- <div class="form-group col-8" style="margin: 30px 0px 20px;"> -->
                    <input type="text" class="form-control" name="postal_code" id="search_for_products"  placeholder="Enter Postal Code">
                    
                    <!-- <span class="input-group-btn"> --> 
                          <!-- <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span> -->
                
                </div>
                <!-- <div class="form-group col-2" style="margin: 30px 0px 20px;"> -->
                <div class="col-lg-2" style="margin: 30px 0px 30px;">
                  <button type='submit' class="btn btn-success" href="view_products.php">Search</button>
                </div>
                </form>
            </div>
          
        </div>

             <!-- <div class="col-md-10 col-lg-8 col-xl-7 mx-auto"> --> -->
                <!-- <div class="wrap">
                    <div class="search">
                       <input type="text" class="searchTerm" placeholder="What kind of food are you craving...">
                       <button type="submit" class="searchButton">
                            <i class="fas fa-search"></i> -->
                            <!-- <i class="fas fa-arrow-right"></i> -->
                      <!-- </button>
                      <div class="dropdown">
                        <button onclick="myFunction()" class="dropbtn">Dropdown</button>
                        <div id="myDropdown" class="dropdown-content">
                          <a href="#nearby">Nearby</a>
                          <a href="#price">Price</a>
                          <a href="#quantity">Quantity</a>
                        </div>
                      </div>
                    </div>
                 </div> -->

        </div>
        </div>
  </header>
  <div style="height:50px"></div>


  <div class="container">
      <div class='row' style="margin-bottom: 30px;">
        <div class='col'>
            <h3 style="margin-bottom: 30px;">Why use Eco?</h3>
            <h6>The best way to save money and save the environment</h6>
            
        </div>
        <div class='col'>
            <img src="images/rsz_2planet-earth.png" class="float-right" style="padding: 30px;">
        </div>

      </div>

      <div class="row">
          <!-- <div class='col-2' style="margin-right: 40px;">
              <h3 style="margin-bottom: 30px;">Why use Eco?</h3>
              <h6>The best way to save money and save the environment</h6>
              <img src="images/rsz_2planet-earth.png" class="float-right">
          </div> -->

          

          <!-- <div class="card-deck" > -->

              <!-- <div class='col-2'>
                  <h3 style="margin-bottom: 30px;">Why use Eco?</h3>
                  <h6>The best way to save money and save the environment</h6>
                  <img src="images/rsz_2planet-earth.png" class="float-right">
              </div> -->

              <div class="col-md-4 mb-5">
              <div class="card text-center" >
                  <img class="card-img-top" src="images/how_to_use/use-1.png" alt="">
                    <div class="card-body">
                        <h4 class="card-title">STEP 1</h4>
                        <p class="card-text">Enter your preferences to receive notifications on nearby or favourite deals!</p>
                    </div>
              </div>
              </div>
          
              <div class="col-md-4 mb-5">
              <div class="card text-center" >
                  <img class="card-img-top" src="images/how_to_use/use-2.png" alt="">
                      <div class="card-body">
                          <h4 class="card-title">STEP 2</h4>
                          <p class="card-text">Select a timeslot for collection <br>and pay online! <br> Timeslots from 6.30PM to 9.30PM </p>         
                      </div>
              </div>
              </div>
        
              <div class="col-md-4 mb-5">
              <div class="card text-center" >
                  <img class="card-img-top" src="images/how_to_use/use-3.png" alt="">
                      <div class="card-body">
                          <h4 class="card-title">STEP 3</h4>
                          <p class="card-text">Upon arrival, show your receipt which will be sent to you via SMS to the stall owner!</p>
                      </div>
              </div>
              </div>
              
          
     
          <!-- </div>   closes card deck -->

          <!-- <div class='col'>
            <h3 style="margin-bottom: 30px;">Why use Eco?</h3>
            <h6>The best way to save money and save the environment</h6>
            <img src="images/rsz_2planet-earth.png" class="float-right">
          </div> -->

      </div>  <!--closes row -->

        <!-- <div class="col">

        </div> -->

  

  
  <!-- Page Content -->
  <!-- <div class="container"> -->
    <h2 class="mb-3">Top Food Listings</h2>
    <div class="row">
        <div class="col-md-4 mb-5">
          <div class="card h-100">
            <img class="card-img-top" src="images/fried-noodles.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Card title</h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-danger">Find Out More!</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-5">
          <div class="card h-100">
            <img class="card-img-top" src="images/fried-noodles.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Card title</h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque sequi doloribus totam ut praesentium aut.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-danger">Find Out More!</a>
            </div>
          </div>
        </div>
        <div class="col-md-4 mb-5">
          <div class="card h-100">
            <img class="card-img-top" src="images/fried-noodles.jpg" alt="">
            <div class="card-body">
              <h4 class="card-title">Card title</h4>
              <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente esse necessitatibus neque.</p>
            </div>
            <div class="card-footer">
              <a href="#" class="btn btn-danger">Find Out More!</a>
            </div>
          </div>
        </div>
      </div>
  </div>





  <!-- For About.html
  <div class="container">
    <div class="row">
        <div class="col-md-8 mb-5">
          <h2>What We Do</h2>
          <hr>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. A deserunt neque tempore recusandae animi soluta quasi? Asperiores rem dolore eaque vel, porro, soluta unde debitis aliquam laboriosam. Repellat explicabo, maiores!</p>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis optio neque consectetur consequatur magni in nisi, natus beatae quidem quam odit commodi ducimus totam eum, alias, adipisci nesciunt voluptate. Voluptatum.</p>
          <a class="btn btn-danger btn-lg" href="#">Call to Action &raquo;</a>
        </div>
        <div class="col-md-4 mb-5">
          <h2>Contact Us</h2>
          <hr>
          <address>
            <strong>Start Bootstrap</strong>
            <br>3481 Melrose Place
            <br>Beverly Hills, CA 90210
            <br>
          </address>
          <address>
            <abbr title="Phone">P:</abbr>
            (123) 456-7890
            <br>
            <abbr title="Email">E:</abbr>
            <a href="mailto:#">name@example.com</a>
          </address>
        </div> -->



  


  <!-- Carousel of brand logos -->
  


  <!-- <div class = 'row'>
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block" src="images/brands/rsz_grand-hyatt-logo.jpg" width="50%;" height="50%;" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block" src="images/profile_picture/company/1.png" width="50%;" height="50%;"  alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block" src="images/profile_picture/company/2.png" width="50%;" height="50%;"  alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block" src="images/profile_picture/company/3.png" width="50%;" height="50%;"  alt="Fourth slide">
          </div>
          <div class="carousel-item">
            <img class="d-block" src="images/profile_picture/company/4.png" width="50%;" height="50%;"  alt="Fifth slide">
          </div>
          <div class="carousel-item">
            <img class="d-block" src="images/profile_picture/company/5.png" width="30%;" height="30%;"  alt="Sixth slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
  </div> -->

  


<!-- Footer -->
<?php include 'include/footer.php';?>

</body>



</html>