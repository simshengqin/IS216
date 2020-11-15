<!DOCTYPE html>
<html lang="en">

<head>
    <!--Modal to inform confirmation of order-->
    <div class="modal fade" id="received_order_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Success</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Successfully confirmed order received!
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal" onclick="refresh_page()" >Okay</button>
        </div>
        </div>
    </div>
    </div>
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
    $unrated_transactions = $transactionDAO->retrieve_unrated_transactions_by_user_id($user_id);
    $rated_transactions = $transactionDAO->retrieve_rated_transactions_by_user_id($user_id);



    $companyDAO = new companyDAO();
    $productDAO = new productDAO();
    
  ?>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Customer Profile</title>
 
  <!-- Bootstrap core CSS -->  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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

<body class="bg-white"> 

<!-- Navigation -->
<?php include 'include/customer_navbar.php';?>




<div class="container">
    <div class='row mx-md-5 pl-3 pr-3'>
        <div class='col-md-3 profile rounded' style="margin-top: 50px; margin-right: 20p;">
            <div class="pb-5"> 
              
                <?php
                    if (file_exists("images/profile_picture/user/$user_id.png")) {
                        $image_link = "images/profile_picture/user/$user_id.png";
                    }
                    elseif (file_exists("images/profile_picture/user/$user_id.jpg")) {
                        $image_link = "images/profile_picture/user/$user_id.jpg";
                    }
                    elseif (file_exists("images/profile_picture/user/$user_id.jpeg")) {
                        $image_link = "images/profile_picture/user/$user_id.jpeg";
                    }
                    else {
                        $image_link = "images/profile_picture/user/default.png";
                    }
                ?>
                <img src='<?php echo "$image_link"?>' class="rounded-circle w-5 mx-auto d-block profile-img" style="margin-top: 30px; margin-bottom: 20px;">
                <!-- <img src="images/profile_picture/user/default.png" class="profile-img mx-auto d-block" style="margin-top: 30px; margin-bottom: 20px;"> -->
                <div class="personal-details"><h3 style="word-wrap: break-word;"><?php echo $user_name ?></h3></div>
                <div class="personal-details"><small style="word-wrap: break-word;"><?php echo $email ?></small></div>
                <div class="personal-details"><small style="word-wrap: break-word;"><?php echo $phoneNumber ?></small></div>
                <div id='user_id' hidden><?php echo $user_id ?></div>
                <div id='preferences' hidden><?php echo $preferences ?></div>
            </div>
        </div>

     
        <div class="col-md-9 profile rounded" style="margin-top: 50px;">
            <div class="mx-md-5" >
            <div class="d-none d-sm-none d-md-block d-lg-block d-xl-block" style= "height: 60px;"></div>
            <h2 style="margin-top: 30px;">Preferences</h2>
                <p></p>
            


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
                            

                        }                            
                        
                        echo "  <label for='updated_proximity' class='label-title'>Highlight to me when a restaurant is outside of this proximity range: <br> (Leave as 0 to turn off this feature)</label>
                                <input type='range' min='0' max='20000' step='5' value='$pref' name='preferances[]' id='updated_proximity' class='form-input' oninput ='change_proximity()' style='height: 28px; width: 78%; padding: 0;' />
                                <span id='proximity-label'>{$pref}m</span>";
                    ?>
                
                <p style=""><button type="submit" style="margin-top: 40px" class="btn btn-primary" onclick="changePreferences()" >Change Preferences</button></p>
                <div class="d-md-none" style= "height: 20px;"></div>
              
            </div>
        </div>
    </div>


 


    <div class="row mx-md-5 pl-3 pr-3" style="margin-top: 50px; margin-bottom: 50px;">
        <?php          
            if ($unrated_transactions == []){
                echo "";
               
            }
            else {
                
                echo "<h2 style='margin-bottom: 20px;'>Active Orders</h2>
                        <div class='col-12'>
                        <i class='fas fa-info-circle'></i><small class='font-weight-bold'>&#8287;&#8287;&#8287;&#8287;Click 'Received' button to confirm that order is completed! Leave a rating and review for your order! (optional) <br> &#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287;&#8287; You are encouraged to bring your own reusable container to collect your food! &#128540; </small>
                        <hr>
                        </div>";
                foreach ($unrated_transactions as $transaction){
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
                    
                    $order_details = '';
                    foreach ($cart as $item) {
                        $item_array = explode(":",$item);
                        $product_id = $item_array[0];
                        $qty = $item_array[1];
                        $product = $productDAO->retrieve_single_product($product_id);
                        $product_name = $product->get_name();
                        $order_details .= $product_name .': ' . $qty . ' pax <br>';
                    }
                    
                   
                    echo "
                    <div class='col-12'>
                    <div class='row card border-dark mb-3'>
                        <div class='card-header'>Order Id #{$transaction->get_transaction_id()}&#8287;&#8287;&#8287;&#8287;&#8287;<br><span class='text-success font-weight-bold'>\${$transaction->get_amount()}</span><small class='float-right'>Date: {$transaction->get_order_date()},  Time: {$time}</small><small class='float-right'>Collection Method: {$transaction->get_collection_type()}&#8287;&#8287;|&#8287;&#8287;</small></div>
                            <div class='card-body bg-special text-dark'>
                                    <h5 class='card-title font-weight-bold text-capitalize'>{$companyDAO->retrieve_company($transaction->get_company_id())->get_name()}</h5>
                                    <p class='card-text'>{$order_details}</p>
                                    <p class='card-text'><button type='button' class='btn btn-primary btn-sm float-right' onclick='set_target_transaction_id({$transaction->get_transaction_id()})' data-toggle='modal' data-target='#review_modal'>Received Order</button></p>
                                        <div class='modal fade' id='review_modal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
                                                <label for='rating' class='col-form-label'>Rating (Optional):
                                                <br> <small>Select a number from 1 (Very bad) to 5 (Very good)</small></label>
                                                <select class='form-control' id='rating-score'>
                                                    <option>No rating</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                                </div>
                                                <div class='form-group'>
                                                <label for='review-text' class='col-form-label'>Review (Optional) :</label>
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
                    </div>
                    ";                 
                    }      
            }                
            echo "  <div class='col-12'>
                            <h2 style='margin-bottom: 20px;'>Order History</h2>
                        </div>
                        <div class='col-12'>
                            <i class='fas fa-info-circle'></i><small class='font-weight-bold'>&#8287;&#8287;&#8287;&#8287;View your past orders. These receipts serve as confirmation for your order pickup.</small>
                            <hr>
                        </div>";    
            if ($rated_transactions == []){
                echo "<div class='col-12'>No past orders</div>";
            }
            else {
                echo "<div class='col-12'>";
                foreach ($rated_transactions as $transaction){
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
                   
                    $order_details = '';
                    foreach ($cart as $item) {
                        $item_array = explode(":",$item);
                        $product_id = $item_array[0];
                        $qty = $item_array[1];
                        $product = $productDAO->retrieve_single_product($product_id);
                        $product_name = $product->get_name();
                        $order_details .= $product_name .': ' . $qty . ' pax <br>';
                    }
                    
                    
                    //rating = 0 means not rated yet, rating = -1 means customer dont want to review
                    $rating = $transaction->get_rating();
                    if ($rating == -1) {
                        $rating = "No rating";
                    }
                    else {
                        $rating = "Rating: " . $rating;
                    }
                    echo "
                        <div class='row card border-dark mb-3'>
                            <div class='card-header'>Order Id #{$transaction->get_transaction_id()}&#8287;&#8287;&#8287;&#8287;&#8287;<span class='badge badge-info'>Received</span>&#8287;&#8287;<span class='badge badge-warning'>$rating</span><br><span class='text-success font-weight-bold'>\${$transaction->get_amount()}</span><small class='float-right'>Date: {$transaction->get_order_date()},  Time: {$time}</small><small class='float-right'>Collection Method: {$transaction->get_collection_type()}&#8287;&#8287;|&#8287;&#8287;</small></div>
                            <div class='card-body text-dark'>
                            <h5 class='card-title font-weight-bold text-capitalize'>{$companyDAO->retrieve_company($transaction->get_company_id())->get_name()}</h5>
                            <p class='card-text'>{$order_details}</p>";
                    $review_text = $transaction->get_review();
                    if ($review_text != "") {
                        echo "<hr class='class-1'>
                                <p class='card-text'>Review: {$transaction->get_review()}</p>";
                    }
                    echo "</div></div>";
                    
                    }
                }
                echo "</div>";                
            

        
        ?>
            
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
    function change_proximity() {
        //Update the slider bar text on change 
        var proximity = document.getElementById("updated_proximity").value;
        document.getElementById("proximity-label").innerText = proximity + "m";
        preferences = proximity;
    }
    function opposite(x){
        if (x == 'true') {
            return 'false';
        } else if (x=='false') {
          return 'true';
        }
    }

    var preferences = document.getElementById('preferences').innerText;//.split(',');
    console.log(preferences);
    function update_preferences(condition) {
       
        preferences = proximity;
    }


    function changePreferences() {
      
        //Send an AJAX request to update_user.php to update the cart of user in database
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                //Add check for success here?
                var success = JSON.stringify(this.responseText);
               
                document.getElementById('toastdiv').setAttribute("style","display: block;");
                $("#success_popup").toast({ delay: 2000 });
                $("#success_popup").toast('show');
                
            }  
        
        };

        request.open('POST', 'update_preferences.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&preferences="+preferences);  

        
        
    }
    //Tells the modal which transaction id to give review to
    function set_target_transaction_id(transaction_id) {
        window.transaction_id = transaction_id;
    }
    function received() {
        transaction_id = window.transaction_id;
        
        var rating = document.getElementById('rating-score').value;
        if (rating == 'No rating'){         
            rating = -1;
        };
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
                    
                    $('#review_modal').modal('hide');
                    $('#received_order_msg').modal('show');
                   
                    
                }  
            
            };

        request.open('POST', 'add_rating_and_review.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("transaction_id="+transaction_id+"&rating="+rating+"&review="+review); 


    }
    function refresh_page() {
        window.location.href = "customer_profile.php";
    }
    



</script>


  


<!-- Footer -->
<?php include 'include/footer.php';?>

</body>

</html>