<?php

class order {
    // property declaration
    private $order_id;
    private $userid;
    private $food_id;
    private $company_id;
    private $order_date;
    private $order_time;
    private $amount;
    private $collection_type;
    private $review;
    private $rating;
    
    
    
    public function __construct($order_id, $userid, $food_id, $company_id, $order_date, $order_time, $amount, $collection_type, $review, $rating)
    {
        $this->order_id = $order_id;
        $this->userid = $userid;
        $this->food_id = $food_id;
        $this->company_id = $company_id;
        $this->order_date = $order_date;
        $this->order_time = $order_time;
        $this->amount = $amount;
        $this->collection_type = $collection_type;
        $this->review = $review;
        $this->rating = $rating;
    }
    public function get_order_id()
    { 
        return $this->order_id;
    }
    public function get_company_id()
    { 
        return $this->company_id;
    }
    public function get_user_id()
    { 
        return $this->userid;
    }
    public function get_food_id()
    { 
        return $this->food_id;
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
    
}

?>