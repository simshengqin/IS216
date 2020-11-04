<html>

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
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="">
    <div class="container">
    <a class="navbar-brand" href="index.php"><img src="images/logo/rsz_e (1).png">    <img src="images/logo/rsz_shadow_eco.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse mb-20" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-4 active" id="link-home">
          <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mr-4" id="link-companies">
        <a class="nav-link" href="view_companies.php">Restaurants</a>
        </li>
        <li class="nav-item mr-4" id="link-inbox">
          <a class="nav-link" href="inbox.php?user_id=<?php echo $_SESSION["user_id"]?>&user_type=user">Inbox</a>
        </li>

        <!-- <li class="nav-item mr-4" id="link-customer-profile">
            <a class="nav-link" href="customer_profile.php">Profile</a>
        </li> -->
        <?php
          if (!isset($_SESSION["user_id"])) {
              echo" <li class='nav-item mr-4 id='link-login'>
                      <a class='nav-link' href='user_login.php'>Login/Register</a>
                  </li>";
              } else {
                echo " 
                    <li class='nav-item mr-4' id='link-customer-profile'>
                        <a class='nav-link' href='customer_profile.php'>". ucwords($_SESSION['name']) ."</a>
                    </li>
                
                    <li class='nav-item mr-4 id='link-login'>
                      <a class='nav-link' href='include/protect.php?logout=true'>Logout</a>
                    </li>";
              }
        ?>
     
        
        <li class="nav-item" id="link-cart">
              <a href="shoppingcart.php" class="nav-link navbar-link-2 waves-effect">
                <span class="badge badge-pill red"></span>
                <i class="fas fa-shopping-cart pl-0"></i>
              </a>
        </li>
      </ul>
    </div>
    </div>
  </nav>

</body>

</html>