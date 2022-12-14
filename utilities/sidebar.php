<div class='sidebar'>


    <!-- Sidebar Menu -->
    <nav class='mt-2'>
    <ul class='nav nav-pills nav-sidebar flex-column' data-widget='treeview' role='menu' data-accordion='false'>
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
        <li class='nav-item'>
            <a href='index.php' class='nav-link'>
                <img src='../assets/images/dashboard.png' alt=''>
                <p>
                    Dashboard
                </p>
            </a>
        </li>
        <?php
            if($_SESSION['level'] == 1337){
                echo "
                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/medicine.png' alt='obat' class='nav-icon'>
                    <p>
                    Obat
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_obat.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Obat</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='obat.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Obat</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='obat_kadaluarsa.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Obat Kadaluwarsa</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='obat_habis.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Obat Habis</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>

                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/list.png' alt='obat' class='nav-icon'>
                    <p>
                    Kategori & Unit
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_kategori_obat.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Kategori</p>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='kategori.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Kategori</p>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='tambah_unit.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Unit</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='units.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Unit</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>

                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/packages.png' alt='obat' class='nav-icon'>
                    <p>
                    Pemasok
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_pemasok.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Pemasok</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='pemasok.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Pemasok</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>

                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/sales.png' alt='obat' class='nav-icon'>
                    <p>
                    Penjualan
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_penjualan.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Penjualan</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='penjualan.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Penjualan</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>

                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/cart.png' alt='obat' class='nav-icon'>
                    <p>
                    Pembelian
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_pembelian.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Pembelian</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='pembelian.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Data Pembelian</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>
                
                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/profile.png' alt='obat' class='nav-icon'>
                    <p>
                    Pegawai
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_user.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Pegawai</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='users.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Data Pegawai</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>
                ";
            }
            elseif($_SESSION['level'] == 1) {
                echo "
                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/sales.png' alt='obat' class='nav-icon'>
                    <p>
                    Penjualan
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_penjualan.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Penjualan</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='penjualan.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Penjualan</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>
                ";
            }
            elseif($_SESSION['level'] == 2){
                echo "
                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/medicine.png' alt='obat' class='nav-icon'>
                    <p>
                    Obat
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_obat.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Obat</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='obat.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Obat</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='obat_kadaluarsa.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Obat Kadaluwarsa</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='obat_habis.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Obat Habis</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>

                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/list.png' alt='obat' class='nav-icon'>
                    <p>
                    Kategori & Unit
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_kategori_obat.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Kategori</p>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='kategori.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Kategori</p>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='tambah_unit.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Unit</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='units.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Unit</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>

                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/packages.png' alt='obat' class='nav-icon'>
                    <p>
                    Pemasok
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_pemasok.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Pemasok</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='pemasok.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Pemasok</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>

                <li class='nav-item'>
                <a href='#' class='nav-link'>
                    <img src='../assets/images/cart.png' alt='obat' class='nav-icon'>
                    <p>
                    Pembelian
                    <i class='right fas fa-angle-left'></i>
                    </p>
                </a>
                <ul class='nav nav-treeview'>
                    <li class='nav-item'>
                    <a href='tambah_pembelian.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Tambah Pembelian</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                    <li class='nav-item'>
                    <a href='pembelian.php' class='nav-link'>
                        <i class='far fa-circle nav-icon'></i>
                        <p>Lihat Data Pembelian</p>
                        <span class='right badge badge-danger'>New</span>
                    </a>
                    </li>
                </ul>
                </li>
                ";
            }
        ?>

        <li class='nav-item'>
            <a href='logout.php' style='padding-left: 80px; padding-right: 80px;' class='mt-2 btn btn-warning text-dark'>
                <img src='../assets/images/exit.png' alt='' width='16' height='16'>
                Logout
            </a>
        </li>

    </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>