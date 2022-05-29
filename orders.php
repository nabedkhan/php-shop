<?php
session_start();
require_once "functions/dbController.php";
require_once "helpers/get_title.php";
require_once "partials/head.php";
require_once "partials/header.php";
set_title('Profile - PHP E-Commerce Shop');

$orders = [];
$db = new DbController;
if (isset($_SESSION['user'])) {
    $orders = $db->getSingleUserOrders($_SESSION['user']);
}

?>

<section class="py-5 full-height">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <?php include_once "partials/sidebar.php"?>
            </div>
            <div class="col-md-8">

                <?php foreach ($orders as $order): ?>
                <div
                    class="px-4 py-3 d-flex justify-content-between align-items-center flex-wrap rounded-3 box-shadow mb-4">
                    <p><?php echo $order['id']; ?></p>
                    <p>$<?php echo $order['charge_amount'] ?></p>
                    <p><?php echo date('d M, Y', strtotime($order['created_at'])) ?></p>
                    <a href="" class="btn btn-info"><i class="bi bi-eye-fill text-white"></i></a>
                </div>
                <?php endforeach?>

            </div>
        </div>
    </div>
</section>


<?php include_once "./partials/footer.php"?>