<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
    	$hitung_supplier=oci_parse($koneksi,"SELECT count(*) FROM SUPPLIER"); oci_execute($hitung_supplier); $count_supp = oci_fetch_array($hitung_supplier);
?>
<section class="content-header">
    <h1>
        Laporan Bulanan
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
        <li class="active">Laporan Bulanan</li>
    </ol>
</section>

<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-lg-4 col-xs-4">
                <!-- small box -->
                <div class="small-box bg-aqua" data-toggle="tooltip" title="Data Supplier">
                    <div class="inner">
                        <h3>
                            <?php echo $count_supp[0]; ?>
                        </h3>
                        <p>
                            Data Supplier
                        </p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                    <a href="index?page=lap_supp_report" class="small-box-footer">
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
<?php
    }else{
        ?>
          <script type="text/javascript">
            setTimeout(function() {
                swal({
                      title:"Oopss!",   
                      text: "Restricted Page !",   
                      type: "warning",
                      showCancelButton: false
                }, function(){
                    window.history.back();
                })
            }, 200);
          </script>
        <?php
    }
?>