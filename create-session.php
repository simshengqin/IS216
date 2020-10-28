
<?php

require 'vendor/autoload.php';

// if(!isset($_SESSION)) { 
//     session_start(); 
// } 

$user_id = $_POST['user_id'];
$company_id = $_POST['company_id'];
$time = $_POST['time'];
$date = $_POST['date'];
$price = floatval($_POST['price']) * 100;
$cart = $_POST['cart'];


\Stripe\Stripe::setApiKey('sk_test_51HgOY8AgaC3WCXUJkZeI8NEO20nKkEYE99qUUjnjSdLxJ25DlKtKJipaM4CvoTWzi1cryHYmF6zD83J5cCunACSz007ce7SGlu');

// header('Content-Type: application/json','Set-Cookie: cross-site-cookie=bar; SameSite=None; Secure');
header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/eco';

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
  'success_url' => $YOUR_DOMAIN . '/success.php?session_id={CHECKOUT_SESSION_ID}',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
  'metadata' => $order_info
]);


// $checkout_session = \Stripe\Checkout\Session::create([
//   'payment_method_types' => ['card'],
//   'line_items' => [[
//     'price_data' => [
//       'currency' => 'sgd',
//       'unit_amount' => 2000,
//       'product_data' => [
//         'name' => 'Stubborn Attachments',
//         'images' => ["https://i.imgur.com/EHyR2nP.png"],
//       ],
//     ],
//     'quantity' => 1,
//   ]],
//   'mode' => 'payment',
//   'success_url' => $YOUR_DOMAIN . '/success.html',
//   'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
// ]);

echo json_encode(['id' => $checkout_session->id]);

?>