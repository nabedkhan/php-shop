<?php

function get_star($num) {
    printf("<i class='bi %s text-warning'></i>
    <i class='bi %s text-warning'></i>
    <i class='bi %s text-warning'></i>
    <i class='bi %s text-warning'></i>
    <i class='bi %s text-warning'></i>",
        ($num >= 0.5 ? (($num >= 1) ? 'bi-star-fill' : 'bi-star-half') : 'bi-star'),
        ($num >= 1.5 ? (($num >= 2) ? 'bi-star-fill' : 'bi-star-half') : 'bi-star'),
        ($num >= 2.5 ? (($num >= 3) ? 'bi-star-fill' : 'bi-star-half') : 'bi-star'),
        ($num >= 3.5 ? (($num >= 4) ? 'bi-star-fill' : 'bi-star-half') : 'bi-star'),
        ($num >= 4.5 ? (($num >= 5) ? 'bi-star-fill' : 'bi-star-half') : 'bi-star'),

    );
}