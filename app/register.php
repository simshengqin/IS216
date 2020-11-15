<?php
  require_once 'include/common.php';
?>
<!DOCTYPE html>
<html style="padding: 0px 0px 0px 0px">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Register</title>

         <!-- Roboto Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <!-- Font Awesome -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!--Link to main.css files while contains all the css of this project-->
        <link rel='stylesheet' href='css\maincss.css'>
    </head>
    <body style="padding: 0px 0px 0px 0px">
        
        <?php
            if(isset($_POST['submit'])) {

                    $name              =$_POST['name'];
                    $email             =$_POST['email'];
                    $phoneNumber       =$_POST['phoneNumber'];
                    $password          =$_POST['password'];
                    $password          =password_hash($password, PASSWORD_BCRYPT);
                    $cart              ="";
                    $cart_company_id   =0;
                    $preferances       = $_POST['preferances'];
                  

                    $connMgr = new ConnectionManager();       
                    $conn = $connMgr->getConnection();
         
                    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
                   
                   $result = $stmt->execute([$email]); 
                   $count = $stmt->rowCount();
                    if ($stmt->rowCount() > 0) { ?>
                        <script type="text/javascript"> 
                            $(document).ready(function(){
                                $("#email-error").modal('show');
                                                           
                            });
                            console.log("hi");
                        </script>
                <?php
                    } else{    
                        $userDAO = new userDAO();
                        $result = $userDAO->add( $password, $name, $email, $phoneNumber, $cart, $cart_company_id, $preferances );?>
                         <script type="text/javascript"> 
                            $(document).ready(function(){
                                $("#success-register").modal('show');
                                                           
                            });
                            console.log("hi");
                        </script>
                <?php

                    }
                    
            } 
        ?>
        <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 background-img"></div>
            <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8 mx-auto">
                    <h3 class="login_header mb-4">Account Creation Portal</h3>
                    <form id="loginForm" method="post" action="register.php">
                        <div class="label-form-cluster">
                        <input name="name" id="name" class="form-control" placeholder="Please Enter Name*" required autofocus>
                        <label for="name">Full Name*</label>
                        </div>
                        <div class="label-form-cluster">
                        <input name="phoneNumber" id="phoneNumber" class="form-control" placeholder="Please enter phone number*" pattern = "([0-9]{1,8})" title="Must contain 8 digts and contain only numbers" required autofocus>
                        <label for="phoneNumber">Phone Number*</label>
                        </div>  
                        <div class="label-form-cluster">
                        <input name="email" id="email" class="form-control" placeholder="Please enter email*" type="email" title="Please Enter a valid email address" required autofocus>
                        <label for="email">Email*</label>
                        </div>
                        <div class="label-form-cluster">
                        <input name="password" type="password" id="password" class="form-control" placeholder="Please enter password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                        <label for="password">Password*</label>
                        </div>
                        <div class="text-left">
                        <hr>
                
                        <a class="medium .text-primary">Preferences:</a>
                        </div>
                     
                         <div class="form-group right">
                            <label for="experience" class="label-title">Within a proximity range from current location (Leave as 0 to not set a range)</label>
                            <br>
                            <input type="range" min="0" max="20000" step="5" value="0" name="preferances" id="experience" class="form-input" oninput="change();" style="height: 28px; width: 75%; padding: 0;" />
                            <span id="range-label">0m</span>
                        </div>
                        <div class="text-left">
                        <br>
                        </div>
                        <button id="register" name="submit" class="btn btn-lg btn-primary btn-block btn-register font-weight-bold mb-2" type="submit">Register</button>
                        <div class="text-center">
                        <br> 
                        <a class="medium font-weight-bold .text-secondary" href="user_login.php">Back to login</a></div>
                    </form>
                    <div class='text-center'>
                        <div class ="index-errormsg" style="background-color: #f8d7da; color: #8b3f46;">
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
         <div class='modal fade' id="email-error" tabindex='-1' role='dialog' aria-labelledby="server-error" aria-hidden="true">
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Error</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <p>Email is already taken</p>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-success' data-dismiss='modal'>Close</button>
                </div>
                </div>
            </div>
        </div>
         <div class='modal fade' id="success-register" tabindex='-1' role='dialog' aria-labelledby="server-error" aria-hidden="true">
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Success</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <p>Your account has been successfully created!</p>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-success' data-dismiss='modal' onclick="navigate_to_login()">Close</button>
                </div>
                </div>
            </div>
        </div>
    </body>

       <!-- Script for range input label -->
    <script>
        var rangeLabel = document.getElementById("range-label");
        var experience = document.getElementById("experience");
        function change() {
        rangeLabel.innerText = experience.value + "m";
        }
    </script>
    <script>
        function navigate_to_login(){
            setTimeout( 'window.location.href = "user_login.php"', 1000);
        }
    </script>

   

</html>