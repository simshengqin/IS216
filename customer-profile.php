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
    <a class="navbar-brand" href="mainpage.html"><img src="images/logo/favicon-32x32.png"></a>
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
            <a class="nav-link" href="customer-profile.html">Profile<span class="sr-only">(current)</span></a>
        </li>
      </ul>
    </div>
    </div>
  </nav>

  <!-- <header class="py-5 mb-5 header-img">

  </header> -->
<div class="container">
  <div class="jumbotron jumbotron-fluid">
    <!-- <h2 class="display-5 mx-md-5">Customer Profile</h2> -->
    <!-- <hr class="my-4"> -->
    <img src="images/profile_picture/user/default.png" class="profile-img mx-auto d-block">
    <div class="personal-details"><b><?php echo $user_name ?></b></div>
    <div class="personal-details"><?php echo $email ?></div>
    <div class="personal-details"><?php echo $phoneNumber ?></div>
  </div>
  
  <br>
  <div class="mx-md-5">
  <h2>Preferences List</h2>
        <p>Conditions for when you prefer to receive notifications on new food product listings.</p>
        <div id="preferences_form">
          <ul>
          <?php 
              $prefArr = explode(',',$preferences);
              foreach($prefArr as $pref){
                echo "<li>$pref</li>";
              }
          ?>
          </ul>
          <!-- <button type="submit" class="btn btn-primary btn-sm" onclick="getAllPreferences()">Change Preferences</button> -->
        </div>
  </div>


  <br>
  <div class="mx-md-5">
    <h2>Order History</h2>
    <?php
      if ($transactions == []){
        echo "<div>No orders made yet.</div>";
      } else {
        echo "<table class='table'>
                <tr>
                    <th>Order Id</th>
                    <th>Food Item(s)</th>
                    <th>Company</th>
                    <th>Order Date</th>
                    <th>Order Time</th>
                    <th>Order Amount</th>
                    <th>Collection Type</th>
                    <th>Order Rating</th>
                    <th>Order Review</th>
                </tr>";

        foreach ($transactions as $transaction){
          $rating = $transaction->get_rating();
          $review = $transaction->get_review();
          // if ($rating == ''){
          //   echo "<button type='submit' class='btn btn-primary btn-sm' onclick="addRating()">Rate</button>"
          // } 

          // if ($review == ''){
          //   echo "<input type='text' name='review' id='review>";
          // }

          echo "<tr>
                  <td>{$transaction->get_transaction_id()}</td>
                  <td></td>
                  <td>{$companyDAO->retrieve_company($transaction->get_company_id())->get_name()}</td>
                  <td>{$transaction->get_order_date()}</td>
                  <td>{$transaction->get_order_time()}</td>
                  <td>{$transaction->get_amount()}</td>
                  <td>{$transaction->get_collection_type()}</td>
                  <td>{$transaction->get_rating()}</td>
                  <td>{$transaction->get_review()}</td>
                </tr>";
        }
        echo "</table>";
      }


    ?>
        
  </div>

  

</div> 

<script>
//   <form id="myform" class="myform" method="post" name="myform">
// <textarea id="myField" type="text" name="myField"></textarea>
// <input type="checkbox" name="myCheckboxes[]" id="myCheckboxes" value="someValue1" />
// <input type="checkbox" name="myCheckboxes[]" id="myCheckboxes" value="someValue2" />
// <input id="submit" type="submit" name="submit" value="Submit" onclick="return submitForm()" />
// </form>
//  <div id="myResponse"></div>

// function submitForm() {
//     var form = document.myform;

//     var dataString = $(form).serialize();

//     $.ajax({
//         type:'POST',
//         url:'update_preferences.php',
//         data: dataString,
//         // success: function(data){
//         //     $('#myResponse').html(data);
//         // }
//     });
//     return false;
// }

function submitForm() {
  $toReplace = '<ul>';
  for ($pref in $prefArr){
    $toReplace += '<li>' + $pref +'</li>';
  }
  document.getElementById('preferences_form').innerHTML = $toReplace + "</ul>";
}

  function getAllPreferences() {
   
        //Send an AJAX request to update_user.php to update the cart of user in database
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                //Add check for success here?
                console.log(this.responseText);  
                document.getElementById("preferences_form").innerHTML = 
                "<input type='checkbox' id='vegetarian' name='check_list[]' value='Vegetarian'><label for='vegetarian'> Must be vegetarian</label><br><input type='checkbox' id='halal' name='check_list[]' value='Halal'><label for='halal'> Halal</label><br><input type='checkbox' id='proximity' name='check_list[]' value='Proximity'><label for='proximity'> Within a proximity range from current location</label><br><br><input type='submit' value='Submit'>";
            }  
        };  
        //Hardcorded user id here. Rmb to change
        user_id = 1;
        preferences = 'halal';
        // for (option in $_POST['check_list']) {
        //   preferences += option + ','; 
        // }
        request.open('POST', 'update_preferences.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&preferences="+preferences);
        //$("#add_to_cart_message").toast('show');
        //alert('Successfully added ' + name + ' to cart!');



  }
  



</script>


  


  <!-- Footer -->
  <footer class="py-5">
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