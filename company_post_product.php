<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';
    header("Access-Control-Allow-Origin: *");

    $companyDAO = new companyDAO();
    $productDAO = new productDAO();
    //$productType = $productDAO->retrieve_product_type();
    $newProductId = count($productDAO->retrieve_all());
    var_dump($newProductId);
    
    if (isset($_GET["company_id"])) {
        $company_id = $_GET["company_id"];    
    }
    else {
      $company_id = "1";
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

  <title>Eco</title>

  <!-- Bootstrap core CSS -->
  <link href="startbootstrap-business-frontpage-gh-pages/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="startbootstrap-business-frontpage-gh-pages/css/business-frontpage.css" rel="stylesheet">
  <!-- Roboto Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700&display=swap">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">

  <link rel="stylesheet" href="css/maincss.css">

</head>


<body>



<!-- Navigation Bar -->
<!--
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
    <a class="navbar-brand" href="mainpage.html">Eco</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active mr-4">
          <a class="nav-link" href="company_profile.php"> Dashboard </a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="company_post_product.php"> Post <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mr-4">
          <a class="nav-link" href="company_edit_product.php"> Edit </a>
        </li>
      </ul>
    </div>
    </div>
  </nav>
  -->
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
                        <p id='errorProductName' style='visibility: hidden; color: red;'> </p>
                    </div> 

                    <!-- Product Type -->
                    <div class="form-group col-md-5" style="margin-bottom: -10px;">
                        <select class="form-control form-control-lg inline" id="productType" name="productType">
                            <option disabled selected value=""> Select Product's type </option>
                            <?php
                                
                                foreach($productType as $type){
                                  echo "<option value='".$type."'> ".$type." </option>";
                                }
                                
                            ?>
                        </select>
                        <p id='errorProductType' style='visibility: hidden; color: red;'>  </p>
                    </div>
                   
                    <div class="form-group col-md-1" style="margin-bottom: 20px;">
                      <button type="button" class="btn btn-info btn-lg"  data-toggle="modal" data-target="#foodTypeModal" style="left: 0%;"> Add </button> 
                    </div>

                    <!-- Qty -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input class="form-control form-control-lg" id="productQuantity" name="productQuantity" type="number" placeholder="Quantity">
                        <p id='errorQuantity' style='visibility: hidden; color: red;'>  </p>
                    </div>

                    <!-- Mode of Collection -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <select class="form-control form-control-lg" id="modeOfCollection" name="modeOfCollection">
                            <!-- <option disabled selected value=""> Mode Of Collection</option> -->
                            <option selected value="selfcollect"> Self-Collect Only</option>
                            <!-- <option value="delivery"> Delivery Only</option> -->
                            <!-- <option value="both"> Self-Collect / Delivery </option> -->
                        </select>
                        <p id='errorCollection' style='visibility: hidden; color: red;'>  </p>
                    </div>


                    <!-- Before Price -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input type="double" id="beforePrice" name="beforePrice" class="form-control form-control-lg" placeholder="Price Before: $0.00"> 
                        <p id='errorBeforePrice' style='visibility: hidden; color: red;'>  </p> 
                    </div>
                    

                    <!-- After Price -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input type="double" id="afterPrice" name="afterPrice" class="form-control form-control-lg" placeholder="Price Discounted: $0.00"> 
                        <p id='errorAfterPrice' style='visibility: hidden; color: red;'>  </p> 
                    </div>
                    

                    <!-- Upload Image -->
                    <div class="form-group col-md-6" style="margin-top: 50px;">
                        <div class="form-group">
                            <label for="productImageUpload">Select Image to upload ( jpg / jpeg image files only )</label>
                            <input type="file" accept="image/jpeg,image/jpg" class="form-control-file form-control-lg" id="productImageUpload" name="productImageUpload">
                        </div>
                        <p id='errorProductImageUpload' style='visibility: hidden; color: red;'>  </p>  
                    </div>

                    <div class="form-group col-md-6">
                        <!-- empty -->
                    </div>

                    <!-- promotion end date -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <!-- <label for="dateInput" class="col-form-label"><h5>End Date: </h5></label> -->
                        <span> Promotional End Date</span>
                        <input id="dateInput" class="form-control form-control-lg datepicker" name="dateInput" type="date" placeholder="dd-mm-yyyy" min="2000-01-01" max="2100-12-31"> 
                        <p id='errorPromotionEndDate' style='visibility: hidden; color: red;'>  </p>
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
                        <p id='errorPromotionEndTime' style='visibility: hidden; color: red;'>  </p>
                    </div>

                    <div class="form-group col-md-12" style="margin-top: 25px;">
                          
                    </div>

                    <div class="col-md-6">
                        <button type="submit" class="btn btn-info btn-lg btn-block" style="left: 0%;" onclick='return validate()'> Add Promotion </button>
                    </diV>
             </div>
        </form>


        </div>
    </div>

    <!-- Modal for Adding new food type-->
            <div class="modal fade" id="foodTypeModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title"> Add to the list! </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form>
                  <div class="modal-body">
                      <input class="form-control form-control-lg" id="newFoodType" type="text" placeholder="What's New?">
                      <p id='errorNewFoodType' style='visibility: hidden; color: red;'> Please specify a food type! </p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-info" onclick="addNewType()" style="left: 0%;"> Add </button>
                    &nbsp
                    &nbsp
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="left: 0%;">Close</button>
                  </div>
                  </form>
                </div>
              </div>
            </div>

  <!-- Footer -->
  <footer class="py-5">
    <div class="container">
      <p class="text-center">Copyright &copy; Eco G5T4 2020</p>
    </div>
    <!-- /.container -->
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <script>

      //var asiaTime = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"}).split('T')[1];
      //console.log("Singapore time: " + asiaTime);
      
      var singaporeDateUnmodified = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"}).split(',')[0];
      var singaporeTimeUnmodified = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"}).split(',')[1];
      
      var singaporeDate = "";
      singaporeDate += singaporeDateUnmodified.split('/')[2]; // Year
      singaporeDate += "-";                         
      singaporeDate += singaporeDateUnmodified.split('/')[0]; // Month
      singaporeDate += "-";   
      singaporeDate += singaporeDateUnmodified.split('/')[1]; // Date
      
      //console.log("Singapore Date: " + singaporeDate);
      //console.log("Singapore Time (Unmodified): " + singaporeTimeUnmodified);

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
          $('#foodTypeModal').modal('hide');
          element.appendChild(node)
        }
      }

      function validate(){
        
        var data = {};
        var noError = true;

        var productName = document.getElementById('productName').value
        var productType = document.getElementById('productType').value
        var productQty = document.getElementById('productQuantity').value
        var productModeOfCollection = document.getElementById('modeOfCollection').value
        var productBeforePrice = document.getElementById('beforePrice').value
        var productAfterPrice = document.getElementById('afterPrice').value
        
        var productImagePathSource = document.getElementById('productImageUpload').value // Get the file path 
        console.log(productImagePathSource);
        //var productImagePathSource = document.getElementById("productImageUpload").files[0].path
        //console.log("Source path " + productImagePathSource);
        var productImage = "";
        if(productImagePathSource!=""){
          productImage = document.getElementById('productImageUpload').files[0].name // Get the file name
        }

        var productDateInput = document.getElementById('dateInput').value
        var productTimeInput = document.getElementById('timeInput').value


        // validate product name 
        if(productName==""){
          document.getElementById("errorProductName").innerHTML = "Please specify a Product Name."
          document.getElementById("errorProductName").style.visibility = "visible";
          noError = false;
        } else {
          //data["productName"] = productName;
          document.getElementById("errorProductName").style.visibility = "hidden";
        }

        // validate product type 
        if(productType==""){
          document.getElementById("errorProductType").innerHTML = "Please select a type."
          document.getElementById("errorProductType").style.visibility = "visible";
          noError = false;
        } else {
          data["productType"] = productType;
          document.getElementById("errorProductType").style.visibility = "hidden";
        }

        // validate product Qty 
        if(productQty==""){
          document.getElementById("errorQuantity").innerHTML = "Please input quantity."
          document.getElementById("errorQuantity").style.visibility = "visible";
          noError = false;
        } else if (productQty < 1){
          document.getElementById("errorQuantity").innerHTML = "Please input a valid quantity, quantity needs to be above 0.";
          document.getElementById("errorQuantity").style.visibility = "visible";
          noError = false;
        } else {
          //data["productQty"] = productQty;
          document.getElementById("errorQuantity").style.visibility = "hidden";
        }

        // validate Mode Of Collection 
        if(productModeOfCollection==""){
          document.getElementById("errorCollection").innerHTML = "Please select collection mode.";
          document.getElementById("errorCollection").style.visibility = "visible";
          noError = false;
        } else {
          //data["productModeOfCollection"] = productModeOfCollection;
          document.getElementById("errorCollection").style.visibility = "hidden";
        }

        // validate before price
        if(productBeforePrice==""){
          document.getElementById("errorBeforePrice").innerHTML = "Please indicate a price.";
          document.getElementById("errorBeforePrice").style.visibility = "visible";
          noError = false;
        } else if(productBeforePrice < 1) {
          document.getElementById("errorBeforePrice").innerHTML = "Please input a valid price, price needs to be above $0.00";
          document.getElementById("errorBeforePrice").style.visibility = "visible";
          noError = false;
        } else{
          //data["productBeforePrice"] = productBeforePrice;
          document.getElementById("errorBeforePrice").style.visibility = "hidden";
        }

        // validate After Price 
        if(productAfterPrice==""){
          document.getElementById("errorAfterPrice").innerHTML = "Please indicate a price.";
          document.getElementById("errorAfterPrice").style.visibility = "visible";
          noError = false;
        } else if(productAfterPrice < 1){
          document.getElementById("errorAfterPrice").innerHTML = "Please input a valid price, price needs to be above $0.00";
          document.getElementById("errorAfterPrice").style.visibility = "visible";
          noError = false;
        } else {
          //data["productAfterPrice"] = productAfterPrice;
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
        }

        // validate promotion end date
        if(productTimeInput==""){
          document.getElementById("errorPromotionEndTime").innerHTML = "Please indicate a promotion end time."
          document.getElementById("errorPromotionEndTime").style.visibility = "visible";
          noError = false;
        } else {
          data["decay_time"] = productTimeInput;
          document.getElementById("errorPromotionEndTime").style.visibility = "hidden";
        }

        
        document.getElementById("company_id").value = <?php echo $company_id ?>;
        document.getElementById("posted_date").value = singaporeDate;
        document.getElementById("posted_time").value = singaporeTime;
        document.getElementById("image_path_source").value = productImagePathSource;
        document.getElementById("image_path_source").value = productImage;

        //data["company_id"] = <?php echo $company_id ?>;
        //data["posted_date"] = singaporeDate;
        //data["posted_time"] = singaporeTime;
        //data["image_path_source"] = productImagePathSource;
        
       // console.log(productImagePathSource)
      
        //console.log(singaporeDate);
        //console.log(singaporeTime);

        //console.log(data);
        //console.log(noError);

        if(noError){
          //processToServer(data)
          console.log("Sent")
          return true
        } else {
          console.log("Did not sent")
          return false
        }

      }
      /*
      function processToServer(data){
        var dataObj;
        var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                  if(this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                    //dataObj = JSON.parse(this.responseText);
                    //console.log(dataObj);
                    console.log("it works!!");
                  } else {
                    //console.log("Error in transition to database")
                  }
                }
        var jsObj = {"result": data};
        var jsonObj = JSON.stringify(jsObj);
        console.log(jsonObj);
        request.open("POST", "company_post_product_transition.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("data=" + jsonObj);
      }
      */

  </script>


</body>

