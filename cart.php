<!-- ============================================================= -->
<?php require_once 'functions/cartController.php'?>
<!-- ============================================================= -->

<!-- layout -->
<?php require_once "partials/head.php";?>
<?php require_once "partials/header.php";?>


<?php if (count($cartList) === 0): ?>
<section class="py-5 full-height d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-body d-flex align-items-center flex-column p-5">
                    <i class="bi bi-basket text-warning" style="font-size: 80px;"></i>
                    <h4 class="text-uppercase py-3">Your cart is empty</h4>
                    <a href="index.php" class="btn btn-dark rounded-0 px-5 mt-4">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif?>

<?php if (count($cartList) > 0): ?>
<section class="py-5 full-height">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <?php foreach ($cartList as $cartitem): ?>
                <?php $totalAmount += $cartitem['quantity'] * $cartitem['price'];?>
                <div class="card card-body mb-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <img src="assets/images/<?php echo $cartitem['image'] ?>" width="90px" alt="">
                        <h6><?php echo $cartitem['name'] ?></h6>
                        <h6><?php echo $cartitem['quantity'] ?> X $<?php echo $cartitem['price'] ?></h6>
                        <h6>$<?php echo $cartitem['quantity'] * $cartitem['price'] ?></h6>
                        <a href="cart.php?cartId=<?php echo $cartitem['productId'] ?>"><i
                                class="bi bi-x-circle text-danger"></i></a>
                    </div>
                </div>
                <?php endforeach?>
            </div>

            <div class="col-md-4">
                <div class="card card-body">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="text-uppercase">Total Cart Item (<?php echo count($cartList) ?>)</h5>
                        <h5 class="text-uppercase text-info">$<?php echo $totalAmount ?></h5>
                    </div>
                    <a href="checkout.php" class="btn btn-dark text-uppercase">Checkout Proceed</a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif?>

<!-- footer -->
<?php include_once "./partials/footer.php"?>