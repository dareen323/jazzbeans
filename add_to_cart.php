<?php
include "./php/conn.php";
include_once "methods.php";
if ($_POST['userId'] && $_POST['productId']) {
    if ($_POST['userId'] == 1) {
        addToCartPhp(null, (int)$_POST['productId']);
        echo  "true with user";
    } else {

        addToCartPhp((int)$_POST['userId'], (int)$_POST['productId']);
    }
} else {

    addToCartPhp(9999, (int)$_POST['productId']);
    echo  "true without user";
}
