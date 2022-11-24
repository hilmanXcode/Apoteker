<?php
include '../utilities/validate.php';
include '../config/koneksi.php';

$pemasok = mysqli_query($koneksi, "SELECT * FROM pemasok");

if($_SESSION['level'] < 2){
  $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
  header("Location: index.php");
  die();
}
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
            <h1 class="m-0">Sistem Informasi Apotek | Kategori</h1>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="box-t-pembelian d-flex justify-content-center align-items-center">
          <form action="proses.php" method="post">
            <h2>Tambah Pembelian</h2>
            <label for="pemasok">Pemasok</label>
            <select class="form-select" aria-label="Default select example" id="pemasok" name="pemasok" onchange="showData(this.value); validate(this.value);">
                <option value="">Pilih Pemasok</option>
                <?php
                  foreach($pemasok as $pemasoks) {
                ?>
                <option value="<?php echo htmlentities($pemasoks['nama']); ?>"><?php echo htmlentities($pemasoks['nama']); ?></option>
                <?php } ?>
            </select>
            <label for="transaksi">Tanggal Transaksi</label>
            <input type="date" name="transaksi" id="transaksi" class="form-control">
            <div id="ajaxxx">
              <label for="namaobat">Obat</label>
              <select class="form-select" aria-label="Default select example" id="namaobat" name="namaobat" aria-readonly="true">
                 <option value="" selected>Pilih Obat</option>
              </select>
            </div>
            <div id="ajax2">
              <label for="stock">Stock</label>
              <input type="number" name="stock" id="stock" class="form-control" readonly>
              <label for="unit">Unit</label>
              <input type="text" name="unit" id="unit" class="form-control" readonly>
              <label for="harga">Harga</label>
              <input type="number" name="harga" id="harga" class="form-control" readonly>
            </div>
            <label for="banyak">Banyak Stock</label>
            <input type="number" name="banyak" id="banyak" class="form-control"><a class="btn btn-primary d-flex mt-1 hitung" onclick="hitungTotal()">Hitung</a>
            <label for="total">Total</label>
            <input type="number" class="form-control" name="total" id="total" readonly>
            <button class="btn d-flex btn-primary mt-2 hitung" type="submit" name="submit_pembelian">Submit</button>
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
  if(isset($_SESSION['ajax'])){
    echo $_SESSION['ajax'];
  }
?>
<?php
    if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
    }
    unset($_SESSION['message']);
?>
<script>
  function showData(str) {
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("ajaxxx").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","getdata_x.php?p="+str,true);
    xmlhttp.send();
  }
  const showDataX = (str) => {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("ajax2").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","getdata_xX.php?p="+str,true);
    xmlhttp.send();
  }
  const hitungTotal = () => {
    let stock = document.querySelector("#stock").value;
    let unit = document.querySelector("#unit").value;
    let harga = document.querySelector("#harga").value;
    let banyak = document.querySelector("#banyak").value;
    let totalInput = document.querySelector("#total");
    let total = harga * banyak;
    totalInput.value = total;
  }
  </script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
