<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    require_once 'include/common.php';
    require_once 'include/protect.php';
    #Get username and id from the link itself
    $userDAO = new userDAO();
    $user = $userDAO->retrieve_user($_SESSION["user_id"]);
    $user_name = $user->get_name();
    $email = $user->get_email();
    $phoneNumber = $user->get_phoneNumber();
    $preferences = $user->get_preferences();
    $user_id = $user->get_user_id();
    $cart = $user->get_cart();

    $transactionDAO = new transactionDAO();
    $transactions = $transactionDAO->retrieve_transactions_by_user_id($user_id);
    // $company_id = $orders->get_company_id();

    $companyDAO = new companyDAO();
    $productDAO = new productDAO();
    
  ?>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Eco</title>
 
  <!-- Bootstrap core CSS -->  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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

  <!-- <header class="py-5 mb-5 header-img">

  </header> -->
<div class="container">
    <div class='row'>
        <div class='col-3 profile rounded' style="margin-top: 50px; margin-bottom: 50px;">
            <div class="jumbotron jumbotron-fluid"> 
                <!-- <h2 class="display-5 mx-md-5">Customer Profile</h2> -->
                <!-- <hr class="my-4"> -->
                <img src="images/profile_picture/user/default.png" class="rounded-circle mx-auto d-block profile-img" style="margin-top: 30px; margin-bottom: 20px;">
                <!-- <img src="images/profile_picture/user/default.png" class="profile-img mx-auto d-block" style="margin-top: 30px; margin-bottom: 20px;"> -->
                <div class="personal-details"><h3><?php echo $user_name ?></h3></div>
                <div class="personal-details"><p><?php echo $email ?></p></div>
                <div class="personal-details"><p><?php echo $phoneNumber ?></p></div>
                <div id='user_id' hidden><?php echo $user_id ?></div>
                <div id='preferences' hidden><?php echo $preferences ?></div>
            </div>
        </div>

        <div style="width:20px;"></div>
  
        <div class="col profile rounded" style="margin-top: 50px; margin-bottom: 50px;">
            <div class="mx-md-5" >
            <h2 style="margin-bottom: 30px; margin-top: 50px;">Notification Preferences</h2>
                <p>Conditions for when you prefer to receive notifications on new food product listings.</p>
                <!-- <div id="success"></div> -->


                <div name="toastdiv" id="toastdiv"style="display: none;">
                    <!--Toast, which is a message pop-up for successful update -->

                        <!-- Then put toasts within -->
                        <div class="toast hide" id="success_popup"  style="margin: 10px;" aria-live="assertive" aria-atomic="true">
                            <!-- <div class="toast-body"> -->
                                <div class='alert alert-success alert-dismissible fade show' style="margin: 0px;" role='alert'>
                                    Successfully updated your preferences!
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>      
                                </div>
                            </div>   
                </div>

                

      
                    <?php 
                        $counter = 0;
                        $prefArr = explode(',',$preferences);
                        foreach($prefArr as $pref){
                            $counter++;
                            
                            if ($pref == 'true' || $pref != 0) {
                              //echo "yey";
                                if ($counter == 1) {
                                    echo "<input type='checkbox' id='c1' name='c1' value='true' onchange =\"update_preferences('must_be_vegetarian')\" checked><label for='c1' style='padding-left: 10px;'> Must be Vegetarian</label><br>";
                                } elseif ($counter == 2){
                                    echo "<input type='checkbox' id='c2' name='c2' value='true' onchange =\"update_preferences('halal')\" checked><label for='c2'' style='padding-left: 10px;'> Halal</label><br>";
                                } else {
                                      echo "<input type='checkbox' id='c3' name='c3' value='{$pref}' onchange =\"update_preferences('proximity')\" checked><label for='c3' style='padding-left: 10px;'> Within a proximity range from current location (m): <input type='text' id='updated_proximity'  value='{$pref}' aria-label='Text input with checkbox' onchange =\"update_preferences('proximity')\" ></label><br>";
                                }
                            } else {
                                  if ($counter == 1) {
                                      echo "<input type='checkbox' id='c1' name='c1' value='false' onchange =\"update_preferences('must_be_vegetarian')\"><label for='c1' style='padding-left: 10px;'> Must be Vegetarian</label><br>";
                                  } elseif ($counter == 2){
                                      echo "<input type='checkbox' id='c2' name='c2' value='false' onchange =\"update_preferences('halal')\"><label for='c2' style='padding-left: 10px;'> Halal</label><br>";
                                  } else {
                                    echo "<input type='checkbox' id='c3' name='c3' value='{$pref}' onchange =\"update_preferences('proximity')\"><label for='c3' style='padding-left: 10px;'> Within a proximity range from current location (m): <input type='text' id='updated_proximity' aria-label='Text input with checkbox' onchange =\"update_preferences('proximity')\" ></label><br>";
                                  }
                            }
                        }
                    ?>
        
                <p style="margin-top: 10px;"><button type="submit" class="btn btn-primary" onclick="changePreferences()" >Change Preferences</button></p>

              
            </div>
        </div>
  </div>


  <!-- <hr> -->


      <div class="mx-md-5" style="margin-top: 50px; margin-bottom: 50px;">
          <h2 style="margin-bottom: 20px;">Order History</h2>
          <i class="fas fa-info-circle"></i><small class="font-weight-bold">&#8287;&#8287;&#8287;&#8287;View your past orders. These receipts serve as confirmation for your order pickup.</small>
          <hr>
          <?php
            if ($transactions == []){
                echo "<div>No orders made yet.</div>";
            } else {

                foreach ($transactions as $transaction){
                    $rating = $transaction->get_rating();
                    $review = $transaction->get_review();
                    $cart_string = $transaction->get_cart();
                    $time = $transaction->get_order_time();
                    if ($time[0] > 0) {
                        $time.= ' PM';
                    } else {
                        $time .= ' AM';
                    }
                    $cart = explode(',', $cart_string);
                    //var_dump($cart);
                    $order_details = '';
                    foreach ($cart as $item) {
                      $item_array = explode(":",$item);
                      $product_id = $item_array[0];
                      $qty = $item_array[1];
                      $product = $productDAO->retrieve_single_product($product_id);
                      $product_name = $product->get_name();
                      $order_details .= $product_name .': ' . $qty . ' pax <br>';
                    }
                    
                    // if ($rating == ''){
                    //   echo "<button type='submit' class='btn btn-primary btn-sm' onclick="addRating()">Rate</button>"
                    // } 

                    // if ($review == ''){
                    //   echo "<input type='text' name='review' id='review>";
                    // }

                    if ($review == '' || $rating ==''){
                        echo "
                            <div class='card border-dark mb-3'>
                            <div class='card-header'>Order Id #{$transaction->get_transaction_id()}&#8287;&#8287;&#8287;&#8287;&#8287;<br><span class='text-success font-weight-bold'>\${$transaction->get_amount()}</span><small class='float-right'>Date: {$transaction->get_order_date()},  Time: {$time}</small><small class='float-right'>Collection Method: {$transaction->get_collection_type()}&#8287;&#8287;|&#8287;&#8287;</small></div>
                            <div class='card-body bg-special text-dark'>
                                  <h5 class='card-title font-weight-bold text-capitalize'>{$companyDAO->retrieve_company($transaction->get_company_id())->get_name()}</h5>
                                  <p class='card-text'>{$order_details}</p>
                                  <p class='card-text'><button type='button' class='btn btn-primary btn-sm float-right' data-toggle='modal' data-target='#exampleModal'>Rate & Review</button></p>
                                        <div class='modal fade' id='exampleModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
                                        <button type='button' class='btn btn-primary' onclick='received({$transaction->get_transaction_id()})'>Submit Review</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        ";
                    } 
                    
                    else {

                        echo "
                          <div class='card border-dark mb-3'>
                              <div class='card-header'>Order Id #{$transaction->get_transaction_id()}&#8287;&#8287;&#8287;&#8287;&#8287;<span class='badge badge-info'>Reviewed</span>&#8287;&#8287;<span class='badge badge-warning'>Rating: {$transaction->get_rating()}</span><br><span class='text-success font-weight-bold'>\${$transaction->get_amount()}</span><small class='float-right'>Date: {$transaction->get_order_date()},  Time: {$time}</small><small class='float-right'>Collection Method: {$transaction->get_collection_type()}&#8287;&#8287;|&#8287;&#8287;</small></div>
                              <div class='card-body text-dark'>
                                <h5 class='card-title font-weight-bold text-capitalize'>{$companyDAO->retrieve_company($transaction->get_company_id())->get_name()}</h5>
                                <p class='card-text'>{$order_details}</p><hr class='class-1'>
                                <p class='card-text'>Review: {$transaction->get_review()}</p>
                              </div>
                          </div>
                      ";
                    }
                  }
              }


          ?>
              
      </div>
  </div>

</div> 

<script>

    // change active navbar
    $(document).ready(function(){
        $(".active").removeClass("active");
        $("#link-customer-profile").addClass("active");
    }); 

    var user_id = document.getElementById('user_id').innerText;
    console.log(user_id);

    function opposite(x){
        if (x == 'true') {
            return 'false';
        } else if (x=='false') {
          return 'true';
        }
    }

    var preferences = document.getElementById('preferences').innerText.split(',');
    console.log(preferences);
    function update_preferences(condition) {
        if (condition == 'must_be_vegetarian') {
            var must_be_vegetarian = document.getElementById("c1").value;
            preferences[0] = opposite(must_be_vegetarian);
            console.log(preferences[0]);
        } else if (condition == 'halal') {
            var halal = document.getElementById("c2").value;
            preferences[1] = opposite(halal);
            console.log(preferences[1]);
        } else {
            if (document.getElementById("c3").checked) {
                var proximity = document.getElementById("updated_proximity").value;
            } else {
                var proximity = 0;
                document.getElementById("updated_proximity").value = 0;
            }
  
            preferences[2] = proximity;
            console.log(preferences[2]);
        }   
    }


    function changePreferences() {
      
        //Send an AJAX request to update_user.php to update the cart of user in database
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                //Add check for success here?
                var success = JSON.stringify(this.responseText);
                // console.log(this.responseText);  
                // document.getElementById('success').innerHTML =  "<div class='alert alert-success alert-dismissible fade show' role='alert'>" + success + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
                document.getElementById('toastdiv').setAttribute("style","display: block;");
                $("#success_popup").toast({ delay: 2000 });
                $("#success_popup").toast('show');
                
            }  
        
        };

        request.open('POST', 'update_preferences.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&preferences="+preferences);  

        
        
    }
  
    function received(transaction_id) {
        var rating = document.getElementById('rating-score').value;
        if (rating == ''){
        rating = 0;
        }
        
        var review = document.getElementById('review-text').value;
        
        console.log(rating);
        console.log(review);
        console.log(transaction_id);
        //Send an AJAX request to update_review.php to update the transaction
        var request = new XMLHttpRequest();  
            request.onreadystatechange = function() {    
                
                if (this.readyState == 4 && this.status == 200) {
                    //Add check for success here?
                    var success = JSON.stringify(this.responseText);
                    alert(success);
                    window.location.href = "customer_profile.php";
                    
                }  
            
            };

        request.open('POST', 'add_rating_and_review.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("transaction_id="+transaction_id+"&rating="+rating+"&review="+review); 


  }

    //****Add to cart message popup****//
    $(document).ready(function(){
    $(".success_popup").click(function(){
            //$("#add_to_cart_message").toast({ delay: 7000 });
            //$("#add_to_cart_message").toast('show');
        }); 
    });



</script>


  


<!-- Footer -->
<?php include 'include/footer.php';?>

</body>

</html>