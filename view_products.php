<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';

?>
<head>
<title>View Products</title>
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

<?php include 'include/customer_navbar.php';?>
<!-- <div class="jumbotron color-grey-light">
    <div class="d-flex align-items-center h-20">
        <div class="container text-center py-5">
        <h3 class="mb-0">List of products</h3>
        </div>
    </div>
</div> -->
</head>
<body>
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

                <div class="toast ide" data-autohide="false" role="alert" aria-live="assertive" aria-atomic="true">
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
        <!-- Modal to confirm changing cart companyid-->
        <div class="modal fade" id="delete_confirmation_msg" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              Are you sure that you want to change company? This will erase your existing cart
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal" onclick=delete_product()>Yes</button>
              <button type="button" class="btn btn-success" data-dismiss="modal">&nbsp;&nbsp;&nbsp;Nope&nbsp;&nbsp;&nbsp;</button>
            </div>
          </div>
        </div>
      </div> 
        <div name="filterform" class="col-md-4">
            <div><!--class="position-fixed"-->
                <div class="form-row ">
                    <div class="form-group col-12">
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">
                                Sort by</label>
                            </span>
                            <select class="form-control custom-select " id="sort_by_bar" onchange = "sort_products();"                                                                                                                >
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

        </div>
        <!--Product grid displaying all food products-->
        <div class="grid_beside_filterform col-md-8">    
            <!--Search bar-->
            <div class="row" name="search_for_products">    
                <div class="form-group col-12">
                    <input type="text" class="form-control" name="x" id="search_for_products" oninput ='search_filter()' placeholder="Search for products">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                        <span class="glyphicon glyphicon-search"></span>
                        </button>
                    </span>
                </div>
            </div>
            <span id="no_items_warning"></span>
            <div class="row" id="main_product_grid">               
                <?php
                    $productDAO = new productDAO();
                    $all_product_info = $productDAO->retrieve_all();                 
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
                    foreach ($all_product_info as $product) {
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
                        $category = $product->get_category();
                        $mode_of_collection = $product->get_mode_of_collection();
                        $product_image_url = $product->get_image_url();
                        if ($product_image_url == "") {
                            $product_image_url ="images/$category/$name.jpg";
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
                            <div class='col-xl-3 col-lg-4 col-sm-6 single_product_grid' id ='single_product_grid' name='$product_id,$company_id,$decay_date,$decay_time,$name,$posted_date,$posted_time,$price_after,$price_before,$quantity,$category,$mode_of_collection'>
                            <div class='product-grid'>
                                
                                <div class='product-image d-flex w-100'>
                                    <img class='pic-1 my-auto'  src='$product_image_url'>";
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
                ?>
            </div>
        </div>
    </div>
</div>
<?php include 'include/footer.php';?>

<script>
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

            //productinfo = $product_id, $company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $category, $mode_of_collection
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
            category = product_info_arr[10];
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
            if ((!categories_dessert && !categories_vegetables && !categories_meal) || (categories_dessert && category == "dessert") || (categories_vegetables && category == "vegetables") || (categories_meal && category == "japanese_food"))
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
        var selected_option = document.getElementById("sort_by_bar").value;        
        var main_product_grid = document.getElementById('main_product_grid');
        //var divs = container.getElementsById('single_product_grid');
        var product_grids = Array.from(document.getElementsByClassName("single_product_grid"));
        var search_for_products = document.getElementById("search_for_products").value;
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
            target.innerText= "ADDED TO CART";
            //Here can put 0 as update_user.php will increase it to 1
            var quantity = 0;
            var quantity_change = 1;        
            //Update the toast to reflect what item was added
            document.getElementById("cart_message_body").innerText = name.charAt(0).toUpperCase() + name.slice(1) + " was successfully added to your cart. ";
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
</script>
</body>

