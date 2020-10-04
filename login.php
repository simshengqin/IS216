<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>LOGIN PAGE FOR USER</title>

         <!-- Roboto Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
         <!--Link to main.css files while contains all the css of this project-->
        <link rel='stylesheet' href='css\maincss.css'>
        <body>
            <div class="container h-100">
                <div class="d-flex justify-content-center h-100">
                    <div class="user_card">
                        <div class="d-flex justify-content-center">
                            <div class="login_logo_container">
                                <img src="images/profile_picture/user/default.png" alt="">
                            </div>
                        </div>
                        <div class="d-flex justify-content-center form_container">
                            <form action="">
                                <div class="login_group mb-3">
                                    <div class="login_inputs">
                                        <span class="form_input"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" name="email" id="email" class="user_input" required>
                                </div>
                                <div class="login_group mb-3">
                                    <div class="login_inputs">
                                        <span class="form_input"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" name="password" id="password" class="user_input" required>
                                </div>
                                <div class="login_group">
                                    <div class="checkbox_group">
                                        <input type="checkbox" name="Remember Me" class="custom_checkbox" id="custom_checkbox">
                                        <label for="custom_checkbox" class="custom_label_checkbox">Remember Me</label>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="d-flex justify-content-center mt-3 login-container">
                            <button type="button" name="button" id="login" class="login_button">Login</button>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex justify-content-center register">
                                Don't have an account? <a href="registration.php" class="ml-2"> Sign Up</a>
                            </div>
                            <div class="d-flex justify-content-center ">
                                <a href="registration.php" class="ml-2">Forget your password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(function(){
                    $("#login").click(function(e){
                        var valid = this.form.checkValidity();

                        if( valid ){
                            var email = $("#email").val();
                            var password = $("#password").val();
                        }

                        e.preventDefault();

                        $.ajax({
                            type: "POST",
                            url: "login.php",
                            data: {email: email, password: password},
                            success: function(data){
                                alert("success")
                            },
                            error: function(data) {
                                alert("Error");
                            }
                        })
                    });
                });
            </script>
        </body>
    </head>
</html>