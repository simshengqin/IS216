<?php

class message {
    // property declaration
    private $message_id;
    private $body;
    private $date;
    private $from_id;
    private $from_type;
    private $seen;
    private $time;
    private $to_id;
    private $to_type;
    private $type;
    
    
    public function __construct($message_id, $body, $date, $from_id, $from_type, $seen, $time, $to_id, $to_type, $type)
    {
        $this->message_id = $message_id;
        $this->body = $body;
        $this->date = $date;
        $this->from_id = $from_id;
        $this->from_type = $from_type;
        $this->seen = $seen;
        $this->time = $time;
        $this->to_id = $to_id;
        $this->to_type = $to_type;
        $this->type = $type;
    }
    public function get_message_id()
    { 
        return $this->message_id;
    }
    public function get_body()
    { 
        return $this->body;
    }
    public function get_date()
    { 
        return $this->date;
    }
    public function get_from_id()
    { 
        return $this->from_id;
    }
    public function get_from_type()
    { 
        return $this->from_type;
    }
    public function get_seen()
    { 
        return $this->seen;
    }
    public function get_time()
    { 
        return $this->time;
    }
    public function get_to_id()
    { 
        return $this->to_id;
    }
    public function get_to_type()
    { 
        return $this->to_type;
    }
    public function get_type()
    { 
        return $this->type;
    }

    
}

?>

