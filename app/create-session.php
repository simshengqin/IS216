
<?php

require 'vendor/autoload.php';


$user_id = $_POST['user_id'];
$company_id = $_POST['company_id'];
$time = $_POST['time'];
$date = $_POST['date'];
$price = floatval($_POST['price']) * 100;
$cart = $_POST['cart'];


\Stripe\Stripe::setApiKey('sk_test_51HnnHcGmZOdyBZEcx9a9NnEe3AzWX102pVGiyFU4u9wnmFsIqf18vl0CfVvO50ijsGob8lIYulJq2j8PxpXL9huJ00DNIEv2SM');


header('Content-Type: application/json');

// change this link to where your app is hosted/ alias
$url = $_SERVER['REQUEST_URI']; //returns the current directoy of current URL
$parts = explode('/',$url);
$dir = $_SERVER['SERVER_NAME'];
for ($i = 0; $i < count($parts) - 1; $i++) {
$dir .= $parts[$i] . "/";
}
$YOUR_DOMAIN =  "http://" . $dir;
//$YOUR_DOMAIN = 'http://localhost/is216/app/';

$order_info = array(
  "user_id" => $user_id,
  "company_id" => $company_id,
  "time" => $time,
  "date"=> $date,
  "price"=> $price,
  "cart"=> $cart
);

function generate_line_item($company_id, $time, $date, $price){
  $name = "Order";
  $amount = $price;
  $currency = "sgd";
  $description = $time . " on " . $date;

  $line_items = [array(
      "name"=> $name,
      "amount"=> $amount,
      "currency"=> "sgd",
      "quantity"=> 1,
      "description"=> $description
  )];
  
  return $line_items;
}

$line_items = generate_line_item($company_id, $time, $date, $price);

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => $line_items,
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . 'success.php?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => $YOUR_DOMAIN . 'shoppingcart.php',
  'metadata' => $order_info
]);




echo json_encode(['id' => $checkout_session->id]);

?>