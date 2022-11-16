<?php
include '../utilities/validate.php';
include '../config/koneksi.php';

// Pagination
$batas = 10;
$halaman = isset($_GET['halaman'])? (int)$_GET['halaman'] : 1;
$halaman_awal = ($halaman > 1 ) ? ($halaman * $batas) - $batas : 0;	

$previous = $halaman - 1;
$next = $halaman + 1;

$data = mysqli_query($koneksi,"SELECT * FROM obat");
$jumlah_data = mysqli_num_rows($data);
$total_halaman = ceil($jumlah_data / $batas);
$datas = mysqli_query($koneksi, "SELECT * FROM obat LIMIT $halaman_awal, $batas") or die(mysqli_error($koneksi));
$no = $halaman_awal + 1;
// End Pagination

// Necessary
$units = mysqli_query($koneksi, "SELECT * FROM units");
$supplier = mysqli_query($koneksi, "SELECT * FROM pemasok");
$kategories = mysqli_query($koneksi, "SELECT * FROM category");
// End Necessary

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
                    foreach($datas as $dataobat) {
                ?>
                <tr class="bg-dark">
                    <th scope="row"><?php echo $no++; ?></th>
                    <td><?php echo htmlentities($dataobat['nama']); ?></td>
                    <td><?php echo htmlentities($dataobat['penyimpanan']); ?></td>
                    <td><?php echo htmlentities($dataobat['kategori']); ?></td>
                    <td><?php echo htmlentities($dataobat['Stock']) ?></td>
                    <td><?php echo htmlentities($dataobat['t_kadaluarsa']); ?></td>
                    <td><?php echo htmlentities($dataobat['h_jual']); ?></td>
                    <td><?php echo htmlentities($dataobat['Unit']); ?></td>
                    <td>
                        <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#edit<?php echo $dataobat['id']; ?>">Edit</a>
                        <a href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?php echo $dataobat['id']; ?>">
                          Hapus
                        </a>

                        <!-- Modal Hapus -->
                        <form action="proses.php" method="post">
                          <div class="modal fade text-dark" id="delete<?php echo $dataobat['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header bg-primary">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah Anda Yakin Ingin Menghapus Data Ini ?</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-left bg-dark">
                                  <input type="hidden" name="id" value="<?php echo $dataobat['id']; ?>">
                                  <p>Nama Obat : <?php echo htmlentities(ucwords($dataobat['nama'])); ?></p>
                                  <p>Penyimpanan : <?php echo htmlentities(ucwords($dataobat['penyimpanan'])); ?></p>
                                  <p>Kategori : <?php echo htmlentities(ucwords($dataobat['kategori'])); ?></p>
                                  <p>Stock : <?php echo htmlentities(ucwords($dataobat['Stock'])); ?></p>
                                  <p>Tanggal Kadaluarsa : <?php echo htmlentities(ucwords($dataobat['t_kadaluarsa'])); ?></p>
                                  <p>Harga Jual : <?php echo htmlentities(ucwords($dataobat['h_jual'])); ?></p>
                                  <p>Unit : <?php echo htmlentities(ucwords($dataobat['Unit'])); ?></p>
                                </div>
                                <div class="modal-footer bg-dark">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                                  <button type="submit" class="btn btn-danger" name="hapus_obat">Hapus</button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <!-- Akhir Modal Hapus -->

                        <!-- Modal Edit -->
                        <form action="proses.php" method="post">
                          <div class="modal fade text-dark" id="edit<?php echo $dataobat['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header bg-primary">
                                  <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Obat</h1>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body bg-dark">
                                  <label for="namaobat">Nama Obat</label>
                                  <input class="form-control" type="text" name="namaobat" id="namaobat" value="<?php echo htmlentities($dataobat['nama']); ?>">
                                  <label for="namaobat">Penyimpanan</label>
                                  <input class="form-control" type="text" name="penyimpanan" id="penyimpanan" value="<?php echo htmlentities($dataobat['penyimpanan']); ?>">
                                  <label for="namaobat">Banyak Stock</label>
                                  <input class="form-control" type="number" name="stock" id="stock" value="<?php echo htmlentities($dataobat['Stock']); ?>">
                                  <label for="unit">Unit</label>
                                  <select class="form-select" aria-label="Default select example" name="unit">
                                    <option selected value="<?php echo $dataobat['Unit']; ?>"><?php echo htmlentities($dataobat['Unit']); ?></option>
                                  <?php 
                                    foreach($units as $unit) {
                                      if($dataobat['Unit'] != $unit['unit']){
                                  ?>
                                      <option value="<?php echo $unit['unit']; ?>"><?php echo htmlentities(ucwords($unit['unit'])); ?></option>
                                  <?php }} ?>
                                  </select>
                                  <label for="kategori">Kategori</label>
                                  <select class="form-select" aria-label="Default select example" name="kategori">
                                    <option selected value="<?php echo $dataobat['kategori']; ?>"><?php echo htmlentities($dataobat['kategori']); ?></option>
                                  <?php 
                                    foreach($kategories as $kategori) {
                                      if($dataobat['kategori'] != $kategori['kategori']){
                                  ?>
                                      <option value="<?php echo $kategori['kategori']; ?>"><?php echo htmlentities(ucwords($kategori['kategori'])); ?></option>
                                  <?php }} ?>
                                  </select>
                                  <label for="kadaluarsa">Tanggal Kadaluarsa</label>
                                  <input type="date" class="form-control" name="kadaluarsa" id="kadaluarsa" autocomplete="off" value="<?php echo $dataobat['t_kadaluarsa']; ?>">
                                  <label for="deskripsi">Deskripsi</label>
                                  <textarea style="height: 213px; resize: none;" name="deskripsi" class="form-control" placeholder="Deskripsi" id="floatingTextarea" autocomplete="off"><?php echo htmlentities($dataobat['deskripsi']); ?></textarea>
                                  <label for="hargabeli">Harga Beli (Rp)</label>
                                  <input type="number" class="form-control" name="hargabeli" id="hargabeli" autocomplete="off" value="<?php echo htmlentities($dataobat['h_beli']); ?>">
                                  <input type="hidden" name="idobat" value="<?php echo $dataobat['id']; ?>">
                                  <label for="hargajual">Harga Jual (Rp)</label>
                                  <input type="number" class="form-control" name="hargajual" id="hargajual" autocomplete="off" value="<?php echo htmlentities($dataobat['h_jual']); ?>">
                                  <label for="pemasok">Nama Pemasok</label>
                                  <select class="form-select" aria-label="Default select example" name="pemasok">
                                    <option selected value="<?php echo $dataobat['pemasok']; ?>"><?php echo htmlentities($dataobat['pemasok']); ?></option>
                                  <?php
                                    foreach($supplier as $pemasok){
                                      if($dataobat['pemasok'] != $pemasok['nama']){
                                  ?>
                                    <option value="<?php echo $pemasok['nama']; ?>"><?php echo $pemasok['nama']; ?></option>
                                  <?php }} ?>
                                  </select>
                                </div>
                                <div class="modal-footer bg-dark">
                                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Kembali</button>
                                  <button type="submit" class="btn btn-warning" name="edit_obat">Edit</button>
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
