<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
?>
<section class="content-header">
    <h1>
        Laporan Bulanan
        <small>Laporan Supplier</small>
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
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Data Supplier</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            Berikut laporan data supplier pada bulan <?php echo date('F Y'); ?>. Mohon untuk menginstall aplikasi PDF Reader terlebih dahulu untuk menampilkan laporan.
                        </div>
                    </div>
                    <br>
                   	<div class="row">
                        <div class="col-md-12">
                        	<iframe src="../pdf/supplier.php" width="890" height="550"></iframe>
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <div class="text-right">
                        <input type="button" class="btn btn-primary" value="Kembali" onclick="window.history.back();" />
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
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