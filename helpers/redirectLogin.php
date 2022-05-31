<?php
if (!isset($_SESSION['user'])):
    header('Location: login.php?redirect=' . $_SERVER['REQUEST_URI']);
endif;