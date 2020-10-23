<?php
require_once 'include/common.php';
require_once 'include/protect.php';
if(isset($_POST['user_id']) && isset($_POST['product_id']) && isset($_POST['quantity']) && isset($_POST['quantity_change'])){
    $user_id = $_POST['user_id'];
    $target_product_id = $_POST['product_id'];
    $new_quantity = $_POST['quantity'];
    $quantity_change = $_POST['quantity_change'];
    //Retreive the cart first
    $userDAO = new userDAO();
    $productDAO = new productDAO();
    $user = $userDAO-> retrieve_user($user_id);
    $cart = $user -> get_cart();
    if (strlen($cart) ==0) {
        $cart_arr = [];
      }
      else {
        $cart_arr = explode(",",$cart);
      }  
    $i = 0;
    $item_in_cart = false;
    foreach ($cart_arr as $productqty) {
        #Split it to an arr, where the 1st element is product_id and 2nd element is quantity
        $productqty_arr = explode(":",$productqty);
        $product_id = $productqty_arr[0];
        #$quantity_in_cart contains how much the user currently ordered that product in their cart
        $quantity_in_cart = $productqty_arr[1];
        #Identify the product id that we are trying to update and update its quantity
        #If qty is 0, remove the product from cart
        if ($target_product_id == $product_id) {
            $item_in_cart = true;
            if ($new_quantity == 0) {
                array_splice($cart_arr, $i, 1);
            }
            else {
                $cart_arr[$i] = $target_product_id . ":" . $new_quantity;
            }
            
        }
        
        $i += 1;
    }
    if ($item_in_cart == false) {
        //Add the item if it does not exist in the cart currently
        $cart_arr[] = $target_product_id . ":" . $new_quantity;
    }
    $updated_cart = implode(",",$cart_arr);
    
    #When user adds an item to their cart, the product qty in database decrease by 1!
    $quantity_change = -$quantity_change;
    if ($productDAO -> update_product_qty($target_product_id,$quantity_change)) {
        echo "Succsessfully updated the product's qty in database!";
        //Only update the user cart if thhere is enough product qty in the database
        if ($userDAO -> update_user_cart($user_id, $updated_cart)) {
            echo "Succsessfully updated the user's cart in database!";

        }
        else {
            echo "Failed to update user's cart in database";
        }
    }
    else {
        echo "Insufficient product qty in database";
    }
}

?>