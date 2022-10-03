<?php
function connect()
{
    # code...
    try {
        $host = "localhost";
        $user = "root";
        $pwd = "root";
        $dbname = "jazzbeans";
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pwd);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException) {
        // echo "error404.html";
        die();
    }
}
