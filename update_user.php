<?php
require_once 'include/common.php';
require_once 'include/protect.php';
if(isset($_POST['user_id']) && isset($_POST['product_id']) && isset($_POST['quantity'])){
    $user_id = $_POST['user_id'];
    $target_product_id = $_POST['product_id'];
    $new_quantity = $_POST['quantity'];
    //Retreive the cart first
    $userDAO = new userDAO();
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
        $cart_arr[] = $target_product_id . ":" . $new_quantity;;
    }
    $updated_cart = implode(",",$cart_arr);
    
    if ($userDAO -> update_user_cart($user_id, $updated_cart)) {
        echo "Succsessfully updated the user's cart in database!";
    }


}

?>