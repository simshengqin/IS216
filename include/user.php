<?php

class user {
    // property declaration
    private $user_id;
    private $cart;
    private $cart_company_id;
    private $name;
    private $email;
    private $phoneNumber;
    private $preferences;
 
    public function __construct($user_id, $cart, $cart_company_id, $name, $email, $phoneNumber, $preferences)
    {
        $this->user_id = $user_id;
        $this->cart = $cart;
        $this->cart_company_id = $cart_company_id;
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->preferences = $preferences;
    }
    public function get_user_id()
    { 
        return $this->user_id;
    }
    public function get_cart()
    { 
        return $this->cart;
    }
    public function get_cart_company_id()
    { 
        return $this->cart_company_id;
    }
    public function get_name()
    { 
        return $this->name;
    }
    public function get_email()
    { 
        return $this->email;
    }
    public function get_phoneNumber()
    { 
        return $this->phoneNumber;
    }
    public function get_preferences()
    { 
        return $this->preferences;
    }
    
}

?>