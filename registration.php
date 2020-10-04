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
        <title>REGISTRATION PAGE FOR USER</title>

         <!-- Roboto Font -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!--Link to main.css files while contains all the css of this project-->
         <link rel='stylesheet' href='css\maincss.css'>
    </head>

    <body>
        <div>
            <?php
                if(isset($_POST['submitted'])) {

                        $name              =$_POST['name'];
                        $school            =$_POST['school'];
                        $email             =$_POST['email'];
                        $phoneNumber       =$_POST['phoneNumber'];
                        $password          = sha1($_POST['password']);
                        $reEnterPassword   =$_POST['reEnterPassword'];
                        $edollar           = 0;
                        $cart              ="";

                        $userDAO = new userDAO();
                        $result = $userDAO->add( $password, $name, $school, $edollar, $email, $phoneNumber, $cart );
                        if( $result ){
                            echo "saved";
                        } else {
                            echo "error";
                        }
                       
                }
            ?>
        </div>

        <div>
            <form action="registration.php" method="post">
                <div class="container">
                    <div class="col-sm-3">
                        <h1>CREATE ACCOUNT</h1>
                        <hr class = "mb-4">

                        <label for="name"><b>Name</b></label>
                        <br>
                        <input class="form_control" type="text" name="name" required>
                        <br>
                        <label for="school"><b>School</b></label>
                        <br>
                        <input class="form_control" type="text" name="school" required>
                        <br>
                        <label for="email"><b>Email</b></label><br>
                        <input class="form_control" type="email" name="email" required>

                        <label for="phoneNumber"><b>Phone Number</b></label>
                        <input class="form_control" type="text" name="phoneNumber" required>

                        <label for="password"><b>Password</b></label>
                        <input class="form_control" type="password" name="password" required>

                        <label for="reEnterPassword"><b>re-enter Password</b></label>
                        <input class="form_control" type="password" name="reEnterPassword" required>

                        <hr class = "mb-4">
                        <input class="btn btn-primary" type="submit" name="submitted" id="register" value="Register">
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
                    <script type="text/javascript" >
                        $( '#register').click(function(e) {

                            var valid = this.form.checkValidity();
                            
                            if( valid ) {
                                var name = $("#name").val();
                                var school = $("school").val();
                                var email = $("email").val();
                                var phoneNumber = $("phoneNumber").val();
                                var password = $("password").val();
                                var reEnterPassword = $("reEnterPassword").val();

                                e.preventDefault();

                                $.ajax({
                                    type: "POST",
                                    url: "Registration.php" ,
                                    data : { name: name, school:school, email: email, phoneNumber: phoneNumber, password: password, reEnterPassword: reEnterPassword},
                                    success: function( data ) {
                                        Swal.fire({
                                                    "title" : "Successful",
                                                    "text": "Thank you for registering an account",
                                                    "type": "success",
                                                })
                                     },
                                error: function( data ) {
                                    Swal.fire({
                                                    "title" : "Errors",
                                                    "text": "",
                                                    "type": "success",
                                                })
                                    }   
                                });
                            } else {
                                Swal.fire({
                                    "title" : "Errors",
                                    "text": "Please Enter Your Fields",
                                    "type": "success",
                                })
                            }
                            //alert( "hello" );
                            
                        });
                    </script>

                   
                </div>
            </form>
        </div>
    </body>

</html>

