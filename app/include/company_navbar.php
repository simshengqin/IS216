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
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>

  <!-- font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

 
</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
    <a class="navbar-brand"><img src="images/logo/rsz_e (1).png">    <img src="images/logo/rsz_shadow_eco.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
      
        <li class="nav-item mr-4" id="link-post-product" >
        <a class="nav-link" href="company_post_product.php">Post</a>
        </li>
        <li class="nav-item mr-4" id="link-edit-product">
          <a class="nav-link" href="company_edit_product.php">Edit</a>
        </li>
        <li class="nav-item mr-4" id="link-inbox">
          <a class="nav-link" href="inbox.php?user_id=<?php echo $_SESSION["company_id"]?>&user_type=company">Inbox</a>
        </li>
        <?php
          if (!isset($_SESSION["company_id"])) {
              echo" <li class='nav-item mr-4 id='link-login'>
                      <a class='nav-link' href='company_login.php'>Login/Register</a>
                  </li>";
              } else {
                echo " <li class='nav-item mr-4' id='link-company-profile'> <a class='nav-link' href='company_profile.php'>" . ucwords($_SESSION['name']) . "</a></li>
                    <li class='nav-item mr-4 id='link-login'>
                      <a class='nav-link' href='include/protect.php?logout=true'>Logout</a>
                    </li>";
              }
        ?>
      </ul>
    </div>
    </div>
  </nav>

</body>

</html>