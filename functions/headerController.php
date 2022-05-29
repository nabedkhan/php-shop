<?php require_once 'functions/dbController.php'?>

<?php
$user = null;
$totalCartitem = 0;

if (isset($_SESSION['cart'])):
    $totalCartitem = count($_SESSION['cart']);
endif;

if (isset($_SESSION['user'])):
    try {
        $db = new DbController();
        $user = $db->getCurrentUser($_SESSION['user']);
    } catch (Exception $error) {
        echo $error->getMessage();
    }
endif;

if (isset($_GET['logout'])):
    $_SESSION['user'] = null;
    header('Location: index.php');
endif;