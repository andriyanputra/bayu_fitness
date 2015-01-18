<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
		$cek_barang=oci_parse($koneksi,"SELECT * FROM BARANG INNER JOIN SUPPLIER ON (BARANG.ID_SUPPLIER = SUPPLIER.ID_SUPPLIER) WHERE BARANG.ID_BARANG='$_GET[id]'");
		oci_execute($cek_barang);
		$db_barang=oci_fetch_array($cek_barang);
    	
?>
<section class="content-header">
    <h1>
        Data Barang
        <small>Update Barang</small>
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
                    <h3 class="box-title">Pembaharuan Data Barang dari <?php echo $db_barang['NM_SUPPLIER']; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?page=inv_barang_save" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Untuk melakukan pembaharuan, silahkan isi pada kolom yang disediakan.
                            </div>
                        </div>
                        <br>
                       <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label for="">Kode Barang: </label>
                                    <input type="hidden" name="kd_supplier" value="<?php echo $db_barang['ID_SUPPLIER']; ?>">
                                    <input type="text" class="form-control" name="kd_barang" id="kode_barang" readonly="readonly" value="<?php echo $db_barang['ID_BARANG']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Nama Barang&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="nm_barang" id="nm_barang" placeholder="Nama Barang" value="<?php echo $db_barang['NM_BARANG']; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Jenis Barang&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="jn_barang" id="jn_barang" placeholder="Jenis Barang" value="<?php echo $db_barang['JENIS_BARANG']; ?>" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Harga @Barang&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control auto" name="hrg_barang" id="hrg_barang" placeholder="Harga Satuan" value="<?php echo $db_barang['HARGA_BARANG']; ?>" required data-a-sep="." data-a-dec="," data-a-sign="Rp. ">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="preview_gambar">Foto Barang&nbsp;<span class="text-red"><b>**</b></span>:</label>
                                    <input type="file" name="ft_barang" id="preview_gambar" class="filestyle" data-buttonName="bg-blue">
                                </div>
                            <?php if($db_barang['FOTO_BARANG']){ ?>
                                <input type="hidden" name="ft_barang_lama" value="<?php echo $db_barang['FOTO_BARANG']; ?>">
                                <img src="../assets/img/barang/<?php echo $db_barang['FOTO_BARANG']; ?>" id="gambar_nodin" width="200" alt="" />
                            <?php }else{ ?>
                                <img src="" id="gambar_nodin" width="200" alt="" />
                            <?php } ?>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Jml. Persediaan Min&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" pattern="\d+" id="jml_barang_min" title="Harus Angka" name="jml_barang_min" placeholder="Jml. Persediaan Min" value="<?php echo $db_barang['JML_MIN']; ?>" required>
                                </div>    
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Jml. Persediaan Max&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" pattern="\d+" id="jml_barang_max" title="Harus Angka" name="jml_barang_max" placeholder="Jml. Persediaan Max" value="<?php echo $db_barang['JML_MAX']; ?>" required>
                                </div>    
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="text-red"><b>*</b></span>&nbsp;Tidak boleh kosong.<br>
                                <span class="text-red"><b>**</b></span>&nbsp;Ukuran foto maksimal 2MB.
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
    <?php include "inv_barang_view.php"; ?>
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