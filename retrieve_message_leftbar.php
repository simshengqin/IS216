<?php
require_once "include\common.php";
if(isset($_POST['user_id']) && isset($_POST['user_type'])){
    $user_id = $_POST['user_id'];
    $user_type = $_POST['user_type'];
    //update the leftsidebar messages
    $messageDAO = new messageDAO();
    //userDAO and companyDAO are for retrieving the user nane and company name
    $userDAO = new userDAO();
    $companyDAO = new companyDAO();
    $messages = $messageDAO->retrieve_message_to($user_id, $user_type);
    //Need to convert to a format that javascript can read!!! As JS cannot read what is message, which is a message object from message.php
    $messages_output = [];
    foreach ($messages as $message) {
        $individual_message = [];
        $individual_message["message_id"] =$message->get_message_id();
        $individual_message["body"] = $message->get_body();
        $individual_message["date"] = $message->get_date();
        $individual_message["from_id"] = $message->get_from_id();
        $individual_message["from_type"] = $message->get_from_type();
        $individual_message["seen"] = $message->get_seen();
        $individual_message["time"] = $message->get_time();
        $individual_message["to_id"] = $message->get_to_id();
        $individual_message["to_type"] = $message->get_to_type();
        $individual_message["type"] = $message->get_type();
        $individual_message["body"] = $message->get_body();
        $individual_message["message_date"] = date('F d Y', strtotime($message-> get_date()));
        //Retrieve the user name or company name depending on from_type
        $from_id = $message->get_from_id();
        $from_type = $message->get_from_type();   
        if ($from_id == $user_id and $from_type == $user_type) {
            $from_id = $message->get_to_id();
            $from_type = $message->get_to_type();                            
        } 
        if ($from_type == "user") {
            $individual_message["from_name"] = ucfirst($userDAO->retrieve_user($from_id)->get_name());
            $individual_message["from_image"] = "images/profile_picture/user/$from_id.png";
            //Use the default picture if the image does not exist
            if (!file_exists($individual_message["from_image"])) {
                $individual_message["from_image"] = "images/profile_picture/user/default.png";
            }
            
        }
        else if ($from_type == "company") {
            
            $individual_message["from_name"] = ucfirst($companyDAO->retrieve_company($from_id)->get_name());
            $individual_message["from_image"] = "images/profile_picture/company/$from_id.png";
            //Use the default picture if the image does not exist
            if (!file_exists($individual_message["from_image"])) {
                $individual_message["from_image"] = "images/profile_picture/company/default.png";
            }
        }  

        array_push($messages_output, $individual_message);
    }
    echo json_encode($messages_output);

}

?>