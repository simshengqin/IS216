<?php
require_once "include\common.php";
if(isset($_POST['body']) && isset($_POST['date']) && isset($_POST['from_id']) && isset($_POST['from_type']) && isset($_POST['seen']) && isset($_POST['time']) && isset($_POST['to_id']) && isset($_POST['to_type']) && isset($_POST['type'])){
    $body = $_POST['body'];
    $date = $_POST['date'];
    $from_id = $_POST['from_id'];
    $from_type = $_POST['from_type'];
    $seen = $_POST['seen'];
    $time = $_POST['time'];
    $to_id = $_POST['to_id'];
    $to_type = $_POST['to_type'];
    $type = $_POST['type'];
    $messageDAO = new messageDAO();
    $status = $messageDAO -> add($body, $date, $from_id, $from_type, $seen, $time, $to_id, $to_type, $type);
    if (!$status) {
        echo "error";
    }
    else {
        echo "success";
    }
    //echo json_encode($messages_output);

}

?>