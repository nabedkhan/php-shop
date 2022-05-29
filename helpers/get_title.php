<?php

$page_title = "PHP E-Commerce Shop";
function get_title() {
    echo $GLOBALS['page_title'];
}

function set_title($name) {
    global $page_title;
    $page_title = $name;
}