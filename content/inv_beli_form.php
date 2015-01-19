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
        <div class="col-md-8 col-md-offset-2">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Transaksi Pembelian Barang</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="index?page=inv_beli_save" method="post" enctype="multipart/form-data">
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
                                <label for="">Supplier Barang - Nama Barang&nbsp;<span class="text-red"><b>*</b></span>: </label>
                                    <select name="kd_beli" class="form-control" required>
	                                    <option value="">Pilih Barang</option>}
	                                    option
	                                    <?php
	                                    	function rupiah($nilai, $pecahan = 0) {
				                                return number_format($nilai, $pecahan, ',', '.');
				                            }
	                                        $buy=oci_parse($koneksi,"SELECT BARANG.HARGA_BARANG, BARANG.ID_BARANG, BARANG.NM_BARANG, SUPPLIER.NM_SUPPLIER FROM BARANG INNER JOIN SUPPLIER ON (BARANG.ID_SUPPLIER = SUPPLIER.ID_SUPPLIER) ORDER BY SUPPLIER.NM_SUPPLIER ASC");
	                                        oci_execute($buy);
	                                        while ($db_=oci_fetch_array($buy)) {
	                                            echo "<option value=\"$db_[ID_BARANG]\"/>$db_[NM_SUPPLIER] | $db_[NM_BARANG] | Rp. ".rupiah($db_[HARGA_BARANG],2)."";
	                                        }
	                                    ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
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