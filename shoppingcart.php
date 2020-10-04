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
                echo "<h5 class='mb-4' >Cart (<span id='cartsize'>" . sizeof($cart_arr) . "</span> items)</h5>";
                $total_price = 0;
                if (strlen($cart) ==0) {
                  echo "<div class='text-danger'>No items in cart currently!</div>";
                }
                else {
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
                      #Calculates the total price of current cart
                      $total_price += round($price_after * $quantity_in_cart,2);
                      echo "
                      <div class='row mb-4'>
                      <div class='col-md-5 col-lg-3 col-xl-3'>
                          <div class='view zoom overlay z-depth-1 rounded mb-3 mb-md-0'>
                          <img class='img-fluid w-100'
                              src='images/$type/$name.jpg' alt='Sample'>
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
                          </div>
                          <div class='d-flex justify-content-between align-items-center'>
                              <p class='mb-0'><span><strong>$$price_after</strong></span></p>
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
                    <span id="totalprice">$<?php echo $total_price;?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                    Shipping
                    <span>Gratis</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>The total amount of</strong>
                      <strong>
                        <p class="mb-0">(including VAT)</p>
                      </strong>
                    </div>
                    <span><strong>$53.98</strong></span>
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
      function XHR_send(user_id, product_id, quantity) {
        //Send an AJAX request to update_user.php to update the cart of user in database
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);  
            }  
        };  
        request.open('POST', 'update_user.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&product_id="+product_id+"&quantity="+quantity);
      }

      function minus_quantity() {
          //Decrease the quantity
          if (event.target.parentNode.children[2].value > 1) {
            event.target.parentNode.children[2].value -= 1;
            //Update the total price
            current_price = parseFloat(document.getElementById("totalprice").innerText.slice(1))
            //Use .slice(1) yo ignore the $ sign in front
            current_price -= parseFloat(event.target.parentNode.parentNode.lastElementChild.children[0].innerText.slice(1));
            //Round price to two decimal places
            document.getElementById("totalprice").innerText = "$" + current_price.toFixed(2);
            //Send the request to the server to update the cart of user in database
            //Need to change hardcoded user_id later!!
            //XHR_send($user_id, $product_id, $quantity)
            XHR_send(1,event.target.parentNode.children[1].innerText ,event.target.parentNode.children[2].value);            
          }

      }
      function add_quantity() {
          current_quantity = parseInt(event.target.parentNode.children[2].value)
          event.target.parentNode.children[2].value = current_quantity + 1;
          //Update the total price
          current_price = parseFloat(document.getElementById("totalprice").innerText.slice(1))
          //Use .slice(1) yo ignore the $ sign in front
          current_price += parseFloat(event.target.parentNode.parentNode.lastElementChild.children[0].innerText.slice(1));
          //Round price to two decimal places
          document.getElementById("totalprice").innerText = "$" + current_price.toFixed(2);
          //Send the request to the server to update the cart of user in database
          //Need to change hardcoded user_id later!!
          //XHR_send($user_id, $product_id, $quantity)
          XHR_send(1,event.target.parentNode.children[1].innerText ,event.target.parentNode.children[2].value);

      }

      function show_confirmation_msg() {
        window.target_element = event.target.parentNode.parentNode.parentNode.parentNode;
        window.target_product_id= event.target.parentNode.children[0].innerText;
        $('#delete_confirmation_msg').modal('show');
      }
      function delete_product() {
          //Show the deletion confirmation message
          //Delete a product when the trash icon is pressed
          //event.target.parentNode.parentNode.parentNode.parentNode.remove();
          window.target_element.remove();
          //Update the number of items in cart
          document.getElementById("cartsize").innerText -= 1;

          //Update the database
          //XHR_send(1,event.target.parentNode.children[0].innerText ,0);
          XHR_send(1,window.target_product_id ,0);
          

      }
  </script>
</body>

</html>