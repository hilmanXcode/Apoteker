<?php

$host = "localhost";
$user = "root";
$password = "";
$db = "apoteker";

$koneksi = mysqli_connect($host, $user, $password, $db);

if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}


?>