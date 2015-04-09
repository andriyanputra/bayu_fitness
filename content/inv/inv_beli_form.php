<?php
	@session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
    	if(!empty($_POST['date'])){
    		$date = date_create($_POST['date']);
    		$tgl_transaksi = date_format($date, 'm/d/Y');
    	}else{
    		$date = date_create($_GET['date']);
    		$tgl_transaksi = date_format($date, 'm/d/Y');
    	}
    	$today = date("Y-m-d");
    	if($_POST['date'] <= $today){
?>
<section class="content-header">
    <h1>
        Pembelian
        <small>Transaksi Pembelian Barang</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Pembelian</li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Transaksi Pembelian Barang</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?fold=inv&page=inv_beli_save" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                Untuk melakukan transaksi pembelian, silahkan isi pada kolom yang disediakan.
                            </div>
                        </div>
                        <br>
                       	<div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Nama Supplier&nbsp;<span class="text-red"><b>*</b></span>: </label> 
                                    <select name="kd_beli" class="form-control col-xs-4" required>
	                                    <option value="">Nama Supplier</option>
	                                    <?php
	                                    	function rupiah($nilai, $pecahan = 0) {
				                                return number_format($nilai, $pecahan, ',', '.');
				                            }
	                                        $buy=oci_parse($koneksi,"SELECT SUPPLIER.NM_SUPPLIER, SUPPLIER.ID_SUPPLIER FROM SUPPLIER");
	                                        oci_execute($buy);
	                                        while ($db_=oci_fetch_array($buy)) {
	                                            echo "<option value=\"$db_[ID_SUPPLIER]\"/>$db_[NM_SUPPLIER]";
	                                        }
	                                    ?>
                                    </select>
                                    <a href="../beranda/index?fold=inv&page=inv_supp" class="btn btn-primary form-control" data-toggle="tooltip" title="Tambah Supplier"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Kode Barang: </label>
                                    <?php 
                                        $hitung = oci_parse($koneksi, "SELECT COUNT(*) FROM BARANG");oci_execute($hitung);
                                        $jml_barang = oci_fetch_array($hitung); $cek_ = oci_parse($koneksi, "SELECT ID_BARANG FROM BARANG");
                                        oci_execute($cek_);
                                        if($jml_barang[0] != 0){
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
                                    ?>
                                    <input type="text" class="form-control" name="kd_barang" id="kode_barang" readonly="readonly" value="<?php echo "Beli - 0".$no_brng; ?>">
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
                                    <br><img src="" id="gambar_nodin" width="200" alt="" />
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Jumlah Pembelian&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <input type="text" class="form-control" pattern="\d+" id="jumlah pembelian" title="Harus Angka" name="jml_pembelian" placeholder="Jumlah Pembelian" required>
                                    <input type="hidden" name="tgl_beli" value="<?php echo $tgl_transaksi; ?>">
                                </div>     
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label for="">Keterangan&nbsp;<span class="text-red"><b>*</b></span>:</label>
                                    <textarea class="form-control" rows="3" name="ket_beli" id="ket_beli" placeholder="Keterangan Pembelian" required></textarea>
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
    <?php include "inv_beli_view.php"; ?>
</section>
<?php 
		}else{
			?>
	          <script type="text/javascript">
	            setTimeout(function() {
	                swal({
	                      title:"Oopss!",   
	                      text: "Anda tidak diperkenankan melakukan pembelian lebih dari hari ini !",   
	                      type: "error",
	                      showCancelButton: false
	                }, function(){
	                    window.history.back();
	                })
	            }, 200);
	          </script>
	        <?php
		}
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