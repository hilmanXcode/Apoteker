<?php
include '../utilities/validate.php';
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

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "INSERT INTO `category` (`kategori`, `deskripsi`, `efekSamping`) VALUES ('$kategori', '$deskripsi', '$efekSamping')");

    // if(!preg_match("/^[a-zA-Z-']*$/",$kategori) || $kategori == "" || $deskripsi == "" || $efekSamping = ""){
    //     $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kolom Wajib Di Isi!',icon: 'error',confirmButtonText: 'OK'})</script>";
    //     header("Location: tambah_kategori_obat.php");
    // }
    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Tambahkan!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: kategori.php");
    }
}
elseif(isset($_POST['edit_jenis_obat'])){
    $id = $_POST['id'];
    $kategori = $_POST['cat'];
    $deskripsi = $_POST['desc'];
    $efekSamping = $_POST['efek'];
    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "UPDATE `category` SET kategori='$kategori', deskripsi='$deskripsi', efekSamping='$efekSamping' WHERE id='$id'") or die(mysqli_error($koneksi));
    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Edit!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: kategori.php");
    }
}
elseif(isset($_POST['hapus_category'])){
    $id = $_POST['id'];

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "DELETE FROM category WHERE id='$id'") or die(mysqli_error($koneksi));

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Hapus!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: kategori.php");
        unset($_SESSION['idcat']);
    }
}
elseif(isset($_POST['submit_unit_obat'])){
    $unit = $_POST['unit'];

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "INSERT INTO units (unit) VALUES ('$unit')") or die(mysqli_error($koneksi));
    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Tambahkan!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
}
elseif(isset($_POST['edit_unit_obat'])){
    $id = $_POST['id'];
    $unit = $_POST['unit'];

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "UPDATE `units` SET unit='$unit' WHERE id='$id'") or die(mysqli_error($koneksi));
    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Data Berhasil Di Ubah!',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: units.php");
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['hapus_unit'])){
    $id = $_POST['id'];
    
    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
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
    $nama = $_POST['npegawai'];
    $username = $_POST['username'];
    $password = md5($_POST['pass']);
    $level = $_POST['level'];

    if($_SESSION['level'] != 1337){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    if($level < 1 || $level > 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Silahkan Pilih Level User!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
    else{
        $query = mysqli_query($koneksi, "INSERT INTO `users` (`nama_pegawai`, `username`, `password`, `level`) VALUES ('$nama', '$username', '$password', '$level')") or die(mysqli_error($koneksi));
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menambahkan Pegawai',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
}
elseif(isset($_POST['submit_pemasok'])){
    $nama = $_POST['nama'];

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "INSERT INTO pemasok (nama) VALUES ('$nama')");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menambahkan Pemasok',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: pemasok.php");
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

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }

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

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "UPDATE `obat` SET nama='$nama', penyimpanan='$penyimpanan', Stock='$stock', Unit='$unit', kategori='$kategori', t_kadaluarsa='$kadaluarsa', deskripsi='$deskripsi', h_beli='$hargabeli', h_jual='$hargajual', pemasok='$pemasok' WHERE id='$id'") or die(mysqli_error($koneksi));;

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Mengubah Data Obat',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: obat.php");
    }
    else{
        echo "Gagal";
    }

}
elseif(isset($_POST['hapus_obat'])){
    $id = $_POST['id'];

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "DELETE FROM obat WHERE id='$id'");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Kamu Berhasil Menghapus Data',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: obat.php");
    }
    else{
        echo "Gagal";
    }
}
elseif(isset($_POST['edit_pemasok'])){
    $id = $_POST['id'];
    $nama = $_POST['pemasok'];

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "UPDATE pemasok SET nama='$nama' WHERE id='$id'");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Mengubah Data Pemasok',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: pemasok.php");
    }
    else {
        echo "Gagal";
    }

}
elseif(isset($_POST['hapus_pemasok'])){
    $id = $_POST['id'];

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "DELETE FROM pemasok WHERE id='$id'");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menghapus Data',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: pemasok.php");
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['edit_pegawai'])){
    $id = $_POST['id'];
    $namapegawai = $_POST['nama'];
    $username = $_POST['username'];
    $level = $_POST['level'];

    if($_SESSION['level'] != 1337){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "UPDATE users SET nama_pegawai='$namapegawai', username='$username', level='$level' WHERE id='$id'");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Mengubah Data',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: users.php");
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['hapus_pegawai'])){
    $id = $_POST['id'];

    if($_SESSION['level'] != 1337){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = mysqli_query($koneksi, "DELETE FROM users WHERE id='$id'");

    if($query){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menghapus Data',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: users.php");
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['submit_penjualan'])){
    $namapembeli = $_POST['namapembeli'];
    $obat = $_POST['namaobat'];
    $stock = $_POST['stock'];
    $unit = $_POST['unit'];
    $harga = $_POST['hargasatuan'];
    $banyakydbeli = $_POST['banyak'];
    $total = $_POST['total'];
    $newStock = $stock - $banyakydbeli;

    if($_SESSION['level'] == 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = "INSERT INTO penjualan (nama, obat, unit, harga, beli, total) VALUES ('$namapembeli', '$obat', '$unit', $harga, $banyakydbeli, $total);
    UPDATE obat SET Stock='$newStock' WHERE nama='$obat'";

    if($koneksi->multi_query($query)){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Kamu Berhasil Menambah Data Penjualan',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['hapus_penjualan'])){
    $id = $_POST['id'];

    if($_SESSION['level'] == 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = "DELETE FROM penjualan WHERE id='$id'";

    if($koneksi->query($query)){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Kamu Berhasil Menghapus Data Penjualan',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: penjualan.php");
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['submit_pembelian'])){
    $pemasok = $_POST['pemasok'];
    $stock = $_POST['stock'];
    $t_transaksi = date('Y-m-d', strtotime($_POST['transaksi']));
    $obat = $_POST['namaobat'];
    $harga = $_POST['harga'];
    $banyak_stock = $_POST['banyak'];
    $total = $_POST['total'];
    $created = date('Y-m-d');
    $newStock = $stock + $banyak_stock;

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = "INSERT INTO pembelian (pemasok, t_transaksi, obat, harga, banyak_stock, total, created) VALUES ('$pemasok', '$t_transaksi', '$obat', $harga, $banyak_stock, $total, '$created');
    UPDATE obat SET Stock='$newStock' WHERE nama='$obat' AND pemasok='$pemasok'";

    if($koneksi->multi_query($query)){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Berhasil Menambahkan Data Pembelian',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
    }
    else {
        echo "Gagal";
    }
}
elseif(isset($_POST['hapus_pembelian'])){
    $id = $_POST['id'];

    if($_SESSION['level'] < 2){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
        header("Location: index.php");
        die();
    }
    $query = "DELETE FROM pembelian WHERE id='$id'";

    if($koneksi->query($query)){
        $_SESSION['message'] = "<script>Swal.fire({title: 'Berhasil!',text: 'Kamu Berhasil Menghapus Data Pembelian',icon: 'success',confirmButtonText: 'OK'})</script>";
        header("Location: pembelian.php");
    }
    else {
        echo "Gagal";
    }
}
else {
    echo "What Are You Doing Here Sir ?";
}


?>