<?php
include_once "../php/conn.php";
include_once "../methods.php";

if (delProduct($_REQUEST["p_id"])) {

    header("Location: http://localhost/jazzbeans/admin/dashboard.php ");
} else {

    header("Location: http://localhost/jazzbeans/admin/dashboard.php?delerr=error ");
}
