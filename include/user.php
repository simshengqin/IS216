<?php

class user {
    // property declaration
    private $user_id;
    private $cart;
    private $name;
 
    public function __construct($user_id, $cart, $name)
    {
        $this->user_id = $user_id;
        $this->cart = $cart;
        $this->name = $name;
    }
    public function get_user_id()
    { 
        return $this->user_id;
    }
    public function get_cart()
    { 
        return $this->cart;
    }
    public function get_name()
    { 
        return $this->name;
    }

    
}

?>