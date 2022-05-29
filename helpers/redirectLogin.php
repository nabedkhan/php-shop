<?php
if (!isset($_SESSION['user'])):
    header('Location: login.php?redirect=' . $_SERVER['REQUEST_URI']);
    // echo "<pre>";
    // var_dump($_SERVER['REQUEST_URI']);
    // echo "</pre>";
endif;