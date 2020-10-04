
<?php
class messageDAO {

    public function add($body, $date, $from_id, $from_type, $seen, $time, $to_id, $to_type, $type) {
        $sql = 'INSERT INTO message (body, date, from_id, from_type, seen, time, to_id, to_type, type) 
                    VALUES  (:body, :date, :from_id, :from_type, :seen, :time, :to_id, :to_type, :type)';
        
        $connMgr = new ConnectionManager();       
        $conn = $connMgr->getConnection();
         
        $stmt = $conn->prepare($sql); 

        $stmt->bindParam(':body', $body, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':from_id', $from_id, PDO::PARAM_STR);
        $stmt->bindParam(':from_type', $from_type, PDO::PARAM_STR);
        $stmt->bindParam(':seen', $seen, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->bindParam(':to_id', $to_id, PDO::PARAM_STR);
        $stmt->bindParam(':to_type', $to_type, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);

        $isAddOK = False;
        if ($stmt->execute()) {
            $isAddOK = True;
        }

        return $isAddOK;
    }


    public function retrieve_all(){
        $sql = "SELECT * FROM message";

        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();

        $result = [];

        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new message($row['message_id'], $row['body'], $row['date'], $row['from_id'], $row['from_type'], $row['seen'], $row['time'], $row['to_id'], $row['to_type'], $row['type']);
        }
        return $result;
    }

    public function retrieve_message($message_id){
        $sql = "SELECT * FROM message WHERE message_id = :message_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result = new message($row['message_id'], $row['body'], $row['date'], $row['from_id'], $row['from_type'], $row['seen'], $row['time'], $row['to_id'], $row['to_type'], $row['type']);
        }
        return $result;
    }
    public function retrieve_message_to($to_id, $to_type){
        //Retreive all messages that is addressed to a particular user_id/company_id, ordered by date and time descending
        //Note that this also includes message that is sent FROM this particular user_id/company_id as we need to take into account the user sending the message, not just receiving 
        //Need to sort by from_type and from first, as we only want to retrieve the latest message sent by a user
        //Then, sort by date. Then,-1 is AM or PM, so we sort by AM or PM first, then by the time itself
        $sql = "SELECT * FROM message WHERE (to_id = :to_id AND to_type = :to_type) OR (from_id = :to_id AND from_type = :to_type) ORDER BY date DESC, from_type, from_id, to_type, to_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':to_id', $to_id, PDO::PARAM_STR);
        $stmt->bindParam(':to_type', $to_type, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new message($row['message_id'], $row['body'], $row['date'], $row['from_id'], $row['from_type'], $row['seen'], $row['time'], $row['to_id'], $row['to_type'], $row['type']);
        }
        return $result;
    }
    public function retrieve_message_from_to($from_id, $from_type, $to_id, $to_type){
        //Retreive all messages that is sent by a user_id/company_id and is sent to a particular user_id/company_id, ordered by date and time descending
        //Sort by date. Note that we want to find both outgonig and receiving message from these 2 users
        $sql = "SELECT * FROM message WHERE (from_id = :from_id AND from_type = :from_type AND to_id = :to_id AND to_type = :to_type) OR (from_id = :to_id AND from_type = :to_type AND to_id = :from_id AND to_type = :from_type) ORDER BY date ASC";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':from_id', $from_id, PDO::PARAM_STR);
        $stmt->bindParam(':from_type', $from_type, PDO::PARAM_STR);        
        $stmt->bindParam(':to_id', $to_id, PDO::PARAM_STR);
        $stmt->bindParam(':to_type', $to_type, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $result = [];
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new message($row['message_id'], $row['body'], $row['date'], $row['from_id'], $row['from_type'], $row['seen'], $row['time'], $row['to_id'], $row['to_type'], $row['type']);
        }
        return $result;
    }
    public function remove_message($message_id){
        $sql = "DELETE * FROM message WHERE message_id = :message_id";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':message_id', $message_id, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $status = $stmt->execute();
        return $status;
    }

    public function remove_message_sender_receiver_date_time($from_id, $from_type, $to_id, $to_type, $date, $time){
        $sql = "DELETE * FROM message WHERE from_id=:from_id AND from_type = :from_type AND to_id = :to_id AND to_type = :to_type AND date = :date AND time = :time";
        $connMgr = new ConnectionManager();      
        $conn = $connMgr->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':from_id', $from_id, PDO::PARAM_STR);
        $stmt->bindParam(':from_type', $from_type, PDO::PARAM_STR);        
        $stmt->bindParam(':to_id', $to_id, PDO::PARAM_STR);
        $stmt->bindParam(':to_type', $to_type, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $status = $stmt->execute();
        return $status;
    }
    public function removeAll(){
        $sql = 'TRUNCATE TABLE message';
        
        $connMgr = new ConnectionManager();
        $conn = $connMgr->getConnection();
        
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        $count = $stmt->rowCount();
    }


    public function update_seen_from_to_date_time($seen, $from_id, $from_type, $to_id, $to_type, $date, $time){
        $sql = "UPDATE message SET seen =:seen WHERE from_id=:from_id AND from_type = :from_type AND to_id = :to_id AND to_type = :to_type AND date = :date AND time = :time";
        $connMgr = new ConnectionManager();    
        $conn = $connMgr->getConnection();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':seen', $seen, PDO::PARAM_STR);
        $stmt->bindParam(':from_id', $from_id, PDO::PARAM_STR);
        $stmt->bindParam(':from_type', $from_type, PDO::PARAM_STR);        
        $stmt->bindParam(':to_id', $to_id, PDO::PARAM_STR);
        $stmt->bindParam(':to_type', $to_type, PDO::PARAM_STR);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':time', $time, PDO::PARAM_STR);
        $status = $stmt->execute();
        return $status;
    }

    
}






?>