<?php
include '../config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM `category`") or die(mysqli_error($koneksi));
$num = mysqli_num_rows($query);

echo $num;
?>