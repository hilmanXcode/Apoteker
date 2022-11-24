<?php
include '../config/koneksi.php';
include '../utilities/validate.php';

if($_SESSION['level'] < 2){
  $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
  header("Location: index.php");
  die();
}

$batas = 10;
$halaman = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1 ) ? ($halaman * $batas) - $batas : 0;	

$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($koneksi,"SELECT * FROM category");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$datas = mysqli_query($koneksi, "SELECT * FROM category LIMIT $halaman_awal, $batas") or die(mysqli_error($koneksi));
$no = $halaman_awal + 1;

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
                    foreach($datas as $data) {
                ?>
                <tr class="bg-dark">
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo htmlentities(ucwords($data['kategori'])); ?></td>
                    <td><?php echo htmlentities(ucwords($data['deskripsi'])); ?></td>
                    <td><?php echo htmlentities(ucwords($data['efekSamping'])); ?></td>
                    <td>
                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id']; ?>">Edit</a>
                        <!-- Button trigger modal -->
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $data['id']; ?>">
                          Hapus
                        </a>

                        <!-- Modal Hapus -->
                        <form action="proses.php" method="post">
                          <div class="modal fade text-dark" id="delete<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header bg-primary">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah Anda Yakin Ingin Menghapus Data Ini ?</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-left bg-dark">
                                  <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                  <p>Jenis Obat : <?php echo htmlentities(ucwords($data['kategori'])); ?></p>
                                  <p>Deskripsi Obat : <?php echo htmlentities(ucwords($data['deskripsi'])); ?></p>
                                  <p>Efek Samping Obat : <?php echo htmlentities(ucwords($data['efekSamping'])); ?></p>
                                </div>
                                <div class="modal-footer bg-dark">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                                  <button type="submit" class="btn btn-danger" name="hapus_category">Hapus</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- End Modal Hapus -->
                        
                        <!-- Modal Edit -->
                        <form action="proses.php" method="post">
                          <div class="modal fade text-dark" id="edit<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header bg-primary">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Kategori</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body bg-dark text-left">
                                  <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                  <label for="cat">Jenis Obat</label>
                                  <input type="text" class="form-control" name="cat" value="<?php echo $data['kategori']; ?>">
                                  <label for="desc">Deskripsi</label>
                                  <input type="text" class="form-control" name="desc" value="<?php echo $data['deskripsi']; ?>">
                                  <label for="efek">Efek Samping</label>
                                  <textarea style="height: 213px; resize: none;" name="efek" class="form-control" placeholder="Efek Samping" id="floatingTextarea" autocomplete="off"><?php echo $data['efekSamping']; ?></textarea>
                                </div>
                                <div class="modal-footer bg-dark">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                                  <button type="submit" class="btn btn-warning" name="edit_jenis_obat">Edit</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- Akhir Modal Edit -->
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
      <nav>
        <ul class="pagination justify-content-center">
          <li class="page-item">
            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
          </li>
          <?php 
          for($x= 1; $x <= $total_halaman; $x++){
            ?> 
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php
          }
          ?>				
          <li class="page-item">
            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
          </li>
        </ul>
      </nav>
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
