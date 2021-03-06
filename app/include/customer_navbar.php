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

  <!-- jquery for bounce animation-->
  <script type = "text/javascript" 
         src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
  </script>
		
  <script type = "text/javascript" 
      src = "https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js">
  </script>
  <!-- icon -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>

  <!-- font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>

 
</head>

<body>
<?php
    $userDAO = new userDAO();
    $user_id = $_SESSION["user_id"];
    $user = $userDAO->retrieve_user($user_id);
    $cart = $user->get_cart();
    $cart_count = 0;                 
    if (strlen($cart) ==0) {
        $cart_arr = [];
      }
      else {
        $cart_arr = explode(",",$cart);
    }  
    $productDAO = new productDAO();
    foreach ($cart_arr as $productqty) {
        #Split it to an arr, where the 1st element is product_id and 2nd element is quantity
        $productqty_arr = explode(":",$productqty);
        $product_id = $productqty_arr[0];
        #$quantity_in_cart contains how much the user currently ordered that product in their cart
        $quantity_in_cart = $productqty_arr[1];
        #Once the product_id is found, get the relevant product details from product table in the database
      
        $product = $productDAO->retrieve_product($product_id);
        if ($product == '' ) {
          continue;
        }
        else {
          $cart_count += 1;
        }
    }        
    if ($cart_count == 0) {
      // clear shopping cart for user
      $_SESSION['cart_company_id'] = 0;
    }

?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="">
    <div class="container">
    <a class="navbar-brand" href="index.php"><img src="images/logo/eco-logo.png">    <img src="images/logo/rsz_shadow_eco.png"></a>    
    <ul class="navbar-nav ml-auto mr-4 d-lg-none">
      <li class="nav-item" id="link-cart">
                <a href="shoppingcart.php" class="nav-link navbar-link-2 waves-effect cart-icon">
                  <span class="badge badge-pill red"></span>
                  <i class="fas fa-shopping-cart pl-0" style="width:30px;height:30px;"></i>
                  <div class='cart-label'><?php echo $cart_count?></div>
                </a>
          </li>
    </ul>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse mb-20 float-right" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-4 active" id="link-home">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item mr-4" id="link-companies">
        <a class="nav-link" href="view_companies.php">Restaurants</a>
        </li>
        <li class="nav-item mr-4" id="link-inbox">
          <a class="nav-link" href="inbox.php?user_id=<?php echo $_SESSION["user_id"]?>&user_type=user">Inbox</a>
        </li>

  
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
     
        
        <li class="nav-item" id="link-cart-inner">
              <a href="shoppingcart.php" class="nav-link navbar-link-2 waves-effect cart-icon">
                <span class="badge badge-pill red"></span>
                <i class="fas fa-shopping-cart pl-0" style="width:30px;height:30px;"></i>
                <div class='cart-label'><?php echo $cart_count?></div>
              </a>
        </li>
      </ul>
    </div>
    </div>
  </nav>

</body>
<script>
    $(document).ready(function() {

        $("#cart_count").effect( "bounce", {times:3}, 300 );

    });
</script>

</html>