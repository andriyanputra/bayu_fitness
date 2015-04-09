<?php
    @session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
        $hari_ini = date("m/d/Y");
?>
<section class="content-header">
    <h1>
        Penjualan
        <small>Transaksi Penjualan Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Penjualan</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Transaksi Penjualan Barang</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?fold=inv&page=inv_jual_save" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Untuk melakukan transaksi penjualan, silahkan isi pada kolom yang disediakan.
                            </div>
                        </div>
                        <br>
                       	<div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                <label for="">Nama Barang / Sisa&nbsp;<span class="text-red"><b>*</b></span>: </label>
                                    <select name="kd_jual" class="form-control" required>
	                                    <option value="">Pilih Barang</option>}
	                                    option
	                                    <?php
	                                    	//function sisa_barang($kode_barang){
											//}

	                                    	function rupiah($nilai, $pecahan = 0) {
				                                return number_format($nilai, $pecahan, ',', '.');
				                            }
	                                        $buy=oci_parse($koneksi,"SELECT DISTINCT BARANG.ID_BARANG, BARANG.NM_BARANG FROM BARANG, TRANSAKSI WHERE BARANG.ID_BARANG = TRANSAKSI.ID_BARANG");
	                                        oci_execute($buy);
	                                        while ($db_=oci_fetch_array($buy)) {
	                                        	//mengecek apakah barang masih ada atau belum
	                                        	//if(sisa_barang($db_[ID_BARANG])<>0 || sisa_barang($db_[ID_BARANG]) == NULL){
	                                        	//	echo "<option value=\"$db_[ID_BARANG]\">$db_[NM_SUPPLIER] - $db_[NM_BARANG] - ".sisa_barang($db_[ID_BARANG])."</option>";
	                                        	//}
	                                        	//echo "Sisa Barang: ".sisa_barang($db_[ID_BARANG]);
                                                $in = oci_parse($koneksi, "SELECT DISTINCT JML_TRANSAKSI FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG = '$db_[ID_BARANG]'"); oci_execute($in);
                                                $masuk = oci_fetch_array($in);
                                                $out = oci_parse($koneksi, "SELECT DISTINCT SUM(JML_TRANSAKSI) FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'K' AND ID_BARANG = '$db_[ID_BARANG]'"); oci_execute($out);
                                                $keluar = oci_fetch_array($out);
                                                $hasil_sisa="SELECT DISTINCT BARANG.ID_BARANG ,(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG='$db_[ID_BARANG]' GROUP BY ID_BARANG)-(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI='K' AND ID_BARANG='$db_[ID_BARANG]' GROUP BY ID_BARANG) AS sisa FROM BARANG WHERE ID_BARANG='$db_[ID_BARANG]'";
                                                $sisa = oci_parse($koneksi, $hasil_sisa);
                                                oci_execute($sisa);
                                                $d = oci_fetch_array($sisa);
                                                if(!empty($d[SISA])){
                                                    echo "<option value=\"$db_[ID_BARANG]\">$db_[NM_BARANG] / $d[SISA]</option>";
                                                }else if($keluar[0] == $masuk[JML_TRANSAKSI]){
                                                    echo "<option value=\"0\">Kosong</option>";
                                                }else{
                                                    echo "<option value=\"$db_[ID_BARANG]\">$db_[NM_BARANG] / $masuk[JML_TRANSAKSI]</option>";
                                                }
                                            }
	                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label for="">Jumlah Penjualan&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" pattern="\d+" id="jml_jual" title="Harus Angka" name="jml_jual" placeholder="Jumlah Penjualan" required>
                                    <input type="hidden" name="tgl_jual" value="<?php echo $hari_ini; ?>">
                                </div>    
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Keterangan&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <textarea class="form-control" rows="3" name="ket_jual" id="ket_jual" placeholder="Keterangan Penjualan" required></textarea>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <span class="text-red"><b>*</b></span>&nbsp;Tidak boleh kosong.<br>
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
    <?php include "inv_jual_view.php"; ?>
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