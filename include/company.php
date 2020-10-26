<?php

class company {
    // property declaration
    private $company_id;
    private $address;
    private $latitude;
    private $longtitude;
    private $description;
    private $following;
    private $joined_date;
    private $name;
    private $password;
    private $rating;
    private $special_description;
    
    
    public function __construct($company_id, $address, $latitude, $longtitude, $description, $following, $joined_date, $mode_of_collection, $name, $password, $rating, $special_description)
    {
        $this->company_id = $company_id;
        $this->address = $address;        
        $this->latitude = $latitude;
        $this->longtitude = $longtitude;
        $this->description = $description;
        $this->following = $following;
        $this->joined_date = $joined_date;
        $this->mode_of_collection = $mode_of_collection;
        $this->name = $name;
        $this->password = $password;
        $this->rating = $rating;
        $this->special_description = $special_description;

    }
    public function get_company_id()
    { 
        return $this->company_id;
    }
    public function get_latitude()
    { 
        return $this->latitude;
    }
    public function get_longtitude()
    { 
        return $this->longtitude;
    }
    public function get_address()
    { 
        return $this->address;
    }
    public function get_description()
    { 
        return $this->description;
    }
    public function get_following()
    { 
        return $this->following;
    }
    public function get_joined_date()
    { 
        return $this->joined_date;
    }
    public function get_mode_of_collection()
    { 
        return $this->mode_of_collection;
    }    
    public function get_name()
    { 
        return $this->name;
    }
    public function get_password()
    { 
        return $this->password;
    }
    public function get_rating()
    { 
        return $this->rating;
    }
    public function get_special_description()
    { 
        return $this->special_description;
    }   

    
}

?>

