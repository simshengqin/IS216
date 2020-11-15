<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';
  
  if(!isset($_SESSION)) { 
    session_start(); 
  } 

 
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

  <!-- font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

  <!-- <link rel="stylesheet" href="style.css"> -->
  <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
  <script src="https://js.stripe.com/v3/"></script>

  <style>
  </style>
  </head>

<body class="skin-light">
  

  
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
      <div class="modal fade" id="insufficent_product_qty_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
      <!--Modal to input postal code-->
      <div class="modal fade" id="input_postal_code" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Current Location</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  </div>
                  <div class="modal-body">
                      <form>
                          <div class="form-group">
                              <label for="postal_code" class="col-form-label">Enter your postal code:</label>
                              <input type="number" minlength="6" maxlength="6" class="form-control" id="postal_code">
                              <div class="mt-3" id="invalid_postal_code_warning"></div>
                          </div>
                      </form>
                  </div>
                  <div class="modal-footer">
                  <button type="button" style="left:0%" class="btn btn-success" id="input_postal_code_confirm" onclick="validate_postal_code()">Confirm</button>
                  </div>
              </div>
          </div>
      </div>
      <?php include 'include/customer_navbar.php';?>
      <!--Section: Block Content-->
      
      <section class="mt-5 mb-4" style="padding-top:25px;">

        <!--Grid row-->
        <div class="row">

          <!--Grid column-->
          <div class="col-md-8">

            <!-- Card -->
            <div class="card wish-list mb-4">
              <div class="card-body">

                
                <!--List of items in the cart -->
                <?php
                $userDAO = new userDAO();
                $companyDAO = new companyDAO();

                $user_id = $_SESSION["user_id"];
                $user = $userDAO->retrieve_user($user_id);
                $cart = $user->get_cart();
                #cart is in the format "product_id:quantity, product_id: quantity"
                #Convert it to an array first, then loop through each of this product qty pair
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
           
                $userDAO = new userDAO();
        
                $user_id = $_SESSION["user_id"];
                $user = $userDAO-> retrieve_user($user_id);
                $cart_company_id = $user->get_cart_company_id(); 
                $total_price = "0.00";
                $company_id="";
                $gst = "0.00"; 
                $total_price_with_gst = "0.00";
                $company_address = "";
                $company_latitude = "";
                $company_longtitude = "";
                if ($_SESSION["cart_company_id"] == 0 || $cart_count ==0) {
                  echo "<h5 class='mb-4 font-weight-bold' >Cart (<span id='cartsize'>" . $cart_count . "</span> items)</h5>";
                  echo "<div class='alert alert-danger'>No items in cart currently!</div>";
                 
                  
                  $company_name = "";
                  $company_latitude = "";
                  $company_longtitude = "";
                }
                else {
                  $company_name = $companyDAO -> retrieve_company_name($cart_company_id);
                  echo "<h5 class='mb-4 font-weight-bold' >Cart (<span id='cartsize'>" . $cart_count . "</span> items) - " . ucwords($company_name) . "</h5>";
                                    
                  $company = $companyDAO->retrieve_company($cart_company_id); 
                  $company_address = $companyDAO -> retrieve_company_address($cart_company_id);                
                  $company_latitude = $company-> get_latitude();
                  $company_longtitude = $company-> get_longtitude();
          
                  foreach ($cart_arr as $productqty) {
                      #Split it to an arr, where the 1st element is product_id and 2nd element is quantity
                      $productqty_arr = explode(":",$productqty);
                      $product_id = $productqty_arr[0];
                      #$quantity_in_cart contains how much the user currently ordered that product in their cart
                      $quantity_in_cart = $productqty_arr[1];
                      #Once the product_id is found, get the relevant product details from product table in the database
                      $productDAO = new productDAO();
                      $product = $productDAO->retrieve_product($product_id);
                      if ($product == '' ) {
                        continue;
                      }
                      $company_id = $product->get_company_id();
                      $decay_date = $product->get_decay_date();
                      $decay_time = $product->get_decay_time();
                      $name = $product->get_name();
                      $posted_date = $product->get_posted_date();
                      $posted_time = $product->get_posted_time();
                      $price_after = $product->get_price_after();
                      $price_before = $product->get_price_before();
                      $quantity = $product->get_quantity();
                      $category = $product->get_category();
                      $image_url = $product->get_image_url();
                      if ($image_url == "") {
                          $image_url ="images/$category/$name.jpg";
                      }
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
                        $total_price_with_gst = "0.00";
                      }
                      else {
                        $gst = round($total_price * 0.07, 2); 
                        $total_price_with_gst = round($total_price * 1.07, 2);
                        
                      }
                      
                      echo "
                      <div class='row mb-4' value='$price_after'>
                        <div class='col-md-3 col-lg-3 col-xl-3'> 
                            <div class='cart_product_img view zoom overlay z-depth-1 rounded mb-3 mb-md-0'>
                              <img class='d-block mx-auto'
                                  src='$image_url' alt='Sample'>";
                          
                          if ($discount != 0.0) {
                              #echo "<span class='product-discount-label'>-$discount%</span>";
                          }                                  
                          
                          echo "
                              <a href='#!'>
                              </a>
                            </div>
                        </div>
                        
                        <div class='col-md-9 col-lg-9 col-xl-9'>
                            <div class='row d-flex justify-content-center'>
                                <div class='col-12 mb-2 d-flex justify-content-md-start justify-content-center'>
                                  <span>" . str_replace('_',' ',$name) . "</span>                                  <span class='d-none'>$product_id</span>

                                </div>
                            </div>
                            <div class='row def-number-input number-input safari_only mb-0 w-100' style='height: 40px;'>
                                <span onmousedown='minus_quantity()'><button class='btn btn-link change_qty_btn pt-0' style='font-size: 25px;'>-</button>
                                </span>
                                <span class='d-none check-checkout'>$product_id</span>
                                <input readonly class='col h-100 quantity check-checkout' style='padding: 10px;' min='1' name='quantity' value='$quantity_in_cart' type='number' >
                                <span onclick='add_quantity()'><button class='btn btn-link change_qty_btn pt-0' style='font-size: 25px;'>+</button>
                                </span>
                                <span class='total_price_for_current_product pt-2' style='width: 3.4em;'>
                                    $$total_price_for_current_product
                                </span>
                            </div>

                        </div>

                      </div>
                      ";
                  }                  
                }

                ?>
                
                <hr class="mb-4">
                <p class="text-primary mb-0"><i class="fas fa-info-circle mr-1"></i> Do not delay your purchase, food in your cart will automatically be deleted once expired or the restaurant remove the promotion</p>

              </div>
            </div>
           
            <div class="card mb-4">
              <div class="card-body">

                <h5 class="mb-4"><b>Self-pickup Timing</b></h5>
                <div class="input-group mb-3">
                  <div class="col-md-6">
                    <div class="row mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Date:</span>
                      </div>
                      <input type="date" class="col form-control check-checkout" value='<?php echo date('Y-m-d');?>'  id="collection_date" aria-label="collection_date" disabled>
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <div class="row">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Time:</span>
                      </div>                   
                      <input type="time" name="limittime" list="limittimeslist" min="18:30" max="21:30" class="col form-control check-checkout"  id="collection_time" aria-label="collection_time">
                      <datalist id="limittimeslist">

                          <option value="18:30">
                          <option value="18:45">
                          <option value="19:00">
                          <option value="19:15">
                          <option value="19:30">
                          <option value="19:45">
                          <option value="20:00">
                          <option value="20:15">
                          <option value="20:30">
                          <option value="20:45">
                          <option value="21:00">
                          <option value="21:15">
                          <option value="21:30">

                      </datalist>
                    </div>
                  </div>
                </div>
                <p class="mb-0"></p>
              </div>
            </div>
            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">

                <h5 class="mb-4"><b>Self-pickup Address</b></h5>

                <p class="mb-19"> <?php if ($cart_count !=0) {echo ucwords($company_name) . " - " . $company_address;} ?></p>                  
                <!--The following is a placeholder for the map.-->
                <?php $items_in_cart_count = $cart_count;?>
                <div id="map" name='<?php echo "$company_latitude,$company_longtitude,$items_in_cart_count"; ?>'></div>
              </div>
            </div>
            <!-- Card -->

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-4">

            <!-- Card -->
            <div class="card mb-4">
              <div class="card-body">

                <h5 class="mb-3 font-weight-bold">Order Summary</h5>

                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                    Subtotal
                    <span id="total_price_for_all_products">$<?php echo $total_price;?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center px-0" >
                    Including GST
                    <span id="gst_amount">$<?php echo $gst;?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                    <div>
                      <strong>Total (Incl. GST)</strong>
                      <strong>
                        <p class="mb-0"></p>
                      </strong>
                    </div>
                    <span class="font-weight-bold" id="total_price_for_all_products_with_gst">$<?php echo $total_price_with_gst;?></span>
                  </li>
                </ul>

                

                <button type="button" class="btn btn-primary btn-block waves-effect waves-light" id="checkout-button" onclick="get_current_cart()" disabled>Checkout</button>

              
                
                <input type='hidden' value='<?php echo "$user_id,$company_id"; ?>' id="checkout-info">
                <input type='hidden' value='<?php echo "$user_id"; ?>' id="user_id">

              </div>
            </div>
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
  <!-- add footer -->
  <?php include 'include/footer.php';?>

  <script>

        function add_quantity() {

          //Send the request to the server to update the cart of user in databasetotal
          //Need to change hardcoded user_id later!!
          //XHR_send($user_id, $product_id, $quantity)
          //Only allows user to buy up to 10 products
          console.log(event.target.parentNode.parentNode);
          if ( event.target.parentNode.parentNode.children[2].value >= 10) {
              document.getElementById("insufficent_product_qty_msg").getElementsByClassName("modal-body")[0].innerText = "Sorry! You can only buy up to 10 of this product.";
              $('#insufficent_product_qty_msg').modal('show');
          }
          else {
            XHR_send(1,event.target.parentNode.parentNode.children[1].innerText ,event.target.parentNode.parentNode.children[2].value,1, event.target);
          }
      }
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
                  if ( event_target.parentNode.parentNode.children[2].value >= 10) {
                    //Do 1 more final check here in case there is server lag, esp on Heroku
                      document.getElementById("insufficent_product_qty_msg").getElementsByClassName("modal-body")[0].innerText = "Sorry! You can only buy up to 10 of this product.";
                      $('#insufficent_product_qty_msg').modal('show');
                  }
                  else {
                    
                    current_quantity = parseInt(event_target.parentNode.parentNode.children[2].value);
                    event_target.parentNode.parentNode.children[2].value = current_quantity + 1;
                    var total_price_product_display = event_target.parentNode.parentNode.children[4];
                    total_price_product = parseFloat(total_price_product_display.innerText.slice(1)) / current_quantity * (current_quantity + 1);
                    total_price_product = Math.round((total_price_product + Number.EPSILON) * 100) / 100;
                    total_price_product_display.innerText = "$" + total_price_product;
                    //Update the total price of all products
                    total_price_for_all_products = 0;
                    for (total_price_product of document.getElementsByClassName("total_price_for_current_product")) {
                      total_price_for_all_products +=  parseFloat(total_price_product.innerText.slice(1));
                    }
                    document.getElementById("total_price_for_all_products").innerText = "$" + total_price_for_all_products.toFixed(2);
                    document.getElementById("total_price_for_all_products_with_gst").innerText = "$" + (total_price_for_all_products*1.07).toFixed(2); 
                    document.getElementById("gst_amount").innerText = "$" + (total_price_for_all_products*0.07).toFixed(2);                       
                  }

                }
                else if (this.responseText == "Insufficient product qty in database") {
                  document.getElementById("insufficent_product_qty_msg").getElementsByClassName("modal-body")[0].innerText = "Sorry! There is insufficient quantity for this product.";
                  $('#insufficent_product_qty_msg').modal('show');
                  
                }
               
            }  
        };  
        request.open('POST', 'update_user.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&product_id="+product_id+"&quantity="+quantity+"&quantity_change="+quantity_change);
      }

      function minus_quantity() {
          //Decrease the quantity
          if (event.target.parentNode.parentNode.children[2].value > 1) {
            current_quantity = parseInt(event.target.parentNode.parentNode.children[2].value)
            event.target.parentNode.parentNode.children[2].value = current_quantity - 1;
            var total_price_product_display = event.target.parentNode.parentNode.children[4];
            total_price_product = parseFloat(total_price_product_display.innerText.slice(1)) / current_quantity * (current_quantity - 1);
            total_price_product = Math.round((total_price_product + Number.EPSILON) * 100) / 100;
            total_price_product_display.innerText = "$" + total_price_product;
            //Update the total price of all products
            total_price_for_all_products = 0;

            for (total_price_product of document.getElementsByClassName("total_price_for_current_product")) {
              total_price_for_all_products +=  parseFloat(total_price_product.innerText.slice(1));
            }
            document.getElementById("total_price_for_all_products").innerText = "$" + total_price_for_all_products.toFixed(2);
            document.getElementById("total_price_for_all_products_with_gst").innerText = "$" + (total_price_for_all_products*1.07).toFixed(2);               
            document.getElementById("gst_amount").innerText = "$" + (total_price_for_all_products*0.07).toFixed(2);  
            //Send the request to the server to update the cart of user in database
            //Need to change hardcoded user_id later!!
            //XHR_send($user_id, $product_id, $quantity)
            user_id = document.getElementById("user_id").innerText;
            XHR_send(user_id,event.target.parentNode.parentNode.children[1].innerText ,event.target.parentNode.parentNode.children[2].value,-1);            
          }
          else {
            //Ask user whether they want to delete if quantity drops below 1
            show_confirmation_msg(event.target);
          }

      }

      function show_confirmation_msg(target) {
        window.target_element = target.parentNode.parentNode.parentNode.parentNode;
        
        window.target_product_id= target.parentNode.parentNode.children[1].innerText;
        window.target_quantity = target.parentNode.parentNode.children[2].value;
        console.log(window.target_product_id, window.target_quantity);
        $('#delete_confirmation_msg').modal('show');
      }
      function delete_product() {
          //Show the deletion confirmation message
          //Delete a product when the trash icon is pressed
          //event.target.parentNode.parentNode.parentNode.parentNode.remove();
          console.log(window.target_element.id);
          window.target_element.remove();
          //Update the navbar cart count
          document.getElementsByClassName("cart-label")[0].innerText = parseInt(document.getElementsByClassName("cart-label")[0].innerText) - 1; 
          document.getElementsByClassName("cart-label")[1].innerText = parseInt(document.getElementsByClassName("cart-label")[1].innerText) - 1;  
          //Update the total price of all products
          total_price_for_all_products = 0
          for (total_price_product of document.getElementsByClassName("total_price_for_current_product")) {
             total_price_for_all_products +=  parseFloat(total_price_product.innerText.slice(1));
          }
          document.getElementById("total_price_for_all_products").innerText = "$" + total_price_for_all_products.toFixed(2);
          document.getElementById("total_price_for_all_products_with_gst").innerText = "$" + (total_price_for_all_products*1.07).toFixed(2);   
          document.getElementById("gst_amount").innerText = "$" + (total_price_for_all_products*0.07).toFixed(2);
          //There is only a shipping cost if there is at least 1 product
          if (document.getElementsByClassName("total_price_for_current_product").length == 0) {
            document.getElementById("total_price_for_all_products_with_gst").innerText = "$0.00";
            document.getElementById("gst_amount").innerText = "$0.00";
            
          }  
          //Update the number of items in cart
          document.getElementById("cartsize").innerText -= 1;
          
          //Update the database
          XHR_send(1,window.target_product_id ,0,-window.target_quantity);
          

      }

</script>
<script>    
      //////////////Loads the Google Map/////////////////////
      function parseURLParams(url) {
        //Works similar to $_GET, retrieve parameters from the url
        var queryStart = url.indexOf("?") + 1,
            queryEnd   = url.indexOf("#") + 1 || url.length + 1,
            query = url.slice(queryStart, queryEnd - 1),
            pairs = query.replace(/\+/g, " ").split("&"),
            parms = {}, i, n, v, nv;

        if (query === url || query === "") return;

        for (i = 0; i < pairs.length; i++) {
            nv = pairs[i].split("=", 2);
            n = decodeURIComponent(nv[0]);
            v = decodeURIComponent(nv[1]);

            if (!parms.hasOwnProperty(n)) parms[n] = [];
            parms[n].push(nv.length === 2 ? v : null);
        }
        return parms;
      }    
      var map, infoWindow;
      //Prevents the form from submitting when pressing enter while inputting postal code
      $('form').submit(function(e){
          e.preventDefault();
      });
      //Allows user to press enter to submit the postal code
      $("form").on('keyup', function (e) {
      if (e.key === 'Enter' || e.keyCode === 13) {
          validate_postal_code();
      }
      });
      function validate_postal_code() {
        postal_code_input = document.getElementById("postal_code");
        if (postal_code_input.value.length != 6) {
            document.getElementById("invalid_postal_code_warning").innerHTML="<div class='alert alert-danger'>Postal code needs to be 6 digits</div>";              
        }
        else {
            //Hides the modal
            $('#input_postal_code').modal('hide');
            sessionStorage.setItem('postal_code', document.getElementById("postal_code").value);
            initMap();
        }
        
      }
      function initMap() {
        //Dont load the map if no items in cart
        var items_in_cart_count = document.getElementById("map").getAttribute("name").split(",")[2]; 
        
        if (items_in_cart_count != 0)    {
          //Get the latitude and longtitude using a postal code (from the url)
          //if the user enters his postal code in the modal on top, this will have a value
          if (sessionStorage.getItem('postal_code') == undefined) {
                //if user never provides a postalcode, ask for it
                $('#input_postal_code').modal('show');
                return;               
          }
          else {
              start = sessionStorage.getItem('postal_code');
          }
             
          //Sets the height of the map
          document.getElementById('map').setAttribute("style", "height: 400px;")       
          map = new google.maps.Map(document.getElementById('map'), {
              
              zoom: 6
            });
           
            calcRoute(); 
            }         
        }         

      function calcRoute() {
          //Calculates the distance between start and end point
          //Get the latitude and longtitude using a postal code (from the url)
          //if the user enters his postal code in the modal on top, this will have a value
          if (sessionStorage.getItem('postal_code') == undefined) {
                //if user never provides a postalcode, ask for it
                $('#input_postal_code').modal('show');
                return;               
            }
            else {
                start = sessionStorage.getItem('postal_code');
          }    
         
          var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + start + "&key=AIzaSyDcIUwwXfLUWzMAE1WspewghH9f-vmSkzc";
                
          try { 
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // following code may throw error if user input is invalid address
                    // so we use try-catch block to handle errors
                    // expected response is JSON data
                    var data = JSON.parse(this.responseText);
                    console.log(data);
                    if ( data["status"] == "ZERO_RESULTS") {
                        document.getElementById("map").innerHTML = "<div class='alert alert-danger'>Invalid postal code. Please refresh the page </div>";
                    }
                    var addr = data["results"][0]["formatted_address"];
                    var loc = data["results"][0]["geometry"]["location"];
                    start_latitude = loc["lat"];
                    start_longtitude = loc["lng"];
                    console.log(start_latitude, start_longtitude);
                    //Retrieves the company latitude and longtitude                        
                    end_latlng_arr = document.getElementById("map").getAttribute("name").split(",");                
                    end_latitude = end_latlng_arr[0]/10000000;
                    end_longtitude = end_latlng_arr[1]/10000000;
                    console.log("End:", end_latitude, end_longtitude);  
                    //console.log(window.latitude, window.longtitude);            
                    var directionsService = new google.maps.DirectionsService();
                    var directionsRenderer = new google.maps.DirectionsRenderer();
                    var start = new google.maps.LatLng(start_latitude,start_longtitude);
                    var end = new google.maps.LatLng(end_latitude, end_longtitude);
                    directionsRenderer.setMap(map);
                    //var selectedMode = document.getElementById('mode').value;
                    var request = {
                        origin: start,
                        destination: end,
                        // Note that JavaScript allows us to access the constant
                        // using square brackets and a string value as its
                        // "property."
                        travelMode: 'DRIVING' //google.maps.TravelMode[selectedMode]
                    };
                    console.log(start);
                    console.log(end);

                    directionsService.route(request, function(response, status) {
                        if (status == 'OK') {
                        directionsRenderer.setDirections(response);
                        }
                        else {
                          document.getElementById("map").innerHTML = "<div class='alert alert-danger'>Invalid postal code. Please refresh the page!</div>";
                        }
                        console.log(response);
                    });  
                }
            };
          } catch(err) { // show error message
                  // not a good idea to directly show err.message 
                  // as it may contain sensitive info
                  // show a predefined error message string
                  console.log("Sorry, invalid address. Please try again!");  
                  
                  document.getElementById("map").innerHTML = "<div class='alert alert-warning'>Invalid postal code. Please refresh the page.</div>";
                  document.getElementById("map").setAttribute("style","height: 10px;");
                  
              }
          xhttp.open("GET", url, true);
          xhttp.send();

      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: The Geolocation service failed.' :
                              'Error: Your browser doesn\'t support geolocation.');
        infoWindow.open(map);
      }

      // change active navbar
      $(document).ready(function(){
          $(".active").removeClass("active");
          $("#link-cart").addClass("active");
      }); 

      
  </script>

  

  <!-- go to stripe checkout page -->
  <script type="text/javascript" async>
      // check if all criteria is fulfilled to enable checkout button
      document.querySelectorAll('.check-checkout').forEach(item => {item.addEventListener('change', event => {
            //handle click
            if (document.getElementById("collection_time").value !== '' && document.getElementById("collection_date").value !== '' && document.getElementById("total_price_for_all_products_with_gst").innerText !== '$0.00') {
                document.getElementById('checkout-button').disabled = false;
            } else {
                document.getElementById('checkout-button').disabled = true;
            }
           
            
          })
        });


    
      function get_current_cart() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() { // callback aka anonymous function
          if (this.readyState == 4) {
              if (this.status == 200) {
                  // process response
                    console.log( this.responseText );
                    checkout(this.responseText);
                }
            }
          };
        
        xhr.open("POST", "retrieve_cart.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       
        xhr.send(); // query parameters

      }

      function checkout(current_cart) {
        var url = "create-session.php";
        // Create an instance of the Stripe object with your publishable API key
        var stripe = Stripe("pk_test_51Hnc3NFI6XY9iwat19YgjSn7VtrRXxsdCjQ0fFqP5PtmVGc4q82zCggY6gGAAEvkNcpioJyNiAkIWxjDlYG7lHol00eo8aZAr0") 
           
            try { 
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // following code may throw error if user input is invalid address
                        // so we use try-catch block to handle errors
                        // expected response is JSON data
                        console.log(this.responseText);
                        var response = JSON.parse(this.responseText);
                        
                        return stripe.redirectToCheckout({ sessionId: response.id
                        });  
                    
                };
              }
            } catch(err) { // show error message
    
                console.log("Sorry, invalid address. Please try again!");
            }
            xhttp.open("POST", url, true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            data = document.getElementById('checkout-info').value;
            data = data.split(','); // array
            var senddata = "user_id=" + data[0]+ "&company_id=" + data[1]+ "&time=" + String(document.getElementById("collection_time").value) + "&date=" +String( document.getElementById("collection_date").value) + "&price=" + document.getElementById("total_price_for_all_products_with_gst").innerText.slice(1) + "&cart=" + current_cart;
            console.log(senddata);
            xhttp.send(senddata); // query parameters
          }

      
  </script>


  <!-- load the map asynchronously, i.e., load data soon as it becomes available -->
  <!-- replace the API key with yours -->
    <!-- load the map asynchronously, i.e., load data soon as it becomes available -->
    <!-- replace the API key with yours -->
  <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcIUwwXfLUWzMAE1WspewghH9f-vmSkzc&callback=initMap">
  </script>
</body>

</html>