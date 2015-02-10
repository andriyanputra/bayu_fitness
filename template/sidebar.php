<?php @session_start(); ?>
<?php if($_SESSION[ID_LEVEL]==1){ ?>
<ul class="sidebar-menu">
    <li class="active">
        <a href="index">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="../beranda/index?fold=notif&page=index"><i class="fa fa-warning"></i> <span>Pemberitahuan</span>
        <small class="badge pull-right bg-red" data-toggle="tooltip" title="<?php echo $emp_[0]+$mem_[0]; ?> Pemberitahuan" data-placement="right"><?php echo $emp_[0]+$mem_[0]; ?></small></a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i>
            <span>Data Member</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="../beranda/index?fold=ang&page=anggota"><i class="fa fa-angle-double-right"></i> Daftar Member</a></li>
            <li><a href="../beranda/index?fold=ang&page=anggota_laporan"><i class="fa fa-angle-double-right"></i> Laporan Member</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-shopping-cart"></i>
            <span>Inventaris Barang</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="../beranda/index?fold=inv&page=inv_supp"><i class="fa fa-angle-double-right"></i> Input Supplier</a></li>
            <li><a href="../beranda/index?fold=inv&page=inv_barang"><i class="fa fa-angle-double-right"></i> Input Barang</a></li>
            <li><a href="../beranda/index?fold=inv&page=inv_pembelian"><i class="fa fa-angle-double-right"></i> Pembelian</a></li>
            <li><a href="../beranda/index?fold=inv&page=inv_penjualan"><i class="fa fa-angle-double-right"></i> Penjualan</a></li>
            <li><a href="../beranda/index?fold=inv&page=inv_stock"><i class="fa fa-angle-double-right"></i> Stock Barang</a></li>
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
        </ul>
    </li>
    <li>
        <a href="../beranda/index?fold=user&page=index">
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
            <li><a href="../beranda/index?page=lap"><i class="fa fa-angle-double-right"></i> Laporan Bulanan</a></li>
        </ul>
    </li>
</ul>
<?php } else if($_SESSION[ID_LEVEL]==2){ ?>
<ul class="sidebar-menu">
    <li class="active">
        <a href="index">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li>
        <a href="../beranda/index?page=notif"><i class="fa fa-warning"></i> <span>Pemberitahuan</span>
        <small class="badge pull-right bg-red" data-toggle="tooltip" title="3 Pemberitahuan" data-placement="right">3</small></a>
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
        </ul>
    </li>
</ul>
<?php } else if($_SESSION[ID_LEVEL]==3){ ?>
<ul class="sidebar-menu">
    <li class="active">
        <a href="index">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#">
            <i class="fa fa-user"></i>
            <span>Data Member</span>
            <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="../beranda/index?fold=ang&page=anggota_profile&id=<?php echo $row[ID_MEMBER]; ?>"><i class="fa fa-angle-double-right"></i> Profile Member</a></li>
            <li><a href="../beranda/index?fold=ang&page=anggota_edit&id=<?php echo $row[ID_MEMBER]; ?>"><i class="fa fa-angle-double-right"></i> Edit Data Member</a></li>
        </ul>
    </li>
</ul>
<?php } ?>