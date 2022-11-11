<?php
session_start();
include '../config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM category");
$fetch = mysqli_fetch_array($query, MYSQLI_ASSOC);
$jumlahData = count($fetch);
print_r($fetch);
?>