<?php
include "../php/conn.php";
include "../methods.php";



if (delUser($_REQUEST['u_id'])) {

    header("Location: http://localhost/jazzbeans/admin/dashboard.php");
} else {
    header("Location: http://localhost/jazzbeans/admin/dashboard.php?delerr=error");
}
