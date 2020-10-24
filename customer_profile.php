<!DOCTYPE html>
<html lang="en">

<head>
  <?php
    require_once 'include/common.php';
    require_once 'include/protect.php';
    #Get username and id from the link itself
    $userDAO = new userDAO();
    if (isset($_GET["user_name"])) {
        $user_name = $_GET["user_name"];   
    }
    else {
      //Just a backup for now
      $user_name = "John Doe";
      $user_id = "1";
    }
    
    $user = $userDAO->retrieve_user($user_id);
    $user_name = $user->get_name();
    $email = $user->get_email();
    $phoneNumber = $user->get_phoneNumber();
    $preferences = $user->get_preferences();
    $user_id = $user->get_user_id();

    $transactionDAO = new transactionDAO();
    $transactions = $transactionDAO->retrieve_transactions_by_user_id($user_id);
    // $company_id = $orders->get_company_id();

    $companyDAO = new companyDAO();
    
  ?>


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


</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
    <a class="navbar-brand" href="mainpage.html"><img src="images/logo/rsz_e (1).png">    <img src="images/logo/rsz_shadow_eco.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active mr-4">
          <a class="nav-link" href="mainpage.html">Home</a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="view_products.php">Food</a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="#">Order</a>
        </li>
        <li class="nav-item mr-4">
            <a class="nav-link" href="#">About</a>
        </li>
        <li class="nav-item mr-4">
            <a class="nav-link" href="#">Contact</a>
        </li>
        <li class="nav-item mr-4">
            <a class="nav-link" href="customer_profile.php"><?php echo $user_name ?><span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
    </div>
  </nav>

  <!-- <header class="py-5 mb-5 header-img">

  </header> -->
<div class="container">
    <div class='row'>
        <div class='col-3 profile rounded' style="margin-top: 120px; margin-bottom: 50px;">
            <div class="jumbotron jumbotron-fluid" >
                <!-- <h2 class="display-5 mx-md-5">Customer Profile</h2> -->
                <!-- <hr class="my-4"> -->
                <img src="images/profile_picture/user/default.png" class="rounded-circle mx-auto d-block profile-img" style="margin-top: 30px; margin-bottom: 20px;">
                <!-- <img src="images/profile_picture/user/default.png" class="profile-img mx-auto d-block" style="margin-top: 30px; margin-bottom: 20px;"> -->
                <div class="personal-details"><h3><?php echo $user_name ?></h3></div>
                <div class="personal-details"><?php echo $email ?></div>
                <div class="personal-details"><?php echo $phoneNumber ?></div>
                <div id='user_id' hidden><?php echo $user_id ?></div>
                <div id='preferences' hidden><?php echo $preferences ?></div>
            </div>
        </div>

        <div style="width:20px;"></div>
  
        <div class="col profile rounded" style="margin-top: 120px; margin-bottom: 50px;">
            <div class="mx-md-5" >
            <h2 style="margin-bottom: 30px; margin-top: 50px;">Notification Preferences</h2>
                <p>Conditions for when you prefer to receive notifications on new food product listings.</p>
                <div id="success"></div>
      
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
        
                <p><button type="submit" class="btn btn-primary" onclick="changePreferences()">Change Preferences</button></p>

              
            </div>
        </div>
  </div>


  <hr>


      <div class="mx-md-5" style="margin-top: 50px; margin-bottom: 50px;">
          <h2 style="margin-bottom: 20px;">Order History</h2>
          <i class="fas fa-info-circle"></i><small class="font-weight-bold">&#8287;&#8287;&#8287;&#8287;View your past orders. These receipts serve as confirmation for your order pickup/ delivery.</small>
          <hr>
          <?php
            if ($transactions == []){
                echo "<div>No orders made yet.</div>";
            } else {

                foreach ($transactions as $transaction){
                    $rating = $transaction->get_rating();
                    $review = $transaction->get_review();
                    
                    // if ($rating == ''){
                    //   echo "<button type='submit' class='btn btn-primary btn-sm' onclick="addRating()">Rate</button>"
                    // } 

                    // if ($review == ''){
                    //   echo "<input type='text' name='review' id='review>";
                    // }

                    if ($review == '' || $rating ==''){
                        echo "
                            <div class='card border-dark mb-3'>
                            <div class='card-header'>Order Id #{$transaction->get_transaction_id()}&#8287;&#8287;&#8287;&#8287;&#8287;<br><span class='text-success font-weight-bold'>\${$transaction->get_amount()}</span><small class='float-right'>Date: {$transaction->get_order_date()},  Time: {$transaction->get_order_time()}</small><small class='float-right'>Collection Method: {$transaction->get_collection_type()}&#8287;&#8287;|&#8287;&#8287;</small></div>
                            <div class='card-body text-dark'>
                                  <h5 class='card-title'>{$companyDAO->retrieve_company($transaction->get_company_id())->get_name()}</h5>
                                  <p class='card-text'>Collection Method: {$transaction->get_collection_type()}</p>
                                  <p class='card-text'><button type='submit' class='btn btn-success btn-sm' onclick='addRating()'>Rate</button></p>
                                  <p class='card-text'><input type='text' name='review' id='review><button type='submit' class='btn btn-info btn-sm' onclick='addReview()'>Review</button></p>
                                </div>
                            </div>
                        ";
                    } 

                    else {

                        echo "
                          <div class='card border-dark mb-3'>
                              <div class='card-header'>Order Id #{$transaction->get_transaction_id()}&#8287;&#8287;&#8287;&#8287;&#8287;<span class='badge badge-info'>Reviewed</span>&#8287;&#8287;<span class='badge badge-warning'>Rating: {$transaction->get_rating()}</span><br><span class='text-success font-weight-bold'>\${$transaction->get_amount()}</span><small class='float-right'>Date: {$transaction->get_order_date()},  Time: {$transaction->get_order_time()}</small><small class='float-right'>Collection Method: {$transaction->get_collection_type()}&#8287;&#8287;|&#8287;&#8287;</small></div>
                              <div class='card-body text-dark'>
                                <h5 class='card-title'>{$companyDAO->retrieve_company($transaction->get_company_id())->get_name()}</h5>
                                <p class='card-text'>Order Details?</p>
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
                document.getElementById('success').innerHTML =  "<div class='alert alert-success alert-dismissible fade show' role='alert' onload='setTimeout(function(){ getElementsByClassName('alert')[0].hide(); }, 2000);'>" + success + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
              
            }  
        
        };

        request.open('POST', 'update_preferences.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&preferences="+preferences);  

        
        
    }
  
    function timeout() {
        var duration = 3000; //2 seconds
        setTimeout(function () { $('.alert').hide(); }, duration);
    }
          // window.onload = function() {
          //     var duration = 3000; //2 seconds
          //     setTimeout(function () { $('.alert').hide(); }, duration);
          // };


</script>


  


  <!-- Footer -->
  <footer class="py-5 footer-color">
    <div class="container">
      <p class="text-center">Copyright &copy; Eco G5T4 2020</p>
    </div>
    <!-- /.container -->
  </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script> -->

</body>

</html>