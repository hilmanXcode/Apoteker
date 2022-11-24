<?php
include '../config/koneksi.php';
error_reporting(0);
$pemasok = $_GET['p'];

if($_SESSION['level'] < 2){
    $_SESSION['message'] = "<script>Swal.fire({title: 'Error!',text: 'Kamu Tidak Punya Akses!',icon: 'error',confirmButtonText: 'OK'})</script>";
    header("Location: index.php");
    die();
}

$query = mysqli_query($koneksi, "SELECT nama FROM obat WHERE pemasok='$pemasok'");

if($query){ ?>
    <label for="namaobat">Obat</label>
    <select class="form-select" aria-label="Default select example" id="namaobat" name="namaobat" onchange="showDataX(this.value)" aria-readonly="true">
        <option value="" selected>Pilih Obat</option>
        <?php
            foreach($query as $obat) {
        ?>
        <option value="<?php echo $obat['nama'] ?>"><?php echo $obat['nama'] ?></option>
        <?php } ?>
    </select>
<?php }
else {
    echo "Gagal";
}
?>