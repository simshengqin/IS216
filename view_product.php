<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';
    //TO BE UPDATED
    $user_id = 1;
    #Get product info from the link itself
    if (isset($_GET["product_id"])) {
        $product_id = $_GET["product_id"];   
    }
    else {
        //Just a backup for now
        $product_id = "1";
    }    
    $productDAO = new productDAO();
    $product = $productDAO->retrieve_product($product_id);
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
    //TO BE UPDATED
    $product_rating = "5.0";
    $product_rating_count =138;
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
?>
<head>
<title>View Individual Products</title>
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
        <h3 class="mb-0">View individual products</h3>
        </div>
    </div>
</div>
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
                <div class="toast-body">
                    Heads up, toasts will stack automatically
                </div>
                </div>
            </div>
            </div>

        </div>
        <div name="left_margin" class="col-md-2">
        </div>
        <!--Product grid displaying the food product-->
        <div name="" class="col-md-3 single_product_image_grid">
            <?php
                echo "<img class='single_product_image'  src='images/$type/$name.jpg'>";                  
                //only add a new label if the product is posted today 
                //Need to follow sql format, which is Y-m-d
                if (date('Y-m-d', time())== $posted_date) {
                    echo "<span class='product-new-label'>New</span>";
                }
                
                if ($discount != 0.0) {
                    echo "<span class='product-discount-label'>-$discount%</span>";
                }
            ?>
        </div>
        <div name="product_info" class="col-md-5 product-content">
            <div class="row">
                <h1 class='title font-weight-bold'><?php echo str_replace('_',' ',$name)?></h3>
                <div class="row mb-3">
                    <span class="mr-2">
                        <?php echo $product_rating ?>
                        <ul class='rating'>
                            <li class='fa fa-star'></li>
                            <li class='fa fa-star'></li>
                            <li class='fa fa-star'></li>
                            <li class='fa fa-star'></li>
                            <li class='fa fa-star'></li>
                        </ul>
                    </span>
                    <span class="mr-2">
                        <?php echo $product_rating_count ?>
                    </span> Rating
                </div>
                <div class="row mb-3">            
                    <div class='price'>
                        $<?php echo $price_after; ?>
                        <span>$<?php echo $price_before_modified; ?></span>
                    </div>
                </div>
                <div class="row mb-3"> 
                    Quantity           
                    <div class='def-number-input number-input safari_only mb-0 w-100'>
                        <span class='fas fa-minus-circle' onmousedown='minus_quantity()'>
                        </span>
                        <input  class='quantity' min='1' id='quantity_in_cart' name='quantity' value='1' type='number' >
                        <span class='fas fa-plus-circle' onclick='add_quantity()'>
                        </span>
                    </div>
                </div>
                <button class='add-to-cart' href='#' onclick="add_to_cart(<?php echo '1, $product_id, $name'; ?>)">ADD TO CART</button>
        </div>
        <div name="right_margin" class="col-md-2">
        </div>        
    </div>
</div>
<hr>

<script>
    function add_to_cart(user_id, product_id, product_name) {
        $("#add_to_cart_message").toast({ delay: 7000 });
        $("#add_to_cart_message").toast('show');
        //Update the toast to reflect what item was added..
        document.getElementById("cart_message_body").innerText = product_name.charAt(0).toUpperCase() + product_name.slice(1);
        //Send an AJAX request to update_user.php to update the cart of user in database
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);  
            }  
        };  
        request.open('POST', 'update_user.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        quantity_in_cart = document.getElementById("quantity_in_cart").value;
        request.send("user_id="+user_id+"&product_id="+product_id+"&quantity="+quantity_in_cart);
    }
    function minus_quantity() {
        //Decrease the quantity
        quantity_in_cart = document.getElementById("quantity_in_cart");
        
        if (quantity_in_cart.value > 1) {
            quantity_in_cart.value -= 1;          
        }
    }
    function add_quantity() {
        quantity_in_cart = document.getElementById("quantity_in_cart");
        quantity_in_cart.value = parseInt(quantity_in_cart.value) + 1;           
    }
</script>
</body>

