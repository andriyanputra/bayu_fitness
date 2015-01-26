<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
        $hari_ini=date("Y-m-d");
?>
<section class="content-header">
    <h1>
        Pembelian
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Pembelian</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Transaksi Pembelian Barang</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?fold=inv&page=inv_beli_form" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Untuk melakukan transaksi pembelian barang, silahkan tentukan tanggal pembelian barang.
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label for="">Tanggal Pembelian: </label>
                                    <div class="input-group date" data-date="" data-date-format="yyyy-mm-dd">
                                        <input class="form-control" type="text" name="date" placeholder="Pilih Tanggal" value="<?php echo $hari_ini; ?>">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                        <div class="text-right">
                            <input type="submit" name="simpan" class="btn btn-primary" value="Submit" />
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
    <?php //include "inv_supp_view.php"; ?>
</section>
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