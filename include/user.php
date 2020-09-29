<?php

class user {
    // property declaration
    private $user_id;
    private $cart;
 
    public function __construct($user_id, $cart)
    {
        $this->user_id = $user_id;
        $this->cart = $cart;
    }
    public function get_user_id()
    { 
        return $this->user_id;
    }
    public function get_cart()
    { 
        return $this->cart;
    }

    
}

?>