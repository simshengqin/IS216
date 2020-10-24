<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Shopping Cart</title>
  <!-- Roboto Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!--Bootstrap 4 and AJAX-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <!--Link to main.css files while contains all the css of this project-->
  <link rel='stylesheet' href='css\maincss.css'>
  </head>

<body class="skin-light">

  <!--Main Navigation-->
  <header>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-light fixed-top scrolling-navbar">
      <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand" href="">
        </a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
          aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

          <!-- Right -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="#!" class="nav-link navbar-link-2 waves-effect">
                <span class="badge badge-pill red">1</span>
                <i class="fas fa-shopping-cart pl-0"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle waves-effect" id="navbarDropdownMenuLink3" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="true">
                <i class="united kingdom flag m-0"></i>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <a class="dropdown-item" href="#!">Action</a>
                <a class="dropdown-item" href="#!">Another action</a>
                <a class="dropdown-item" href="#!">Something else here</a>
              </div>
            </li>
            <li class="nav-item">
              <a href="#!" class="nav-link waves-effect">
                Shop
              </a>
            </li>
            <li class="nav-item">
              <a href="#!" class="nav-link waves-effect">
                Contact
              </a>
            </li>
            <li class="nav-item">
              <a href="#!" class="nav-link waves-effect">
                Sign in
              </a>
            </li>
            <li class="nav-item pl-2 mb-2 mb-md-0">
              <a href="#!" type="button"
                class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light">Sign
                up</a>
            </li>
          </ul>

        </div>
        <!-- Links -->
      </div>
    </nav>
    <!-- Navbar -->

    <div class="jumbotron color-grey-light mt-70">
      <div class="d-flex align-items-center h-20">
        <div class="container text-center py-5">
          <h3 class="mb-0">Shopping cart</h3>
        </div>
      </div>
    </div>

  </header>
  <!--Main Navigation-->

  <!--Main layout-->
  <main>
    <div class="container">
      <!-- Modal -->
      <div class="modal fade" id="delete_confirmation_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure that you want to delete this product from your cart?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick=delete_product()>Yes</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">&nbsp;&nbsp;&nbsp;Nope&nbsp;&nbsp;&nbsp;</button>
            </div>
          </div>
        </div>
      </div>        
      <!--Modal to inform not enough product qty in database-->
      <div class="modal fade" id="insufficint_product_qty_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Error</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            Sorry! There is insufficient quantity for this product.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal" >Okay</button>
            </div>
          </div>
        </div>
      </div>
      <!--Section: Block Content-->
      <section class="mt-5 mb-4">

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-lg-8">

            <!-- Card -->
            <div class="card wish-list mb-4">
              <div class="card-body">

                
                <!--List of items in the cart -->
                <?php
                $userDAO = new userDAO();
                $companyDAO = new companyDAO();
                //Hardcoded as 1 first. Need to change to check who is currently logged in!
                $user_id = 1;
                $user = $userDAO->retrieve_user($user_id);
                $cart = $user->get_cart();
                #cart is in the format "product_id:quantity, product_id: quantity"
                #Convert it to an array first, then loop through each of this product qty pair
                if (strlen($cart) ==0) {
                    $cart_arr = [];
                  }
                  else {
                    $cart_arr = explode(",",$cart);
                }             
                $userDAO = new userDAO();
                //HARDCODED user_id here, need to change
                $user_id = 1;
                $user = $userDAO-> retrieve_user($user_id);
                $cart_company_id = $user->get_cart_company_id(); 
                $company_name = $companyDAO -> retrieve_company_name($cart_company_id);
                $company_address = $companyDAO -> retrieve_company_address($cart_company_id);
                
                $total_price = "0.00";
                if (strlen($cart) ==0) {
                  echo "<h5 class='mb-4' >Cart (<span id='cartsize'>" . sizeof($cart_arr) . "</span> items)</h5>";
                  echo "<div class='text-danger'>No items in cart currently!</div>";
                  $total_price_with_shipping = "0.00";
                  $shipping = "0.00";
                }
                else {
                  echo "<h5 class='mb-4' >Cart (<span id='cartsize'>" . sizeof($cart_arr) . "</span> items) - " . ucwords($company_name) . "</h5>";
                  foreach ($cart_arr as $productqty) {
                      #Split it to an arr, where the 1st element is product_id and 2nd element is quantity
                      $productqty_arr = explode(":",$productqty);
                      $product_id = $productqty_arr[0];
                      #$quantity_in_cart contains how much the user currently ordered that product in their cart
                      $quantity_in_cart = $productqty_arr[1];
                      #Once the product_id is found, get the relevant product details from product table in the database
                      $productDAO = new productDAO();
                      $product = $productDAO->retrieve_product($product_id);
                      $company_id = $product->get_company_id();
                      $decay_date = $product->get_decay_date();
                      $decay_time = $product->get_decay_time();
                      $name = $product->get_name();
                      $posted_date = $product->get_posted_date();
                      $posted_time = $product->get_posted_time();
                      $price_after = $product->get_price_after();
                      $price_before = $product->get_price_before();
                      $quantity = $product->get_quantity();
                      $type = $product->get_type();
                      $discount = round((($price_before-$price_after)/$price_before)*100,0);
                      $total_price_for_current_product = $price_after * $quantity_in_cart;
                      //set timezone to singapore so the time will be correct
                      date_default_timezone_set('Asia/Singapore');
                      //if there is no discount, do not show the -% label and the crossed out price
                      if ($discount == 0.0) {
                          $price_before_modified = "";                 
                      }     
                      else {
                          $price_before_modified = "$" . $price_before . "&nbsp;";
                      }     
                      #Calculates the total price of current cart
                      $total_price += round($price_after * $quantity_in_cart,2);
                      #There is only a shippping cost if there is at least 1 product
                      if ($total_price == 0) {
                        $total_price_with_shipping = "0.00";
                      }
                      else {
                        $shipping = 3.00;
                        $total_price_with_shipping = $total_price + 3.00;
                        
                      }
                      
                      echo "
                      <div class='row mb-4' value='$price_after'>
                      <div class='col-md-5 col-lg-3 col-xl-3'>
                          <div class='cart_product_img view zoom overlay z-depth-1 rounded mb-3 mb-md-0'>
                          <img 
                              src='images/$type/$name.jpg' alt='Sample'>";
                      if (date('Y-m-d', time())== $posted_date) {
                          echo "<span class='product-new-label'>New</span>";
                      }
                      if ($discount != 0.0) {
                          echo "<span class='product-discount-label'>-$discount%</span>";
                      }
                      echo "
                          <a href='#!'>
                          </a>
                          </div>
                      </div>
                      
                      <div class='col-md-7 col-lg-9 col-xl-9'>
                          <div class='d-flex justify-content-between'>
                              <div>
                              <h5>" . str_replace('_',' ',$name) . "</h5>
                              </div>
                              <div>
                                <span class='d-none'>$product_id</span>
                                <a href='#!' type='button' class='card-link-secondary small text-uppercase mr-3' onmousedown='show_confirmation_msg()'><i
                                    class='fas fa-trash-alt mr-1'></i>DELETE</a>
                              </div>
                          </div>
                          <div class='def-number-input number-input safari_only mb-0 w-100'>
                              <span class='fas fa-minus-circle' onmousedown='minus_quantity()'>
                              </span>
                              <span class='d-none'>$product_id</span>
                              <input readonly class='quantity' min='1' name='quantity' value='$quantity_in_cart' type='number' >
                              <span class='fas fa-plus-circle' onclick='add_quantity()'>
                              </span>
                              <span class='total_price_for_current_product'>
                                  $$total_price_for_current_product
                              </span>
                          </div>
                          <div class='d-flex justify-content-between align-items-center mt-1'>
                              <p class='mb-0 ml-4'><span style='text-decoration: line-through' >$price_before_modified</span><span ><strong>$$price_after</strong></span></p>
                          </div>
                      </div>

                      </div>
                      ";
                  }                  
                }

                ?>
                <hr class="mb-4">
                <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i> Do not delay the purchase, adding
                  items to your cart does not mean booking them.</p>

              </div>
            </div>
            <!-- Card -->

            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">

                <h5 class="mb-4">Expected shipping delivery</h5>

                <p class="mb-0"> Thu., 12.03. - Mon., 16.03.</p>
              </div>
            </div>
            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">

                <h5 class="mb-4">Self-pickup Location</h5>

                <p class="mb-0"> <?php echo ucwords($company_name) . " - " . $company_address ?></p>
              </div>
            </div>
            <!-- Card -->

            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">

                <h5 class="mb-4">We accept</h5>

                <img class="mr-2" width="45px"
                  src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/visa.svg"
                  alt="Visa">
                <img class="mr-2" width="45px"
                  src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/amex.svg"
                  alt="American Express">
                <img class="mr-2" width="45px"
                  src="https://mdbootstrap.com/wp-content/plugins/woocommerce-gateway-stripe/assets/images/mastercard.svg"
                  alt="Mastercard">
              </div>
            </div>
            <!-- Card -->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-lg-4">

            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">

                <h5 class="mb-3">The total amount of</h5>

                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    Temporary amount
                    <span id="total_price_for_all_products">$<?php echo $total_price;?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                    Shipping
                    <span id="shipping">$<?php echo $shipping;?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>The total amount of</strong>
                      <strong>
                        <p class="mb-0"></p>
                      </strong>
                    </div>
                    <span class="font-weight-bold" id="total_price_for_all_products_with_shipping">$<?php echo $total_price_with_shipping;?></span>
                  </li>
                </ul>

                <button type="button" class="btn btn-primary btn-block waves-effect waves-light">go to
                  checkout</button>

              </div>
            </div>
            <!-- Card -->

            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">

                <a class="dark-grey-text d-flex justify-content-between" data-toggle="collapse" href="#collapseExample"
                  aria-expanded="false" aria-controls="collapseExample">
                  Add a discount code (optional)
                  <span><i class="fas fa-chevron-down pt-1"></i></span>
                </a>

                <div class="collapse" id="collapseExample">
                  <div class="mt-3">
                    <div class="md-form md-outline mb-0">
                      <input type="text" id="discount-code" class="form-control font-weight-light"
                        placeholder="Enter discount code">
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Card -->

          </div>
          <!--Grid column-->

        </div>
        <!--Grid row-->

      </section>
      <!--Section: Block Content-->

    </div>
  </main>
  <!--Main layout-->

  <script>
      function XHR_send(user_id, product_id, quantity, quantity_change,event_target) {
        //Send an AJAX request to update_user.php to update the cart of user in database
        //Also send to update-user.php to update the product qty in database, quantity_change is needed to reflect
        //whether it's +1 or -1 to the qty
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                //Only needs to check for user adding more items to their cart. If there is not enough item, the user should not be able to add at all
                //Note that AJAX CANNOT return a value to another function as it has some lag, so need to do the changes here
                if ( quantity_change == 1 && this.responseText != "Insufficient product qty in database") {
                  current_quantity = parseInt(event_target.parentNode.children[2].value)
                  event_target.parentNode.children[2].value = current_quantity + 1;
                  var total_price_product_display = event_target.parentNode.children[4];
                  total_price_product = parseFloat(total_price_product_display.innerText.slice(1)) / current_quantity * (current_quantity + 1);
                  total_price_product = Math.round((total_price_product + Number.EPSILON) * 100) / 100
                  total_price_product_display.innerText = "$" + total_price_product
                  //Update the total price of all products
                  total_price_for_all_products = 0
                  for (total_price_product of document.getElementsByClassName("total_price_for_current_product")) {
                    total_price_for_all_products +=  parseFloat(total_price_product.innerText.slice(1));
                  }
                  document.getElementById("total_price_for_all_products").innerText = "$" + total_price_for_all_products.toFixed(2);
                  document.getElementById("total_price_for_all_products_with_shipping").innerText = "$" + (total_price_for_all_products+3.00).toFixed(2);   
                }
                else if (this.responseText == "Insufficient product qty in database") {
                  document.getElementById("insufficient_product_qty_msg").getElementsByClassName("modal-body")[0].innerText = "Sorry! There is insufficient quantity for this product.";
                  $('#insufficient_product_qty_msg').modal('show');
                  //alert("Insufficient product qty in database");
                }
                //return (this.responseText);
            }  
        };  
        request.open('POST', 'update_user.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&product_id="+product_id+"&quantity="+quantity+"&quantity_change="+quantity_change);
      }

      function minus_quantity() {
          //Decrease the quantity
          if (event.target.parentNode.children[2].value > 1) {
            current_quantity = parseInt(event.target.parentNode.children[2].value)
            event.target.parentNode.children[2].value = current_quantity - 1;
            var total_price_product_display = event.target.parentNode.children[4];
            total_price_product = parseFloat(total_price_product_display.innerText.slice(1)) / current_quantity * (current_quantity - 1);
            total_price_product = Math.round((total_price_product + Number.EPSILON) * 100) / 100
            total_price_product_display.innerText = "$" + total_price_product
            //Update the total price of all products
            total_price_for_all_products = 0

            for (total_price_product of document.getElementsByClassName("total_price_for_current_product")) {
              total_price_for_all_products +=  parseFloat(total_price_product.innerText.slice(1));
            }
            document.getElementById("total_price_for_all_products").innerText = "$" + total_price_for_all_products.toFixed(2);
            document.getElementById("total_price_for_all_products_with_shipping").innerText = "$" + (total_price_for_all_products+3.00).toFixed(2);               
            //Send the request to the server to update the cart of user in database
            //Need to change hardcoded user_id later!!
            //XHR_send($user_id, $product_id, $quantity)
            XHR_send(1,event.target.parentNode.children[1].innerText ,event.target.parentNode.children[2].value,-1);            
          }

      }
      function add_quantity() {

          //Send the request to the server to update the cart of user in databasetotal
          //Need to change hardcoded user_id later!!
          //XHR_send($user_id, $product_id, $quantity)
          //Only allows user to buy up to 10 products
          if ( event.target.parentNode.children[2].value >= 10) {
              document.getElementById("insufficient_product_qty_msg").getElementsByClassName("modal-body")[0].innerText = "Sorry! You can only buy up to 10 of this product.";
              $('#insufficient_product_qty_msg').modal('show');
          }
          else {
            XHR_send(1,event.target.parentNode.children[1].innerText ,event.target.parentNode.children[2].value,1, event.target);
          }
      }

      function show_confirmation_msg() {
        window.target_element = event.target.parentNode.parentNode.parentNode.parentNode;
        
        window.target_product_id= event.target.parentNode.children[0].innerText;
        window.target_quantity = event.target.parentNode.parentNode.parentNode.children[1].children[2].value;
        $('#delete_confirmation_msg').modal('show');
      }
      function delete_product() {
          //Show the deletion confirmation message
          //Delete a product when the trash icon is pressed
          //event.target.parentNode.parentNode.parentNode.parentNode.remove();
          console.log(window.target_element.id);
          window.target_element.remove();
          //Update the total price of all products
          total_price_for_all_products = 0
          for (total_price_product of document.getElementsByClassName("total_price_for_current_product")) {
             total_price_for_all_products +=  parseFloat(total_price_product.innerText.slice(1));
          }
          document.getElementById("total_price_for_all_products").innerText = "$" + total_price_for_all_products.toFixed(2);
          document.getElementById("total_price_for_all_products_with_shipping").innerText = "$" + (total_price_for_all_products+3.00).toFixed(2);   
          //There is only a shipping cost if there is at least 1 product
          if (document.getElementsByClassName("total_price_for_current_product").length == 0) {
            document.getElementById("total_price_for_all_products_with_shipping").innerText = "$0.00";
            document.getElementById("shipping").innerText = "$0.00";
            
          }  
          //Update the number of items in cart
          document.getElementById("cartsize").innerText -= 1;
          
          //Update the database
          //XHR_send(1,event.target.parentNode.children[0].innerText ,0);
          XHR_send(1,window.target_product_id ,0,-window.target_quantity);
          

      }
  </script>
</body>

</html>