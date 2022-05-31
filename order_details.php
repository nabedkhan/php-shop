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

?>


<section class="full-height py-4">
    <div class="container">
        <div class="row">
            <div class="offset-md-1 col-md-10">
                <a href="orders.php" class="btn bg-light rounded-0 mb-4">GO Back</a>

                <div class="card card-body rounded-3 border-0 box-shadow pb-0">
                    <div class="d-flex bg-light justify-content-between rounded-3 px-3 py-3">
                        <p>Order ID: 9001997718074513</p>
                        <p>Placed on: 31 May, 2022</p>
                        <p>Delivered on: 31 May, 2022</p>
                    </div>

                    <div class="mt-4">

                        <?php foreach ($orderInfo['products'] as $product): ?>
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center gap-2">
                                <img src="assets/images/<?php echo $product['image'] ?>" alt="product" width="60px">
                                <div>
                                    <h6><?php echo $product['name'] ?></h6>
                                    <p>$<?php echo $product['price'] ?> x <?php echo $product['quantity'] ?></p>
                                </div>
                            </div>
                            <button class="btn text-warning shadow-none">Write a review</button>
                        </div>
                        <?php endforeach?>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card card-body rounded-3 border-0 box-shadow">
                            <h5>Shipping Address</h5>
                            <hr>
                            <p class="mb-2">Name: Mohammad Nabed Khan</p>
                            <p class="mb-2">Email: nabed@gmail.com</p>
                            <p class="mb-2">Phone: 01828895567</p>
                            <p>Address: Middle Madarsha, Hathazari</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-body rounded-3 border-0 box-shadow">
                            <h5>Order Summery</h5>
                            <hr>
                            <p class="mb-2">Sub Total: <span class="float-end">$120</span></p>
                            <p class="mb-2">Shipping: <span class="float-end">$10</span></p>
                            <p class="mb-2">Total: <span class="float-end">$130</span></p>
                            <p>Paid by Credit/Debit Card</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>