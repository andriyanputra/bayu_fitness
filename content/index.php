<?php 
@session_start();
    if($_SESSION[ID_LEVEL]==1) { 
    	?>
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
	                <?php echo "<b>".$row['NM_PEGAWAI']."</b>";?> dalam Sistem Informasi New Comando Fitness Center.</p>
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
	                    <a href="index?fold=user&page=index" class="small-box-footer">
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
<?php } else if($_SESSION[ID_LEVEL]==2){ ?>
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
	                <?php echo "<b>".$row['NM_PEGAWAI']."</b>";?> dalam Sistem Informasi New Comando Fitness Center.</p>
	            </div>
	        <?php }} ?>
	    </div>
	</div>

	<!-- Main content -->
	<section class="content">
	    <!-- Small boxes (Stat box) -->
	    <div class="row">
	        <div class="col-md-12">
	            <div class="col-lg-3 col-xs-6">
	                <!-- small box -->
	                <div class="small-box bg-aqua" data-toggle="tooltip" title="Artikel">
	                    <div class="inner">
	                        <h3>
	                            <i class="fa fa-files-o"></i>
	                        </h3>
	                        <p>
	                            Artikel
	                        </p>
	                    </div>
	                    <div class="icon">
	                        <i class="fa fa-file-text-o"></i>
	                    </div>
	                    <a href="index?page=artikel" class="small-box-footer">
	                        More info <i class="fa fa-arrow-circle-right"></i>
	                    </a>
	                </div>
	            </div><!-- ./col -->
	            <div class="col-lg-3 col-xs-6">
	                <!-- small box -->
	                <div class="small-box bg-green" data-toggle="tooltip" title="Kegiatan New Comando">
	                    <div class="inner">
	                        <h3>
	                            <i class="fa fa-bookmark"></i>
	                        </h3>
	                        <p>
	                            Kegiatan New Comando
	                        </p>
	                    </div>
	                    <div class="icon">
	                        <i class="fa fa-thumb-tack"></i>
	                    </div>
	                    <a href="index?page=kegiatan" class="small-box-footer">
	                        More info <i class="fa fa-arrow-circle-right"></i>
	                    </a>
	                </div>
	            </div><!-- ./col -->
	            <div class="col-lg-3 col-xs-6">
	                <!-- small box -->
	                <div class="small-box bg-maroon" data-toggle="tooltip" title="Unggah Video">
	                    <div class="inner">
	                        <h3>
	                            <i class="fa fa-upload"></i>
	                        </h3>
	                        <p>
	                            Unggah Video
	                        </p>
	                    </div>
	                    <div class="icon">
	                        <i class="fa fa-youtube-play"></i>
	                    </div>
	                    <a href="index?page=unggah" class="small-box-footer">
	                        More info <i class="fa fa-arrow-circle-right"></i>
	                    </a>
	                </div>
	            </div><!-- ./col -->
	            <div class="col-lg-3 col-xs-6">
	                <!-- small box -->
	                <div class="small-box bg-red" data-toggle="tooltip" title="Pemberitahuan">
	                    <div class="inner">
	                        <h3>
	                            3
	                        </h3>
	                        <p>
	                            Pemberitahuan
	                        </p>
	                    </div>
	                    <div class="icon">
	                        <i class="fa fa-exclamation-circle"></i>
	                    </div>
	                    <a href="index?page=notif" class="small-box-footer">
	                        More info <i class="fa fa-arrow-circle-right"></i>
	                    </a>
	                </div>
	            </div><!-- ./col -->
	        </div>
	    </div>
	</section><!-- /.content -->
<?php //} else { ?>
	<!--<div class="row">
	    <div class="col-md-10 col-md-offset-1">
		    <div class="alert alert-danger alert-dismissable">
		        <i class="fa fa-ban"></i>
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		        <p>Maaf, halaman tidak tersedia !!.</p>
		    </div>
	    </div>
	</div>-->
<?php //} ?>
<?php 
    }else{
        ?>
          <script type="text/javascript">
            setTimeout(function() {
                swal({
                      title:"Oopss!",   
                      text: "Maaf, halaman tidak tersedia !!.",   
                      type: "warning",
                      showCancelButton: false
                }, function(){
                    document.location = 'beranda/index';
                })
            }, 200);
          </script>
        <?php
    }
?>