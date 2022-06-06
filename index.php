<?php session_start();?>
<?php require_once "./helpers/get_star.php";?>
<?php require_once "./partials/head.php";?>
<?php require_once "./partials/header.php";?>
<?php require_once "functions/dbController.php"?>
<?php require_once "helpers/flashMessage.php"?>


<?php
$products = [];
$db = new DbController;
$products = $db->getProducts();
?>

<?php flashMessage();?>

<!-- product list area -->
<section class="py-5 full-height">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3>Our Products</h3>
                <hr class="mb-5">
            </div>
        </div>

        <div class="row gx-md-5 gy-5">
            <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="assets/images/<?php echo $product['image'] ?>" class="card-img-top p-2" alt="product">
                    <div class="card-body">
                        <h5><a href="product.php?id=<?php echo $product['id'] ?>"
                                class="text-dark"><?php echo substr($product['name'], 0, 30) ?>...</a>
                        </h5>

                        <div class="my-2"><?php get_star($product['rating']);?></div>
                        <h4>$<?php echo $product['price'] ?></h4>
                    </div>
                </div>
            </div>
            <?php endforeach?>
        </div>
    </div>
</section>

<?php require_once "./partials/footer.php"?>