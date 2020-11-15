Eco G5T4
======
Step by step instructions of:
## How to set up Eco app based on the submitted file(s)
1. Ensure your WAMP is running
2. Connect your WAMP to the IS216 folder by creating an alias (E.g. eco)
3. Import the sql file into phpmyadmin; database is216 will be created


## How to run Eco app
1. Access our application at /app locally. (E.g. localhost/eco/app)
2. Alternatively, you can access our webpage at https://ecois216.herokuapp.com/.
3. To checkout, simply enter `4242 4242 4242 4242` in the stripe checkout page for the card number and any expiry date (after today) and CSV code.


## Username/password details:

**User**


Username 1: sunjunlovesg5t4@smu.edu.sg

Password 1: `Password2`


Username 2: chrislee@gmail.com

Password 2: `Password1`


**Company**

* all companies have the same password - `password1`


Usernames: 
1. breadtalk
2. saizeriya
3. pasta fresca
4. Lola Cafe
5. DingTeLe
6. popeyes
7. umisushi
8. mcdonald
9. Icg Incredible Chicken
10. Yaowarat Thai Kway Chap


## Note
Stripe API has a order/rate limit, hence if Stripe appears to timeout or stop working after the Stripe checkout page, you can create a new Stripe API account and follow the steps below:
1. Name `Account Name` in Stripe as `Eco`
2. Get the public key and secret key
3. Replace the public key in `var stripe = Stripe("pk_test_...") ` in `shoppingcart.php` and replace the secret key in `\Stripe\Stripe::setApiKey('sk_test_...');` found in `success.php` and `create-session.php`
4. The Stripe API checkout page should work again.


###### Version 
* Version 1.0