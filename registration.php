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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <!--Link to main.css files while contains all the css of this project-->
        <link rel='stylesheet' href='css\maincss.css'>
    </head>

    <body>
        <div>
            <?php
                if(isset($_POST['submit'])) {

                        $name              =$_POST['name'];
                        $email             =$_POST['email'];
                        $phoneNumber       =$_POST['phoneNumber'];
                        $password          =$_POST['password'];
                        $reEnterPassword   =$_POST['reEnterPassword'];
                        $cart              ="";
                        if(!isset($_POST['preferances'])){
                            $preferances = "";
                            $userDAO = new userDAO();
                            $result = $userDAO->add( $password, $name, $email, $phoneNumber, $cart, $preferances );
                            if($result){
                                echo"hi";
                            }
                        } else {
                            $preferances = $_POST['preferances'];
                            $userDAO = new userDAO();
                            $result = $userDAO->add( $password, $name, $email, $phoneNumber, $cart, $preferances );
                             if($result){
                                echo"hi";
                            }
                        }
                        
                        
                       
                } 
            
            ?>
        </div>

        <div>
            <form action="registration.php" method="post" name="myform">
                
                <div class="container"> 

                    <!--form header-->
                    <div id="form-header" class="form-header">
                        <h1>CREATE ACCOUNT</h1>
                    </div>

                    <div class="form-body">
                        <div class="horizontal-group">
                            <div class="form-group left"> 
                                <label for="name" class="label-title"><b>Name*</b></label>
                                <input class="form-input" type="text" name="name" required>
                            </div>
                            <div class="form-group right">
                               <label for="phoneNumber" class="label-title"><b>Phone Number</b></label>
                                <input class="form-input" type="text" name="phoneNumber" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="label-title">Email</label>
                            <input class="form-input" type="email" name="email" required>
                        </div>
                        <div class="horizontal-group">
                            <div class="form-group left">
                                <label for="password" class="label-title"><b>Password</b></label>
                                <input class="form-input" type="password" name="password" required>
                            </div>
                            <div class="form-group right">
                                <label for="reEnterPassword" class="label-title"><b>re-enter Password</b></label>
                                <input class="form-input" type="password" name="reEnterPassword" required><br>
                            </div>
                        </div>
                        <div class="horizontal-group">
                            <div class="form-group left">
                                <label for="prefer" class="label-title"><b>Preferances</b></label><br><br>
                                <input  type="checkbox" id="vegetarian" value="vegetarian" name="preferance[]" >
                                <label for="vegetarian">Vegetarian</label><br><br>
                                <input  type="checkbox" id="halal" value="halal" name="preferance[]">
                                <label for="halal">Halal</label>
                            </div>
                            <div class="form-group right">
                                    <label for="experience" class="label-title">Within a proximity range from current location</label>
                                    <input type="range" min="1" max="25" step="5" value="0" id="experience" class="form-input" onChange="change();" style="height: 28px; width: 78%; padding: 0;" />
                                    <span id="range-label">1KM</span>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-footer">
                            <input class="btn btn-primary" type="submit" name="submit" id="register" value="submit">
                        </div>



                       
                        

                     

                        

                       

                

                    </div>

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
                                
                                
                            } else {
                                Swal.fire({
                                    "title" : "Errors",
                                    "text": "Please Enter Your Fields",
                                    "type": "success",
                                })
                            }   
                        });
                    </script>
                    <!-- Script for range input label -->
                    <script>
                    var rangeLabel = document.getElementById("range-label");
                    var experience = document.getElementById("experience");
                    function change() {
                    rangeLabel.innerText = experience.value + "K";
                    }
                    </script>

                   
                </div>
            </form>
        </div>
    </body>

</html>

