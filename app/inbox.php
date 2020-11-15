<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

<html>
<head>
    <?php
        require_once 'include/common.php';
        require_once 'include/protect.php';



    ?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet">
    <!--Link to main.css files while contains all the css of this project-->
    <link rel='stylesheet' href='css\maincss.css'>

</head>
<body>
<div class="container-fluid ">
    <!-- add navbar at the top -->
    <?php 
        if (isset($_SESSION["user_id"])) {
            include 'include/customer_navbar.php';
        }
        else if (isset($_SESSION["company_id"])) {
            include 'include/company_navbar.php';
        }
    ?>
    <?php 
        //go back to previous page on history
        echo "<a id='go_back_btn' href='javascript:history.go(-1)'><h4 class='m-2'><button class='mt-2 mb-2' style='margin-left: 40px;' onClick='header(\'Location: view_company.php?company_name=target_name\');'><i class='fas fa-chevron-circle-left'></i></button>Go back</h4></a>";

    ?>
    <div class="messaging row">
        <div class="col-12">
            <!--inbox_msg contains both the left sidebar and right sidebar-->
            <div class="inbox_msg row" style="margin-left: 40px; margin-right: 40px;">
                <!--Main leftsidebar, contains both searchbar and chat previews to other people-->
                <div class="inbox_people2 col-sm-4 p-0" style="border-right: 1px solid #c4c4c4;">
                   
                    <!--The left sidebar below the searchbar containing all the chat previews to other people -->
                    <div class="inbox_chat" id="inbox_chat">
                        <!--<div class='alert alert-warning m-3'>No messages currently!</div>-->
                    </div>

                </div>
                <!-- Rightsidebar Contains the messages to the currently selected person/company -->
                <div class="mesgs col-sm-8 w-100">
                    <div class="msg_history" id="msg_history2">
                        <div id="selected_messages">                    
                        </div>
                    </div>
                    <div class="type_msg" id="type_msg">
                        <div class="input_msg_write d-none" id="input_msg_write" >
                            <input type="text" class="write_msg" id="sent_message" placeholder="Type a message" />
                            <button class="msg_send_btn" id="msg_send_btn" type="button" onclick='send_message()'><i class="fas fa-paper-plane" aria-hidden="true" name="false"></i></button>
                        </div>
                    </div>       
                </div>
            </div>
        </div>
    </div>
      
    </div></div>
<script>
    window.onload = function(){
                  
        //Get the user_id and user_type from the current url
       
        var params_arr = parseURLParams(window.location.href);
        var user_id = params_arr["user_id"];
        var user_type = params_arr["user_type"]; 
        if (sessionStorage.getItem("selected_from_id") !== undefined && sessionStorage.getItem("selected_from_type") !== undefined) {
           
            sessionStorage.setItem("selected_from_id","");
            sessionStorage.setItem("selected_from_type","");            
        }
        window.scroll_down = "true";
        
        update_selected_messages_leftbar();
        update_selected_messages();


    };

    window.setInterval(function(){
        //Update the right side bar messages ever 1 second
        update_selected_messages();
         //Update the left side bar messages ever 1 second
        update_selected_messages_leftbar();
    }, 500);

    function update_selected_messages_leftbar() {
        //Update the left sidebar messages

        //Send an AJAX request to retrieve all messages received by or sent to the selected user/company
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                //Add check for success here?
                
                var messages = JSON.parse(this.responseText);
               
                //Only retrieve the first chat message received by a certain from_id
                //Note that it is sorted by descending, so the first one message will always be the latest message by that user
                //Hence, keep a list to keep track which user/company has already been displayed, so as not to duplicate them
                var displayed = []; 
                var params_arr = parseURLParams(window.location.href);
               
                if (sessionStorage.getItem("selected_from_id") == ""  && sessionStorage.getItem("selected_from_type") == "") {
                    //Select this empty message window
                    sessionStorage.setItem("selected_from_id", params_arr["target_id"]);
                    sessionStorage.setItem("selected_from_type", params_arr["target_type"]);                    
                }
                //Empty out all the messages displayed first
                document.getElementById("inbox_chat").innerHTML = "";
                if (params_arr["target_id"] !== undefined && params_arr["target_type"] !== undefined && params_arr["target_name"] !== undefined) {
                     

                    //If a chat target is selected, immediately show the send message bar
                    document.getElementById("input_msg_write").setAttribute("class", "input_msg_write");
                    var from_id_url=params_arr["target_id"];
                    var from_type_url=params_arr["target_type"];
                    var from_name_url=params_arr["target_name"];
                    var has_existing_chat = false;
                    for (var i=0; i < messages.length; i++) {
                        var message = messages[i];
                        //Note that the last message can be either sent by the user or company
                        //However, we will always want to show the other user/company info, hence we need to check whether it's in from or to
                        if ((from_id_url == message["from_id"] && from_type_url ==   message["from_type"]) || (from_id_url ==  message["to_id"] && from_type_url == message["to_type"])) {
                            var has_existing_chat = true;
                        }
                            
                    }
                    
                    
                    
                   
                    if (!has_existing_chat && !(String(params_arr["target_id"]) === String(params_arr["user_id"])  && String(params_arr["target_type"]) === String(params_arr["user_type"]))) {

                        //This part is to just create a new chat window based on the url if there no existing chat messages with that user
                        //If there is, just select that chat window
                        //Retrieve the user name or company name depending on from_type
                        if (from_type_url == "user") {
                            
                            var from_name = from_name_url;
                            var from_image = "images/profile_picture/user/default.png";
                            //Use the default picture if the image does not exist
                            //if (!file_exists(from_image)) {
                            //    from_image = "images/profile_picture/user/default.png";
                            //}
                            
                        }
                        else if (from_type_url == "company") {
                            
                            
                            var from_name = String(from_name_url).charAt(0).toUpperCase() + String(from_name_url).slice(1);
                            var from_image = "images/profile_picture/company/"+from_id_url+".png";
                            //Use the default picture if the image does not exist
                            //if (!file_exists(from_image)) {
                            //    from_image = "images/profile_picture/company/default.png";
                            //}
                        }
                        //Empty out all the messages displayed first
                        document.getElementById("inbox_chat").innerHTML = "";
                        
                        document.getElementById("inbox_chat").innerHTML =document.getElementById("inbox_chat").innerHTML + "\
                                                                                    <div class='incoming_msg'> \
                                                                                        <div class='chat_list active_chat' id='"+from_id_url+","+from_type_url+"' onclick='select_chat()'> \
                                                                                        <div class='chat_people2 row d-flex justify-content-center'> \
                                                                                            <div class='chat_img col-xs-4'> <img class='d-block mx-auto' src='" + from_image +"' width='100px'> </div> \
                                                                                            <div class='chat_ib col-xs-4'> \
                                                                                                <div class='text-center mt-1'>" + from_name +" </div> <div class='text-center chat_date'>Today</div> \
                                                                                            </div>\
                                                                                        </div>\
                                                                                    </div>";
                                                                                    
                        console.log(document.getElementById("inbox_chat").innerHTML);
                    }
                }
                for (var i=0; i < messages.length; i++) {
                    var message = messages[i];
                    //$message_id, $body, $date, $from_id, $from_type, $seen, $time, $to_id, $to_type, $type
                    
                    //Add \ at the end of the line to tell javascript the string continues on the next line
                    //Note that the last message can be either sent by the user or company
                    //However, we will always want to show the other user/company info, hence we need to check whether it's in from or to
                    var from_id =  message["from_id"];;
                    var from_type = message["from_type"];  
                    var from_image = message["from_image"];  
                    if (from_id == user_id && from_type == user_type) {
                        from_id = message["to_id"];
                        from_type = message["to_type"];     
                        //echo "NO";                        
                    }            
                    if (!displayed.includes(from_type + from_id)) {
                        displayed.push(from_type + from_id);
                        var message_date = message["message_date"];
                        var message_body =  message["body"];   
                        var from_name = message["from_name"];                    
                        //Selects the currently active chat and gives it a grey background
                        //$active_chat = ($active_chat_index == $i) ? "active_chat" : "";
                        var active_chat = "";
                        var params_arr = parseURLParams(window.location.href);
                        //Highlights the message if selected. If nothing is selcted, check the url
                        //Select the message if defined in target_id and target_type in the url
                        //console.log(sessionStorage.getItem("selected_from_id") + sessionStorage.getItem("selected_from_type"));
                        //alert(sessionStorage.getItem("selected_from_id") + sessionStorage.getItem("selected_from_type"))
                        if (sessionStorage.getItem("selected_from_id") != '' && sessionStorage.getItem("selected_from_type") != '') {
                            active_chat = ((sessionStorage.getItem("selected_from_id") == from_id && sessionStorage.getItem("selected_from_type") ==  from_type) ? "active_chat" : "");
                        }
                        else if ( params_arr["target_id"] !== undefined && params_arr["target_type"] !== undefined) {

                            active_chat = ((params_arr["target_id"] == from_id && params_arr["target_type"] ==  from_type) ? "active_chat" : "");
                            
                        } 
                        // Change quotes
                        message_body = message_body.replace(/[\u00A0-\u9999<>\&]/gim, function(i) {
                                                                                                return '&#'+i.charCodeAt(0)+';';
                                                                                                });
                        document.getElementById("inbox_chat").innerHTML =document.getElementById("inbox_chat").innerHTML + "\
                                                                                    <div class='incoming_msg'> \
                                                                                        <div class='chat_list" + " " + active_chat + "' id='"+from_id+","+from_type+"' onclick='select_chat()'> \
                                                                                        <div class='chat_people2 row d-flex justify-content-center'> \
                                                                                            <div class='chat_img col-xs-4'> <img class='d-block mx-auto' src='" + from_image +"' width='100px'> </div> \
                                                                                             <div class='chat_ib col-xs-4'> \
                                                                                                <div class='text-center mt-1'>" + from_name +" </div> <div class='text-center chat_date'>" + message_date +"</div> \
                                                                                            </div>\
                                                                                            <div class='col-xs-4 mt-1 text-center w-100 overflow-hidden'> \
                                                                                                <p id='message_body'>" + message_body +"</p> \
                                                                                            </div>\
                                                                                        </div> \
                                                                                    </div>";                                                                                       

                    }
 
                }   
                if ( document.getElementById("inbox_chat").innerHTML == "") {
                    //Show empty inbox message if no messages
                    if (user_type == "user") {
                        document.getElementById("inbox_chat").innerHTML = "<div class='alert alert-warning m-3'>No messages currently! Start a new chat through the restaurant page</div>";
                    }
                    else {
                        document.getElementById("inbox_chat").innerHTML = "<div class='alert alert-warning m-3'>No messages currently! A customer will enquire on your food products soon enough!</div>";
                    }
                    
                }         
            }  
        };  
        request.open('POST', 'retrieve_message_leftbar.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        //Get the user_id and user_type from the current url
        var params_arr = parseURLParams(window.location.href);
        var user_id = params_arr["user_id"];
        var user_type = params_arr["user_type"];
        var selected_from_id = sessionStorage.getItem("selected_from_id");
        var selected_from_type = sessionStorage.getItem("selected_from_type");
        request.send("user_id="+user_id+"&user_type="+user_type+"&nothing=wow");
        //alert(user_id);

    }
    function getDifference(a, b)
    {
        var i = 0;
        var j = 0;
        var result = "";

        while (j < b.length)
        {
         if (a[i] != b[j] || i == a.length)
             result += b[j];
         else
             i++;
         j++;
        }
        return result;
    }
    function update_selected_messages() {
        //Update the rightsidebar messages
        //Send an AJAX request to retrieve all messages received by or sent to the selected user/company
       
        var request = new XMLHttpRequest();  
        request.onreadystatechange = function() {    
            
            if (this.readyState == 4 && this.status == 200) {
                //Add check for success here?
                
                messages = JSON.parse(this.responseText);
                
                //Empty out all the messages displayed first
               
                new_html = "";
                for (var i=0; i < messages.length; i++) {
                    message = messages[i];
                    //$message_id, $body, $date, $from_id, $from_type, $seen, $time, $to_id, $to_type, $type
                    
                    //Need to figure out whether it's an incoming or outgoing message
                    //Add \ at the end of the line to tell javascript the string continues on the next line
                    if (message["from_id"] == selected_from_id && message["from_type"] == selected_from_type) {
                        //if the from_id is same as the selected from id, it means it's an incoming message. else it is outgoing
                       var from_image = "images/profile_picture/"+message["from_type"] + "/" + message["from_id"]+".png";
                       if (message["from_type"] == "user") {
                        var from_image = "images/profile_picture/"+message["from_type"] + "/" + "default"+".png";
                       }
                       

                        new_html = new_html + "\
                                                                                    <div class='incoming_msg'> \
                                                                                        <div class='incoming_msg_img'> <img src='" + from_image + "' alt='sunil'> </div> \
                                                                                        <div class='received_msg'> \
                                                                                            <div class='received_withd_msg'> \
                                                                                                <p>" + message["body"] + "</p> \
                                                                                                <span class='time_date'>" + message["date"] + "</span> \
                                                                                            </div> \
                                                                                        </div> \
                                                                                    </div> \
                                                                                ";   
                    }
                    else { 
                        new_html = new_html + "\
                                                                                    <div class='outgoing_msg'> \
                                                                                        <div class='sent_msg' style='margin-right: 10px;'> \
                                                                                            <p class='individual_chat_msg' style='margin-right: 10px;'>" + message["body"] + "</p> \
                                                                                            <span class='time_date'>" + message["date"] + "</span> \
                                                                                        </div> \
                                                                                    </div>  \
                                                                                ";

                    }


                }  
                document.getElementById("selected_messages").innerHTML = new_html;
                //Keeps it scrolled down only when there is a change in the html
               
                
                if (window.scroll_down == "true") {
                    var element = document.getElementsByClassName("msg_history")[0];
                    element.scrollTop = element.scrollHeight;
                    window.scroll_down = "false";                            
                } 
                           
            }  
        };  
        request.open('POST', 'retrieve_message.php', true);
        request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
        //Get the user_id and user_type from the current url
        var params_arr = parseURLParams(window.location.href);
        var user_id = params_arr["user_id"];
        var user_type = params_arr["user_type"];
        var selected_from_id = "";
        var selected_from_type = "";
        if (sessionStorage.getItem("selected_from_id") != '' && sessionStorage.getItem("selected_from_type") != '') {
            selected_from_id = sessionStorage.getItem("selected_from_id");
            selected_from_type = sessionStorage.getItem("selected_from_type");            
        }
        else if ( params_arr["target_id"] !== undefined && params_arr["target_type"] !== undefined){
           
            selected_from_id = params_arr["target_id"];
            selected_from_type = params_arr["target_type"];
        }
        if (selected_from_id != "" && selected_from_type != "") {
            request.send("from_id="+selected_from_id+"&from_type="+selected_from_type+"&to_id="+user_id+"&to_type="+user_type);
        }
        
    }
    function select_chat() {
       
        //Display the send message bar if a chat is selected
        document.getElementById("input_msg_write").setAttribute("class", "input_msg_write");
        //Need to take note of which user is selected for the rightsidebar to display the messages         
        //Highlights the chat with grey background and show the messages to that particular user/company
        chat_lists = document.getElementsByClassName("chat_list");
        //Remove the grey background of all chat
        for (chat_list of chat_lists) { 
            chat_list.setAttribute("class", "chat_list");
        }
        target_element = event.target;
        //The user might select any of the inner chat message body elements, such as the picture. Hence, we need to loop through
        //its parents until we get the main outside chat body
        while (target_element.getAttribute("class") != "chat_list") {
            target_element = target_element.parentNode;
        }
        target_element.setAttribute("class", "chat_list active_chat");        
        selected_id_arr = target_element.getAttribute("id").split(",");
        selected_from_id = selected_id_arr[0];
        selected_from_type = selected_id_arr[1];
        sessionStorage.setItem("selected_from_id", selected_from_id);
        sessionStorage.setItem("selected_from_type", selected_from_type);
        window.scroll_down = "true";
        //Update the right side chat bar
        update_selected_messages();

    }
    function parseURLParams(url) {
        //Works similar to $_GET, retrieve parameters from the url
        var queryStart = url.indexOf("?") + 1,
            queryEnd   = url.indexOf("#") + 1 || url.length + 1,
            query = url.slice(queryStart, queryEnd - 1),
            pairs = query.replace(/\+/g, " ").split("&"),
            parms = {}, i, n, v, nv;

        if (query === url || query === "") return;

        for (i = 0; i < pairs.length; i++) {
            nv = pairs[i].split("=", 2);
            n = decodeURIComponent(nv[0]);
            v = decodeURIComponent(nv[1]);

            if (!parms.hasOwnProperty(n)) parms[n] = [];
            parms[n].push(nv.length === 2 ? v : null);
        }
        return parms;
    }
    // Execute a function when the user releases a key on the keyboard => Main purpose is to send message when enter key is pressed
    document.getElementById("sent_message").addEventListener("keyup", function(event) {
        // Number 13 is the "Enter" key on the keyboard
        if (event.keyCode === 13) {
            send_message();
        }
    });
    function send_message() {
        //Scrolls down to the end of message
        window.scroll_down = "true";
        //Retrieves the chat message sent
        body = document.getElementById("sent_message").value;
        if (body != "") {
            var request = new XMLHttpRequest();  
            request.onreadystatechange = function() {    
                
                if (this.readyState == 4 && this.status == 200) {
                    //Add check for success here?            
                    status = this.responseText;
                    console.log(status);          
                    //Update the messages displayed to show the sent message
                    //Update the right side chat bar
                    update_selected_messages();
                    update_selected_messages_leftbar();
                }  
            };  
            request.open('POST', 'send_message.php', true);
            request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded'); 
            //$body, $date, $from_id, $from_type, $seen, $time, $to_id, $to_type, $type
            //Get today date and time in sql format yyyy-mm-dd hh:mm:ss
            var d = new Date();
            var month = d.getMonth() + 1;
            var day = d.getDate() ;
            var year = d.getFullYear();
            var seconds = d.getSeconds();
            var minutes = d.getMinutes();
            var hour = d.getHours();
            var sent_datetime = year + "-" + month + "-" + day + " " + hour + ":" + minutes + ":" +seconds;
            //Get the user_id and user_type from the current url
            var params_arr = parseURLParams(window.location.href);
            var user_id = params_arr["user_id"];
            var user_type = params_arr["user_type"];        
            selected_from_id = sessionStorage.getItem("selected_from_id");
            selected_from_type = sessionStorage.getItem("selected_from_type");
            request.send("body=" +body+ "&date="+sent_datetime+ "&from_id="+user_id+ "&from_type="+user_type+ "&seen="+"false"+ "&time="+""+ "&to_id="+selected_from_id+ "&to_type="+selected_from_type+ "&type="+ "");              
        }
        //Empty the input box
        document.getElementById("sent_message").value = "";

      
    }

     // change active navbar
     $(document).ready(function(){
        $(".active").removeClass("active");
        $("#link-inbox").addClass("active");
    }); 
var checkbottom = "hi";
jQuery(function($) {
$('.msg_history').on('scroll', function() {
    var check = $(this).scrollTop() + $(this).innerHeight() >= $(this) 
[0].scrollHeight;
    if(check) {
       checkbottom = "bottom";
    }
    else {
    checkbottom = "nobottom";
    }
})
});
window.setInterval(function(){
if (checkbottom=="bottom") {
    //Scrolls down only if the user is already at the bottom when new messages arrive
    var element = document.getElementsByClassName("msg_history")[0];
    element.scrollTop = element.scrollHeight;
}
}, 100);
</script>
<!-- Footer -->
<?php include 'include/footer.php';?>
</body>
</html>