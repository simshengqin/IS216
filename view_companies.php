<head>
    <!--Important for certain characters to display correctly!-->
    <meta charset="UTF-8">
</head>
<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';

?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge"> 
<title>View Companies</title>
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
<div class="jumbotron color-grey-light">
    <div class="d-flex align-items-center h-20">
    <div class="container text-center py-5">
    <h3 class="mb-0">View Companies</h3>
    </div>
    </div>
</div>
</head>
<body>
</head>
<body>
<div class='container-fluid'>
    <div class='row'>
        <div name="toastdiv">
            <!--Toast, which is a message pop-up whenever an item is added to the cart-->
            <div style="position: relative; min-height: 200px;">
            <!-- Position it -->
            <div style="position: fixed; top: 0; right: 0;  z-index: 10;" >

                <!-- Then put toasts within -->
                <div class="toast" id="add_to_cart_message" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <!--<img src="..." class="rounded mr-2" alt="...">-->
                    <strong class="mr-auto">Success!</strong>
                    <small class="text-muted">just now</small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="toast-body">
                    <span id="cart_message_body">was successfully added to your cart. </span><a href="shoppingcart.php" target="_blank" >Click here</a> to view.
                </div>
                </div>

                <div class="toast" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
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
        <!--A placeholder to store the user's cart-->
        <!--company grid displaying all food companys-->
        <div class="grid_beside_filterform col-md-8">    
            <!--Search bar-->
            <div class="row" name="search_for_companies">    
                <div class="form-group col-12">
                    <input type="text" class="form-control" name="x" id="search_for_companies" oninput ='search_filter()' placeholder="Search for companies">
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
                    //Process the database into info to be displayed
                    $companyDAO = new companyDAO();
                    $companies = $companyDAO->retrieve_companies();
                    foreach ($companies as $company) {
                        
                        //echo $company->get_name();
                        $company_id = $company->get_company_id();
                        echo $company_id;
                        $company_address = $company->get_address();
                        $company_description = $company->get_description();
                        $company_following = $company->get_following();
                        $company_get_joined_date = $company->get_joined_date();
                        $company_name = $company->get_name();
                        //$company_password = $company->get_password();
                        $company_rating = $company->get_rating();
                            echo "
                            <div class='col-xl-3 col-lg-4 col-sm-6 single_company_grid' id ='single_company_grid' name='$company_id,$company_address,$company_description,$company_following,$company_get_joined_date,$company_name,$company_rating'>
                            <div class='company-grid'>
                                
                                <div class='company-image d-flex w-100'>
                                    <img class='pic-1 my-auto'  src='images/company_profile_image/$company_id.jpeg'>";
                                    
                                    echo "
                                </div>
                                <div class='company-content'>
                                    <ul class='rating'>
                                        <li class='fa fa-star'></li>
                                        <li class='fa fa-star'></li>
                                        <li class='fa fa-star'></li>
                                        <li class='fa fa-star'></li>
                                        <li class='fa fa-star'></li>
                                    </ul>
                                    <h3 class='title'>" . str_replace('_',' ',$company_name) . "</h3>
                                </div>
                            </div>
                        </div>
                            ";                            
                        

                    }
                ?>
            </div>
        </div>
    </div>
</div>
<hr>

<script>
    //****Search bar****//
    function search_filter(){
        //Change the display to none for companys that do not meet the filter criteria, else change the display to block
        var company_grids = document.getElementsByClassName("single_company_grid");
        var search_for_companys = document.getElementById("search_for_companys").value;
        if (document.getElementById("mode_of_collection_delivery").checked) {
            mode_of_collection = "delivery";
        }
        else if (document.getElementById("mode_of_collection_pickup").checked) {
            mode_of_collection = "pickup";
        }
        else {
            mode_of_collection = "";
        }
        var price_min = document.getElementById("price_min").value;
        var price_max = document.getElementById("price_max").value;
        var offers_free_delivery = document.getElementById("offers_free_delivery").checked;
        var offers_has_discount = document.getElementById("offers_has_discount").checked;
        var freshness_min_days_to_expiry = document.getElementById("freshness_min_days_to_expiry").value;
        var categories_dessert = document.getElementById("categories_dessert").checked;
        var categories_vegetables = document.getElementById("categories_vegetables").checked;
        var categories_meal = document.getElementById("categories_meal").checked;
        var has_at_least_one_value = false;
        for (var i=0; i < company_grids.length; i++) {
            var company_grid = company_grids[i];

            //companyinfo = $company_id, $company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $type, $mode_of_collection
            //To retrieve the name, need to split by , and find the 5th element
            company_info_arr = company_grid.getAttribute("name").split(",");
            company_id = company_info_arr[0];
            company_id = company_info_arr[1];
            decay_date = company_info_arr[2];
            decay_time = company_info_arr[3];
            name = company_info_arr[4];
            posted_date = company_info_arr[5];
            posted_time = company_info_arr[6];
            price_after = parseFloat(company_info_arr[7]);
            price_before = parseFloat(company_info_arr[8]);
            quantity = company_info_arr[9];
            type = company_info_arr[10];
            mode_of_collection_user = company_info_arr[11];
            //Gets today date and the date of decay in a date object
            var now = new Date();
            var decay_date = new Date(decay_date); 
            // To calculate the time difference of two dates 
            var difference_in_time = decay_date.getTime() - now.getTime(); 
            
            // To calculate the no. of days between two dates 
            var difference_in_days = difference_in_time / (1000 * 3600 * 24); 
            //Checks whether the company meets all filter criteria. As long as the company does not meet one of the criteria, it wont be displayed
            //Display the company as long as it fufills 1 of the categories. Hence, if both dessert and vegeatables are checked, it will display companys with either dessert or vegetables
            //console.log(price_before);
            if ((!categories_dessert && !categories_vegetables && !categories_meal) || (categories_dessert && type == "dessert") || (categories_vegetables && type == "vegetables") || (categories_meal && type == "japanese_food"))
            {
                if (name.includes(search_for_companys) && (mode_of_collection == "" || mode_of_collection == mode_of_collection_user) && (price_max == "" || price_after <= parseFloat(price_max)) && (price_min == "" || price_after >= parseFloat(price_min)) && (!offers_has_discount|| price_before != price_after) && (freshness_min_days_to_expiry == "" || difference_in_days >= freshness_min_days_to_expiry)) {
                    company_grid.setAttribute("style", "display: block;");
                    has_at_least_one_value = true;
                }    
                else {
                company_grid.setAttribute("style", "display: none;");
                }           
            }
            else {
                company_grid.setAttribute("style", "display: none;");
            }
        }
        //Display warning message if no companys match the filter criteria
        if (!has_at_least_one_value) {
            document.getElementById("no_items_warning").innerHTML = "<span class='text-danger font-weight-bold'>No results match the filter criteria</span>";
        }
        else {
            document.getElementById("no_items_warning").innerHTML = "";

        }
    }
    function sort_companys() {
        var selected_option = document.getElementById("sort_by_bar").value;        
        var main_company_grid = document.getElementById('main_company_grid');
        //var divs = container.getElementsById('single_company_grid');
        var company_grids = Array.from(document.getElementsByClassName("single_company_grid"));
        var search_for_companys = document.getElementById("search_for_companys").value;
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
        
        //console.log(sorted_by_price);
        main_company_grid.innerHTML = "";
        for (var i = 0; i < company_grids_sorted.length; i++) {
            main_company_grid.appendChild(company_grids_sorted[i]);
        }
          
        /*
        for (var i=0; i < company_grids.length; i++) {
            var company_grid = company_grids[i];
            if (sorted_by_price.length == 0){
                sorted_by_price.push()
            }
            for (var j=0; j < sorted_by_price.length; j++) {

            }
        */
            //companyinfo = $company_id, $company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $type, $mode_of_collection
            //To retrieve the name, need to split by , and find the 5th element
            //company_info_arr = company_grid.getAttribute("name").split(",");
            //company_id = company_info_arr[0];
            //company_id = company_info_arr[1];
            //decay_date = company_info_arr[2];
            //decay_time = company_info_arr[3];
            //name = company_info_arr[4];
            //posted_date = company_info_arr[5];
            //posted_time = company_info_arr[6];
            //price_after = parseFloat(company_info_arr[7]);
            //price_before = parseFloat(company_info_arr[8]);
            //quantity = company_info_arr[9];
            //type = company_info_arr[10];
            //mode_of_collection_user = company_info_arr[11];    
    }

</script>
</body>
</html>
