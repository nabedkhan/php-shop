<!-- ============================================================= -->
<?php
session_start();
require_once "helpers/checkAdmin.php";
require_once "helpers/redirectLogin.php";
require_once "helpers/flashMessage.php";
require_once "helpers/flashMessage.php";
require_once "functions/dbController.php";
require_once "helpers/get_title.php";
set_title('Orders - PHP E-Commerce Shop');

require_once "partials/head.php";
require_once "partials/header.php";

$db = new DbController;
$orders = $db->getAllOrders();
?>
<!-- ============================================================= -->
<!-- show flash -->
<?php flashMessage();?>

<section class="py-5 full-height">
    <div class="container">
        <div class="row">

            <div class="col-md-4">
                <?php require_once 'partials/sidebar.php'?>
            </div>

            <div class="col-md-8">
                <h4>All Orders</h4>
                <hr class="mb-4">

                <?php foreach ($orders as $order): ?>
                <div
                    class="px-4 py-3 d-flex justify-content-between align-items-center flex-wrap rounded-3 box-shadow mb-4">
                    <p><?php echo $order['id']; ?></p>
                    <p>$<?php echo $order['charge_amount'] ?></p>
                    <p><?php echo date('d M, Y', strtotime($order['created_at'])) ?></p>
                    <a href="order_details.php?orderId=<?php echo $order['id'] ?>" class="btn btn-info"><i
                            class="bi bi-eye-fill text-white"></i></a>
                </div>
                <?php endforeach?>

            </div>
        </div>
    </div>
</section>


<?php include_once "partials/footer.php"?>