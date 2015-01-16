<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
?>
<section class="content-header">
    <h1>
        Data Supplier
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Data Supplier</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Tambah Data Supplier</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?page=inv_supp_save" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label for="">Kode Supplier: </label>
                                    <?php $date = date("my"); $detik = date("s-A"); ?>
                                    <input data-toggle="tooltip" title="SP(Supplier)-011521(bln,thn,detik)-AM(Waktu)" type="text" class="form-control" name="kd_supplier" id="kode_supplier" readonly="readonly" value="<?php echo 'SP-'.$date.''.$detik; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Nama Supplier&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="nm_supplier" id="text" placeholder="Nama Supplier" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">No. Telp/HP&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="no_telp" id="text" placeholder="Nomor Telepon/HP" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Fax&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="no_fax" id="text" placeholder="Nomor Fax" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Alamat&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <textarea class="form-control" rows="3" name="almt_supplier" id="alamat_supplier" placeholder="Alamat Supplier" required></textarea>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Email Address&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="email" class="form-control" id="email" name="email_supplier" placeholder="Email Address" required>
                                </div>    
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="text-red"><b>*</b></span>&nbsp;Tidak boleh kosong.
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="text-right">
                            <input type="submit" name="simpan" class="btn btn-primary" value="Simpan" />
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
    <?php include "inv_supp_view.php"; ?>
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