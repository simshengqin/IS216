<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';
    $transactionDAO = new transactionDAO();
    $companyDAO = new companyDAO();
    $productDAO = new productDAO();
    $userDAO = new userDAO();

    require 'vendor/autoload.php';
    $stripe = new \Stripe\StripeClient('sk_test_51HnnHcGmZOdyBZEcx9a9NnEe3AzWX102pVGiyFU4u9wnmFsIqf18vl0CfVvO50ijsGob8lIYulJq2j8PxpXL9huJ00DNIEv2SM');
   
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
         
          $price = strval(floatval($price_in_cents/100));
          
          $cart = $cart_info->cart;
          // add pending order into transactions table
          $transactionDAO->add($user_id, $cart, $company_id, $date, $time, $price, 'Self-pickup', '', 0, 'false');
          //redirect to profile page immediately  
      }
    }


    
    $transactions = $transactionDAO->retrieve_transactions_by_user_id($user_id);

    // clear shopping cart for user
    $_SESSION['cart_company_id'] = "0";
    $userDAO->update_user_cart($user_id, '');
    $userDAO->update_user_cart_company_id($user_id, 0);
    ob_start();
    header('Location: '.'customer_profile.php');
    ob_end_flush();
    die();

?>

<html>
<head>
  <title>Thanks for your order!</title>
  <!-- Bootstrap core CSS -->  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="css/maincss.css">
  <!-- icon -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>

  <!-- font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

  
</head>
<body>

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
</body>
</html>