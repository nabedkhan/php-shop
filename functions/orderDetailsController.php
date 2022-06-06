<?php
session_start();
require_once "helpers/redirectLogin.php";
require_once "helpers/flashMessage.php";
require_once "functions/dbController.php";
require_once "helpers/get_title.php";
set_title('Orders - PHP E-Commerce Shop');

require_once "partials/head.php";
require_once "partials/header.php";

$orderInfo = [];
$db = new DbController;
if (isset($_GET['orderId'])):
    $orderInfo = $db->getOrderDetails($_GET['orderId']);
endif;

if (isset($_POST['delivered']) && isset($_GET['orderId'])):
    $delivered = htmlentities($_POST['delivered']);

    if (!empty($delivered) && $delivered == 'delivered') {
        $db->updateOrderWithDelivered($_GET['orderId']);
        header('Location: dashboard.php');
    }
endif;