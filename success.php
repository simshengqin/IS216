<html>
<head>
  <title>Thanks for your order!</title>
  <link rel="stylesheet" href="css/maincss.css">
</head>
<body>
  <section>
    <p>
      We appreciate your business! If you have any questions, please email
      <a href="mailto:orders@example.com">orders@example.com</a>.
    </p>
  </section>
  <?php
    require 'vendor/autoload.php';
    $stripe = new \Stripe\StripeClient('sk_test_51HgOY8AgaC3WCXUJkZeI8NEO20nKkEYE99qUUjnjSdLxJ25DlKtKJipaM4CvoTWzi1cryHYmF6zD83J5cCunACSz007ce7SGlu');
    $events = $stripe->events->all(['limit' => 3]);
    foreach($events->autoPagingIterator() as $event) {
      $session = $event['data']['object'];
      if ($session['id'] == $_GET["session_id"]){
          $cart_info = $session['metadata'];
          var_dump($cart_info);
          #amount = session['display_items'][0]['amount']         
      }
     
    }
    /*
    # Check if payment is confirmed
    events = stripe.Event.list(
      type='checkout.session.completed',
      created={
          # Check for events created in the last hour.
          'gte': int(time.time() - 60 * 60 * 2),
      },
      )
  
      for event in events.auto_paging_iter():
          session = event['data']['object'] 
          session = dict(session) # convert stripe session class to dictionary
          if session['id'] == session_id:
              $cart_info = session['metadata']
              var_dump(cart_info);
              #amount = session['display_items'][0]['amount']
      */

  ?>
</body>
</html>