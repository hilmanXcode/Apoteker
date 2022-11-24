<?php
include '../utilities/validate.php';
include '../config/koneksi.php';

$id = mysqli_real_escape_string($koneksi, $_GET['id']);

if($_SESSION['level'] < 2){
  $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
  header("Location: index.php");
  die();
}
elseif(!$id){
    header("Location: obat.php");
}

$units = mysqli_query($koneksi, "SELECT * FROM units");
$supplier = mysqli_query($koneksi, "SELECT * FROM pemasok");
$kategories = mysqli_query($koneksi, "SELECT * FROM category");

$obat = mysqli_query($koneksi, "SELECT * FROM obat WHERE id='$id'");

$row = mysqli_fetch_array($obat, MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistem Informasi Apoteker</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
  <link rel="stylesheet" href="css/">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" href="dist/img/brand-logo.png" type="image/gif" sizes="16x16">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="dist/img/brand-logo.png" alt="Hospital Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SI Apoteker</span>
    </a>

    <!-- Sidebar -->
    <?php
      include '../utilities/sidebar.php'
    ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Sistem Informasi Apotek | Tambah Obat</h1>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="box-t-obat d-flex justify-content-center align-items-center">
          <form action="proses.php" method="post">
            <h2>Tambah Obat</h2>
            <label for="namaobat">Nama Obat</label>
            <input type="text" class="form-control" name="namaobat" id="namaobat" autocomplete="off" value="<?php echo $row['nama']; ?>">
            <label for="penyimpanan">Penyimpanan</label>
            <input type="text" class="form-control" name="penyimpanan" id="penyimpanan" autocomplete="off" value="<?php echo $row['penyimpanan']; ?>">
            <label for="stock">Banyak Stock</label>
            <input type="number" class="form-control" name="stock" id="stock" autocomplete="off" value="<?php echo $row['Stock']; ?>">
            <label for="unit">Unit</label>
            <select class="form-select" aria-label="Default select example" name="unit">
                <option selected value="<?php echo $row['Unit']; ?>"><?php echo htmlentities($row['Unit']); ?></option>
            <?php 
              foreach($units as $unit) {
            ?>
                <option value="<?php echo $unit['unit']; ?>"><?php echo htmlentities(ucwords($unit['unit'])); ?></option>
            <?php } ?>
            </select>
            <label for="kategori">Kategori</label>
            <select class="form-select" aria-label="Default select example" name="kategori">
                <option selected value="<?php echo $row['kategori']; ?>"><?php echo htmlentities($row['kategori']); ?></option>
              <?php 
                foreach($kategories as $kategori){
              ?>
                <option value="<?php echo $kategori['kategori']; ?>"><?php echo htmlentities(ucwords($kategori['kategori'])); ?></option>
              <?php } ?>
            </select>
            <label for="kadaluarsa">Tanggal Kadaluarsa</label>
            <input type="date" class="form-control" name="kadaluarsa" id="kadaluarsa" autocomplete="off" value="<?php echo $row['t_kadaluarsa']; ?>">
            <div class="form-floating mt-1">
                <textarea style="height: 213px; resize: none;" name="deskripsi" class="form-control" placeholder="Deskripsi" id="floatingTextarea" autocomplete="off"><?php echo htmlentities($row['deskripsi']); ?></textarea>
                <label for="floatingTextarea"></label>
            </div>
            <label for="hargabeli">Harga Beli (Rp)</label>
            <input type="number" class="form-control" name="hargabeli" id="hargabeli" autocomplete="off" value="<?php echo htmlentities($row['h_beli']); ?>">
            <label for="hargajual">Harga Jual (Rp)</label>
            <input type="number" class="form-control" name="hargajual" id="hargajual" autocomplete="off" value="<?php echo htmlentities($row['h_jual']); ?>">
            <label for="pemasok">Nama Pemasok</label>
            <select class="form-select" aria-label="Default select example" name="pemasok">
                <option selected value="<?php echo $row['pemasok']; ?>"><?php echo htmlentities($row['pemasok']); ?></option>
              <?php
                foreach($supplier as $pemasok){
              ?>
                <option value="<?php echo $pemasok['nama']; ?>"><?php echo $pemasok['nama']; ?></option>
              <?php } ?>
            </select>
            <button class="btn btn-primary mt-2" type="submit" name="submit_obat">Submit</button>
          </form>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
    }
    unset($_SESSION['message']);
?>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
