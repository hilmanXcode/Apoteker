<?php
session_start();
include '../config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM category");
$num = mysqli_num_rows($query);
$row = mysqli_fetch_array($query);

echo $row['kategori'];
?>