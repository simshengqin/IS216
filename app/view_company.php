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
  $company_latitude = $company-> get_latitude();
  $company_longtitude = $company-> get_longtitude();
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
<!-- Poppins font -->
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
  <!-- Roboto Font -->
  <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap"> -->
  <!-- Font Awesome -->
  <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css"> -->
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
    //Retrieve all the unique categories, then we will retrieve all thep roducts category by category
    $unique_categories = $productDAO->retrieve_unique_categories_by_company_id($company_id);
    //echo '<pre>'; print_r($unique_categories); echo '</pre>'; 
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

<?php include 'include/customer_navbar.php';?>
<div class="jumbotron  mt-3" style="background-color: #FFFFFF" name="companyinfo">
    <div class="row text-capitalize mb-3" style='margin: 25px 30px 10px 0px;'>

        <div class="col-md-6">
            <div class="row ml-3">
            <h1 class="font-weight-bold;"><?php echo $company_name ?>  
            </div> 
            <div class="row mb-3 ml-3">         
                <button type="button" onclick="location.href='inbox.php?user_id=<?php echo $_SESSION['user_id']?>&user_type=user&target_id=<?php echo $company_id?>&target_type=company&target_name=<?php echo $company_name?>'" class="btn btn-outline-info mr-2"><i class="fas fa-comment mr-2"></i>Chat</button>
                <button type="button" onclick="show_map_modal()" class="btn btn-outline-info"><i class="fa fa-map-marker"></i>View Map</button>
            </div>
            </h1>         
            <div class="row mb-3 ml-3">
                <li class='fa fa-star'></li>
                <span class='font-weight-bold'><?php echo $company_rating ?></span>
                <span>/5</span><span style="margin-left: 10px;" id="distance" name='<?php echo "$company_latitude,$company_longtitude"?>'></span>
            </div> 
            <div class="row mb-3 ml-3">  
                <div class="company-description"> <?php echo $company_description?></div>
                <div class="company-description"> <?php echo $company_address?></div>
            </div>

        </div>        
     
        <div class="col-md-6">
            <img class="mr-2 mb-2" width="100%" src="images/company_profile_image/<?php echo $company_id ?>.jpeg"></img>


            
        </div>
        <div class="col-sm-6 col-md-2">
        </div>
    </div>
    <!--<div class="d-flex align-items-center h-20"></div>-->
</div>


</head>
<body>
<div class='container-fluid'>
    <div class='row'>
        <div name="toastdiv" class="d-none">
            <!--Toast, which is a message pop-up whenever an item is added to the cart-->
            <div style="position: relative; min-height: 200px;">
            <!-- Position it -->
            <div style="position: fixed; top: 0; right: 0;  z-index: 10000;" >

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
                    <span id="cart_message_body">was successfully added to your cart. </span><a href="shoppingcart.php" id="added_to_cart_msg" target="_blank" >Click here</a> to view.
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
        <!--Modal to warn users of change in cart-->
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
        <!--Modal to inform not enough product qty in database-->
        <div class="modal fade" id="insufficient_product_qty_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                    Sorry! This product is out of stock as someone just bought the last unit of this product.
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
                    <h5 class="modal-title" id="exampleModalLabel">Delivery Address</h5>
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
        <!--Modal to filter products-->
        <div class="modal fade" id="filter_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Advanced options</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="form-row m-2">
                                <div class="form-group col-12">
                                    <div class="input-group">
                                        <span class="input-group-prepend">
                                            <label class="input-group-text" for="inputGroupSelect01">
                                            Sort by</label>
                                        </span>
                                        <select class="form-control custom-select w-100" id="sort_by_bar";"                                                                                                                >
                                            <option selected value="Posted Date: Newest to oldest">Posted Date: Newest to oldest</option>
                                            <option selected value="Posted Date: Oldest to newest">Posted Date: Oldest to newest</option>
                                            <option selected value="Expiry Date: Shorter away to further away">Expiry Date: Shorter away to further away</option>
                                            <option selected value="Expiry Date: Further away to shorter away">Expiry Date: Further away to shorter away</option>
                                            <option value="Price: Low to high">Price: Low to high</option>
                                            <option value="Price: High to low">Price: High to low</option>
                                        </select>
                                    </div>  
                                </div>
                            </div>  
                            <hr> 
                            <div class="form-row ml-3">
                                Price 
                            </div>
                            <div class="form-row m-2">
                                <div class="form-group col-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <input type="text" id="price_min" class="mr-1 w-100" placeholder='Min $'></input>
                                        </div>
                                        <div class="col-6">
                                            <input type="text" id="price_max" class="w-100" placeholder='Max $'></input>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row m-2">
                                Offers 
                            </div>
                            <div class="form-row m-2">
                                <div class="form-group">
                                    <input type="checkbox" id="offers_has_discount"> Has discount 
                                </div>               
                            </div>
                            <hr>
                            <div class="form-row m-2">
                                Freshness 
                            </div>
                            <div class="form-row ml-2 mr-2">
                                <div class="form-group col-12">
                                    <input type="number" id="freshness_min_days_to_expiry" min="1" step="1" placeholder='Min days to expiry'></input>   
                                </div>
                            </div>
                            <!--
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
                            -->
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="filter_modal_confirm" onclick="search_filter()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal to show map-->
        <div class="modal fade" id="map_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Map</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div id="map"></div>

                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="close_input_postal_code" data-dismiss="modal" >Okay</button>
                    </div>
                </div>
            </div>
        </div>        
        <!--A placeholder to store the user's cart-->

        <input type="hidden" id="same_company_id_from_user_cart" value="<?php 
                                                                $userDAO = new userDAO();
                                                                //HARDCODED user_id here, need to change
                                                                $user_id = $_SESSION["user_id"];
                                                                $user = $userDAO-> retrieve_user($user_id);
                                                                $cart = $user -> get_cart();
                                                                if (strlen($cart) ==0) {
                                                                    //echo the company_id for the below js function to access it
                                                                    echo "$company_id";
                                                                    //echo 'true';
                                                                }
                                                                else {
                                                                    $cart = $user -> get_cart();
                                                                    if (strlen($cart) ==0) {
                                                                        $cart_arr = [];
                                                                      }
                                                                      else {
                                                                        $cart_arr = explode(",",$cart);
                                                                    }  
                                                                    $cart_company_id = $user->get_cart_company_id();
                                                                    if ($cart_company_id == $company_id) {
                                                                        echo 'true';
                                                                    }
                                                                    else {
                                                                        //echo the company_id for the below js function to access it
                                                                        echo "$company_id";
                                                                    }
                                                                         
                                                                }  
                                                            ?>"></input>
        <input type="hidden" id="cart_company_name" value="<?php 
                                                                $companyDAO = new companyDAO();
                                                                
                                                                //HARDCODED user_id here, need to change
                                                                $user_id = $_SESSION["user_id"];
                                                                $user = $userDAO-> retrieve_user($user_id);
                                                                $cart = $user -> get_cart();
                                                                $cart_company_id = $user->get_cart_company_id();
                                                                //echo "Cart companyid: " . $cart_company_id;
                                                                if ($cart_company_id != "0") {
                                                                    echo $companyDAO -> retrieve_company_name($cart_company_id);    
                                                                }
                                                                else {
                                                                    //Cart is empty
                                                                    echo "";
                                                                }
                                                            ?>"></input>
        <!--Product grid displaying all food products-->
        <div class="col-2"></div>
        <div class="grid_beside_filterform col-8">    
            <!--Search bar-->
            <!--
            <div class="row" name="search_for_products">    
                <div class="form-group col-12">
                    <input type="text" class="form-control" name="x" id="search_for_products" oninput ='search_filter()' placeholder="Search for products">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div> -->
            
            <div class="row">               
                <?php
                    $productDAO = new productDAO();
                    #$all_product_info = $productDAO->retrieve_all();                 
                    $userDAO = new userDAO();
                    //HARDCODED user_id here, need to change
                    $user_id = $_SESSION["user_id"];
                    $user = $userDAO-> retrieve_user($user_id);
                    $cart = $user -> get_cart();
                    if (strlen($cart) ==0) {
                        $cart_arr = [];
                      }
                      else {
                        $cart_arr = explode(",",$cart);
                    }        
                    $i = 0;
                    #Here, we want to retrieve the items in the user's cart, so we can show it as added to cart accordingly
                    $cart_product_ids = [];
                    foreach ($cart_arr as $productqty) {
                        #Split it to an arr, where the 1st element is product_id and 2nd element is quantity
                        $productqty_arr = explode(":",$productqty);
                        $product_id = $productqty_arr[0];
                        #$quantity_in_cart contains how much the user currently ordered that product in their cart
                        $quantity_in_cart = $productqty_arr[1];
                        #Identify the product id that we are trying to update and update its quantity
                        #If qty is 0, remove the product from cart
                        if ($quantity_in_cart != 0) {
                            array_push($cart_product_ids, $product_id);
                            
                        }
                        
                        $i += 1;
                    }
                    echo "<div class='col-12'>";
                    //Search bar
                    echo '<div class="row" name="search_for_products">    
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <input type="text" class="form-control" name="x" id="search_for_products" oninput ="search_filter()" placeholder="Find products">
                                    </div>
                                    <button class="btn btn-outline-info mb-2" id="filter_btn" onclick="show_filter_modal()">Filter</button>
                                </div>
                            </div>                 
                            </div>
                        </div>';
                    //warning message
                    echo '<h5 id="no_items_warning"></h5>';
                    // Print category (of the food product) by category
                    echo '<div class="row" id="main_product_grid">';
                    foreach ($unique_categories as $category) {
                        echo "  <div class='col-12' style='margin-left: 5px; margin-bottom: 20px;'>
                                    <h1 class='font-weight-bold'>$category</h1>
                                </div>";
                        $company_products_by_category = $productDAO->retrieve_products_by_category($category);
                        //echo '<pre>'; print_r($company_products_by_category); echo '</pre>';
                        echo "<div class='col-12' style='margin-left: 5px; margin-bottom: 20px;'>";
                        echo "  <div class='row'>";
                        foreach ($company_products_by_category as $product) {
                            //echo $product->get_name();
                            $product_id = $product->get_product_id();
                            $company_id = $product->get_company_id();
                            $decay_date = $product->get_decay_date();
                            $decay_time = $product->get_decay_time();
                            $name = $product->get_name();
                            //To escape single quotes
                            $name = str_replace("'", "&#39;", $name);
                            $posted_date = $product->get_posted_date();
                            $posted_time = $product->get_posted_time();
                            $price_after = $product->get_price_after();
                            $price_before = $product->get_price_before();
                            $quantity = $product->get_quantity();
                            $category = $product->get_category();
                            $mode_of_collection = $product->get_mode_of_collection();
                            $image_url = $product->get_image_url();
                            if ($image_url == "") {
                                $image_url ="images/$category/$name.jpg";
                            }
                            $discount = round((($price_before-$price_after)/$price_before)*100,0);

                            //checks whether this product is in the user cart. If so, it should display added to cart                        
                            $product = $productDAO -> retrieve_product($product_id);
                            $product_quantity_in_database = $product -> get_quantity();
                            if (in_array($product_id, $cart_product_ids, true)) {
                                $add_to_cart_btn_text = "ADDED TO CART";
                                $add_to_cart_btn_class = "add-to-cart add-to-cart-hover";
                            }
                            //checks whether the product still has stocks left
                            //this is after added to cart, as the user might be the person to hold on to the stocks so no more stocks left

                            elseif ($product_quantity_in_database == 0) {
                                $add_to_cart_btn_text = "OUT OF STOCK";
                                #do not have the hover class, so no hover animation
                                $add_to_cart_btn_class = "add-to-cart";
                            }
                            else {
                                $add_to_cart_btn_text = "ADD TO CART";
                                $add_to_cart_btn_class = "add-to-cart add-to-cart-hover";
                            }
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
                            if ($product_quantity_in_database != 0) {
                                echo "
                                <div class='col-xxl-3 col-xl-4 col-lg-4 col-sm-6 single_product_grid' id ='single_product_grid' name='$product_id,$company_id,$decay_date,$decay_time,$name,$posted_date,$posted_time,$price_after,$price_before,$quantity,$category,$mode_of_collection'>
                                    <div class='product-grid'>
                                        
                                        <div class='product-image d-flex w-100'>
                                            <img class='pic-1 my-auto'  style='margin-top: 0px !important' src='$image_url'>";
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
                                            <!--
                                            <ul class='rating'>
                                                <li class='fa fa-star'></li>
                                                <li class='fa fa-star'></li>
                                                <li class='fa fa-star'></li>
                                                <li class='fa fa-star'></li>
                                                <li class='fa fa-star'></li>
                                            </ul>
                                            -->
                                            <h3 class='title'>" . str_replace('_',' ',$name) . "</h3>
                                            <div class='price'>
                                                $$price_after
                                                <span>$price_before_modified</span>
                                            </div>
                                            <button class='" . $add_to_cart_btn_class . "' href='#' id='" . $product_id . "," . str_replace('_',' ',$name) . "' onclick='add_to_cart(this)'>" . $add_to_cart_btn_text . "</button>
                                        </div>
                                    </div>
                                </div>
                                    ";                            
                            }

                        }
                        echo "  </div>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo '</div>';
                ?>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
</div>
<?php include 'include/footer.php';?>

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
    //****Show filter modal  *****//
    function show_filter_modal() {
        $('#filter_modal').modal('show');
    }
    //****Search bar****//
    function search_filter(){
        sort_products();
        //Hides the modal
        $('#filter_modal').modal('hide');
        //Change the display to none for products that do not meet the filter criteria, else change the display to block
        var product_grids = document.getElementsByClassName("single_product_grid");
        var search_for_products = document.getElementById("search_for_products").value.toLowerCase();
        var price_min = document.getElementById("price_min").value;
        var price_max = document.getElementById("price_max").value;
        var offers_has_discount = document.getElementById("offers_has_discount").checked;
        var freshness_min_days_to_expiry = document.getElementById("freshness_min_days_to_expiry").value;
        //var categories_dessert = document.getElementById("categories_dessert").checked;
        //var categories_vegetables = document.getElementById("categories_vegetables").checked;
        //var categories_meal = document.getElementById("categories_meal").checked;
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
            name = product_info_arr[4].toLowerCase();
            posted_date = product_info_arr[5];
            posted_time = product_info_arr[6];
            price_after = parseFloat(product_info_arr[7]);
            price_before = parseFloat(product_info_arr[8]);
            quantity = product_info_arr[9];
            category = product_info_arr[10];
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
            //if ((!categories_dessert && !categories_vegetables && !categories_meal) || (categories_dessert && category == "dessert") || (categories_vegetables && category == "vegetables") || (categories_meal && category == //"japanese_food"))
            //{
            if (name.includes(search_for_products) && (price_max == "" || price_after <= parseFloat(price_max)) && (price_min == "" || price_after >= parseFloat(price_min)) && (!offers_has_discount|| price_before != price_after) && (freshness_min_days_to_expiry == "" || difference_in_days >= freshness_min_days_to_expiry)) {
                product_grid.setAttribute("style", "display: block;");
                has_at_least_one_value = true;
            }    
            else {
            product_grid.setAttribute("style", "display: none;");
            }           
            //}
            //else {
            //    product_grid.setAttribute("style", "display: none;");
            //}
        }
        //Display warning message if no products match the filter criteria
        if (!has_at_least_one_value) {
            document.getElementById("no_items_warning").innerHTML = "<h5 class='alert alert-danger'>No results match the filter criteria</h5>";
        }
        else {
            document.getElementById("no_items_warning").innerHTML = "";

        }
    }
    function sort_products() {
        var selected_option = document.getElementById("sort_by_bar").value;        
        var main_product_grid = document.getElementById('main_product_grid');
        //var divs = container.getElementsById('single_product_grid');
        var product_grids = Array.from(document.getElementsByClassName("single_product_grid"));
        var search_for_products = document.getElementById("search_for_products").value;
        var price_min = document.getElementById("price_min").value;
        var price_max = document.getElementById("price_max").value;
        var offers_has_discount = document.getElementById("offers_has_discount").checked;
        var freshness_min_days_to_expiry = document.getElementById("freshness_min_days_to_expiry").value;
        //var categories_dessert = document.getElementById("categories_dessert").checked;
        //var categories_vegetables = document.getElementById("categories_vegetables").checked;
        //var categories_meal = document.getElementById("categories_meal").checked;
        var has_at_least_one_value = false;
        if (selected_option == "Price: Low to high") {
            var product_grids_sorted = product_grids.sort(function(a, b){return parseFloat(a.getAttribute("name").split(",")[7])-parseFloat(b.getAttribute("name").split(",")[7])});
        }

        else if (selected_option == "Price: High to low") {
            var product_grids_sorted = product_grids.sort(function(b, a){return parseFloat(a.getAttribute("name").split(",")[7])-parseFloat(b.getAttribute("name").split(",")[7])});
        }
        //Create a date object based on date and time field and compare which one is larger
        else if (selected_option == "Posted Date: Newest to oldest") {
            var product_grids_sorted = product_grids.sort(function(b, a){return Date.parse(a.getAttribute("name").split(",")[5] + " " + a.getAttribute("name").split(",")[6])-Date.parse(b.getAttribute("name").split(",")[5] + " " + b.getAttribute("name").split(",")[6])});
        }   
        else if (selected_option == "Posted Date: Oldest to newest") {
            var product_grids_sorted = product_grids.sort(function(a, b){return Date.parse(a.getAttribute("name").split(",")[5] + " " + a.getAttribute("name").split(",")[6])-Date.parse(b.getAttribute("name").split(",")[5] + " " + b.getAttribute("name").split(",")[6])});
        }  
        else if (selected_option == "Expiry Date: Further away to shorter away") {
            var product_grids_sorted = product_grids.sort(function(b, a){return Date.parse(a.getAttribute("name").split(",")[2] + " " + a.getAttribute("name").split(",")[3])-Date.parse(b.getAttribute("name").split(",")[2] + " " + b.getAttribute("name").split(",")[3])});
        }  
        else if (selected_option == "Expiry Date: Shorter away to further away") {
            var product_grids_sorted = product_grids.sort(function(a, b){return Date.parse(a.getAttribute("name").split(",")[2] + " " + a.getAttribute("name").split(",")[3])-Date.parse(b.getAttribute("name").split(",")[2] + " " + b.getAttribute("name").split(",")[3])});
        }  
        
        //console.log(sorted_by_price);
        main_product_grid.innerHTML = "";
        for (var i = 0; i < product_grids_sorted.length; i++) {
            main_product_grid.appendChild(product_grids_sorted[i]);
        }
          
        /*
        for (var i=0; i < product_grids.length; i++) {
            var product_grid = product_grids[i];
            if (sorted_by_price.length == 0){
                sorted_by_price.push()
            }
            for (var j=0; j < sorted_by_price.length; j++) {

            }
        */
            //productinfo = $product_id, $company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $category, $mode_of_collection
            //To retrieve the name, need to split by , and find the 5th element
            //product_info_arr = product_grid.getAttribute("name").split(",");
            //product_id = product_info_arr[0];
            //company_id = product_info_arr[1];
            //decay_date = product_info_arr[2];
            //decay_time = product_info_arr[3];
            //name = product_info_arr[4];
            //posted_date = product_info_arr[5];
            //posted_time = product_info_arr[6];
            //price_after = parseFloat(product_info_arr[7]);
            //price_before = parseFloat(product_info_arr[8]);
            //quantity = product_info_arr[9];
            //category = product_info_arr[10];
            //mode_of_collection_user = product_info_arr[11];    
    }
    //****Add to cart message popup****//
    $(document).ready(function(){
    $(".add-to-cart").click(function(){
            //$("#add_to_cart_message").toast({ delay: 7000 });
            //$("#add_to_cart_message").toast('show');
        }); 
    });
    function change_cart_company_id() {
        window.target_element.innerText= "ADDED TO CART";
        var quantity = 0;
        var quantity_change = 1; 
        //Send an AJAX request to update_user.php to update the cart of user in database
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);  
                //Handles the scenario where the user loaded the page, and another user bought the last item, so the user can no longer buy this item
                if (this.responseText == "Insufficient product qty in database") { 
                    $('#insufficient_product_qty_msg').modal('show');
                    target.innerText = "OUT OF STOCK";
                    target.setAttribute("class", "add-to-cart");                   
                }        
                else {
                    //Now the user cart should be the same company id as this current page
                    document.getElementById("same_company_id_from_user_cart").value = "true";
                    //Update the toast to reflect what item was added
                    arr = window.target_element.id.split(",");
                    product_id = arr[0];
                    name = arr[1];
                    document.getElementById("cart_message_body").innerText = name.charAt(0).toUpperCase() + name.slice(1) + " was successfully added to your cart. ";   
                    $("#add_to_cart_message").toast({ delay: 7000 });
                    $("#add_to_cart_message").toast('show');
                }
            }  
        };  
        //Hardcorded user id here. Rmb to change
        user_id = 1;
        request.open('POST', 'update_user.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        //alert(document.getElementById("same_company_id_from_user_cart").value);
        request.send("user_id="+user_id+"&product_id="+product_id+"&quantity="+quantity+"&quantity_change="+quantity_change+"&change_cart_company_id="+document.getElementById("same_company_id_from_user_cart").value );
        //$("#add_to_cart_message").toast('show');
        //alert('Successfully added ' + name + ' to cart!');
    }
    function add_to_cart(target) {        
        arr = event.target.id.split(",");
        product_id = arr[0];
        name = arr[1];
        //Button should not work at all if product is out of stock
        if (target.innerText == "OUT OF STOCK") {
            return;
        }
        //If the user has previously added to cart, clicking the btn again should remove it from cart!
        else if (target.innerText == "ADD TO CART") {           
            //Warn the user if he wants to change the company id in his current cart
            //alert(document.getElementById("same_company_id_from_user_cart").value);
            if (document.getElementById("same_company_id_from_user_cart").value == "true") {
                //Here can put 0 as update_user.php will increase it to 1
                var quantity = 0;
                var quantity_change = 1;        
                target.innerText= "ADDED TO CART";
                //Update the toast to reflect what item was added
                document.getElementById("cart_message_body").innerText = name.charAt(0).toUpperCase() + name.slice(1) + " was successfully added to your cart. ";             
            }
            else {
                window.target_element = target;
                //document.getElementById("change_company_id_in_cart_msg_yes_btn").setAttribute("name",target);
                //Update the modal to show what company the user cart currently contains
                var cart_company_name = document.getElementById("cart_company_name").value;
                //Converts to uppercase
                cart_company_name = cart_company_name.replace(/(^\w{1})|(\s{1}\w{1})/g, match => match.toUpperCase());
                document.getElementById("change_company_id_in_cart_msg_body").innerText = "Are you sure that you want to start a new cart? Your current cart from " + cart_company_name + " will be deleted.";
                $('#change_company_id_in_cart_msg').modal('show');
                return;
            }
        }
        else {
            target.innerText= "ADD TO CART";
            var quantity = 0;
            //Need to let the server know that it needs to retrieve the correct qty from the user cart and remove that qty for that product id in the database
            //this way also helps to prevent cheating the system! if the user remove from his cart on shoppingcart page, it wont change the product qty in database twice
            var quantity_change = "to_be_updated";    
            //Update the toast to reflect what item was removed
            document.getElementById("cart_message_body").innerText = name.charAt(0).toUpperCase() + name.slice(1) + " was successfully removed from your cart. ";        
        }

        

        //Send an AJAX request to update_user.php to update the cart of user in database
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);  
                //Handles the scenario where the user loaded the page, and another user bought the last item, so the user can no longer buy this item
                if (this.responseText == "Insufficient product qty in database") { 
                    $('#insufficient_product_qty_msg').modal('show');
                    target.innerText = "OUT OF STOCK";
                    target.setAttribute("class", "add-to-cart");                   
                }        
                else {
                    $("#add_to_cart_message").toast({ delay: 7000 });
                    $("#add_to_cart_message").toast('show');
                }
            }  
        };  
        //Hardcorded user id here. Rmb to change
        user_id = 1;
        request.open('POST', 'update_user.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        
        request.send("user_id="+user_id+"&product_id="+product_id+"&quantity="+quantity+"&quantity_change="+quantity_change);
        //$("#add_to_cart_message").toast('show');
        //alert('Successfully added ' + name + ' to cart!');
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
    function show_map_modal() { 
        //Only show the map modal if postal code is entered
        if(sessionStorage.getItem('postal_code') == undefined) {            
            //Ask the modal to show the map modal once the user enters in a postal code
            document.getElementById("close_input_postal_code").setAttribute("onclick", "show_map_modal()");
            $('#input_postal_code').modal('show');

             
        }
        else {
            $('#map_modal').modal('show');
            //Need to only init map after showing modal for it to zoom in properly
            initMap();             
        }

                        

    }
    function show_postal_code_modal() { 
        $('#input_postal_code').modal('show');
    }
    //run this function when this page loads

    window.onload = calculates_distance("");
    function calculates_distance() {
            //This functions calculate distance from provided postal code to this company location
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
            end_latlng_arr = document.getElementById("distance").getAttribute("name").split(",");
      
            end_latitude = end_latlng_arr[0]/10000000;
            end_longtitude = end_latlng_arr[1]/10000000;
            //console.log("End:", end_latitude, end_longtitude);                        
            try {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        // following code may throw error if user input is invalid address
                        // so we use try-catch block to handle errors
                        
                            // expected response is JSON data
                            var data = JSON.parse(this.responseText);
                            var loc = data["results"][0]["geometry"]["location"];
                            start_latitude = loc["lat"];
                            start_longtitude = loc["lng"];
                            //console.log("Start:",start_latitude, start_longtitude);
                            //After getting current latitude and longtitude, calculates distance from this point to this company's longtitude and latitude
                            var distance = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng(start_latitude,start_longtitude), new google.maps.LatLng(end_latitude, end_longtitude))/1000; 
                            //console.log("Distance between start and end:", distance, "km");
                            //round to 2 dp
                            var distance = Math.round(distance * 100) / 100;               
                            document.getElementById("distance").innerText = distance + " km away";    
                            //If the user provides his postal code through the modal, saves it in the added to cart msg so he dont need to enter it again 
                            added_to_cart_msg = document.getElementById("added_to_cart_msg");
                            //added_to_cart_msg.setAttribute("href", added_to_cart_msg.getAttribute("href") + "?postal_code=" + start);   
                    }
                };
                xhttp.open("GET", url, true);
                xhttp.send();
            }
            catch(err) { // show error message
                                // not a good idea to directly show err.message 
                                // as it may contain sensitive info
                                // show a predefined error message string
                                console.log("Sorry, invalid address. Please try again!");
                                document.getElementById("map").innerHTML = "<div class='alert alert-danger'>Invalid postal code. Please refresh the page.</div>";

                                //if user never provides a postalcode, ask for it
                                $('#input_postal_code').modal('show');

            }
}
</script>
<script>    
    //////////////Loads the Google Map/////////////////////
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
    var map, infoWindow;
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
            //document.getElementById("input_postal_code_confirm").setAttribute("data-dismiss","modal");
            //Sets the postal code in session
            sessionStorage.setItem('postal_code', document.getElementById("postal_code").value);
            calculates_distance();
        }
    }
    function initMap() {
    //alert(document.getElementById('map').getAttribute("style"));
    
    if (document.getElementById('map').getAttribute("style") == "height: 400px; position: relative; overflow: hidden;") {
        //if the map is already rendered, dont render it again
    }
    else {
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
        //Sets the height of the map
        document.getElementById('map').setAttribute("style", "height: 400px;")       
        map = new google.maps.Map(document.getElementById('map'), {
            //center: {lat: -34.397, lng: 150.644},
            zoom: 6
            });
            calcRoute();               
        }
                        
    }

    function calcRoute() {
        //Calculates the distance between start and end point
        //Get the latitude and longtitude using a postal code (from the url)
        //if the user enters his postal code in the modal on top, this will have a value
        var start = document.getElementById("postal_code").value;
        if (sessionStorage.getItem('postal_code') == undefined) {
                //if user never provides a postalcode, ask for it
                $('#input_postal_code').modal('show');
                return;               
        }
        else {
            start = sessionStorage.getItem('postal_code');
        }    
        //console.log(start[0]);
        var url = "https://maps.googleapis.com/maps/api/geocode/json?address=" + start + "&key=AIzaSyDcIUwwXfLUWzMAE1WspewghH9f-vmSkzc";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            // following code may throw error if user input is invalid address
            // so we use try-catch block to handle errors
            // expected response is JSON data
            var data = JSON.parse(this.responseText);
                                
            try { 
                var addr = data["results"][0]["formatted_address"];
            if ( data["status"] == "ZERO_RESULTS") {
                    document.getElementById("map").innerHTML = "<div class='alert alert-danger'>Invalid postal code. Please refresh the page.</div>";
            }
            var loc = data["results"][0]["geometry"]["location"];
            start_latitude = loc["lat"];
            start_longtitude = loc["lng"];
            //console.log("Start:",start_latitude, start_longtitude);
            //Retrieves the company latitude and longtitude                        
            end_latlng_arr = document.getElementById("distance").getAttribute("name").split(",");
    
            end_latitude = end_latlng_arr[0]/10000000;
            end_longtitude = end_latlng_arr[1]/10000000;
            //console.log("End:", end_latitude, end_longtitude);    
            //console.log(window.latitude, window.longtitude);            
            var directionsService = new google.maps.DirectionsService();
            var directionsRenderer = new google.maps.DirectionsRenderer();
            var start = new google.maps.LatLng(start_latitude,start_longtitude);
            var end = new google.maps.LatLng(end_latitude, end_longtitude);
            directionsRenderer.setMap(map);
            //var selectedMode = document.getElementById('mode').value;
            var request = {
                origin: start,
                destination: end,
                // Note that JavaScript allows us to access the constant
                // using square brackets and a string value as its
                // "property."
                travelMode: 'DRIVING' //google.maps.TravelMode[selectedMode]
            };
            //console.log(start);
            //console.log(end);

            directionsService.route(request, function(response, status) {
                if (status == 'OK') {
                    directionsRenderer.setDirections(response);
                    //No need to enter postal code if map is rendered successfully
                    document.getElementById("close_input_postal_code").setAttribute("onclick","");
                    //If the user provides his postal code through the modal, saves it in the added to cart msg so he dont need to enter it again 
                    // added_to_cart_msg = document.getElementById("added_to_cart_msg");
                    // var currrent_link = added_to_cart_msg.getAttribute("href");
                    // if (current_link.includes("?postal_code=") == false) {
                    //     added_to_cart_msg.setAttribute("href", current_link + "?postal_code=" + start);  
                    // }
                   
                }
                else {
                        document.getElementById("map").innerHTML = "<div class='alert alert-danger'>Invalid postal code</div>";
                }
                //console.log(response);
            }); 
            } catch(err) { // show error message
                // not a good idea to directly show err.message 
                // as it may contain sensitive info
                // show a predefined error message string
                console.log("Sorry, invalid address. Please try again!");
                document.getElementById("map").innerHTML = "<div class='alert alert-danger'>Invalid postal code. Please enter the postal code again.</div>";
                //Prompts user to enter th ecorrect postal code again
                document.getElementById("close_input_postal_code").setAttribute("onclick","show_postal_code_modal()");
                //Need to reset the style of map so it will generate again
                document.getElementById('map').setAttribute("style","height: auto;");
                //document.getElementById("display").innerHTML = "Sorry, invalid address. Please try again!";
            }
        }
        };
        xhttp.open("GET", url, true);
        xhttp.send();

    }

    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                            'Error: The Geolocation service failed.' :
                            'Error: Your browser doesn\'t support geolocation.');
    infoWindow.open(map);
    }
</script>
<!-- To calculate distance between 2 points-->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&v=3&libraries=geometry"></script>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDcIUwwXfLUWzMAE1WspewghH9f-vmSkzc">
</script>
</body>
</html>
