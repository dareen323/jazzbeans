<?php
include "../php/conn.php";
include "../methods.php";


if (delCategory($_REQUEST['c_id'])) {

    header("Location: http://localhost/jazzbeans/admin/dashboard.php");
} else {
    header("Location: http://localhost/jazzbeans/admin/dashboard.php?delerr=error");
}
