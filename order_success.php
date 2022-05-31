<!-- ============================================================= -->
<?php
session_start();
require_once "partials/head.php";
require_once "partials/header.php";
?>
<!-- ============================================================= -->

<!-- login page area -->
<section class="py-5 full-height d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-body d-flex align-items-center flex-column p-5">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 80px;"></i>
                    <h4 class="text-uppercase py-3">Your Order is Sucessfully Created!</h4>
                    <a href="orders.php" class="btn btn-dark rounded-0 px-5 mt-4">Your Orders</a>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once "./partials/footer.php"?>