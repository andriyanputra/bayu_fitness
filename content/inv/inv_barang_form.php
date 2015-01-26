<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
    	//if($_POST['simpan'] == "Next"){
    		$kd_supplier = $_POST['kd_supplier'];
    		$cek_barang=oci_parse($koneksi,"SELECT * FROM BARANG INNER JOIN SUPPLIER ON (BARANG.ID_SUPPLIER = SUPPLIER.ID_SUPPLIER) WHERE BARANG.ID_SUPPLIER='$kd_supplier' OR BARANG.ID_SUPPLIER='$_GET[id]'");
    		$hitung_barang=oci_parse($koneksi,"select count(*) from BARANG WHERE ID_SUPPLIER='$kd_supplier' OR ID_SUPPLIER='$_GET[id]'");
    		$cek_supp=oci_parse($koneksi, "SELECT * FROM SUPPLIER WHERE ID_SUPPLIER='$kd_supplier' OR ID_SUPPLIER='$_GET[id]'");
			oci_execute($cek_barang);oci_execute($hitung_barang);oci_execute($cek_supp);
			$db_barang=oci_fetch_array($cek_barang);$db_supp=oci_fetch_array($cek_supp);
			$jml_barang=oci_fetch_array($hitung_barang);
    	//}
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
                    <h3 class="box-title">Transaksi Penambahan Barang dari <?php echo $db_supp['NM_SUPPLIER']; ?></h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?fold=inv&page=inv_barang_save" method="post" enctype="multipart/form-data">
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
                                    	$nm = $db_supp['NM_SUPPLIER'];
										function initials($str) {
										    $ret = '';
										    foreach (explode(' ', $str) as $word)
										        $ret .= strtoupper($word[0]);
										    return $ret;
										}
										if($jml_barang[0] != 0){
											$cek_ = oci_parse($koneksi, "SELECT ID_BARANG FROM BARANG");
											oci_execute($cek_);
											$no = 0;
											while ($db_=oci_fetch_array($cek_)) {
												$no++;
												$kd = $db_['ID_BARANG'];
												$kd_barang = substr($kd,-1);
												if($kd_barang != $no){
													$no_brng = $no ;
												}else{
													$no_brng = $kd_barang + 1;
												}
												//echo $kd_barang."<br>";
												//echo $no."<br>";
											}
										}else{
											$no_brng = $jml_barang[0] + 1;
										}
										
										//echo $no_brng;
										
                                    ?>
                                    <input type="hidden" name="kd_supplier" value="<?php echo $db_barang['ID_SUPPLIER']; ?>">
                                    <input type="text" class="form-control" name="kd_barang" id="kode_barang" readonly="readonly" value="<?php echo "".initials($nm)."-0".$no_brng; ?>">
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
                                    <label for="preview_gambar">Foto Barang&nbsp;<span class="text-red"><b>**</b></span>:</label>
                                    <input type="file" name="ft_barang" id="preview_gambar" class="filestyle" data-buttonName="bg-blue">
                                </div>
                                <img src="" id="gambar_nodin" width="200" alt="" />
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Jml. Persediaan Min&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" pattern="\d+" id="jml_barang_min" title="Harus Angka" name="jml_barang_min" placeholder="Jml. Persediaan Min" required>
                                </div>    
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="">Jml. Persediaan Max&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" pattern="\d+" id="jml_barang_max" title="Harus Angka" name="jml_barang_max" placeholder="Jml. Persediaan Max" required>
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