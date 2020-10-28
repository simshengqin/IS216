<?php

class transactions {
    // property declaration
    private $transaction_id;
    private $userid;
    private $cart;
    private $company_id;
    private $order_date;
    private $order_time;
    private $amount;
    private $collection_type;
    private $review;
    private $rating;
    private $collected;
    
    
    
    public function __construct($transaction_id, $userid, $cart, $company_id, $order_date, $order_time, $amount, $collection_type, $review, $rating,$collected)
    {
        $this->transaction_id = $transaction_id;
        $this->userid = $userid;
        $this->cart = $cart;
        $this->company_id = $company_id;
        $this->order_date = $order_date;
        $this->order_time = $order_time;
        $this->amount = $amount;
        $this->collection_type = $collection_type;
        $this->review = $review;
        $this->rating = $rating;
        $this->collected = $collected;
    }
    public function get_transaction_id()
    { 
        return $this->transaction_id;
    }
    public function get_company_id()
    { 
        return $this->company_id;
    }
    public function get_user_id()
    { 
        return $this->userid;
    }
    public function get_cart()
    { 
        return $this->cart;
    }
   
    public function get_order_date()
    { 
        return $this->order_date;
    }
    public function get_order_time()
    { 
        return $this->order_time;
    }
    public function get_amount()
    { 
        return $this->amount;
    }
    public function get_collection_type()
    { 
        return $this->collection_type;
    }
    public function get_review()
    { 
        return $this->review;
    }
    public function get_rating()
    { 
        return $this->rating;
    }
    public function get_collected()
    { 
        return $this->collected;
    }
    
}

?>