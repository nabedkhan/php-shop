<!-- ============================================================= -->
<?php require_once 'functions/loginController.php'?>
<!-- ============================================================= -->

<!-- login page area -->
<section class="py-5 full-height d-flex align-items-center">
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card card-body p-5 shadow">
                    <h3>Login with Email</h3>
                    <hr class="mb-5">

                    <?php if (isset($connectionError)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $connectionError; ?>
                    </div>
                    <?php endif;?>

                    <form accept="login.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control rounded-0" id="email" name="email"
                                value="<?php echo $email ?>">
                            <p class="text-danger"><?php echo $emailError; ?></p>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control rounded-0" id="password" name="password"
                                value="<?php echo $password ?>">
                            <p class="text-danger"><?php echo $passwordError; ?></p>
                        </div>
                        <button type="submit" name="submit" class="btn btn-dark rounded-0 mt-3">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include_once "./partials/footer.php"?>