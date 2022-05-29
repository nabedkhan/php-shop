<!-- ============================================================= -->
<?php require_once 'functions/checkoutController.php'?>
<?php require_once 'helpers/flashMessage.php'?>
<!-- ============================================================= -->
<!-- show flash -->
<?php flashMessage();?>

<section class="py-5 full-height">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card card-body p-5">
                    <form action="checkout.php" method="POST">
                        <h5 class="text-uppercase fw-bold">Shipping Address</h5>
                        <hr>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control rounded-0" id="name" name="name">
                                <p class="text-danger"><?php echo $nameError ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control rounded-0" id="email" name="email">
                                <p class="text-danger"><?php echo $emailError; ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control rounded-0" id="phone" name="phone">
                                <p class="text-danger"><?php echo $phoneError; ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control rounded-0" id="address" name="address">
                                <p class="text-danger"><?php echo $addressError; ?></p>
                            </div>
                        </div>

                        <h5 class="text-uppercase fw-bold mt-4">Payment Details</h5>
                        <hr>
                        <div class="row gy-3">
                            <div class="col-md-6">
                                <label for="cardNo" class="form-label">Card No</label>
                                <input type="text" class="form-control rounded-0" id="cardNo" name="cardNo"
                                    maxlength="16">
                                <p class="text-danger"><?php echo $cardNoError; ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="expiryMonth" class="form-label">Expiry Month</label>
                                <input type="text" class="form-control rounded-0" id="expiryMonth" name="expiryMonth"
                                    maxlength="2">
                                <p class="text-danger"><?php echo $expiryMonthError; ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="expiryYear" class="form-label">Expiry Year</label>
                                <input type="text" class="form-control rounded-0" id="expiryYear" name="expiryYear"
                                    maxlength="4">
                                <p class="text-danger"><?php echo $expiryYearError; ?></p>
                            </div>

                            <div class="col-md-6">
                                <label for="cardCvc" class="form-label">Card CVC</label>
                                <input type="text" class="form-control rounded-0" id="cardCvc" name="cardCvc"
                                    maxlength="4">
                                <p class="text-danger"><?php echo $cardCvcError; ?></p>
                            </div>
                        </div>

                        <button type="submit" name="submit" class="btn btn-dark rounded-0 mt-4">Place Order</button>
                    </form>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-body border-0 p-4">
                    <h6 class="text-uppercase fw-bold">Order Summery</h6>
                    <hr>

                    <?php foreach ($cartList as $cartItem): ?>
                    <div class="d-flex justify-content-between mb-3">
                        <p><span class="fw-bold"><?php echo $cartItem['quantity'] ?> x
                            </span><?php echo substr($cartItem['name'], 0, 30) ?>..</p>
                        <p>$<?php echo $cartItem['quantity'] * $cartItem['price'] ?></p>
                    </div>
                    <?php endforeach?>

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <p style="font-weight: 600;">Subtotal</p>
                        <p>$<?php echo $subTotalAmount ?></p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <p style="font-weight: 600;">Shipping Charge</p>
                        <p>$<?php echo $shippingCharge ?></p>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <p style="font-weight: 600;">Total</p>
                        <p>$<?php echo $totalAmount ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>