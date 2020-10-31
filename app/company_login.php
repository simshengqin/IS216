
<?php
  require_once 'include/common.php';
?>
<!DOCTYPE html>
<html style="padding: 0px 0px 0px 0px">
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
    <body style="padding: 0px 0px 0px 0px">
        <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-6 background-login-img"></div>
            <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                <div class="row">
                    <div class="col-md-9 col-lg-8 mx-auto">
                    <img class="d-flex justify-content-center" src="images/profile_picture/user/default.png" style="height:400px; width:460px;">
                    <h3 class="login-heading mb-4">Company Sign In</h3>
                    <form id="loginForm">
                        <div class="label-form-cluster">
                        <input id="name" class="form-control" placeholder="Name" required autofocus>
                        <label for="inputEmail">Company Name</label>
                        </div>
                        <div class="label-form-cluster">
                        <input type="password" id="password" class="form-control" placeholder="Password" required>
                        <label for="inputPassword">Password</label>
                        </div>
                        <button id="login" class="btn btn-lg btn-primary btn-block btn-register text-uppercase font-weight-bold mb-2" type="submit">Sign in</button>
                        <div class="text-center">
                        <br> 
                       
                    
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
          <div class='modal fade' id="login-error" tabindex='-1' role='dialog' aria-labelledby="server-error" aria-hidden="true">
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title'>Error</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                <div class='modal-body'>
                    <p>Please enter the correct credentials</p>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-success' data-dismiss='modal'>Close</button>
                </div>
                </div>
            </div>
        </div>
        </div>
        <script>
            $(function() {
                $("#login").click(function(e){
                    var name = $("#name").val();
                    var password = $("#password").val();
                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "company_jslogin.php",
                        data: {name:name, password:password},
                        success:function(data){
                            if( $.trim(data) === "1" ){
                                sessionStorage.setItem('name', data['name']);
                                sessionStorage.setItem('password', data['password']);
              
                                setTimeout( 'window.location.href = "index.php"', 1000)
                            } else {
                                $("#login-error").modal('show');
                    
                            }
                        },
                        error:function(data){
                            alert("there were trouble!");
                        }
                    });
                })
            
            });
        </script>
    </body>

</html>