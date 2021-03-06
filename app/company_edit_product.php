<?php
    require_once 'include/common.php';
    require_once 'include/protect.php';

    $companyDAO = new companyDAO();
    $productDAO = new productDAO();
    
    if(isset($_SESSION["company_id"])){
      $company_id = $_SESSION["company_id"];
    } else {
      header("Location: company_login.php");
      exit();
    }
   

    
    if(isset($_POST['editProduct']))
    {
      $id = $_POST["productid"];
      $decay_date = $_POST["decay_date"];
      $decay_time = $_POST["decay_time"];
      $price_after = $_POST["price_after"];
      $quantity = $_POST["quantity"];
      $result = $productDAO->update_product_by_productid($id, $decay_date, $decay_time, $price_after, $quantity);
      if($result){
        header("Location: company_edit_product.php#{$id}");
      }
    }
    
    if(isset($_POST['deleteProduct']))
    {
     
      $id = $_POST["modalProductName"];
      $result = $productDAO->remove_product($id);;
      if($result){
        header("Location: company_edit_product.php");
      }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Edit Products</title>

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

  <script>
    // change active navbar
    $(document).ready(function(){
        $(".active").removeClass("active");
        $("#link-edit-product").addClass("active");
    }); 

  </script>

</head>

<body>

<?php include 'include/company_navbar.php';?>

  <!-- Confirm Delete Modal  -->
  <div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"> Delete Promotion ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <form action='company_edit_product.php' method='POST'>

        <input type='hidden' name='modalProductName' id="modalProductName" value="">
        <h5 class="text-center font-weight-light"> Are you sure that you would like to delete this promotion ? </h5>
        
      </div>
      <div class="modal-footer">
        <?php echo "<button type='submit' class='btn btn-danger' name='deleteProduct' style='left: 0%;'> Delete </button>" ?>
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- -->

  <div class="jumbotron jumbotron-fluid bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    </br>
                    <h1 class="text-center font-weight-light"> Edit Promotion </h1>
                    <?php displayProducts($company_id);?>
                </div>
            </div>
        </div>
    </div>

    
  <?php include 'include/footer.php';?>

<script>
document.addEventListener("DOMContentLoaded", function(event) { 
    var singaporeDateUnmodified = new Date().toLocaleString("en-US", {timeZone: "Asia/Singapore"}).split(',')[0];
      
      var singaporeDate = "";
      singaporeDate += singaporeDateUnmodified.split('/')[2]; // Year
      singaporeDate += "-";                         
      singaporeDate += singaporeDateUnmodified.split('/')[0]; // Month
      singaporeDate += "-";   
      singaporeDate += singaporeDateUnmodified.split('/')[1]; // Date

      var results = document.getElementsByClassName("dateInput");
      for(var ele of results){
        ele.setAttribute('min', singaporeDate);
      }

      var time = document.getElementsByClassName("timeInput");
      for(var ele of time){
        var timeUnmodified = ele.getAttribute('value')
        var hour = timeUnmodified.split(':')[0];
        var min = timeUnmodified.split(':')[1];
        var newTime = hour + ":" + min;
        ele.setAttribute('value', newTime);
      }

      var beforePrice = document.getElementsByName("before_Price_Display");
      for(var ele of beforePrice){
        console.log("test");
        var num = ele.getAttribute('value');
        num = parseFloat(num);
        num = num.toFixed(2)
      
        ele.setAttribute('value', num);
      }

      var afterPrice = document.getElementsByName("price_after");
      for(var ele of afterPrice){
        var num = ele.getAttribute('value');
        num = parseFloat(num);
        num = num.toFixed(2)
     
        ele.setAttribute('value', num);
      }

    var data = document.getElementsByClassName("dateTimeInputLeft");
    for(var ele of data){
      var id_Date_Time = ele.getAttribute('value');
    
      var productid = id_Date_Time.split("*")[0];
      var decay_date_Unmodified = id_Date_Time.split("*")[1];
      var decay_time_Unmodified = id_Date_Time.split("*")[2];
      // date
      var year = decay_date_Unmodified.split("-")[0];
      var month = decay_date_Unmodified.split("-")[1];
      var day = decay_date_Unmodified.split("-")[2];
      // convert month num into month text
      var monthList = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"]
      month = month -1;
      var monthText = "";
      for(var i = 0; i < monthList.length; i++){
        if(month == i){
          monthText = monthList[i];
        }
      }
      // time
      var decay_time_Unmodified_without_milliseconds = decay_time_Unmodified.split(".")[0];
      var hour = decay_time_Unmodified_without_milliseconds.split(':')[0];
      var min = decay_time_Unmodified_without_milliseconds.split(':')[1];
      var sec = decay_time_Unmodified_without_milliseconds.split(':')[2];
      // date time input into string format
      var newTime = " " + monthText + " " + day + ", " + year + " " + hour + ":" + min + ":" + sec + "";
      
      var countDownDate = new Date(newTime).getTime();
      var now = new Date().getTime();
      var timeRemaining =  countDownDate - now;

      if (timeRemaining < 0) {
        document.getElementById('name_'+productid).innerText += " * EXPIRED";
        document.getElementById('name_'+productid).style.color = "red";
      }
    }
  

});

function validationUpdate(errorDateInput, decay_date_value, errorEndTime, decay_time_value, price_before_value, errorAfterPrice, price_after_value, errorQuantity, quantity_value){
    
    var noError = true;

    errorDateInput = errorDateInput.attributes[0].value
    errorEndTime = errorEndTime.attributes[0].value
    errorAfterPrice = errorAfterPrice.attributes[0].value
    errorQuantity = errorQuantity.attributes[0].value

    var decayDateInput = document.getElementById(decay_date_value.attributes[1].value).value;
    var decayTimeInput = document.getElementById(decay_time_value.attributes[1].value).value;
    var priceBefore = document.getElementById(price_before_value.attributes[2].value).value;
    priceBefore = parseFloat(priceBefore)
    var priceAfter = document.getElementById(price_after_value.attributes[1].value).value;
    priceAfter = parseFloat(priceAfter)
    var qty = document.getElementById(quantity_value.attributes[1].value).value;

    var noDateError = false;

    console.log("Decay Date: " + decayDateInput);
    console.log("Decay time: " + decayTimeInput);

    if(decayDateInput==""){
      document.getElementById(errorDateInput).innerHTML = "Please specify a new end date."
      document.getElementById(errorDateInput).style.visibility = "visible";
      noError = false;
    } else {
      noDateError = true
      document.getElementById(errorDateInput).style.visibility = "hidden";
    }

    if(decayTimeInput==""){
      document.getElementById(errorEndTime).innerHTML = "Please specify a new end time.";
      document.getElementById(errorEndTime).style.visibility = "visible";
      noError = false;
    } else if (noDateError == true){
      var checkDatetime = checkIfDateTimeExpired(decayDateInput, decayTimeInput);
      if(checkDatetime == false){
        document.getElementById(errorEndTime).innerHTML = "Please indicate a promotion end time, with a later end time.";
        document.getElementById(errorDateInput).innerHTML = "Please indicate a promotion end date, with a later end date."
        document.getElementById(errorEndTime).style.visibility = "visible";
        document.getElementById(errorDateInput).style.visibility = "visible";
        noError = false;
      }
    }else {
      document.getElementById(errorEndTime).style.visibility = "hidden";
      document.getElementById(errorDateInput).style.visibility = "hidden";
      noError = true;
    }

    if(priceAfter==""){
      document.getElementById(errorAfterPrice).innerHTML = "Please specify a new price."
      document.getElementById(errorAfterPrice).style.visibility = "visible";
      noError = false;
    } else if (priceAfter < 0.01){
      document.getElementById(errorAfterPrice).innerHTML = "Price cannot be less than 0."
      document.getElementById(errorAfterPrice).style.visibility = "visible";
      noError = false;
    } else if (priceAfter >= priceBefore){
      document.getElementById(errorAfterPrice).innerHTML = "Price must be less than before price."
      document.getElementById(errorAfterPrice).style.visibility = "visible";
      noError = false;
    }
    else {
      document.getElementById(errorAfterPrice).style.visibility = "hidden";
    }

    if(qty==""){
      document.getElementById(errorQuantity).innerHTML = "Please specify a new Qty."
      document.getElementById(errorQuantity).style.visibility = "visible";
      noError = false;
    } else if (qty < 1){
      document.getElementById(errorQuantity).innerHTML = "Qty cannot be less than 0."
      document.getElementById(errorQuantity).style.visibility = "visible";
      noError = false;
    } else {
      document.getElementById(errorQuantity).style.visibility = "hidden";
    }

    if(!noError){
      return false
    } else {
      return true
    }
    return false;
}

function validationDelete(productId){
  console.log(productId);
 
  document.getElementById("modalProductName").setAttribute("value", productId)
  $('#confirmDelete').modal('show');
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


</script>    

</body>

<?php 
  function displayProducts($company_id) {
      $companyProducts = new productDAO();
      $products = $companyProducts->retrieve_product_by_company($company_id);
      foreach($products as $product){
        $time = convertTime($product->get_decay_time());

        $strProductId = strval($product->get_product_id());

       
        $errorDateInput = "errorDateInput".$strProductId;
        $decay_date_value = "decayDate".$strProductId;
        $errorEndTime = "errorEndTime".$strProductId;
        $decay_time_value = "decayTime".$strProductId;
        $errorAfterPrice = "errorAfterPrice".$strProductId;
        $price_before_value = "beforePrice".$strProductId;
        $price_after_value = "priceAfter".$strProductId;
        $errorQuantity = "errorQuantity".$strProductId;
        $quantity_value = "quantity".$strProductId;

        echo"
        
        <h1 style='visibility: hidden;' id='{$product->get_product_id()}'> - </h1>
        
        <div class='row shadow-sm bg-white rounded text-dark' >

          <div class='col-md-12 text-center'>
            <p style='visibility: hidden;'>  - </p>
            <input type='hidden' class='dateTimeInputLeft' value='{$product->get_product_id()}*{$product->get_decay_date()}*{$product->get_decay_time()}'>
          </div>

          <div class='col-md-6 text-center' style='padding-bottom: 30px;'>
              <!-- <img class='.img-fluid' style='max-width: 75%; height: auto' src='images/{$product->get_category()}/{$product->get_name()}.jpg'> -->
              <!-- <img class='.img-fluid rounded shadow d-flex w-100 mx-auto justify-content-center' style='max-width: auto; height: auto' src='{$product->get_image_url()}'> -->
              <img class='.img-fluid rounded shadow d-flex w-100 mx-auto justify-content-center' src='{$product->get_image_url()}'>
          </div>

          <div class='col-md-6'>
            <form action='company_edit_product.php' method='POST'>

                <h4 class='card-title' id='name_{$product->get_product_id()}' style='font-size: 24px; '>" . ucfirst(str_replace('_', ' ', $product->get_name())) . "</h4>";
                echo "                
                    <div class='card-subtitle mb-2'> Category: " . 
                     ucfirst(str_replace('_', ' ', $product->get_category()))."
                    </div>
                    ";
                echo "
                <input type='hidden' name='errorBugBlock' value={$product->get_product_id()}>

                <input type='hidden' name='productid' value={$product->get_product_id()}>

                <input type='hidden' name='before_Price' id='beforePrice{$product->get_product_id()}' value={$product->get_price_before()}>

                <div class='form-group'>
                    <div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' id='{$product->get_product_id()}date'> End Date </span>
                        </div>
                        <input class='form-control form-control-lg dateInput' id='decayDate{$product->get_product_id()}' name='decay_date' type='date' value='{$product->get_decay_date()}' aria-describedby='{$product->get_product_id()}date'>   
                    </div>
                </div>
                <p id='errorDateInput{$product->get_product_id()}' value='test' style='visibility: hidden; color: red;'> </p>

                <div class='form-group'>
                    <div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' id='{$product->get_product_id()}time'> End Time </span>
                        </div>
                        <input class='form-control form-control-lg timeInput' id='decayTime{$product->get_product_id()}' name='decay_time' type='time' value='{$time}' min='00:00:00' max='23:59:59' aria-describedby='{$product->get_product_id()}time'>
                    </div>
                </div>
                <p id='errorEndTime{$product->get_product_id()}' style='visibility: hidden; color: red;'> </p>

                <div class='form-group' style='margin-bottom:-15px;'>
                  <div class='input-group mb-3'>
                    <label for='beforePrice_{$product->get_product_id()}' class='col-form-label' style='font-size: 20px;'> Before Price : $  </label>
                    <input type='text' readonly class='form-control-plaintext'  name='before_Price_Display' value='{$product->get_price_before()}' style='font-size: 20px;'>
                  </div>
                </div>


                <div class='form-group'>
                    <div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' id='{$product->get_product_id()}afterprice'> After Price $</span>
                        </div>
                        <input class='form-control form-control-lg' id='priceAfter{$product->get_product_id()}' name='price_after' type='number'step='0.01' value='{$product->get_price_after()}' min='0.01' aria-describedby='{$product->get_product_id()}afterprice'>
                    </div>
                </div>
                <p id='errorAfterPrice{$product->get_product_id()}' style='visibility: hidden; color: red;'> </p>

                <div class='form-group'>
                    <div class='input-group mb-3'>
                        <div class='input-group-prepend'>
                            <span class='input-group-text' id='{$product->get_product_id()}qty'> Quantity </span>
                        </div>
                        <input class='form-control form-control-lg' id='quantity{$product->get_product_id()}' name='quantity' type='number' value='{$product->get_quantity()}' min='1' aria-describedby='{$product->get_product_id()}qty'>
                    </div>
                </div>
                <p id='errorQuantity{$product->get_product_id()}' style='visibility: hidden; color: red;'> </p>

                
                <button type='submit' class='btn btn-info btn-lg btn-block' name='editProduct' style='left: 0%;' onclick='return validationUpdate($errorDateInput, $decay_date_value, $errorEndTime, $decay_time_value, $price_before_value, $errorAfterPrice, $price_after_value, $errorQuantity, $quantity_value)'> Update </button>
                <!-- <button type='submit' class='btn btn-danger btn-lg btn-block' name='deleteProduct' style='left: 0%;'> Delete </button> -->
                <button type='button' class='btn btn-danger btn-lg btn-block' onclick='validationDelete($strProductId)' style='left: 0%;'> Delete </button>

                </br>
                </br>

            </form>
          </div>
        
        </div>
      ";
      }
    }

    function convertTime($time){
        $tempTime = explode(".",$time);
        $newTime = $tempTime[0];
        return $newTime;
    }

?>