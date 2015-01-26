<?php
    @session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {

    	$kd_jual = $_POST['kd_jual'];
    	$ket_jual = $_POST['ket_jual'];
    	$jml_jual = $_POST['jml_jual'];
    	$tgl_jual = $_POST['tgl_jual'];

		$hasil_sisa="SELECT BARANG.ID_BARANG ,(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG='$kd_jual' GROUP BY ID_BARANG)-(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI='K' AND ID_BARANG='$kd_jual' GROUP BY ID_BARANG) AS sisa FROM BARANG WHERE ID_BARANG='$kd_jual'";
		$sisa = oci_parse($koneksi, $hasil_sisa);
		oci_execute($sisa);
		$db = oci_fetch_array($sisa);
		$db_sisa = $db['sisa'];

		$jml_max = "SELECT JML_MAX, JML_MIN FROM BARANG WHERE ID_BARANG='$kd_jual'";
		$jml_q = oci_parse($koneksi, $jml_max); oci_execute($jml_q);
		$db_ = oci_fetch_array($jml_q);
		$db_min = $db_['JML_MIN'];
		$db_max = $db_['JML_MAX'];

		//function jml_barang($kode_barang,$status){
            $jml_brng = oci_parse($koneksi, "SELECT SUM(JML_TRANSAKSI) AS jumlah FROM TRANSAKSI WHERE ID_BARANG='$kd_jual' AND STATUS_TRANSAKSI='M' AND JML_TRANSAKSI>0");
            oci_execute($jml_brng); 
            $jml_barang_ = oci_fetch_array($jml_brng);
            $tes = $jml_barang_[jumlah];
        //}

		//echo $db_sisa;

		if($db_sisa == NULL){
			$sisa_barang = $tes;
		}else{
			$sisa_barang = $db_sisa;
		}

		if(($sisa_barang - $jml_jual)<$db_min){
			?>
	          <script type="text/javascript">
	            setTimeout(function() {
	                swal({
	                      title:"Oopss!",   
	                      text: "Penjualan sebanyak <?php echo $jml_jual; ?> mengakibatkan Jml minimum persediaan kurang dari <?php echo $db_min; ?>",   
	                      type: "warning",
	                      showCancelButton: false
	                }, function(){
	                    document.location = 'index?fold=inv&page=inv_penjualan';
	                })
	            }, 200);
	          </script>
	        <?php
	    }else{
			$insert = oci_parse($koneksi, "INSERT INTO TRANSAKSI 
				VALUES($kd_jual,TO_DATE('$tgl_jual', 'MM/DD/YYYY'),'$ket_jual',$jml_jual,'K')");
			if(oci_execute($insert)){
				?>
		          <script type="text/javascript">
		            setTimeout(function() {
		                swal({
		                      title:"Success!",   
		                      text: "Data berhasil disimpan",   
		                      type: "success",
		                      showCancelButton: false
		                }, function(){
		                    document.location = 'index?fold=inv&page=inv_jual_form';
		                })
		            }, 200);
		          </script>
		        <?php
			}else{
				?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "Data penjualan gagal tersimpan ! Silahkan memulainya dari awal.",   
			                  type: "warning",
			                  showCancelButton: false
			            }, function(){
			                document.location = 'index?fold=inv&page=inv_penjualan';
			            })
			        }, 200);
			      </script>
			    <?php
			} 
		}
		//echo $count_."<br>".$kd_jual."<br>".$ket_jual."<br>".$jml_jual."<br>".$tgl_jual;
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