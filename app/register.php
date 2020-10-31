<?php
  require_once 'include/common.php';
  require_once 'include/protect.php';
?>
<!DOCTYPE html>
<html style="padding: 0px 0px 0px 0px">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>REGISTRATION PAGE FOR USER</title>

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
        <?php
            if(isset($_POST['submit'])) {

                    $name              =$_POST['name'];
                    $email             =$_POST['email'];
                    $phoneNumber       =$_POST['phoneNumber'];
                    $password          =$_POST['password'];
                    $cart              ="";
                    $cart_company_id   =1;
                    $prefer            =$_POST['preferances'];
                    $preferances       ="";
                    if( in_array("halal", $prefer)){
                        $preferances = $preferances . "true" . ",";
                    } else {
                         $preferances . "false" . ",";
                    }

                     if( in_array("vegetarian", $prefer)){
                        $preferances = $preferances . "true" . ",";
                    } else {
                         $preferances . "false" . ",";
                    }

                    $end = end($prefer);

                    $preferances = $preferances . $end ;
    

                    $userDAO = new userDAO();
                    $result = $userDAO->add( $password, $name, $email, $phoneNumber, $cart, $cart_company_id, $preferances );

                    
            } 
        ?>
        <div class="container-fluid">
        <div class="row no-gutter">
            <div class="d-none d-md-flex col-md-4 col-lg-8 background-img"></div>
            <div class="col-md-8 col-lg-4">
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
                        <br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="preferances[]" id="prefer1" value="halal" >
                            <label class="form-check-label" for="gender1">Halal</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="checkbox" name="preferances[]" id="prefer2" value="vegetarian" >
                            <label class="form-check-label" for="gender2">Vegetarian</label>
                        </div>   
                        <br>
                        <br>
                         <div class="form-group right">
                            <label for="experience" class="label-title">Within a proximity range from current location</label>
                            <input type="range" min="1" max="25" step="5" value="0" name="preferances[]" id="experience" class="form-input" onChange="change();" style="height: 28px; width: 78%; padding: 0;" />
                            <span id="range-label">1KM</span>
                        </div>
                        <div class="text-left">
                        <br>
                        </div>
                        <button id="register" name="submit" class="btn btn-lg btn-primary btn-block btn-register text-uppercase font-weight-bold mb-2" type="submit">Register</button>
                        <div class="text-center">
                        <br> 
                        <a class="medium font-weight-bold .text-secondary" href="../index.php">Back to login</a></div>
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
    </body>

       <!-- Script for range input label -->
    <script>
        var rangeLabel = document.getElementById("range-label");
        var experience = document.getElementById("experience");
        function change() {
        rangeLabel.innerText = experience.value + "K";
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script type="text/javascript" >
        $( '#register').click(function(e) {
            var valid = this.form.checkValidity();
            console.log("hi");
            if( valid ) {
                alert("success");
                Swal.fire({
                            "title" : "Successful",
                            "text": "Thank you for registering an account",
                            "type": "success",
                        })
                
                
            }    
        });
    </script>

</html>