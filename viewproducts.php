<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';

?>
<link href='//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
<script src='//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js'></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<!------ Include the above in your HEAD tag ---------->

<link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' />
<link rel='stylesheet' href='include\main.css'>

<div class='container'>
    <h3 class='h3'>shopping Demo-4 </h3>
    <div class='row'>
        <?php
            $productDAO = new productDAO();
            $all_product_info = $productDAO->retrieve_all();
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
                $type = $product->get_type();
                $discount = round((($price_before-$price_after)/$price_before)*100,0);
                //if there is no discount, do not show the -% label and the crossed out price
                if ($discount == 0.0) {
                    $price_before = "";                 
                }     
                else {
                    $price_before = "$" . $price_before;
                }           
                //set timezone to singapore so the time will be correct
                date_default_timezone_set('Asia/Singapore');
                //$datetime = date('m/d/Y h:i:s a', time());
                
                echo "
                <div class='col-md-3 col-sm-6'>
                <div class='product-grid4'>
                    <div class='product-image4'>
                        <a href='#'>
                            <img class='pic-1' width='250' height='200' src='images/$type/$name.jpg'>
                        </a>";
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
                        <h3 class='title'><a href='#'> " . str_replace('_',' ',$name) . "</a></h3>
                        <div class='price'>
                            $$price_after
                            <span>$price_before</span>
                        </div>
                        <a class='add-to-cart' href=''>ADD TO CART</a>
                    </div>
                </div>
            </div>
                ";
            }
        ?>
        
    </div>
<hr>
</div>
<hr>

