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

    if(!preg_match("/^[a-zA-Z-']*$/",$kategori) || $kategori == "" || $deskripsi == "" || $efekSamping = ""){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kolom Wajib Di Isi!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: tambah_kategori_obat.php");
    }
    else{
        $query = mysqli_query($koneksi, "INSERT INTO `category` (`kategori`, `deskripsi`, `efekSamping`) VALUES ('$kategori', '$deskripsi', '$efekSamping')");
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
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Hapus!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: kategori.php");
        unset($_SESSION['idcat']);
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
    $password = md5($_POST['pass']);
    $level = $_POST['level'];

    if($level < 1 || $level > 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Silahkan Pilih Level User!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
    else{
        $query = mysqli_query($koneksi, "INSERT INTO `users` (`username`, `password`, `level`) VALUES ('$username', '$password', '$level')") or die(mysqli_error($koneksi));
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menambahkan Pegawai',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
}
elseif(isset($_POST['submit_pemasok'])){
    $nama = $_POST['nama'];

    $query = mysqli_query($koneksi, "INSERT INTO pemasok (nama) VALUES ('$nama')");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menambahkan Pemasok',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['submit_obat'])){
    $nama = $_POST['namaobat'];
    $penyimpanan = $_POST['penyimpanan'];
    $stock = $_POST['stock'];
    $unit = $_POST['unit'];
    $kategori = $_POST['kategori'];
    $kadaluarsa = date('Y-m-d', strtotime($_POST['kadaluarsa']));
    $deskripsi = $_POST['deskripsi'];
    $hargabeli = $_POST['hargabeli'];
    $hargajual = $_POST['hargajual'];
    $pemasok = $_POST['pemasok'];

    $query = mysqli_query($koneksi, "INSERT INTO obat (nama, penyimpanan, Stock, Unit, kategori, t_kadaluarsa, deskripsi, h_beli, h_jual, pemasok) VALUES ('$nama', '$penyimpanan', $stock, '$unit', '$kategori', '$kadaluarsa', '$deskripsi', $hargabeli, $hargajual, '$pemasok')");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menambahkan Obat',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
}
elseif(isset($_POST['edit_obat'])){
    $id = $_POST['idobat'];
    $nama = $_POST['namaobat'];
    $penyimpanan = $_POST['penyimpanan'];
    $stock = $_POST['stock'];
    $unit = $_POST['unit'];
    $kategori = $_POST['kategori'];
    $kadaluarsa = date('Y-m-d', strtotime($_POST['kadaluarsa']));
    $deskripsi = $_POST['deskripsi'];
    $hargabeli = $_POST['hargabeli'];
    $hargajual = $_POST['hargajual'];
    $pemasok = $_POST['pemasok'];

    $query = mysqli_query($koneksi, "UPDATE `obat` SET nama='$nama', penyimpanan='$penyimpanan', Stock='$stock', Unit='$unit', kategori='$kategori', t_kadaluarsa='$kadaluarsa', deskripsi='$deskripsi', h_beli='$hargabeli', h_jual='$hargajual', pemasok='$pemasok' WHERE id='$id'") or die(mysqli_error($koneksi));;

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Mengubah Data Obat',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: obat.php");
    }
    else{
        echo "Gagal";
    }

}
else {
    echo "What Are You Doing Here Sir ?";
}


?>