<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
        $update=oci_parse($koneksi,"select * from SUPPLIER WHERE ID_SUPPLIER = '$_GET[id]'");
        oci_execute($update);
        $db_data=oci_fetch_array($update);
?>
<section class="content-header">
    <h1>
        Data Supplier
        <small>Update Data Supplier</small>
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
                    <h3 class="box-title">Update Data Supplier</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?fold=inv&page=inv_supp_save" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label for="">Kode Supplier: </label>
                                    <input data-toggle="tooltip" title="SP(Supplier)-011521(bln,thn,detik)-AM(Waktu)" type="text" class="form-control" name="kd_supplier" id="kode_supplier" readonly="readonly" value="<?php echo $db_data[ID_SUPPLIER]; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Nama Supplier:</label>
                                    <input type="text" class="form-control" name="nm_supplier" id="text" placeholder="Nama Supplier" value="<?php echo $db_data[NM_SUPPLIER]; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">No. Telp/HP:</label>
                                    <input type="text" class="form-control" name="no_telp" id="text" placeholder="Nomor Telepon/HP" value="<?php echo $db_data[TELEPON]; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Fax:</label>
                                    <input type="text" class="form-control" name="no_fax" id="text" placeholder="Nomor Fax" value="<?php echo $db_data[FAX]; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Alamat:</label>
                                    <textarea class="form-control" rows="3" name="almt_supplier" id="alamat_supplier" placeholder="Alamat Supplier" required><?php echo $db_data[ALAMAT_SUPPLIER]; ?></textarea>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Email Address:</label>
                                    <input type="email" class="form-control" id="email" name="email_supplier" placeholder="Email Address" value="<?php echo $db_data[EMAIL_SUPPLIER]; ?>" required>
                                </div>    
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="text-right">
                            <input type="submit" name="update" class="btn btn-primary" value="Update" />
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