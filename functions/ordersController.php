<?php
session_start();
require_once "helpers/redirectLogin.php";
require_once "helpers/flashMessage.php";
require_once "functions/dbController.php";
require_once "helpers/get_title.php";
set_title('Orders - PHP E-Commerce Shop');

require_once "partials/head.php";
require_once "partials/header.php";

$orders = [];
$db = new DbController;
if (isset($_SESSION['user'])):
    $orders = $db->getSingleUserOrders($_SESSION['user']);
endif;