<!-- ============================================================= -->
<?php require_once 'functions/productController.php'?>
<!-- ============================================================= -->

<?php if ($product): ?>
<section class="py-5 full-height">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="index.php" class="btn bg-light rounded-0 mb-4">GO Back</a>
            </div>
        </div>

        <div class="row gx-md-5 gy-5">
            <div class="col-md-6">
                <div class="card">
                    <img src="assets/images/<?php echo $product['image'] ?>" class="p-1" alt="product">
                </div>
            </div>

            <div class="col-md-6">
                <form action="product.php?id=<?php echo $product['id'] ?>" method="POST">
                    <h4><?php echo $product['name'] ?></h4>
                    <p><?php echo $product['description'] ?></p>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 py-3">
                            <?php get_star($product['rating']);?>
                            <span class="ps-2">(<?php echo $product['reviews'] ?>)</span>
                        </li>
                        <li class="list-group-item px-0 py-3">Price: $<?php echo $product['price'] ?></li>

                        <?php if ($product['stock'] > 0): ?>
                        <li class="list-group-item px-0 py-3">Status: In Stock Available</li>
                        <?php else: ?>
                        <li class="list-group-item px-0 py-3 text-danger">Status: Out Of Stock</li>
                        <?php endif?>


                        <?php if ($product['stock'] > 0): ?>
                        <li class="list-group-item px-0 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <span>Quantity:</span>

                                <select name="quantity" class="form-select w-25">
                                    <?php for ($item = 1; $item <= $product['stock']; $item++): ?>
                                    <option value="<?php echo $item ?>" <?php echo $item == 1 && 'selected' ?>>
                                        <?php echo $item ?></option>
                                    <?php endfor?>
                                </select>
                            </div>
                        </li>
                        <?php endif;?>
                        <li class="list-group-item px-0 py-3">
                            <button type="submit" name="submit" class="btn btn-dark rounded-0 px-4"
                                <?php echo $product['stock'] == 0 ? 'disabled' : '' ?>>Add To Cart</button>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</section>

<?php endif?>

<?php include_once "./partials/footer.php"?>