<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
    	if($_POST['simpan'] == "Next"){
    		$kd_supplier = $_POST['kd_supplier'];
    		$cek_barang=oci_parse($koneksi,"select * from SUPPLIER WHERE ID_SUPPLIER='$kd_supplier'");
    		$hitung_barang=oci_parse($koneksi,"select count(*) from BARANG");
			oci_execute($cek_barang);oci_execute($hitung_barang);
			$db_barang=oci_fetch_array($cek_barang);
			$jml_barang=oci_fetch_array($hitung_barang);
    	}
?>
<section class="content-header">
    <h1>
        Data Barang
        <small>Penambahan Barang</small>
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
                    <h3 class="box-title">Transaksi Penambahan Barang dari <?php echo $db_barang['NM_SUPPLIER']; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?page=inv_barang_save" method="post">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Untuk melakukan transaksi penambahan, silahkan isi pada kolom yang disediakan.
                            </div>
                        </div>
                        <br>
                       <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label for="">Kode Barang: </label>
                                    <?php 
                                    	$nm = $db_barang['NM_SUPPLIER'];
										function initials($str) {
										    $ret = '';
										    foreach (explode(' ', $str) as $word)
										        $ret .= strtoupper($word[0]);
										    return $ret;
										}
										if($jml_barang[0] == 0){
											$no_brng = 1;
										}else{
											$no_brng = $jml_barang[0];
										}
                                    ?>
                                    <input type="hidden" name="kd_supplier" value="<?php echo $db_barang['ID_SUPPLIER']; ?>">
                                    <input type="text" class="form-control" name="kd_barang" id="kode_barang" readonly="readonly" value="<?php echo "".initials($nm)."-0".$no_brng; ?>" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Nama Barang&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="nm_barang" id="nm_barang" placeholder="Nama Barang" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Jenis Barang&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" name="jn_barang" id="jn_barang" placeholder="Jenis Barang" required>
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Harga @Barang&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control auto" name="hrg_barang" id="hrg_barang" placeholder="Harga Satuan" required data-a-sep="." data-a-dec="," data-a-sign="Rp. ">
                                   
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="preview_gambar">Foto Barang:</label>
                                    <input type="file" name="ft_barang" id="preview_gambar" class="filestyle" data-buttonName="bg-blue">
                                </div>
                                <img src="" id="gambar_nodin" width="200" alt="" />
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Jml. Persediaan Min&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" pattern="\d+" title="Harus Angka" name="jml_barang_min" placeholder="Jml. Persediaan Min" required>
                                </div>    
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Jml. Persediaan Max&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" pattern="\d+" title="Harus Angka" name="jml_barang_max" placeholder="Jml. Persediaan Max" required>
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
                            <input type="submit" name="simpan" class="btn btn-primary" value="Submit" />
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