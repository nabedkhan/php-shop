<!-- ============================================================= -->
<?php require_once 'functions/orderDetailsController.php'?>
<!-- ============================================================= -->

<section class="full-height py-4">
    <div class="container">
        <div class="row">
            <div class="offset-md-1 col-md-10">
                <a href="orders.php" class="btn bg-light rounded-0 mb-4">GO Back</a>

                <div class="card card-body rounded-3 border-0 box-shadow pb-0">
                    <div class="d-flex bg-light justify-content-between rounded-3 px-3 py-3">
                        <p>Order ID:
                            <span class="fw-bold">#<?php echo $orderInfo['order_details']['order_id'] ?></span>
                        </p>
                        <p>Placed on:
                            <span class="fw-bold">
                                <?php echo date('d M, Y', strtotime($orderInfo['order_details']['created_at'])) ?>
                            </span>
                        </p>

                        <?php if (isset($orderInfo['order_details']['delivered_at'])): ?>
                        <p>Delivered on:
                            <span class="fw-bold">
                                <?php echo date('d M, Y', strtotime($orderInfo['order_details']['delivered_at'])) ?>
                            </span>
                        </p>
                        <?php endif?>
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
                        </div>
                        <?php endforeach?>
                    </div>
                </div>


                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card card-body rounded-3 border-0 box-shadow">
                            <h5>Shipping Address</h5>
                            <hr>
                            <p class="mb-2">Name: <?php echo $orderInfo['order_details']['name'] ?></p>
                            <p class="mb-2">Email: <?php echo $orderInfo['order_details']['email'] ?></p>
                            <p class="mb-2">Phone: <?php echo $orderInfo['order_details']['phone'] ?></p>
                            <p>Address: <?php echo $orderInfo['order_details']['address'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card card-body rounded-3 border-0 box-shadow">
                            <h5>Order Summery</h5>
                            <hr>

                            <p class="mb-2">Total:
                                <span class="float-end">
                                    <?php echo $orderInfo['order_details']['charge_amount'] ?>
                                </span>
                            </p>

                            <p class="mb-2">Payment Status:
                                <span class="float-end text-success">
                                    <?php echo $orderInfo['order_details']['payment_status'] ?>
                                </span>
                            </p>
                            <p>Paid by <?php echo strtoupper($orderInfo['order_details']['card_type']) ?> Card</p>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['admin']) && !$orderInfo['order_details']['delivered']): ?>
                    <form action="order_details.php?orderId=<?php echo $_GET['orderId'] ?>" method="POST" class="mt-5">
                        <select class="form-select" name="delivered">
                            <option value="progress" selected>Progress</option>
                            <option value="delivered">Delivered</option>
                        </select>
                        <button class="btn btn-dark shadow-none rounded-0 mt-3">Update Order</button>
                    </form>
                    <?php endif?>
                </div>
            </div>
        </div>
    </div>
</section>