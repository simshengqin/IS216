<?php
require_once 'include/common.php';
require_once 'include/protect.php';
if(isset($_POST['user_id']) && isset($_POST['preferences'])){
    $user_id = $_POST['user_id'];
    $preferences = $_POST['preferences'];
    $userDAO = new userDAO();
    $userDAO-> update_preferences($user_id, $preferences);
    // $user = $userDAO-> retrieve_user($user_id);
    // $preferences = $user -> get_preferences();
    // if (strlen($preferences) ==0) {
    //     $preferences_arr = [];
    //   }
    //   else {
    //     $preferences_arr = explode(",",$preferences);
    //   }  
    
    // echo "Successfully updated your preferences!";
}

?>