<?php
session_start();
require_once "functions/dbController.php";
require_once "helpers/get_title.php";
require_once "helpers/get_star.php";
require_once "partials/head.php";
require_once "partials/header.php";
set_title('Product - PHP E-Commerce Shop');

$product = null;
// get product from database
if (isset($_GET['id'])) {
    $db = new DbController;
    $product = $db->getProduct($_GET['id']);
}

// add to cart
if (isset($_POST['submit'])) {
    if (isset($_POST['quantity']) && !empty($_POST['quantity']) && isset($_GET['id']) && !empty($_GET['id'])) {
        $quantity = htmlentities($_POST['quantity']);
        $productId = htmlentities($_GET['id']);
        $cartItem = [
            'productId' => $productId,
            'quantity'  => $quantity,
            'name'      => $product['name'],
            'image'     => $product['image'],
            'price'     => $product['price'],
        ];

        if (isset($_SESSION['cart'])):
            $productId_list = array_column($_SESSION['cart'], 'productId');
            $find = in_array($productId, $productId_list);

            if (!$find) {
                array_push($_SESSION['cart'], $cartItem);
            }

            foreach ($_SESSION['cart'] as $key => $item) {
                if ($item['productId'] == $productId):
                    $_SESSION['cart'][$key]['quantity'] = $quantity;
                    break;
                endif;
            }
            header("Location: cart.php");
        else:
            $_SESSION['cart'] = [$cartItem];
            header("Location: cart.php");
        endif;
    }

}