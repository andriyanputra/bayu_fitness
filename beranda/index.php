<?php
	include "../config/koneksi.php";
    @session_start();
	if(isset($_SESSION['NIP_PEGAWAI']) && !empty($_SESSION['NIP_PEGAWAI'])) {
		$query = oci_parse($koneksi, "SELECT * FROM PEGAWAI INNER JOIN LEVEL_LOGIN ON (PEGAWAI.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL)
										INNER JOIN JABATAN ON (PEGAWAI.ID_JABATAN = JABATAN.ID_JABATAN)
            							WHERE PEGAWAI.NIP_PEGAWAI = $_SESSION[NIP_PEGAWAI]");
  		$data = oci_execute($query);
  		$row = oci_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <title>New Comando Fitness Center</title>

        <meta name="description" content="Common form elements and layouts" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!--page specific plugin styles-->
        <link rel="shortcut icon" href="../../assets/img/favicon.png">

        <script src="../assets/frontend/js/sweet-alert.js"></script>
        <link rel="stylesheet" href="../assets/frontend/css/sweet-alert.css" />
        <!-- bootstrap 3.0.2 -->
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <style type="text/css" media="screen">
            .footer {
                position: relative;
                padding: 15px;
                background: #FFF;
                color: #000;
            }
        </style>

        <!--inline styles related to this page-->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    </head>
    <body class="skin-blue">
		 <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="index.html" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                New Comando Fitness
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                <span class="label label-success">4</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 4 messages</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar3.png" class="img-circle" alt="User Image"/>
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li><!-- end message -->
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    AdminLTE Design Team
                                                    <small><i class="fa fa-clock-o"></i> 2 hours</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Developers
                                                    <small><i class="fa fa-clock-o"></i> Today</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar2.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Sales Department
                                                    <small><i class="fa fa-clock-o"></i> Yesterday</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="../assets/img/avatar.png" class="img-circle" alt="user image"/>
                                                </div>
                                                <h4>
                                                    Reviewers
                                                    <small><i class="fa fa-clock-o"></i> 2 days</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $row['NM_PEGAWAI']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
                                    <img src="../assets/img/avatar3.png" class="img-circle" alt="User Image" />
                                    <p>
                                        <?php echo $row['NM_PEGAWAI']." - ".$row['NM_JABATAN']; ?>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../config/signout" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="../assets/img/avatar3.png" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                        <?php $nama = $row['NM_PEGAWAI']; $first_nama = explode(' ',trim($nama)); ?>
                            <p>Hello, <?php echo $first_nama[0]; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
                    <div align="center">
                    	<script>
	                        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
	                        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
	                        var date = new Date();
	                        var day = date.getDate();
	                        var month = date.getMonth();
	                        var thisDay = date.getDay(),
	                                thisDay = myDays[thisDay];
	                        var yy = date.getYear();
	                        var year = (yy < 1000) ? yy + 1900 : yy;
	                        document.write(thisDay + ', ' + day + ' ' + months[month] + ' ' + year);
	                    </script>
	                    <p>Pukul <span id="clock"></span></p>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
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
                                <li><a href="../anggota/index"><i class="fa fa-angle-double-right"></i> Daftar Anggota</a></li>
                                <li><a href="../anggota/cek"><i class="fa fa-angle-double-right"></i> Cetak Kartu Anggota</a></li>
                                <li><a href="../anggota/sewa"><i class="fa fa-angle-double-right"></i> Sewa Peralatan</a></li>
                                <li><a href="../anggota/laporan"><i class="fa fa-angle-double-right"></i> Laporan Anggota</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Inventaris Barang</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../inv/supplier"><i class="fa fa-angle-double-right"></i> Data Supplier</a></li>
                                <li><a href="../inv/pembelian"><i class="fa fa-angle-double-right"></i> Pembelian</a></li>
                                <li><a href="../inv/penjualan"><i class="fa fa-angle-double-right"></i> Penjualan</a></li>
                                <li><a href="../inv/stock"><i class="fa fa-angle-double-right"></i> Stock Barang</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-cog"></i>
                                <span>Olah Website</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> Artikel</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Kegiatan</a></li>
                                <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Unggah Video</a></li>
                                <li>
	                                <a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> <span>Pemberitahuan</span>
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
                                <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                                <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                            </ul>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Dashboard
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Dashboard</li>
                    </ol>
                </section>

                <br>

				<div class="row">
					<div class="col-md-10 col-md-offset-1">
						<?php
		                    if (isset($_GET['msg'])) {
		                        if ($_GET['msg'] == 'log_in') {
		                            ?>
		                    <div class="alert alert-success alert-dismissable">
		                        <i class="fa fa-check"></i>
		                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		                        <p>Selamat datang,
		                        <?php echo "<b>".$row['NM_PEGAWAI']."</b>";?> dalam sistem informasi New Comando Fitness Center.</p>
		                    </div>
	                	<?php }} ?>
	                </div>
				</div>

                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                    	<div class="col-md-10 col-md-offset-1">
                    		<div class="col-lg-4 col-xs-4">
	                            <!-- small box -->
	                            <div class="small-box bg-aqua" data-toggle="tooltip" title="Data Anggota">
	                                <div class="inner">
	                                    <h3>
	                                        150
	                                    </h3>
	                                    <p>
	                                        Data Anggota
	                                    </p>
	                                </div>
	                                <div class="icon">
	                                    <i class="fa fa-user"></i>
	                                </div>
	                                <a href="#" class="small-box-footer">
	                                    More info <i class="fa fa-arrow-circle-right"></i>
	                                </a>
	                            </div>
	                        </div><!-- ./col -->
	                        <div class="col-lg-4 col-xs-4">
	                            <!-- small box -->
	                            <div class="small-box bg-green" data-toggle="tooltip" title="Inventaris Barang">
	                                <div class="inner">
	                                    <h3>
	                                        53<sup style="font-size: 20px">%</sup>
	                                    </h3>
	                                    <p>
	                                        Inventaris Barang
	                                    </p>
	                                </div>
	                                <div class="icon">
	                                    <i class="fa fa-shopping-cart"></i>
	                                </div>
	                                <a href="#" class="small-box-footer">
	                                    More info <i class="fa fa-arrow-circle-right"></i>
	                                </a>
	                            </div>
	                        </div><!-- ./col -->
	                        <div class="col-lg-4 col-xs-4">
	                            <!-- small box -->
	                            <div class="small-box bg-red" data-toggle="tooltip" title="Olah Website">
	                                <div class="inner">
	                                    <h3>
	                                        <i class="fa fa-file-text"></i>
	                                    </h3>
	                                    <p>
	                                        Olah Website
	                                    </p>
	                                </div>
	                                <div class="icon">
	                                    <i class="fa fa-wrench"></i>
	                                </div>
	                                <a href="#" class="small-box-footer">
	                                    More info <i class="fa fa-arrow-circle-right"></i>
	                                </a>
	                            </div>
	                        </div><!-- ./col -->
                    	</div>
                    </div>
                    <div class="row">
                    	<div class="col-md-6 col-md-offset-3">
                    		<div class="col-lg-6 col-xs-6">
	                            <!-- small box -->
	                            <div class="small-box bg-maroon" data-toggle="tooltip" title="User Management">
	                                <div class="inner">
	                                    <h3>
	                                        <i class="fa fa-users"></i>
	                                    </h3>
	                                    <p>
	                                        User Management
	                                    </p>
	                                </div>
	                                <div class="icon">
	                                    <i class="fa fa-cogs"></i>
	                                </div>
	                                <a href="#" class="small-box-footer">
	                                    More info <i class="fa fa-arrow-circle-right"></i>
	                                </a>
	                            </div>
	                        </div><!-- ./col -->
                    		<div class="col-lg-6 col-xs-6" data-toggle="tooltip" title="Laporan">
	                            <!-- small box -->
	                            <div class="small-box bg-yellow">
	                                <div class="inner">
	                                    <h3>
	                                        <i class="fa fa-bar-chart-o"></i>
	                                    </h3>
	                                    <p>
	                                        Laporan
	                                    </p>
	                                </div>
	                                <div class="icon">
	                                    <i class="ion ion-pie-graph"></i>
	                                </div>
	                                <a href="#" class="small-box-footer">
	                                    More info <i class="fa fa-arrow-circle-right"></i>
	                                </a>
	                            </div>
	                        </div><!-- ./col -->
                    	</div>
                    </div><!-- /.row -->
                </section><!-- /.content -->

            </aside><!-- /.right-side -->
            <footer>
	            <div class="row">
	                <div class="col-sm-6 col-md-offset-3 text-center">
		                <blockquote>
		                    <small>Copyright 2014 | All Rights Reserved <cite title="Source Title">New Comando Fitness Center </cite>- Surabaya</small>
		                </blockquote>
	                </div>
	            </div>
	        </footer>
        </div><!-- ./wrapper -->
		
        <?php include "../template/footer.php"; ?>
    </body>
</html>
<?php 
	}else{
		?>
	      <script type="text/javascript">
	        setTimeout(function() {
	            swal({
	                  title:"Oopss!",   
	                  text: "Silahkan Sign In terlebih dahulu !",   
	                  type: "warning",
	                  showCancelButton: false
	            }, function(){
	                document.location = '../index';
	            })
	        }, 200);
	      </script>
	    <?php
	}
?>