<?php
include '../config/koneksi.php';
error_reporting(0);
$obat = $_GET['p'];

$query = mysqli_query($koneksi, "SELECT * FROM obat WHERE nama='$obat'");
$row = mysqli_fetch_array($query, MYSQLI_ASSOC);

if($query){ ?>
    <label for="stock">Stock</label>
    <input type="number" value="<?php echo htmlentities($row['Stock']); ?>" name="stock" id="stock" class="form-control" readonly >
    <label for="unit">Unit</label>
    <input type="text" name="unit" id="unit" class="form-control" value="<?php echo htmlentities($row['Unit']); ?>" readonly>
    <label for="harga">Harga</label>
    <input type="number" name="harga" id="harga" class="form-control" value="<?php echo htmlentities($row['h_beli']); ?>" readonly>
<?php }
else {
    echo "Gagal";
}
?>