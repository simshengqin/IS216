<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';
    $transactionDAO = new transactionDAO();
    $companyDAO = new companyDAO();
    $productDAO = new productDAO();
    $userDAO = new userDAO();

    require 'vendor/autoload.php';
    $stripe = new \Stripe\StripeClient('sk_test_51HgOY8AgaC3WCXUJkZeI8NEO20nKkEYE99qUUjnjSdLxJ25DlKtKJipaM4CvoTWzi1cryHYmF6zD83J5cCunACSz007ce7SGlu');
    $events = $stripe->events->all(['limit' => 3]);

    foreach($events->autoPagingIterator() as $event) {
      $session = $event['data']['object'];
      if ($session['id'] == $_GET["session_id"]){
          $cart_info = $session['metadata'];
          $user_id = $cart_info->user_id;
          $company_id = $cart_info->company_id;
          $time = $cart_info->time;
          $date = $cart_info->date;
          $price_in_cents = floatval($cart_info->price);
          //var_dump($price_in_cents);
          $price = strval(floatval($price_in_cents/100));
          //var_dump($price);
          $cart = $cart_info->cart;
          // add pending order into transactions table
          $transactionDAO->add($user_id, $cart, $company_id, $date, $time, $price, 'Self-pickup', '', 0, 'false');
          


          #amount = session['display_items'][0]['amount']         
      }
    }


    
    $transactions = $transactionDAO->retrieve_transactions_by_user_id($user_id);

    // clear shopping cart for user
    $userDAO->update_user_cart($user_id, '');
    $userDAO->update_user_cart_company_id($user_id, 0);


?>

<html>
<head>
  <title>Thanks for your order!</title>
  <!-- Bootstrap core CSS -->  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/maincss.css">
  <!-- icon -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>  -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>

  <!-- font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

  
</head>
<body>
  <!-- Navigation -->
  <?php include 'include/customer_navbar.php';?>
  
<!-- <div style="margin-top: 80px;"></div> -->


<div class="mx-md-5" style="margin-top: 50px; margin-bottom: 50px;">
          <h2 style="margin-bottom: 20px;">Active Orders</h2>
          <i class="fas fa-info-circle"></i><small class="font-weight-bold">&#8287;&#8287;&#8287;&#8287;Click 'Received' button to confirm that order is completed! Leave a rating and review for your order! (optional) <br> &#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287; You are encouraged to bring your own reusable container to collect your food! &#128540; </small>
           <!-- pass user_id -->
           <input type='hidden' value='<?php echo "$user_id" ?>' id="user_id"> 
          <hr>
          <?php
            if ($transactions == []){
                echo "<div>No orders made yet.</div>";
            } else {

                foreach ($transactions as $transaction){
                  if ($transaction->get_collected() == 'false'){
                    $cart_string = $transaction->get_cart();
                    $cart = explode(',', $cart_string);
                    //var_dump($cart);
                    $order_details = '';
                    foreach ($cart as $item) {
                      //var_dump($item);
                      $item_array = explode(":",$item);
                      $product_id = $item_array[0];
                      $qty = $item_array[1];
                      $product = $productDAO->retrieve_single_product($product_id);
                      $product_name = $product->get_name();
                      $order_details .= $product_name .': ' . $qty . ' pax <br>';
                    }

                  

                  
                        echo "
                            <div class='card border-dark mb-3'>
                            <div class='card-header'>Order Id #{$transaction->get_transaction_id()}&#8287;&#8287;&#8287;&#8287;&#8287;<small class='float-right'>Date: {$transaction->get_order_date()},  Time: {$transaction->get_order_time()}</small><small class='float-right'>Collection Method: {$transaction->get_collection_type()}&#8287;&#8287;|&#8287;&#8287;</small><br><span class='text-success font-weight-bold'>\${$transaction->get_amount()}</span>" .
                            "<button type='button' class='btn btn-primary btn-sm float-right' data-toggle='modal' data-target='#exampleModal'>Received</button>".
                            "<div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                              <div class='modal-content'>
                                <div class='modal-header'>
                                  <h5 class='modal-title' id='exampleModalLabel'>New Review</h5>
                                  <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                    <span aria-hidden='true'>&times;</span>
                                  </button>
                                </div>
                                <div class='modal-body'>
                                  <form>
                                    <div class='form-group'>
                                      <label for='rating' class='col-form-label'>Rating: ⭐⭐⭐⭐⭐</label>
                                      <input type='number' class='form-control' placeholder='Enter a number from 1 (Very bad) to 5 (Very good)'  id='rating-score'>
                                    </div>
                                    <div class='form-group'>
                                      <label for='review-text' class='col-form-label'>Review:</label>
                                      <textarea class='form-control' id='review-text'></textarea>
                                    </div>
                                  </form>
                                </div>
                                <div class='modal-footer'>
                                  <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                  <button type='button' class='btn btn-primary' onclick='received()'>Submit Review</button>
                                </div>
                              </div>
                            </div>
                          </div>".
                            "</div>
                            <div class='card-body text-dark'>
                                  <h5 class='card-title font-weight-bold text-capitalize'>{$companyDAO->retrieve_company($transaction->get_company_id())->get_name()}</h5>
                                  <p class='card-text'>{$order_details}</p>
                                </div>
                            </div>
                        ";
                  }
                }
              }


          ?>

          <!-- <p class='card-text'><button type='submit' class='btn btn-success btn-sm' onclick='addRating()'>Rate</button></p>
          <p class='card-text'><button type='submit' class='btn btn-success btn-sm' onclick='addReview()'>Review</button></p> -->
              
      </div>
  </div>

</div> 


<script>
 

  function received() {
    var rating = document.getElementById('rating-score').value;
    if (rating == ''){
      rating = 0;
    }
    
    var review = document.getElementById('review-text').value;
    var user_id = document.getElementById('user_id').value;
    console.log(rating);
    console.log(review);
    console.log(user_id);
    //Send an AJAX request to update_review.php to update the transaction
    var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                //Add check for success here?
                var success = JSON.stringify(this.responseText);
                alert(success);
                window.location.href = "index.php";
                
            }  
        
        };

        request.open('POST', 'update_review.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&rating="+rating+"&review="+review); 


  }


</script>




  <!-- Footer -->
  <?php include 'include/footer.php';?>


</body>
</html>