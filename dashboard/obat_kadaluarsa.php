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

$now = date('Y-m-d');

$data = mysqli_query($koneksi,"SELECT * FROM obat");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$datas = mysqli_query($koneksi, "SELECT * FROM obat LIMIT $halaman_awal, $batas") or die(mysqli_error($koneksi));
$no = $halaman_awal + 1;
$num = mysqli_num_rows($datas);

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
            <h1 class="m-0">Sistem Informasi Apotek | Obat</h1>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="">
        <?php
          if($num < 1){
            echo "<h3 class='text-center'>Data Tidak Ditemukan</h3>";
          }
          else {
        ?>
        <table class="table text-center" border="1">
            <thead>
                <tr class="bg-primary">
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Penyimpanan</th>
                <th scope="col">Kategori</th>
                <th scope="col">Stok</th>
                <th scope="col">Tanggal Kadaluarsa</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Unit</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($datas as $data) {
                    if($data['t_kadaluarsa'] < $now) {
                ?>
                <tr class="bg-dark">
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo htmlentities($data['nama']); ?></td>
                    <td><?php echo htmlentities($data['penyimpanan']); ?></td>
                    <td><?php echo htmlentities($data['kategori']); ?></td>
                    <td><?php echo htmlentities($data['Stock']) ?></td>
                    <td><?php echo htmlentities($data['t_kadaluarsa']); ?></td>
                    <td><?php echo htmlentities($data['h_jual']); ?></td>
                    <td><?php echo htmlentities($data['Unit']); ?></td>
                    <td>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $data['id']; ?>">Hapus</a>
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
                                  <p>Nama Obat : <?php echo htmlentities(ucwords($data['nama'])); ?></p>
                                  <p>Penyimpanan : <?php echo htmlentities(ucwords($data['penyimpanan'])); ?></p>
                                  <p>Kategori : <?php echo htmlentities(ucwords($data['kategori'])); ?></p>
                                  <p>Stock : <?php echo htmlentities(ucwords($data['Stock'])); ?></p>
                                  <p>Tanggal Kadaluarsa : <?php echo htmlentities(ucwords($data['t_kadaluarsa'])); ?></p>
                                  <p>Harga Jual : <?php echo htmlentities(ucwords($data['h_jual'])); ?></p>
                                  <p>Unit : <?php echo htmlentities(ucwords($data['Unit'])); ?></p>
                                </div>
                                <div class="modal-footer bg-dark">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                                  <button type="submit" class="btn btn-danger" name="hapus_obat_kadaluarsa">Hapus</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- Akhir Modal Hapus -->
                    </td>
                </tr>
                <?php }} ?>
            </tbody>
        </table>
      <?php } ?>
      <nav>
        <ul class="pagination justify-content-center">
          <?php
            if($halaman != 1){
          ?>
          <li class="page-item">
            <a class="page-link" <?php if($halaman > 1){ echo "href='?halaman=$previous'"; } ?>>Previous</a>
          </li>
          <?php }
          else {

          } ?>
          <?php 
          for($x= 1; $x <= $total_halaman; $x++){
            if($x != 1) {
            ?> 
            <li class="page-item"><a class="page-link" href="?halaman=<?php echo $x ?>"><?php echo $x; ?></a></li>
            <?php
            }
            else {

            }
          }
          ?>
          <?php
            if($halaman != 1){
          ?>				
          <li class="page-item">
            <a  class="page-link" <?php if($halaman < $total_halaman) { echo "href='?halaman=$next'"; } ?>>Next</a>
          </li>
          <?php }
          else {

          } ?>
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
