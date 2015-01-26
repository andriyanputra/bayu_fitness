<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
?>
<section class="content-header">
    <h1>
        Data Barang
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Data Barang</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Transaksi Penambahan Barang</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?fold=inv&page=inv_barang_form" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Untuk melakukan transaksi, silahkan pilih supplier pada kolom yang disediakan.
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label for="">Nama Supplier: </label>
                                    <select name="kd_supplier" class="form-control" required>
                                    <option value="">Pilih Supplier</option>}
                                    option
                                    <?php
                                        $supp=oci_parse($koneksi,"select ID_SUPPLIER, NM_SUPPLIER from SUPPLIER");
                                        oci_execute($supp);
                                        while ($db_=oci_fetch_array($supp)) {
                                            echo "<option value=\"$db_[ID_SUPPLIER]\"/>$db_[NM_SUPPLIER]";
                                        }
                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        <div class="text-right">
                            <input type="submit" name="simpan" class="btn btn-primary" value="Next" />
                        </div>
                    </div>
                </form>
            </div><!-- /.box -->
        </div>
    </div>
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