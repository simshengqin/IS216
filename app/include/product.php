<?php

class product {
    // property declaration
    private $product_id;
    private $company_id;
    private $decay_date;
    private $decay_time;
    private $name;
    private $posted_date;
    private $posted_time;
    private $price_after;
    private $price_before;
    private $quantity;
    private $category;
    private $mode_of_collection;
    private $image_url;
    private $visible;
    
    public function __construct($product_id, $company_id, $decay_date, $decay_time, $name, $posted_date, $posted_time, $price_after, $price_before, $quantity, $category, $mode_of_collection, $image_url, $visible)
    {
        $this->product_id = $product_id;
        $this->company_id = $company_id;
        $this->decay_date = $decay_date;
        $this->decay_time = $decay_time;
        $this->name = $name;
        $this->posted_date = $posted_date;
        $this->posted_time = $posted_time;
        $this->price_after = $price_after;
        $this->price_before = $price_before;
        $this->quantity = $quantity;
        $this->category = $category;
        $this->mode_of_collection = $mode_of_collection;
        $this->image_url = $image_url;
        $this->visible = $visible;
    }
    public function get_product_id()
    { 
        return $this->product_id;
    }
    public function get_company_id()
    { 
        return $this->company_id;
    }
    public function get_decay_date()
    { 
        return $this->decay_date;
    }
    public function get_decay_time()
    { 
        return $this->decay_time;
    }
    public function get_name()
    { 
        return $this->name;
    }
    public function get_posted_date()
    { 
        return $this->posted_date;
    }
    public function get_posted_time()
    { 
        return $this->posted_time;
    }
    public function get_price_after()
    { 
        return $this->price_after;
    }
    public function get_price_before()
    { 
        return $this->price_before;
    }
    public function get_quantity()
    { 
        return $this->quantity;
    }
    public function get_category()
    { 
        return $this->category;
    }
    public function get_mode_of_collection()
    {
        return $this->mode_of_collection;
    }
    public function get_image_url()
    {
        return $this->image_url;
    }
    public function get_visible()
    {
        return $this->visible;
    }
    
}

?>