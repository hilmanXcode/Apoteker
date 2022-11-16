<?php
include '../utilities/validate.php';
include '../config/koneksi.php';

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
            <h1 class="m-0">Sistem Informasi Apotek</h1>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Obat</h5>
                <p class="card-text">Tersedia <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM obat");
                  $num = mysqli_num_rows($query);
                  echo $num;
                ?> obat</p>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Total Jenis Obat</h5>
                <p class="card-text">Terdapat <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM `category`") or die(mysqli_error($koneksi));
                $num = mysqli_num_rows($query);
                
                echo $num;
                ?> Jenis obat</p>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Total Unit</h5>
                <p class="card-text">Terdapat <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM `units`") or die(mysqli_error($koneksi));
                $num = mysqli_num_rows($query);
                
                echo $num;
                ?> Unit</p>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Total Pegawai</h5>
                <p class="card-text">Terdapat <?php 
                $query = mysqli_query($koneksi, "SELECT * FROM `users` WHERE level < 1337") or die(mysqli_error($koneksi));
                $num = mysqli_num_rows($query);
                
                echo $num;
                ?> Pegawai</p>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Obat Kadaluarsa</h5>
                <p class="card-text">Terdapat <?php
                  $now = date('Y-m-d');
                  $query = mysqli_query($koneksi, "SELECT * FROM obat");
                  $total = 0;
                  $tampilkan = 0;
                  foreach($query as $kadaluarsa){
                    if($kadaluarsa['t_kadaluarsa'] < $now){
                      $total++;
                    }
                  }
                  echo $total;
                ?> Obat Kadaluarsa</p>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Stock Obat</h5>
                <p class="card-text">Terdapat <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM obat");
                  
                  $totalObat = 0;
                  foreach($query as $data){
                    $totalObat+= $data['Stock'];
                  }
                  echo $totalObat;
                ?> obat</p>
              </div>
            </div>
          </div>
          <div class="col-4">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Pemasok</h5>
                <p class="card-text">Terdapat <?php
                  $query = mysqli_query($koneksi, "SELECT * FROM pemasok");
                  $num = mysqli_num_rows($query);

                  echo $num;
                ?> Pemasok</p>
              </div>
            </div>
          </div>
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
