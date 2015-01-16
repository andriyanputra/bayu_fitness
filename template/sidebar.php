<?php @session_start(); ?>
<?php if($_SESSION['NIP_PEGAWAI'] == 115623210){ ?>
<ul class="sidebar-menu">
    <li class="active">
        <a href="index">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i>
            <span>Data Anggota</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="../index?page=anggota"><i class="fa fa-angle-double-right"></i> Daftar Anggota</a></li>
            <li><a href="../index?page=anggota_cek"><i class="fa fa-angle-double-right"></i> Cetak Kartu Anggota</a></li>
            <li><a href="../index?page=anggota_sewa"><i class="fa fa-angle-double-right"></i> Sewa Peralatan</a></li>
            <li><a href="../index?page=anggota_laporan"><i class="fa fa-angle-double-right"></i> Laporan Anggota</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Inventaris Barang</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="../beranda/index?page=inv_supp"><i class="fa fa-angle-double-right"></i> Data Supplier</a></li>
            <li><a href="../beranda/index?page=inv_barang"><i class="fa fa-angle-double-right"></i> Data Barang</a></li>
            <li><a href="../beranda/index?page=inv_pembelian"><i class="fa fa-angle-double-right"></i> Pembelian</a></li>
            <li><a href="../beranda/index?page=inv_penjualan"><i class="fa fa-angle-double-right"></i> Penjualan</a></li>
            <li><a href="../beranda/index?page=inv_stock"><i class="fa fa-angle-double-right"></i> Stock Barang</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-cog"></i>
            <span>Olah Website</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="../beranda/index?page=artikel"><i class="fa fa-angle-double-right"></i> Artikel</a></li>
            <li><a href="../beranda/index?page=kegiatan"><i class="fa fa-angle-double-right"></i> Kegiatan</a></li>
            <li><a href="../beranda/index?page=unggah"><i class="fa fa-angle-double-right"></i> Unggah Video</a></li>
            <li>
                <a href="../beranda/index?page=notif"><i class="fa fa-angle-double-right"></i> <span>Pemberitahuan</span>
                <small class="badge pull-right bg-red" data-toggle="tooltip" title="3 Pemberitahuan" data-placement="right">3</small></a>
            </li>
        </ul>
    </li>
    <li>
        <a href="#">
            <i class="fa fa-users"></i> <span>User Management</span>
        </a>                        
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-bar-chart-o"></i> <span>Laporan</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-angle-double-right"></i> Grafik</a></li>
            <li><a href="#"><i class="fa fa-angle-double-right"></i> Laporan Bulanan</a></li>
        </ul>
    </li>
</ul>
<?php } else if($_SESSION['NIP_PEGAWAI'] == 115623204){ ?>
<ul class="sidebar-menu">
    <li class="active">
        <a href="index">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview active">
        <a href="#">
            <i class="fa fa-cog"></i>
            <span>Olah Website</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="index?page=artikel"><i class="fa fa-angle-double-right"></i> Artikel</a></li>
            <li><a href="index?page=kegiatan"><i class="fa fa-angle-double-right"></i> Kegiatan</a></li>
            <li><a href="index?page=unggah"><i class="fa fa-angle-double-right"></i> Unggah Video</a></li>
            <li>
                <a href="index?page=notif"><i class="fa fa-angle-double-right"></i> <span>Pemberitahuan</span>
                <small class="badge pull-right bg-red" data-toggle="tooltip" title="3 Pemberitahuan" data-placement="right">3</small></a>
            </li>
        </ul>
    </li>
</ul>
<?php } ?>