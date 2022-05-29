<!-- ============================================================= -->
<?php require_once 'functions/headerController.php'?>
<!-- ============================================================= -->

<header class="bg-dark py-3">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">PHP SHOP</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (!$user): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <?php endif;?>

                    <?php if ($user): ?>
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle text-light" type="button" id="dropdownMenu"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-person-circle" style="font-size: 20px;"></i>
                            </button>

                            <ul class="dropdown-menu py-0 rounded-0 border-0 shadow" aria-labelledby="dropdownMenu">
                                <li class="dropdown-item py-3">Welcome <?php echo $user['name']; ?></li>
                                <hr class="mt-0">
                                <li><a class="dropdown-item" href="#">Profile</a></li>
                                <li><a class="dropdown-item" href="orders.php">Orders</a></li>
                                <li><a class="dropdown-item" href="index.php?logout=true">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php endif;?>

                    <li class="nav-item">
                        <a class="nav-link btn position-relative" href="cart.php">
                            <i class="bi bi-basket3-fill"></i>
                            <?php if ($totalCartitem > 0): ?>
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-dark">
                                <?php echo $totalCartitem ?>
                            </span>
                            <?php endif;?>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>