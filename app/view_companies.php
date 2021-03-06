<head>
    <!--Important for certain characters to display correctly!-->
    <meta charset="UTF-8">
</head>
<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';

  if(!isset($_SESSION)) { 
    session_start(); 
  } 
  if (isset($_GET['postal_code'])) {
    $_SESSION["postal_code"] = $_GET['postal_code'];
    
  }



?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge"> 
<title>View Restaurants</title>
<link rel="icon" href="images/logo/favicon.png">
<!-- Roboto Font -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<!--Bootstrap 4 and AJAX-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<!--Link to main.css files while contains all the css of this project-->
<link rel='stylesheet' href='css\maincss.css'>

<script>
  // change active navbar
    $(document).ready(function(){
        $(".active").removeClass("active");
        $("#link-companies").addClass("active");
    }); 
 </script> 

 
<?php
    $companyDAO = new companyDAO();
    //Retrieve all the special descriptions, then we will retrieve all the companies by each special description
    $unique_special_descriptions = $companyDAO->retrieve_unique_special_description();


?>

</head>
<body>
</head>
<body">
<div class='container-fluid' style="background-color:white;">
    <div class='row'>
        <div name="toastdiv">
            <!--Toast, which is a message pop-up whenever an item is added to the cart-->
            <div style="position: relative; min-height: 200px;">
            <!-- Position it -->
            <div style="position: fixed; top: 0; right: 0;  z-index: 10;" >

                <!-- Then put toasts within -->
                <div class="toast hide" id="add_to_cart_message" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                   
                    <strong class="mr-auto">Success!</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    <span id="cart_message_body">was successfully added to your cart. </span><a href="shoppingcart.php" id="added_to_cart_msg" target="_blank" >Click here</a> to view.
                </div>
                </div>

                <div class="toast hide" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="..." class="rounded mr-2" alt="...">
                    <strong class="mr-auto">Bootstrap</strong>
                    <small class="text-muted">2 seconds ago</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    Heads up, toasts will stack automatically
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="modal fade" id="change_company_id_in_cart_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div id="change_company_id_in_cart_msg_body" class="modal-body">
                Are you sure that you want to start a new cart? Your current cart will be deleted.
                </div>
                <div class="modal-footer">
                <button type="button" id="change_company_id_in_cart_msg_yes_btn" class="btn btn-danger" data-dismiss="modal" onclick="change_cart_company_id()">Yes</button>
                <button type="button" class="btn btn-success" data-dismiss="modal">&nbsp;&nbsp;&nbsp;Nope&nbsp;&nbsp;&nbsp;</button>
                </div>
            </div>
            </div>
        </div>         
        <!--Modal to inform not enough company qty in database-->
        <div class="modal fade" id="insufficient_company_qty_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    Sorry! This company is out of stock as someone just bought the last unit of this company.
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
                    <button type="button" class="btn btn-success" id="input_postal_code_confirm" onclick="validate_postal_code()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- add navbar at the top -->
        <?php include 'include/customer_navbar.php';?>

        <!--company grid displaying all food companys-->
        <!-- The col-12 IS SUPER IMPORTANT HERE. ALWAYS ensure col followes after row, THEN u can use col-->
        <div class="col-12" style="padding-left: 40px; padding-right: 40px; w-100">    
            <!--Search bar-->
            <div class="row" name="search_for_companies">    
                <div class="form-group col-12">
                    <input type="text" class="form-control" style="margin-top: 100px;" name="x" id="search_for_company" oninput ='search_filter()' placeholder="Search for restaurants">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <span id="no_items_warning"></span>
            <div class="row" id="main_company_grid"> 
                <?php
                    //To calculate whether a company is within the range of the user specified proximity in preferences
                    $userDAO = new userDAO();
                    $preferences = $userDAO->retrieve_user_preferences($_SESSION["user_id"]);
                    $proximity_range = $preferences; 
                    echo "<input type='hidden' id='proximity_range' value='$proximity_range'></input>";
                ?>
                <div id='proximity'></div>       
                <?php
                    function display_company_grids($data) {
                        echo "<div class='row'>";
                        foreach ($data as $company) {
                           
                            $company_id = $company->get_company_id();
                            $company_address = $company->get_address();
                            $company_latitude = $company-> get_latitude();
                            $company_longtitude = $company-> get_longtitude();
                            $company_description = $company->get_description();
                            $company_following = $company->get_following();
                            $company_joined_date = $company->get_joined_date();
                            $company_mode_of_collection = ucwords($company->get_mode_of_collection());
                            $company_name = $company->get_name();
                          
                            $transactionDAO = new transactionDAO();
                            $transactions = $transactionDAO -> retrieve_transactions_by_company_id($company_id);
                            $company_total_rating = 0;
                            $company_rating_count = 0;
                            foreach ($transactions as $transaction) {
                                $transaction_rating = floatval($transaction->get_rating());
                                $transaction_company_id = $transaction->get_company_id();
                                if ($transaction_company_id == $company_id && $transaction_rating > 0 ) {
                                      $company_total_rating += $transaction_rating;
                                      $company_rating_count += 1;
                                }
                          
                            }
                            if ($company_rating_count == 0) {
                                $company_rating = 0;
                            }
                            else {
                                $company_rating = round($company_total_rating / $company_rating_count , 2);
                            }
                            
                                echo "
                                <div class='col-xl-4 col-lg-4 col-sm-6 single_company_grid' id ='single_company_grid' name='$company_id|$company_address|$company_description|$company_following|$company_joined_date|$company_mode_of_collection|$company_name|$company_rating'>
                                    <div class='company-grid shadow p-3 mb-5 bg-white rounded'>
                                        <a class='product_link' href='view_company.php?company_name=" . $company_name . "'>                               
                                            <div class='company-image d-flex w-100'>
                                                <img class='pic-1 my-auto'  src='images/company_profile_image/$company_id.jpeg'></img>";
                                                
                                                echo "
                                            </div>
                                            <div class='company-content'>
                                                
                                                <span class='title font-weight-bold'>" . str_replace('_',' ',$company_name) ."</span> <li class='fa fa-star' style='margin-left: 10px;'></li>";
                                                if ($company_rating == 0) {
                                                    echo "<span class='font-weight-bold ml-1 mt-2'>No rating yet!</span>";
                                                }
                                                else {
                                                    if ($company_rating == 0) {
                                                        echo "<span class='font-weight-bold ml-1'>No rating yet!</span>";
                                                    }
                                                    else {
                                                        echo "<span class='font-weight-bold ml-1'>$company_rating</span>
                                                        <span>/5</span>&nbsp;($company_rating_count ";
                                                        if ($company_rating_count > 1) {
                                                            echo "reviews)";
                                                        }
                                                        else {
                                                            echo "review)";
                                                        }
                                                    }
                                                }
                                                echo "
                                                <h3 class='description'>" . $company_description . "</h3>
                                                <h3 class='description'>" . $company_mode_of_collection . "</h3> <h3 class='description distance_obj' name='$company_latitude,$company_longtitude'></h3>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                ";                            
                        }
                        echo "</div>";                   
                    }
                    echo "<div class='col-12'>";
                   
                    // Print special description (of the food product) by special description
                    foreach ($unique_special_descriptions as $unique_special_description) {
                        echo "  <div class='row' style='margin-left: 5px; margin-bottom: 20px;'>
                                    <h2 class='font-weight-bold'>$unique_special_description</h2>
                                </div>";
                        $company_products_by_special_description = $companyDAO->retrieve_products_by_special_description($unique_special_description);
                        echo display_company_grids($company_products_by_special_description);
                    }
                    
                    //Print all the restaurants
                    echo "  <div class='row' style='margin-left: 5px; margin-bottom: 20px;'>
                                <h2 class='font-weight-bold'>All restaurants</h2>
                            </div>";
                    $companies = $companyDAO->retrieve_companies();
                    echo display_company_grids($companies);
                    echo "</div>";
                ?> 
            </div>
        </div>
    </div>
</div>
<?php include 'include/footer.php';?>

<script>
    //****Search bar****//
    function search_filter(){
        //Change the display to none for companys that do not meet the filter criteria, else change the display to block
        var company_grids = document.getElementsByClassName("single_company_grid");
        var search_for_company = document.getElementById("search_for_company").value.toLowerCase();
        

        has_at_least_one_value = false;
     
        for (var i=0; i < company_grids.length; i++) {
            var company_grid = company_grids[i];
            var company_info_arr = company_grid.getAttribute("name").split("|");        
            
            var name = company_info_arr[6].toLowerCase();
            
                //Checks whether the company meets all filter criteria. 
            if (name.includes(search_for_company)) {
                company_grid.setAttribute("style", "display: block;");
               
                console.log(company_grid);
                has_at_least_one_value = true;
            }
            else {
              
                company_grid.setAttribute("style", "display: none;");
            }
        }
        //Display warning message if no companys match the filter criteria
        if (!has_at_least_one_value) {
            document.getElementById("no_items_warning").innerHTML = "<div class='alert alert-danger'>No results match the filter criteria</div>";
        }
        else {
            document.getElementById("no_items_warning").innerHTML = "";

        }
    }
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
            
            //Sets the postal code in session
            sessionStorage.setItem('postal_code', document.getElementById("postal_code").value);
            calculates_distance();
        }
    }
    //run this function when this page loads
    window.onload = calculates_distance("");
    function calculates_distance() {
        //This functions calculate distance from provided postal code to all companies location
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
        //Retrieves the company latitude and longtitude 
        var all_distances = document.getElementsByClassName("distance_obj");
        for (distance_obj of all_distances) {
            end_latlng_arr = distance_obj.getAttribute("name").split(",");    
            end_latitude = end_latlng_arr[0]/10000000;
            end_longtitude = end_latlng_arr[1]/10000000;
       
            //Need to put XHR_request as a seperate function and call it if
            //you want to make multiple AJAX requests!
            XHR_request(url, end_latitude, end_longtitude, distance_obj);                                 
        }          
        

                       

    }

    function XHR_request(url, end_latitude, end_longtitude, distance_obj) {
    
        var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // following code may throw error if user input is invalid address
                    // so we use try-catch block to handle errors
                    try { 
                        // expected response is JSON data
                        var data = JSON.parse(this.responseText);
                        var loc = data["results"][0]["geometry"]["location"];
                        start_latitude = loc["lat"];
                        start_longtitude = loc["lng"];
                        
                        //After getting current latitude and longtitude, calculates distance from this point to this company's longtitude and latitude
                        var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(start_latitude,start_longtitude), new google.maps.LatLng(end_latitude, end_longtitude))/1000; 
                      
                        //round to 2 dp
                        distance = Math.round(distance * 100) / 100;   

                        distance_obj.innerHTML = "<div>" + distance + " km away</div>";  
                        if ( parseFloat(document.getElementById("proximity_range").value) != 0 && distance > parseFloat(document.getElementById("proximity_range").value)/1000) {
                            distance_obj.innerHTML += "<div class='mt-2 text-danger'>Further away then specified preferences</div> ";  
                        }  


                        


                    } catch(err) { // show error message
                        // not a good idea to directly show err.message 
                        // as it may contain sensitive info
                        // show a predefined error message string
                        console.log("Sorry, invalid address. Please try again!");

                    }
                }
            };
            xhttp.open("GET", url, true);
            xhttp.send();  
    }
    function sort_companys() {
        var selected_option = document.getElementById("sort_by_bar").value;        
        var main_company_grid = document.getElementById('main_company_grid');
 
        var company_grids = Array.from(document.getElementsByClassName("single_company_grid"));
        var search_for_company = document.getElementById("search_for_company").value;
        var price_min = document.getElementById("price_min").value;
        var price_max = document.getElementById("price_max").value;
        var offers_free_delivery = document.getElementById("offers_free_delivery").checked;
        var offers_has_discount = document.getElementById("offers_has_discount").checked;
        var freshness_min_days_to_expiry = document.getElementById("freshness_min_days_to_expiry").value;
        var categories_dessert = document.getElementById("categories_dessert").checked;
        var categories_vegetables = document.getElementById("categories_vegetables").checked;
        var categories_meal = document.getElementById("categories_meal").checked;
        var has_at_least_one_value = false;
        if (selected_option == "Price: Low to high") {
            var company_grids_sorted = company_grids.sort(function(a, b){return parseFloat(a.getAttribute("name").split(",")[7])-parseFloat(b.getAttribute("name").split(",")[7])});
        }

        else if (selected_option == "Price: High to low") {
            var company_grids_sorted = company_grids.sort(function(b, a){return parseFloat(a.getAttribute("name").split(",")[7])-parseFloat(b.getAttribute("name").split(",")[7])});
        }
        //Create a date object based on date and time field and compare which one is larger
        else if (selected_option == "Posted Date: Newest to oldest") {
            var company_grids_sorted = company_grids.sort(function(b, a){return Date.parse(a.getAttribute("name").split(",")[5] + " " + a.getAttribute("name").split(",")[6])-Date.parse(b.getAttribute("name").split(",")[5] + " " + b.getAttribute("name").split(",")[6])});
        }   
        else if (selected_option == "Posted Date: Oldest to newest") {
            var company_grids_sorted = company_grids.sort(function(a, b){return Date.parse(a.getAttribute("name").split(",")[5] + " " + a.getAttribute("name").split(",")[6])-Date.parse(b.getAttribute("name").split(",")[5] + " " + b.getAttribute("name").split(",")[6])});
        }  
        else if (selected_option == "Expiry Date: Further away to shorter away") {
            var company_grids_sorted = company_grids.sort(function(b, a){return Date.parse(a.getAttribute("name").split(",")[2] + " " + a.getAttribute("name").split(",")[3])-Date.parse(b.getAttribute("name").split(",")[2] + " " + b.getAttribute("name").split(",")[3])});
        }  
        else if (selected_option == "Expiry Date: Shorter away to further away") {
            var company_grids_sorted = company_grids.sort(function(a, b){return Date.parse(a.getAttribute("name").split(",")[2] + " " + a.getAttribute("name").split(",")[3])-Date.parse(b.getAttribute("name").split(",")[2] + " " + b.getAttribute("name").split(",")[3])});
        }  
        
     
        main_company_grid.innerHTML = "";
        for (var i = 0; i < company_grids_sorted.length; i++) {
            main_company_grid.appendChild(company_grids_sorted[i]);
        }
          
    }

   
</script>
<!-- To calculate distance between 2 points-->
<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>
</body>
</html>
