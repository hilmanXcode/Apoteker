<?php
include '../config/koneksi.php';
include '../utilities/validate.php';

$showData = 5;


$datas = mysqli_query($koneksi, "SELECT * FROM category LIMIT 0, $showData") or die(mysqli_error($koneksi));

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
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="icon" href="dist/img/brand-logo.png" type="image/gif" sizes="16x16">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="hold-transition sidebar-mini" oncontextmenu="return false;">
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
        <div class="">
        <table class="table text-center" border="1">
            <thead>
                <tr class="bg-primary">
                <th scope="col">No</th>
                <th scope="col">Jenis Obat</th>
                <th scope="col">Deskripsi Obat</th>
                <th scope="col">Efek Samping Obat</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach($datas as $data) {
                ?>
                <tr class="bg-dark">
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo htmlentities($data['kategori']); ?></td>
                    <td><?php echo htmlentities($data['deskripsi']); ?></td>
                    <td><?php echo htmlentities($data['efekSamping']); ?></td>
                    <td>
                        <a href="edit_kategori.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Edit</a>
                        <!-- Button trigger modal -->
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $data['id']; ?>">
                          Hapus
                        </a>

                        <!-- Modal -->
                        <form action="proses.php" method="post">
                          <?php
                            unset($_SESSION['idcat']);
                            $_SESSION['idcat'] = $data['id'];
                          ?>
                          <div class="modal fade text-dark" id="delete<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah Anda Yakin Ingin Menghapus Data Ini ?</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  <p>Jenis Obat : <?php echo htmlentities($data['kategori']); ?></p>
                                  <p>Deskripsi Obat : <?php echo htmlentities($data['deskripsi']); ?></p>
                                  <p>efekSamping Obat : <?php echo htmlentities($data['efekSamping']); ?></p>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                                  <button type="submit" class="btn btn-danger" name="hapus_category">Hapus</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
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
<script>
document.onkeydown = function(e) {
  if(event.keyCode == 123) {
    return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'I'.charCodeAt(0)){
    return false;
  }
  if(e.ctrlKey && e.shiftKey && e.keyCode == 'J'.charCodeAt(0)){
    return false;
  }
  if(e.ctrlKey && e.keyCode == 'U'.charCodeAt(0)){
    return false;
  }
}  
</script>


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
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
