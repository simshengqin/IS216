<?php

class company {
    // property declaration
    private $company_id;
    private $address;
    private $description;
    private $following;
    private $joined_date;
    private $name;
    private $password;
    private $rating;
    
    
    public function __construct($company_id, $address, $description, $following, $joined_date, $name, $password, $rating)
    {
        $this->company_id = $company_id;
        $this->address = $address;
        $this->description = $description;
        $this->following = $following;
        $this->joined_date = $joined_date;
        $this->name = $name;
        $this->password = $password;
        $this->rating = $rating;
    }
    public function get_company_id()
    { 
        return $this->company_id;
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

    
}

?>

