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

$productId = null;
$name = $price = $stock = $category = $brand = $description = $image = null;
$nameError = $priceError = $stockError = $categoryError = $brandError = $descriptionError = $imageError = null;

if (isset($_GET['productId']) && !empty($_GET['productId'])) {
    $productId = $_GET['productId'];
    $product = $db->getProduct($productId);
    if ($product) {
        $name = $product['name'];
        $price = $product['price'];
        $stock = $product['stock'];
        $category = $product['category'];
        $brand = $product['brand'];
        $description = $product['description'];
    } else {
        header('Location: products.php');
    }
}

if (isset($_POST['submit'])) {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        if (isset($_POST['name']) && !empty($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (isset($_POST['price']) && !empty($_POST['price'])) {
            $price = $_POST['price'];
        }
        if (isset($_POST['brand']) && !empty($_POST['brand'])) {
            $brand = $_POST['brand'];
        }
        if (isset($_POST['category']) && !empty($_POST['category'])) {
            $category = $_POST['category'];
        }
        if (isset($_POST['description']) && !empty($_POST['description'])) {
            $description = $_POST['description'];
        }
        if (isset($_POST['stock']) && !empty($_POST['stock'])) {
            $stock = $_POST['stock'];
        }

        $result = $db->updateProduct($_POST['id'], [
            'name'        => $name,
            'price'       => $price,
            'brand'       => $brand,
            'stock'       => $stock,
            'category'    => $category,
            'description' => $description,
        ]);

        if ($result) {
            header('Location: products.php');
        }
    } else {
        if (empty($_POST['name'])) {
            $nameError = "Name is required!";
        }
        if (empty($_POST['price'])) {
            $priceError = "Price is required!";
        }
        if (empty($_POST['brand'])) {
            $brandError = "Brand is required!";
        }
        if (empty($_POST['category'])) {
            $categoryError = "Cateogry is required!";
        }
        if (empty($_POST['description'])) {
            $descriptionError = "Description is required!";
        }
        if (empty($_POST['stock'])) {
            $stockError = "Stock is required!";
        }

        if (isset($_FILES['image']) && !empty($_FILES['image']) &&
            isset($_POST['name']) && !empty($_POST['name']) &&
            isset($_POST['price']) && !empty($_POST['price']) &&
            isset($_POST['brand']) && !empty($_POST['brand']) &&
            isset($_POST['category']) && !empty($_POST['category']) &&
            isset($_POST['description']) && !empty($_POST['description']) &&
            isset($_POST['stock']) && !empty($_POST['stock'])
        ) {
            $imgType = ['image/png', 'image/jpeg', 'image/jpg'];
            if (in_array($_FILES['image']['type'], $imgType)) {
                move_uploaded_file($_FILES['image']['tmp_name'], __DIR__ . "/assets/images/" . $_FILES['image']['name']);
                $image = $_FILES['image']['name'];
                try {
                    $db->createNewProduct([
                        'image'       => $image,
                        'name'        => $_POST['name'],
                        'brand'       => $_POST['brand'],
                        'price'       => $_POST['price'],
                        'stock'       => $_POST['stock'],
                        'category'    => $_POST['category'],
                        'description' => $_POST['description'],
                    ]);

                    header('Location: products.php');
                } catch (Exception $error) {
                    var_dump($error->getMessage());
                }
            } else {
                $imageError = "Invalid image format";
            }

        }
    }
}
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
                <h4>Add/Edit Product</h4>
                <hr class="mb-4">

                <form
                    action="<?php echo isset($_GET['productId']) ? "addProduct.php?productId={$_GET['productId']}" : "addProduct.php" ?>"
                    enctype="multipart/form-data" method="POST">

                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>">
                        <p class="text-danger"><?php echo $nameError; ?></p>
                    </div>

                    <input hidden type="text" class="form-control" name="id" value="<?php echo $productId; ?>">

                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo $price ?>">
                        <p class="text-danger"><?php echo $priceError; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="<?php echo $brand ?>">
                        <p class="text-danger"><?php echo $brandError; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <input type="text" class="form-control" id="category" name="category"
                            value="<?php echo $category ?>">
                        <p class="text-danger"><?php echo $categoryError; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $stock ?>">
                        <p class="text-danger"><?php echo $stockError; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Product Description</label>
                        <textarea rows="5" class="form-control" id="description"
                            name="description"><?php echo $description ?></textarea>
                        <p class="text-danger"><?php echo $descriptionError; ?></p>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Product Image</label>
                        <input class="form-control" type="file" id="image" name="image">
                        <p class="text-danger"><?php echo $imageError; ?></p>
                    </div>

                    <button type="submit" name="submit" class="btn btn-dark rounded-0">Submit</button>
                </form>

            </div>
        </div>
    </div>
</section>


<?php include_once "partials/footer.php"?>