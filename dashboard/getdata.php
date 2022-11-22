<?php
include '../config/koneksi.php';
error_reporting(0);
$name = $_GET['q'];
$pemasok = $_GET['p'];

$query = mysqli_query($koneksi, "SELECT * FROM obat WHERE nama='$name'");
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

if($query){ ?>
    <label for="stock">Stock</label>
    <input class="form-control" type="text" name="stock" id="stock" value="<?php echo $row['Stock']; ?>" readonly>
    <label for="unit">Unit Obat</label>
    <input type="text" name="unit" id="unit" class="form-control" value="<?php echo htmlentities($row['Unit']); ?>" readonly>
    <label for="hargasatuan">Harga Satuan</label>
    <input type="number" name="hargasatuan" id="hargasatuan" class="form-control" value="<?php echo htmlentities($row['h_jual']); ?>" readonly>
    <label for="banyak">Banyak</label>
    <input type="number" name="banyak" id="banyak" class="form-control"><a class="btn btn-primary d-flex mt-1 hitung" onclick="hitungTotal()">Hitung</a>
    <label for="total">Total</label>
    <input type="number" name="total" id="total" class="form-control" readonly>
<?php }
else {
    echo "Gagal";
}
?>
