<?php
session_start();
require_once "functions/paymentController.php";
include_once "helpers/get_title.php";
// set title
set_title('Cart - PHP E-Commerce Shop');

$cartList = [];
$totalAmount = 0;

if (isset($_SESSION['cart'])):
    $cartList = $_SESSION['cart'];
endif;

if (isset($_GET['cartId'])):
    foreach ($cartList as $key => $cartItem) {
        if ($cartItem['productId'] === $_GET['cartId']) {
            unset($cartList[$key]);
            $_SESSION['cart'] = $cartList;
            header('Location: cart.php');
        }
    }
endif;

// $paymentMethod = new PaymentController;
// $paymentMethod->createChargeFromCard();