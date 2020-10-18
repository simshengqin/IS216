<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';
    header("Access-Control-Allow-Origin: *");

    $companyDAO = new companyDAO();
    
    $productDAO = new productDAO();
    $productType = $productDAO->retrieve_product_type();
    
    if (isset($_GET["company_id"])) {
        $company_id = $_GET["company_id"];   
    }
    else {
      $company_id = "1";
    }

    // After vlaidtaion is Ok, will JSON to this page.
    if(isset($_POST['companyAddress']) && isset($_POST['companyDescription'])) 
    {
      $update_company_address = $_POST['companyAddress'];
      $update_company_description =$_POST['companyDescription'];
      $companyDAO->updateCompanyProfile($company_id, $update_company_description, $update_company_address);
      header("Refresh:0");
    }

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

</head>


<body>

<!-- Navigation Bar -->
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
          <a class="nav-link" href="#"> Edit </a>
        </li>
      </ul>
    </div>
    </div>
  </nav>



  <!--Company profile  -->
    <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">

        <h1 class="font-weight-light text-center"> Create Promotion </h1>
        </br>

        <form>
            <div class="form-row">

                    
                    <!-- Product Name -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input class="form-control form-control-lg" id="productName" type="text" placeholder="Product Name">
                        <p id='errorProductName' style='visibility: hidden; color: red;'> Please specify a Product Name </p>
                    </div>

                    <!-- Product Type -->
                    <div class="form-group col-md-5" style="margin-bottom: -10px;">
                        <select class="form-control form-control-lg inline" id="productType">
                            <option disabled selected value=""> Select Product's type </option>
                            <?php
                                foreach($productType as $type){
                                  echo "<option value='".$type."'> ".$type." </option>";
                                }
                            ?>
                        </select>
                        <p id='errorProductType' style='visibility: hidden; color: red;'> Please select a type </p>
                    </div>

                    <div class="form-group col-md-1" style="margin-bottom: -10px;">
                      <button type="button" class="btn btn-outline-secondary btn-lg"  data-toggle="modal" data-target="#foodTypeModal">  <b> + </b> </button> 
                    </div>

                    <!-- Qty -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <input class="form-control form-control-lg" id="productQuantity" type="number" placeholder="Quantity">
                        <p id='errorQuantity' style='visibility: hidden; color: red;'> Please input quantity </p>
                    </div>

                    <!-- Mode of Collection -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <select class="form-control form-control-lg" id="modeOfCollection">
                            <option disabled selected value=""> Mode Of Collection</option>
                            <option value="selfcollect"> Self-Collect Only</option>
                            <option value="delivery"> Delivery Only</option>
                            <option value="both"> Self-Collect / Delivery </option>
                        </select>
                        <p id='errorCollection' style='visibility: hidden; color: red;'> Please select collection mode </p>
                    </div>


                    <!-- Before Price -->
                    <div class="form-group col-md-6 input-group" style="margin-bottom: -10px;">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" id="beforePrice" class="form-control form-control-lg" placeholder="Before Price"> 
                        <p id='errorBeforePrice' style='visibility: hidden; color: red;'> Please indicate a before price </p> 
                    </div>
                    

                    <!-- After Price -->
                    <div class="input-group form-group col-md-6" style="margin-bottom: -10px;">
                        <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                        </div>
                        <input type="number" id="afterPrice" class="form-control form-control-lg" placeholder="After Price"> 
                        <p id='errorAfterPrice' style='visibility: hidden; color: red;'> Please indicate a after price </p> 
                    </div>
                    



                    <!-- Upload Image -->
                    <div class="form-group col-md-6" style="margin-top: 50px;">
                        <div class="form-group">
                            <label for="productImageUpload">Select Image to upload ( jpg & png only )</label>
                            <input type="file" class="form-control-file form-control-lg" id="productImageUpload">
                        </div>
                        <p id='errorProductImageUpload' style='visibility: hidden; color: red;'> Please insert an image file with correct file extension </p>  
                    </div>

                    <div class="form-group col-md-6">
                        <!-- empty -->
                    </div>

                    <!-- promotion end date -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <!-- <label for="dateInput" class="col-form-label"><h5>End Date: </h5></label> -->
                        <span> Promotional End Date</span>
                        <input id="dateInput" class="form-control form-control-lg" type="date">
                        <p id='errorPromotionEndDate' style='visibility: hidden; color: red;'> Please indicate a promotion end date </p>
                    </div>

                    <div class="form-group col-md-6">
                        <!-- empty -->
                    </div>

                    <!-- promotion end time -->
                    <div class="form-group col-md-6" style="margin-bottom: -10px;">
                        <span> Promotional End Time</span>
                        <input id="timeInput" class="form-control form-control-lg" type="time">
                        <p id='errorPromotionEndTime' style='visibility: hidden; color: red;'> Please indicate a promotion end time </p>
                    </div>

                    <div class="form-group col-md-12" style="margin-top: 25px;">
                        <button type="button" class="btn btn-success btn-lg inline" onclick='validate()'> Create </button>
                        <button type="button" class="btn btn-danger btn-lg inline"> Cancel </button>
                    </div>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addNewType()"> Add </button>
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
        var productImage = document.getElementById('productImageUpload').value
        var productDateInput = document.getElementById('dateInput').value
        var productTimeInput = document.getElementById('timeInput').value

        // validate product name 
        if(productName==""){
          document.getElementById("errorProductName").style.visibility = "visible";
          noError = false;
        } else {
          data["productName"] = productName;
          document.getElementById("errorProductName").style.visibility = "hidden";
        }

        // validate product type 
        if(productType==""){
          document.getElementById("errorProductType").style.visibility = "visible";
          noError = false;
        } else {
          data["productType"] = productType;
          document.getElementById("errorProductType").style.visibility = "hidden";
        }

        // validate product Qty 
        if(productQty==""){
          document.getElementById("errorQuantity").style.visibility = "visible";
          noError = false;
        } else {
          data["productQty"] = productQty;
          document.getElementById("errorQuantity").style.visibility = "hidden";
        }

        // validate Mode Of Collection 
        if(productModeOfCollection==""){
          document.getElementById("errorCollection").style.visibility = "visible";
          noError = false;
        } else {
          data["productModeOfCollection"] = productModeOfCollection;
          document.getElementById("errorCollection").style.visibility = "hidden";
        }

        // validate before price
        if(productBeforePrice==""){
          document.getElementById("errorBeforePrice").style.visibility = "visible";
          noError = false;
        } else {
          data["productBeforePrice"] = productBeforePrice;
          document.getElementById("errorBeforePrice").style.visibility = "hidden";
        }

        // validate After Price 
        if(productAfterPrice==""){
          document.getElementById("errorAfterPrice").style.visibility = "visible";
          noError = false;
        } else {
          data["productAfterPrice"] = productAfterPrice;
          document.getElementById("errorAfterPrice").style.visibility = "hidden";
        }

        // validate image upload
        if(productImage==""){
          document.getElementById("errorProductImageUpload").style.visibility = "visible";
          noError = false;
        } else {
          data["productImage"] = productImage;
          document.getElementById("errorProductImageUpload").style.visibility = "hidden";
        }

        // validate promotion end date
        if(productDateInput==""){
          document.getElementById("errorPromotionEndDate").style.visibility = "visible";
          noError = false;
        } else {
          data["productDateInput"] = productDateInput;
          document.getElementById("errorPromotionEndDate").style.visibility = "hidden";
        }

        // validate promotion end date
        if(productTimeInput==""){
          document.getElementById("errorPromotionEndTime").style.visibility = "visible";
          noError = false;
        } else {
          data["productTimeInput"] = productTimeInput;
          document.getElementById("errorPromotionEndTime").style.visibility = "hidden";
        }

        console.log(data);
        console.log(noError);

        if(noError){
          processToServer(data)
        }

      }

      function processToServer(data){
        var dataObj;
        var request = new XMLHttpRequest();
                request.onreadystatechange = function() {
                  if(this.readyState == 4 && this.status == 200) {
                    //dataObj = JSON.parse(this.responseText);
                    //console.log(dataObj);
                    console.log("it works!!");
                  } else {
                    //console.log("Error in transition to database")
                  }
                }
        var jsObj = {"data": data,};
        var jsonObj = JSON.stringify(jsObj);
        console.log(jsonObj);
        request.open("POST", "company_post_product.php", true);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("c=" + jsonObj);
      }
  </script>

<?php
    if(isset($_POST['c'])) 
    {
      $query = $_POST["c"];
      var_dump($query);
    }
?>

</body>

