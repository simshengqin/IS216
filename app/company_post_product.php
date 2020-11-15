<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';
    header("Access-Control-Allow-Origin: *");

    $companyDAO = new companyDAO();
    $productDAO = new productDAO();

    $newProductId = count($productDAO->retrieve_all(false));
    
    if(isset($_SESSION["company_id"])){
      $company_id = $_SESSION["company_id"];
    } else {
      header("Location: company_login.php");
      exit();
    }
    

    $productType = $productDAO->retrieve_unique_categories_by_company_id($company_id);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Post Product</title>
  <link rel="icon" href="images/logo/favicon.png">;
  <!-- Roboto Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
  <!--Bootstrap 4 and AJAX-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <!--Link to main.css files while contains all the css of this project-->
  <link rel='stylesheet' href='css\maincss.css'>
</head>


<body>



    

  <?php include 'include/company_navbar.php';?>
  <!--Company profile  -->
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">

        <h1 class="font-weight-light text-center"> Create Promotion </h1>
        </br>

        <form method='POST' action='company_post_product_transition.php' enctype='multipart/form-data'>
            <div class="form-row">
                    <!-- Product Name -->
                
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input class="form-control form-control-lg" id="productName" name="productName" type="text" placeholder="Product Name">
                        <p id='errorProductName' class="error_msg" style='visibility: hidden; color: red;'> </p>
                    </div> 

                    <!-- Product Type -->
                    <div class="form-group col-md-3" style="margin-bottom: -10px;">
                        <select class="form-control form-control-lg inline" id="productType" name="productType">
                            <option disabled selected value=""> Select Product's type </option>
                            <?php
                                
                                foreach($productType as $type){
                                  echo "<option value='".ucfirst(str_replace('_', ' ', $type))."'> ".ucfirst(str_replace('_', ' ', $type))." </option>";
                                }
                            ?>
                        </select>
                        <p id='errorProductType' class="error_msg" style='visibility: hidden; color: red;'>  </p>
                    </div>
                 
                    <div class="form-group col-md-3" style="margin-bottom: 20px;">
                      <button type="button" class="btn btn-info btn-lg"  data-toggle="modal" data-target="#foodTypeModal" style="left: 0%;">  New Product Type </button> 
                    </div> 

                    <!-- Qty -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input class="form-control form-control-lg" id="productQuantity" name="productQuantity" type="number" placeholder="Quantity">
                        <p id='errorQuantity'class="error_msg"  style='visibility: hidden; color: red;'>  </p>
                    </div>

                    <!-- Mode of Collection -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <select class="form-control form-control-lg" id="modeOfCollection" name="modeOfCollection">
                  
                            <option selected value="selfcollect"> Self-Collect Only</option>
                           
                        </select>
                        <p id='errorCollection'class="error_msg"  style='visibility: hidden; color: red;'>  </p>
                    </div>


                    <!-- Before Price -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input type="number" step="0.01" id="beforePrice" name="beforePrice" class="form-control form-control-lg" placeholder="Price Before: $0.00"> 
                        <p id='errorBeforePrice'class="error_msg"  style='visibility: hidden; color: red;'>  </p> 
                    </div>
                    

                    <!-- After Price -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input type="number" step="0.01" id="afterPrice" name="afterPrice" class="form-control form-control-lg" placeholder="Price Discounted: $0.00"> 
                        <p id='errorAfterPrice'class="error_msg"  style='visibility: hidden; color: red;'>  </p> 
                    </div>
                    

                    <!-- Upload Image -->
                    <div class="form-group col-md-6" style="margin-top: 50px;">
                        <div class="form-group">
                            <label for="productImageUpload">Select Image to upload ( jpg / jpeg image files only )</label>
                            <input type="file" accept="image/jpeg,image/jpg" class="form-control-file form-control-lg" id="productImageUpload" name="productImageUpload">
                        </div>
                        <p id='errorProductImageUpload'class="error_msg"  style='visibility: hidden; color: red;'>  </p>  
                    </div>

                    <div class="form-group col-md-6">
                        <!-- empty -->
                    </div>

                    <!-- promotion end date -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        
                        <span> Promotional End Date</span>
                        <input id="dateInput" class="form-control form-control-lg datepicker" name="dateInput" type="date" min="2000-01-01" max="2100-12-31"> 
                        <p id='errorPromotionEndDate'class="error_msg"  style='visibility: hidden; color: red;'>  </p>
                    </div>

                    <div class="form-group col-md-6">
                        <!-- empty -->
                        <input type="hidden" id="company_id" name="company_id" >
                        <input type="hidden" id="posted_date" name="posted_date">
                        <input type="hidden" id="posted_time" name="posted_time">
                        <input type="hidden" id="image_path_source" name="image_path_source">
                        <input type="hidden" id="image_Name" name="image_Name">
                    </div>

                    <!-- promotion end time -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <span> Promotional End Time</span>
                        <input id="timeInput" class="form-control form-control-lg" name="timeInput" type="time" min="00:00:00" max="23:59:59">
                        <p id='errorPromotionEndTime'class="error_msg"  style='visibility: hidden; color: red;'>  </p>
                    </div>

                    <div class="form-group col-md-12" style="margin-top: 25px;">
                          <!-- empty -->
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info btn-lg btn-block" style="left: 0%;" onclick='return validate()'> Add Promotion </button>
                    </diV>
             </div>
        </form>
        </div>
        
    </div>


    <div id="modalContainer">
            <!-- Confirm Delete Modal  -->
            <div class="modal fade" id="foodTypeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
              <!-- modal header -->
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle"> Add to the list! </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <!-- End of modal header -->
                <!-- modal body -->
                <div class="modal-body">
                  <input class="form-control form-control-lg" id="newFoodType" type="text" placeholder="E.g. Pasta, Noodles or Bread">
                  <p id='errorNewFoodType'class="error_msg"  style='visibility: hidden; color: red;'> Please specify a food type! </p>
                </div>
                <!-- End of modal body -->
                <!-- modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="addNewType()" style="left: 0%;"> Add </button>
                      &nbsp
                      &nbsp
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="left: 0%;">Close</button>
                </div>
                <!-- End of modal footer -->
              </div>
            </div>
          </div>
          <!-- End of Confirm Delete Modal  -->
    </div>

    <footer>

        <?php include 'include/footer.php';?> 

    </footer>

  </body>


  <script>

    
      
      var singaporeDateUnmodified = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"}).split(',')[0];
      var singaporeTimeUnmodified = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"}).split(',')[1];
      
      var singaporeDate = "";
      singaporeDate += singaporeDateUnmodified.split('/')[2]; // Year
      singaporeDate += "-";                         
      singaporeDate += singaporeDateUnmodified.split('/')[0]; // Month
      singaporeDate += "-";   
      singaporeDate += singaporeDateUnmodified.split('/')[1]; // Date
      
     

      var tempTime = singaporeTimeUnmodified.split(' ')[1];
      var hourClock = singaporeTimeUnmodified.split(' ')[2];

      var singaporeTime = tempTime; // if time is before PM

      if(hourClock == "PM"){
          var tempHour = tempTime.split(':')[0];
          tempHour = parseInt(tempHour) + 12; // convert to 24 hour clock
          var tempMin = tempTime.split(':')[1];
          var tempSecond = tempTime.split(':')[2];
          singaporeTime = tempHour + ":" + tempMin + ":" + tempSecond;
      } 
      
      console.log("Singapore Time: " + singaporeTime);
      console.log("Singapore Time: " + singaporeDate);

      document.getElementById("dateInput").setAttribute('min', singaporeDate);

      
      function addNewType(){

        var newItem = document.getElementById('newFoodType').value
        
        if(newItem==""){
          document.getElementById("errorNewFoodType").style.visibility = "visible";
        } else {
          document.getElementById("errorNewFoodType").style.visibility = "hidden";
          var element = document.getElementById('productType'); 
          var node = document.createElement("OPTION"); 
          var textnode = document.createTextNode(newItem);
          node.appendChild(textnode);
          newItem = newItem.replace(/\s/g, '_')
          node.setAttribute("value", newItem);
          element.appendChild(node)
          $('#foodTypeModal').modal('hide');
          $(document.body).removeClass('modal-open');
          $('.modal-backdrop').remove();
          $('#foodTypeModal').remove();
          $('#foodTypeModal').removeData();
          $('#foodTypeModal').add();
          recreateFoodTypeModal();
        }
      }

      function validate(){
        
        var data = {};
        var noError = true;
        var noErrorBefore = false; 
        var noErrorDate = false;

        var productName = document.getElementById('productName').value;
        var productType = document.getElementById('productType').value;
        var productQty = document.getElementById('productQuantity').value;
        var productModeOfCollection = document.getElementById('modeOfCollection').value;
        var productBeforePrice = parseFloat(document.getElementById('beforePrice').value);
        var productAfterPrice = parseFloat(document.getElementById('afterPrice').value);
  
        var productImagePathSource = document.getElementById('productImageUpload').value; // Get the file path 
   
   
        var productImage = "";
        if(productImagePathSource!=""){
          productImage = document.getElementById('productImageUpload').files[0].name; // Get the file name
        }

        var productDateInput = document.getElementById('dateInput').value;
        var productTimeInput = document.getElementById('timeInput').value;

        // Singapore Current Datetime
        var singaporeDateUnmodified = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"}).split(',')[0];
        var singaporeDate = "";
        singaporeDate += singaporeDateUnmodified.split('/')[2]; // Year
        singaporeDate += "-";                         
        singaporeDate += singaporeDateUnmodified.split('/')[0]; // Month
        singaporeDate += "-";   
        singaporeDate += singaporeDateUnmodified.split('/')[1]; // Date

        var currentDate = new Date(singaporeDate);
        var inputDate = new Date(productDateInput);

        //reset all error messages
        all_error_msg = document.getElementsByClassName("error_msg");
        for (error_msg of all_error_msg) {
            error_msg.setAttribute('visibility', 'hidden; color: red;');
        }
        // validate product name 
        if(productName==""){
          document.getElementById("errorProductName").innerHTML = "Please specify a Product Name.";
          document.getElementById("errorProductName").style.visibility = "visible";
          noError = false;
        } else {
         
          document.getElementById("errorProductName").style.visibility = "hidden";
        }

        // validate product type 
        if(productType==""){
          document.getElementById("errorProductType").innerHTML = "Please select a type.";
          document.getElementById("errorProductType").style.visibility = "visible";
          noError = false;
        } else {
          data["productType"] = productType;
          document.getElementById("errorProductType").style.visibility = "hidden";
        }

        // validate product Qty 
        if(productQty==""){
          document.getElementById("errorQuantity").innerHTML = "Please input quantity.";
          document.getElementById("errorQuantity").style.visibility = "visible";
          noError = false;
        } else if (productQty < 1){
          document.getElementById("errorQuantity").innerHTML = "Please input a valid quantity, quantity needs to be above 0.";
          document.getElementById("errorQuantity").style.visibility = "visible";
          noError = false;
        } else {
         
          document.getElementById("errorQuantity").style.visibility = "hidden";
        }

        // validate Mode Of Collection 
        if(productModeOfCollection==""){
          document.getElementById("errorCollection").innerHTML = "Please select collection mode.";
          document.getElementById("errorCollection").style.visibility = "visible";
          noError = false;
        } else {
          
          document.getElementById("errorCollection").style.visibility = "hidden";
        }

        // validate before price
        if(document.getElementById('beforePrice').value==""){
          document.getElementById("errorBeforePrice").innerHTML = "Please indicate a price.";
          document.getElementById("errorBeforePrice").style.visibility = "visible";
          noError = false;
        } else if(productBeforePrice < 0.001 ) {
          document.getElementById("errorBeforePrice").innerHTML = "Please input a valid price, price needs to be above $0.00";
          document.getElementById("errorBeforePrice").style.visibility = "visible";
          noError = false;
        } else{
          
          document.getElementById("errorBeforePrice").style.visibility = "hidden";
          noErrorBefore = true;
        }

        // validate After Price 
        if(document.getElementById('afterPrice').value==""){
          document.getElementById("errorAfterPrice").innerHTML = "Please indicate a price.";
          document.getElementById("errorAfterPrice").style.visibility = "visible";
          noError = false;
        } else if(productAfterPrice < 0.001 ){
          document.getElementById("errorAfterPrice").innerHTML = "Please input a valid price, price needs to be above $0.00";
          document.getElementById("errorAfterPrice").style.visibility = "visible";
          noError = false;
        } else if (noErrorBefore == true) {
            if(productBeforePrice < productAfterPrice){
              document.getElementById("errorAfterPrice").innerHTML = "Please input a price lower than the before price";
              document.getElementById("errorAfterPrice").style.visibility = "visible";
              noError = false;
            }
        }else {
          
          document.getElementById("errorAfterPrice").style.visibility = "hidden";
        }

        // validate image upload
        if(productImage==""){
          // Check if the value is not empty
          document.getElementById("errorProductImageUpload").innerHTML = "Please insert an image file with correct file extension."
          document.getElementById("errorProductImageUpload").style.visibility = "visible";
          noError = false;
        } else {
          // Check image file extension, only allow jpg or jpeg formats 
          checkFileextension = productImage.split(".")
          if(checkFileextension.slice(-1)[0] == "jpg" || checkFileextension.slice(-1)[0] == "jpeg"){
            data["productImage"] = productImage; // To get the filename
            document.getElementById("errorProductImageUpload").style.visibility = "hidden";
          } else {
            document.getElementById("errorProductImageUpload").innerHTML = "Please upload an jpg / jpeg file image only."
            document.getElementById("errorProductImageUpload").style.visibility = "visible";
            noError = false;
          }
        }

        // validate promotion end date
        if(productDateInput==""){
          document.getElementById("errorPromotionEndDate").innerHTML = "Please indicate a promotion end date."
          document.getElementById("errorPromotionEndDate").style.visibility = "visible";
          noError = false;
        } else {
          //data["decay_date"] = productDateInput;
          document.getElementById("errorPromotionEndDate").style.visibility = "hidden";
          noErrorDate = true;
        }

        // validate promotion end date
        if(productTimeInput==""){
          document.getElementById("errorPromotionEndTime").innerHTML = "Please indicate a promotion end time."
          document.getElementById("errorPromotionEndTime").style.visibility = "visible";
          noError = false;
        } else if(noErrorDate == true){
          var noErrorTime = checkIfDateTimeExpired(productDateInput,productTimeInput) 
          console.log("No Error Time: " + noErrorTime)
          if(noErrorTime == false){
            document.getElementById("errorPromotionEndDate").innerHTML = "Please indicate a promotion end date, with a later end date"
            document.getElementById("errorPromotionEndTime").innerHTML = "Please indicate a promotion end time, with a later end time";
            document.getElementById("errorPromotionEndTime").style.visibility = "visible";
            document.getElementById("errorPromotionEndDate").style.visibility = "visible";
            noError = false;
          } else {
            document.getElementById("errorPromotionEndTime").style.visibility = "hidden";
            document.getElementById("errorPromotionEndDate").style.visibility = "hidden";
          }
        }
        
        document.getElementById("company_id").value = <?php echo $company_id ?>;
        document.getElementById("posted_date").value = singaporeDate;
        document.getElementById("posted_time").value = singaporeTime;
        document.getElementById("image_path_source").value = productImagePathSource;
        document.getElementById("image_path_source").value = productImage;

        

        if(noError){
          //processToServer(data)
          console.log("Sent");
          return true;
        } else {
          console.log("Did not sent");
          return false;
        }

      }
      

      function checkIfDateTimeExpired(date,time){
        console.log(date);
        console.log(time);
        // date
        var year = date.split("-")[0];
        var month = date.split("-")[1];
        var day = date.split("-")[2];
        // time
        var hour = time.split(":")[0];
        var min = time.split(":")[1];
        var sec = "00";
        
        var postDateTime = " " + month + " " + day + ", " + year + " " + hour + ":" + min + ":" + sec + "";
        var checkPostDateTime = new Date(postDateTime).getTime();
        var now = new Date().getTime();
        var timeRemaining =  checkPostDateTime - now;
        console.log(timeRemaining);
        
        if(timeRemaining < 0){
          return false;
        } else {
          return true;
        }
        return false;
      }

      function recreateFoodTypeModal(){
        $("#modalContainer").append(
          "<div class='modal fade' id='foodTypeModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalCenterTitle' aria-hidden='true'>" +
            "<div class='modal-dialog modal-dialog-centered' role='document'>" + 
              "<div class='modal-content'>" + 

              "<div class='modal-header'>" +
                "<h5 class='modal-title' id='exampleModalLongTitle'> Add to the list! </h5>" +
                "<button type='button' class='close' data-dismiss='modal' aria-label='Close'> <span aria-hidden='true'>&times;</span> </button>" +
              "</div>" +

              "<div class='modal-body'> <input class='form-control form-control-lg' id='newFoodType' type='text' placeholder='E.g. Pasta, Noodles or Bread'>" +
                "<p id='errorNewFoodType'class='error_msg'  style='visibility: hidden; color: red;'> Please specify a food type! </p>" +
              "</div>" +

              "<div class='modal-footer'>" +
                "<button type='button' class='btn btn-info' onclick='addNewType()' style='left: 0%;'> Add </button>" + 
                "&nbsp" + 
                "&nbsp" + 
                "<button type='button' class='btn btn-secondary' data-dismiss='modal' style='left: 0%;'>Close</button>" +
              "</div>" +

              "</div>" +
            "</div>" +
          "</div>" 
        );
      }

  </script>

</html>


