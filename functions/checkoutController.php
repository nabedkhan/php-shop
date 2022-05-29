<?php
session_start();
require_once "functions/paymentController.php";
require_once "helpers/redirectLogin.php";
require_once "functions/dbController.php";
require_once "helpers/get_title.php";
require_once "partials/head.php";
require_once "partials/header.php";

// set page title
set_title('Checkout - PHP E-Commerce Shop');

$cartList = [];
if (isset($_SESSION['cart'])):
    $cartList = $_SESSION['cart'];
endif;

// total amount of all cart items
$subTotalAmount = array_reduce($cartList, function ($prev, $curr) {
    return $prev + ($curr['price'] * $curr['quantity']);
}, 0);

// shipping charge
$shippingCharge = 10;

// total amount for place order
$totalAmount = $subTotalAmount + $shippingCharge;

$name = $email = $phone = $address = null;
$cardNo = $expiryMonth = $expiryYear = $cardCvc = null;

$connectionError = null;
$nameError = $emailError = $phoneError = $addressError = null;
$cardNoError = $expiryMonthError = $expiryYearError = $cardCvcError = null;

if (isset($_POST['submit'])) {
    $setData = isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['address'])
    && isset($_POST['cardNo']) && isset($_POST['expiryMonth']) && isset($_POST['expiryYear']) && isset($_POST['cardCvc']);

    if ($setData) {
        try {
            // shipping information
            $name = htmlentities($_POST['name']);
            $email = htmlentities($_POST['email']);
            $phone = htmlentities($_POST['phone']);
            $address = htmlentities($_POST['address']);
            // card information
            $cardNo = htmlentities($_POST['cardNo']);
            $expiryMonth = htmlentities($_POST['expiryMonth']);
            $expiryYear = htmlentities($_POST['expiryYear']);
            $cardCvc = htmlentities($_POST['cardCvc']);

            // shipping address information error
            if (empty($name)) {
                $nameError = 'Name is required!';
            }
            if (empty($email)) {
                $emailError = 'Email is required!';
            }
            if (empty($phone)) {
                $phoneError = 'Phone is required!';
            }
            if (empty($address)) {
                $addressError = 'Address is required!';
            }
            // card information error
            if (empty($cardNo)) {
                $cardNoError = 'Card is required!';
            }
            if (empty($expiryMonth)) {
                $expiryMonthError = 'Expiry Month is required!';
            }
            if (empty($expiryYear)) {
                $expiryYearError = 'Expiry Year is required!';
            }
            if (empty($cardCvc)) {
                $cardCvcError = 'Card CVC is required!';
            }

            if (!empty($email) && !empty($phone) && !empty($name) && !empty($address)
                && !empty($cardNo) && !empty($expiryMonth) && !empty($expiryYear) && !empty($cardCvc)) {
                $payment = new PaymentController;
                $paymentResult = $payment->createChargeFromCard([
                    'cardNo'       => $cardNo,
                    'cardExpMonth' => $expiryMonth,
                    'cardExpYear'  => $expiryYear,
                    'cardCvc'      => $cardCvc,
                    'amount'       => $totalAmount,
                ]);

                $db = new DbController();
                $paymentId = $db->createPayment($paymentResult, $_SESSION['user']);
                var_dump($paymentId);
                // $_SESSION['toast'] = "User Logged In Successfully";
                // $_SESSION['user'] = $user['id'];
                // header('Location: index.php');
            }

        } catch (Exception $error) {
            $connectionError = $error->getMessage();
        }
    }
}