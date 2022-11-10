<?php
session_start();
include 'config/koneksi.php';

$uname = $_POST['username'];
$pass = md5($_POST['password']);


$filterUname = mysqli_real_escape_string($koneksi, $uname);

$query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$filterUname' AND password='$pass'") or die(mysqli_error($koneksi));
$num = mysqli_num_rows($query);
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

if($num != 0){
    if($row['level'] == 1337){
        $_SESSION['level'] = $row['level'];
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Kamu Telah Masuk Sebagai Owner!',icon: 'success',confirmButtonText: 'Close'})</script>";
    }
    elseif($row['level'] == 1){
        $_SESSION['level'] = $row['level'];
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Kamu Telah Masuk Sebagai User biasa!',icon: 'success',confirmButtonText: 'Close'})</script>";
    }
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['password'] = $row['password'];
    header("Location: dashboard/index.php");
    exit();
} else {
    $_SESSION['error'] = "<script>Swal.fire({title: 'Error!',text: 'Masukkan username dan password dengan benar!',icon: 'error',confirmButtonText: 'Close'})</script>";
    header("Location: index.php");
    exit();
}

?>