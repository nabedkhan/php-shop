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
$products = $db->getAllProducts();
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
                <h4>All Product</h4>
                <hr class="mb-4">

                <?php foreach ($products as $product): ?>
                <div
                    class="px-4 py-3 d-flex justify-content-between align-items-center flex-wrap rounded-3 box-shadow mb-4">
                    <p><?php echo $product['id']; ?></p>
                    <p><?php echo $product['name'] ?></p>
                    <p>$<?php echo $product['price'] ?></p>
                    <a href="addProduct.php?productId=<?php echo $product['id'] ?>" class="btn btn-info">
                        <i class="bi bi-eye-fill text-white"></i>
                    </a>
                </div>
                <?php endforeach?>

            </div>
        </div>
    </div>
</section>


<?php include_once "partials/footer.php"?>