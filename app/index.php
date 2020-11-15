<?php

require_once 'include/common.php';
require_once 'include/protect.php';
                    

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Eco</title>
  <link rel="icon" href="images/logo/favicon.png">
  <!-- Bootstrap core CSS -->  
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
 
  <!-- maincss.css -->
  <link href="css/maincss.css" rel="stylesheet">

  <!-- icon -->
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.js" integrity="sha256-2JRzNxMJiS0aHOJjG+liqsEOuBb6++9cY4dSOyiijX4=" crossorigin="anonymous"></script>

  <!-- font -->
  <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  

 
</head>

<body>

<!-- Navigation -->
<?php include 'include/customer_navbar.php';?>

  <!-- Header -->
  <header class="header-img" style="margin: 0px 0px 10px;">
        <div class="container align-items-center justify-items-center" style="height: auto;">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="mb-3" style="text-align: center; color: white; margin-top: 100px;">Buy surplus food at a discount</h1>
                    <div style="text-align: center; color: white;">Grabbing worthy deals and reducing food waste at the same time!</div>
                    <br><br>
                </div>
            </div>
            <div class ='row'>
                <div class="form-group col" style="margin: 30px 0px 30px; w-100">
                    
                    
                      
                        <input type="number" class="form-control w-100" name="postal_code" id="postal_code"  placeholder="Enter Postal Code">
                        
                    
                </div>
              
                <div class="form-group" style="margin: 30px 15px 30px; w-100">
                    <button id="postal_code_submit" onclick="validate_postal_code()" class="btn btn-success" href="view_products.php">Confirm</button>
                </div>
                
            </div>
          
        </div>

  </header>
  <div style="height:50px"></div>


  <div class="container">
      <div class='row' style="margin-bottom: 30px;">
        <div class='col'>
            <h3 style="margin-bottom: 30px;">Why use Eco?</h3>
            <h6>The best way to save money and save the environment</h6>
            
        </div>
        <div class='col'>
            <img src="images/rsz_2planet-earth.png" class="float-right" style="padding: 30px;">
        </div>

      </div>

      <div class="row">
         

              <div class="col-md-4 mb-5">
              <div class="card text-center" >
                  <img class="card-img-top" src="images/how_to_use/use-1.png" alt="">
                    <div class="card-body">
                        <h4 class="card-title">STEP 1</h4>
                        <p class="card-text">Enter your preferences for proximity range to highlight nearby deals which are convenient to collect!</p>
                    </div>
              </div>
              </div>
          
              <div class="col-md-4 mb-5">
              <div class="card text-center" >
                  <img class="card-img-top" src="images/how_to_use/use-2.png" alt="">
                      <div class="card-body">
                          <h4 class="card-title">STEP 2</h4>
                          <p class="card-text">Select a timeslot from 6.30PM to 9.30PM for collection and pay online via your credit card!</p>         
                      </div>
              </div>
              </div>
        
              <div class="col-md-4 mb-5">
              <div class="card text-center" >
                  <img class="card-img-top" src="images/how_to_use/use-3.png" alt="">
                      <div class="card-body">
                          <h4 class="card-title">STEP 3</h4>
                          <p class="card-text">Upon arrival, show your receipt at the active orders section to the restaurant and collect your food!</p>
                      </div>
              </div>
              </div>
              
          
     
         
      </div>  <!--closes row -->

       
  </div>


  
<script>
    // change active navbar
    $(document).ready(function(){
        $(".active").removeClass("active");
        $("#link-home").addClass("active");
    }); 

</script>

<!-- Footer -->
<?php include 'include/footer.php';?>

</body>

<script>
    // Execute a function when the user releases a key on the keyboard => Main purpose is to submit postal code when enter key is pressed
    document.getElementById("postal_code").addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
          validate_postal_code();
        }
    });
    function validate_postal_code() {
        postal_code_input = document.getElementById("postal_code");
        if (postal_code_input.value.length != 6) { 
            postal_code_input.value = "";
            postal_code_input.setAttribute("placeholder", "Please enter 6 digit"); 

        }
        else {
          try {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // following code may throw error if user input is invalid address
                        // so we use try-catch block to handle errors
                        //Invalid psotal code
                        var data = JSON.parse(this.responseText);
                        if ( data["status"] == "ZERO_RESULTS") {
                          console.log("Sorry, invalid postal code. Please try again!");
                          postal_code_input.value = "";
                          postal_code_input.setAttribute("placeholder", "Invalid postal code"); 
                        }
                        else {
                          //Sets the postal code in session
                          sessionStorage.setItem('postal_code', document.getElementById("postal_code").value);
                          window.location.href = "view_companies.php";                          
                        }

                    }
                };
                var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + postal_code_input.value + "&key=AIzaSyDcIUwwXfLUWzMAE1WspewghH9f-vmSkzc";    
                xhttp.open("GET", url, true);
                xhttp.send();
            }
            catch(err) { // show error message
              // not a good idea to directly show err.message 
              // as it may contain sensitive info
              // show a predefined error message string
              console.log("Sorry, invalid postal code. Please try again!");
              postal_code_input.value = "";
              postal_code_input.setAttribute("placeholder", "Sorry, invalid postal code. Please try again!"); 

            }
        }
    }
</script>


</html>