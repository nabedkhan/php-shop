<?php
// show a notification flash message
function flashMessage() {
    if (isset($_SESSION['toast'])) {
        printf("<script> showToast('%s') </script>", $_SESSION['toast']);
        unset($_SESSION['toast']);
    }
}