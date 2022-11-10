<?php
session_start();
include '../config/koneksi.php';


if(isset($_POST['submit_jenis_obat'])){
    // $data = [
    //     "kategori" => $_POST['cat'],
    //     "deskripsi" => $_POST['desc'],
    //     "efekSamping" => $_POST['efek']
    // ];

    $kategori = $_POST['cat'];
    $deskripsi = $_POST['desc'];
    $efekSamping = $_POST['efek'];

    $query = mysqli_query($koneksi, "INSERT INTO `category` (`kategori`, `deskripsi`, `efekSamping`) VALUES ('$kategori', '$deskripsi', '$efekSamping')");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Tambahkan!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
}
elseif(isset($_POST['edit_jenis_obat'])){
    $kategori = $_POST['cat'];
    $deskripsi = $_POST['desc'];
    $efekSamping = $_POST['efek'];
    $id = $_SESSION['idcat'];
    $query = mysqli_query($koneksi, "UPDATE `category` SET kategori='$kategori', deskripsi='$deskripsi', efekSamping='$efekSamping' WHERE id='$id'") or die(mysqli_error($koneksi));
    if($query){
        unset($_SESSION['idcat']);
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Edit!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
}
elseif(isset($_POST['hapus_category'])){
    $id = $_SESSION['idcat'];

    $query = mysqli_query($koneksi, "DELETE FROM category WHERE id='$id'") or die(mysqli_error($koneksi));

    if($query){
        unset($_SESSION['idcat']);
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Hapus!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: kategori.php");
    }
}
elseif(isset($_POST['submit_unit_obat'])){
    $unit = $_POST['unit'];

    $query = mysqli_query($koneksi, "INSERT INTO units (unit) VALUES ('$unit')") or die(mysqli_error($koneksi));
    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Tambahkan!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
}
elseif(isset($_POST['edit_unit_obat'])){
    $id = $_SESSION['idunit'];
    $unit = $_POST['unit'];

    $query = mysqli_query($koneksi, "UPDATE `units` SET unit='$unit' WHERE id='$id'") or die(mysqli_error($koneksi));
    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Ubah!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: units.php");
        unset($_SESSION['idunit']);
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['hapus_unit'])){
    $id = $_SESSION['idunit'];
    
    $query = mysqli_query($koneksi, "DELETE FROM units WHERE id='$id'") or die(mysqli_error($koneksi));

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Hapus!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: units.php");
        unset($_SESSION['idunit']);
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['submit_new_user'])){
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $level = $_POST['level'];

    if($level < 1){
        header("Location: index.php");
    }

    $query = mysqli_query($koneksi, "INSERT INTO `users` (`username`, `password`, `level`) VALUES ('$username', '$password', '$level')") or die(mysqli_error($koneksi));

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menambahkan Pegawai',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
    else {
        echo "Gagal";
    }
}
else {
    echo "What Are You Doing Here Sir ?";
}


?>