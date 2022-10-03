<?php
include "php/conn.php";
include "methods.php";
delCartItem((int)$_REQUEST['del_cart_id']);
header("Location: http://localhost/jazzbeans/checkout.php");
