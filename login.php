<?php
    session_start();
    if(isset($_SESSION['login'])) {
        header("Location: registration.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE FOR USER</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>REGISTRATION PAGE FOR USER</title>

        <!-- Roboto Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!--Link to main.css files while contains all the css of this project-->
    <link rel='stylesheet' href='css\maincss.css'>
</head>
<body>
    <div class="container h-100">
        <div class="d-flex justify-content-center h-100">
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="images/profile_picture/user/default.png" class="brand_logo" >
                    </div>
                </div>	
                <div class="d-flex justify-content-center form_container">
                    <form>
                        <div class="input-group mb-3">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>					
                            </div>
                            <input type="text" name="username" id="username" class="form-control input_user" required>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>					
                            </div>
                            <input type="password" name="password" id="password" class="form-control input_pass" required>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="rememberme" class="custom-control-input" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                            </div>
                        </div>
                    
                </div>
                <div class="d-flex justify-content-center mt-3 login_container">
                    <button type="button" name="button" id="login" class="btn login_button">Login</button> 
                </div>
                </form>
                <div class="mt-4" >
                    <div class="d-flex justify-content-center user_input">
                        Don't have an account? 
                        <a href="registration.php" class="ml-2" style="color: black">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center" style="color: red">
                        <a href="#">Forgot your password?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(function() {
            $("#login").click(function(e){
                 var valid = this.form.checkValidity();
                 if(valid){
                    var username = $("#username").val();
                    var password = $("#password").val();
                   
                 } else{
                     Swal.fire({
                                    "title" : "Errors",
                                    "text": "Please Enter Your Fields",
                                    "type": "success",
                                })
                 }
                 
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "jslogin.php",
                    data: {username:username, password:password},
                    success:function(data){
                        if( $.trim(data) ===  "1" ) {
                            setTimeout('window.location.href = "registration.php"', 2000 )
        
                        } else {
                              Swal.fire({
                                    "title" : "Errors",
                                    "text": "Please Enter Your Credentials Correctly!",
                                    "type": "success",
                                })
                        }
                       
                    
                    },
                    error:function(data){
                    
                    }
                })
            })
           
        });
    </script>
    
</body>
</html>