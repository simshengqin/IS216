<head>
    <!--Important for certain characters to display correctly!-->
    <meta charset="UTF-8">
</head>
<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';
  #Get company name and id from the link itself
  $companyDAO = new companyDAO();
  if (isset($_GET["company_name"])) {
      $company_name = $_GET["company_name"];   
      
  }
  else {
    //Just a backup for now
    $company_name = "saizeriya";
    $company_id = "1";
  }
  $company = $companyDAO->retrieve_company_from_company_name($company_name);
  $company_id = $company-> get_company_id();
  $company_address = $company-> get_address();
  $company_description = $company-> get_description();
  $company_following = $company-> get_following();
  $company_joined_date = $company-> get_joined_date();
  //$company_name = $company-> get_name()
  //$company_password= $company-> get_password()
  $company_rating = $company-> get_rating();


?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta http-equiv="x-ua-compatible" content="ie=edge"> 
<title>View Company</title>
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
<!--Company main info such as logo, numbero f products, followers etc-->
<?php
    //Process the database into info to be displayed
    $productDAO = new productDAO();
    $company_products = $productDAO->retrieve_product_by_company($company_id);
    $company_products_count = count($company_products);
    //TO BE UPDATED
    $company_followers_count = "533";
    //Calculate the number of days since the company joined                     
    //set timezone to singapore so the time will be correct
    date_default_timezone_set('Asia/Singapore');
    //$start is today date
    $start = strtotime($company_joined_date);
    $end = strtotime(date('Y-m-d'));
    $company_joined_days_ago = ceil(abs($end - $start) / 86400);
    $company_following_arr = explode(",", $company_following);
    $company_following_count = count($company_following_arr);


?>
<div class="jumbotron bg-light" name="companyinfo">
    <div class="row text-dark text-capitalize mb-3">
        <div class="col-md-4">
            
        </div>
        <div class="col-md-2">
            <img class="mr-2 mb-2" width="120px" src="images/profile_picture/company/<?php echo $company_id ?>.png"></img>
            <span class="font-weight-bold "><?php echo $company_name ?></span>
            <button type="button" id="follow_button" class="btn btn-outline-success ml-2 mt-3 mb-3" onclick='process_follow()'><i class="fas fa-user-plus mr-2"></i>Follow</button>
            <!--To be UPDATED the user_id is hardcoded -->
            <button type="button" onclick="location.href='inbox.php?user_id=1&user_type=user&target_id=<?php echo $company_id?>&target_type=company&target_name=<?php echo $company_name?>'" class="btn btn-outline-info ml-2"><i class="fas fa-comment mr-2"></i>Chat</button>
            
        </div>
        <div class="col-sm-6 col-md-2">
            <div class="mb-3"><i class="fas fa-utensils mr-2"></i>Products: <?php echo $company_products_count ?></div>
            <div class="mb-3"><i class="fas fa-users mr-2"></i>Followers: <div id='followers_count'><?php echo $company_followers_count ?></div></div>
            <div class="mb-3"><i class="fas fa-calendar-alt mr-2"></i>Joined: <?php echo $company_joined_days_ago ." Days Ago" ?></div>
        </div>
        <div class="col-sm-6 col-md-2">
            <div class="mb-3"><i class="fas fa-star mr-2"></i>Rating: <?php echo $company_rating ?></div>
            <div class="mb-3"><i class="fas fa-user-friends mr-2"></i>Following: <?php echo $company_following_count ?></div>
            <div><?php echo "" ?></div>
        </div>
        <div class="col-sm-6 col-md-2">
        </div>
    </div>
    <!--<div class="d-flex align-items-center h-20"></div>-->
</div>
</head>
<body>
<div class="d-none" name="toastdiv" id="toastdiv">
    <!--Toast, which is a message pop-up whenever an item is added to the cart-->
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
            <span id="cart_message_body"></span> was successfully added to your cart. <a href="shoppingcart.php" target="_blank" >Click here</a> to view.
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
        <div class="toast-body ml-3 mt-500">
            Heads up, toasts will stack automatically
        </div>
        </div>
    </div>
    </div>
</div>
<div class='container-fluid'>
    <div class='row ml-2'>

        <div class='font-weight-bold'>ABOUT SHOP</div>
        <br>
        <span class='mb-2 '>
            <?php
                echo $company_description;
            ?>
        </span>
    </div>
    <div class='row'>
        <div name="filterform" class="col-md-4">
            <div class="form-row ">
                <div class="form-group col-12">
                    <div class="input-group">
                        <span class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">
                            Sort by</label>
                        </span>
                        <select class="form-control custom-select " id="sort_by" onchange = "sort_products();"                                                                                                                >
                            <option selected value="1">Newest</option>
                            <option value="2">Price: Low to high</option>
                            <option value="3">Price: High to low</option>
                        </select>
                    </div>  
                </div>
            </div>  
            <hr> 
            <div class="form-row mb-2">
                Mode of collection 
            </div>
            <div class="form-row">
                <div class="form-group">
                    <input type="radio" id="mode_of_collection_delivery" name="mode_of_collection" value="delivery" onchange ='search_filter()'> Delivery
                    <input type="radio" id="mode_of_collection_pickup" name="mode_of_collection" value="pickup" onchange ='search_filter()'> Pickup
                </div>               
            </div>
            <hr>
            <div class="form-row mb-2">
                Price 
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    
                    <input type="text" id="price_min" class="mb-2" oninput ='search_filter()' placeholder='Min $'></input>
                    <input type="text" id="price_max" oninput ='search_filter()' placeholder='Max $'></input>
                </div>
            </div>
            <hr>
            <div class="form-row mb-2">
                Offers 
            </div>
            <div class="form-row">
                <div class="form-group">
                    <input type="checkbox" id="offers_free_delivery" onchange ='search_filter()'> Free delivery
                    <input type="checkbox" id="offers_has_discount" onchange ='search_filter()'> Has discount 
                </div>               
            </div>
            <hr>
            <div class="form-row mb-2">
                Freshness 
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <input type="number" id="freshness_min_days_to_expiry" min="1" step="1" oninput ='search_filter()' placeholder='Min days to expiry'></input>   
                </div>
            </div>
            <hr>
            
            <div class="form-row mb-2">
                Categories
            </div>
            <div class="form-row">
                <div class="form-group col-12">
                    <input type="checkbox" id="categories_dessert" onchange ='search_filter()'> Dessert
                    <input type="checkbox" id="categories_vegetables" onchange ='search_filter()'> Vegetables
                    <input type="checkbox" id="categories_meal" onchange ='search_filter()'> Meal

                </div>
            </div>

        </div>
        <!--Product grid displaying all food products-->
        <div class="grid_beside_filterform col-md-8">    
            <!--Search bar-->
            <div class="row" name="search_for_products">    
                <div class="form-group col-12">
                    <input type="text" class="form-control" name="x" id="search_for_products" oninput ='search_filter()' placeholder="Search for <?php echo $company_name?>'s products">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <div class="row" name="main_product_grid">
                <span id="no_items_warning"></span>
                <?php
                    foreach ($company_products as $product) {
                        //echo $product->get_name();
                        $product_id = $product->get_product_id();
                        $company_id = $product->get_company_id();
                        $decay_date = $product->get_decay_date();
                        $decay_time = $product->get_decay_time();
                        $name = $product->get_name();
                        $posted_date = $product->get_posted_date();
                        $posted_time = $product->get_posted_time();
                        $price_after = $product->get_price_after();
                        $price_before = $product->get_price_before();
                        $quantity = $product->get_quantity();
                        $type = $product->get_type();
                        $mode_of_collection = $product->get_mode_of_collection();
                        $discount = round((($price_before-$price_after)/$price_before)*100,0);
                        //if there is no discount, do not show the -% label and the crossed out price
                        if ($discount == 0.0) {
                            $price_before_modified = "";                 
                        }     
                        else {
                            $price_before_modified = "$" . $price_before;
                        }           
                        //set timezone to singapore so the time will be correct
                        date_default_timezone_set('Asia/Singapore');
                        //$datetime = date('m/d/Y h:i:s a', time());
                        
                        echo "
                        <div class='col-xl-3 col-lg-4 col-sm-6 single_product_grid' name='$product_id,$company_id,$decay_date,$decay_time,$name,$posted_date,$posted_time,$price_after,$price_before,$quantity,$type,$mode_of_collection'>
                        <div class='product-grid'>
                            
                            <div class='product-image'>
                                <img class='pic-1'  src='images/$type/$name.jpg'>";
                                //only add a new label if the product is posted today 
                                //Need to follow sql format, which is Y-m-d
                                if (date('Y-m-d', time())== $posted_date) {
                                    echo "<span class='product-new-label'>New</span>";
                                }
                                
                                if ($discount != 0.0) {
                                    echo "<span class='product-discount-label'>-$discount%</span>";
                                }
                                
                                echo "
                            </div>
                            <div class='product-content'>
                                <ul class='rating'>
                                    <li class='fa fa-star'></li>
                                    <li class='fa fa-star'></li>
                                    <li class='fa fa-star'></li>
                                    <li class='fa fa-star'></li>
                                    <li class='fa fa-star'></li>
                                </ul>
                                <h3 class='title'>" . str_replace('_',' ',$name) . "</h3>
                                <div class='price'>
                                    $$price_after
                                    <span>$price_before_modified</span>
                                </div>
                                <button class='add-to-cart' href='#' id='" . $product_id . "," . str_replace('_',' ',$name) . "' onclick='add_to_cart()'>ADD TO CART</button>
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
    //***Follow button****//
    function process_follow() {
        var follow_button = document.getElementById("follow_button");
        var followers_count = document.getElementById("followers_count");
        //alert(parseInt(followers_count.innerText));
        if (follow_button.innerText == "Follow") {
            follow_button.innerHTML = '<i class="fas fa-user-check mr-2"></i>Following';
            followers_count.innerText = parseInt(followers_count.innerText) + 1;
        }
        else {
            follow_button.innerHTML = '<i class="fas fa-user-plus mr-2"></i>Follow';
            followers_count.innerText = parseInt(followers_count.innerText) - 1;
        }
    }
    //****Search bar****//
    function search_filter(){
        //Change the display to none for products that do not meet the filter criteria, else change the display to block
        var product_grids = document.getElementsByClassName("single_product_grid");
        var search_for_products = document.getElementById("search_for_products").value;
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
        for (var i=0; i < product_grids.length; i++) {
            var product_grid = product_grids[i];

            //productinfo = $product_id, $company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $type, $mode_of_collection
            //To retrieve the name, need to split by , and find the 5th element
            product_info_arr = product_grid.getAttribute("name").split(",");
            product_id = product_info_arr[0];
            company_id = product_info_arr[1];
            decay_date = product_info_arr[2];
            decay_time = product_info_arr[3];
            name = product_info_arr[4];
            posted_date = product_info_arr[5];
            posted_time = product_info_arr[6];
            price_after = parseFloat(product_info_arr[7]);
            price_before = parseFloat(product_info_arr[8]);
            quantity = product_info_arr[9];
            type = product_info_arr[10];
            mode_of_collection_user = product_info_arr[11];
            //Gets today date and the date of decay in a date object
            var now = new Date();
            var decay_date = new Date(decay_date); 
            // To calculate the time difference of two dates 
            var difference_in_time = decay_date.getTime() - now.getTime(); 
            
            // To calculate the no. of days between two dates 
            var difference_in_days = difference_in_time / (1000 * 3600 * 24); 
            //Checks whether the product meets all filter criteria. As long as the product does not meet one of the criteria, it wont be displayed
            //Display the product as long as it fufills 1 of the categories. Hence, if both dessert and vegeatables are checked, it will display products with either dessert or vegetables
            //console.log(price_before);
            if ((!categories_dessert && !categories_vegetables && !categories_meal) || (categories_dessert && type == "dessert") || (categories_vegetables && type == "vegetables") || (categories_meal && type == "japanese_food"))
            {
                if (name.includes(search_for_products) && (mode_of_collection == "" || mode_of_collection == mode_of_collection_user) && (price_max == "" || price_after <= parseFloat(price_max)) && (price_min == "" || price_after >= parseFloat(price_min)) && (!offers_has_discount|| price_before != price_after) && (freshness_min_days_to_expiry == "" || difference_in_days >= freshness_min_days_to_expiry)) {
                    product_grid.setAttribute("style", "display: block;");
                    has_at_least_one_value = true;
                }    
                else {
                product_grid.setAttribute("style", "display: none;");
                }           
            }
            else {
                product_grid.setAttribute("style", "display: none;");
            }
        }
        //Display warning message if no products match the filter criteria
        if (!has_at_least_one_value) {
            document.getElementById("no_items_warning").innerHTML = "<span class='text-danger font-weight-bold'>No results match the filter criteria</span>";
        }
        else {
            document.getElementById("no_items_warning").innerHTML = "";

        }
    }
    function sort_products() {
        
    }
    //****Add to cart message popup****//
    $(document).ready(function(){
    $(".add-to-cart").click(function(){
            //$("#add_to_cart_message").toast({ delay: 7000 });
            //$("#add_to_cart_message").toast('show');
        }); 
    });
    function add_to_cart() {
        document.getElementById("toastdiv").setAttribute("class", "d-block");
        $("#add_to_cart_message").toast({ delay: 7000 });
        $("#add_to_cart_message").toast('show');
        
        arr = event.target.id.split(",");
        product_id = arr[0];
        name = arr[1];
        //Update the toast to reflect what item was added
        document.getElementById("cart_message_body").innerText = name.charAt(0).toUpperCase() + name.slice(1);
        //Send an AJAX request to update_user.php to update the cart of user in database
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                //Add check for success here?
                console.log(this.responseText);  
            }  
        };  
        //Hardcorded user id here. Rmb to change
        user_id = 1;
        quantity = 1;
        request.open('POST', 'update_user.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        request.send("user_id="+user_id+"&product_id="+product_id+"&quantity="+quantity);
        //$("#add_to_cart_message").toast('show');
        //alert('Successfully added ' + name + ' to cart!');
    }
</script>
</body>
</html>
