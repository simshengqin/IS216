<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>LOGIN PAGE FOR USER</title>

         <!-- Roboto Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
        <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!--Link to main.css files while contains all the css of this project-->
        <link rel='stylesheet' href='css\maincss.css'>
    </head>
    <body>
        <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 background-login-img"></div>
            <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8 mx-auto">
                    <img class="d-flex justify-content-center" src="images/logo/android-chrome-192x192.png" style="height:200px; width:450px;">
                    <h3 class="login-heading mb-4">User Sign In</h3>
                    <form id="loginForm">
                        <div class="label-form-cluster">
                        <input id="username" class="form-control" placeholder="Username" required autofocus>
                        <label for="inputEmail">Email</label>
                        </div>
                        <div class="label-form-cluster">
                        <input type="password" id="password" class="form-control" placeholder="Password" required>
                        <label for="inputPassword">Password</label>
                        </div>
                        <button class="btn btn-lg btn-primary btn-block btn-register text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
                        <div class="text-center">
                        <br> 
                        <a class="medium font-weight-bold .text-secondary" href="patient/register.php">Register new account</a>
                        <hr>
                        <a class="medium font-weight-bold .text-secondary" href="doctor/doctorLogin.php">Doctor Portal</a>
                        </div>
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
        </div>
    </body>

</html>