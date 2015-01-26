<?php
    @session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
    	$inc = "SELECT COUNT(*) FROM TRANSAKSI";
    	$inc_ = oci_parse($koneksi, $inc);oci_execute($inc_);
    	$count = oci_fetch_array($inc_);
    	if($count[0] == 0){
    		$count_ = $count[0] + 1;
    	}else{
    		$count_ = $count[0] + 1;
    	}

    	$kd_beli = $_POST['kd_beli'];
    	$ket_beli = $_POST['ket_beli'];
    	$jml_beli = $_POST['jml_pembelian'];
    	$tgl_beli = $_POST['tgl_beli'];
    	if($jml_beli < 0){
    		?>
		      <script type="text/javascript">
		        setTimeout(function() {
		            swal({
		                  title:"Oopss!",   
		                  text: "Maaf pembelian barang tidak boleh kurang dari 0 !",   
		                  type: "warning",
		                  showCancelButton: false
		            }, function(){
		                 document.location = 'index?fold=inv&page=inv_pembelian';
		            })
		        }, 200);
		      </script>
			<?php
			exit;
    	}
    	//function sisa_barang($kd_beli){
			$hasil_sisa="SELECT BARANG.ID_BARANG ,(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG='$kd_beli' GROUP BY ID_BARANG)-(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI='K' AND ID_BARANG='$kd_beli' GROUP BY ID_BARANG) AS sisa FROM BARANG WHERE ID_BARANG='$kd_beli'";
			$sisa = oci_parse($koneksi, $hasil_sisa);
			oci_execute($sisa);
			$db = oci_fetch_array($sisa);
			$db_sisa = $db['sisa'];
			//return $db_[sisa];
		//}
		//function jml_max($kd_beli){
			$jml_max = "SELECT JML_MAX, JML_MIN FROM BARANG WHERE ID_BARANG='$kd_beli'";
			$jml_q = oci_parse($koneksi, $jml_max); oci_execute($jml_q);
			$db_ = oci_fetch_array($jml_q);
			$db_min = $db_['JML_MIN'];
			$db_max = $db_['JML_MAX'];
			//return $db_[JML_MAX];
		//}
		/*function jml_min($kd_beli){
			$jml_max = "SELECT JML_MIN FROM BARANG WHERE ID_BARANG='$kd_beli'";
			$jml_q = oci_parse($koneksi, $jml_max); oci_execute($jml_q);
			$db_ = oci_fetch_array($jml_q);
			return $db_[JML_MIN];
		}*/
		
		if(($db_sisa + abs($jml_beli)) > $db_max){
			//$over = abs($jml_beli) - ($db_max - $db_sisa);
			?>
	          <script type="text/javascript">
	            setTimeout(function() {
	                swal({
	                      title:"Oopss!",   
	                      text: "Maaf, jumlah pembelian barang melebihi kapasistas !",   
	                      type: "warning",
	                      showCancelButton: false
	                }, function(){
	                    document.location = 'index?fold=inv&page=inv_beli_form';
	                })
	            }, 200);
	          </script>
	        <?php
		}else if(($db_sisa + abs($jml_beli)) < $db_min){
			//$over = abs($jml_beli) - ($db_max - $db_sisa);
			?>
	          <script type="text/javascript">
	            setTimeout(function() {
	                swal({
	                      title:"Oopss!",   
	                      text: "Maaf, jumlah pembelian barang dibawah kapasistas minimum !",   
	                      type: "warning",
	                      showCancelButton: false
	                }, function(){
	                    document.location = 'index?fold=inv&page=inv_beli_form';
	                })
	            }, 200);
	          </script>
	        <?php
		}else{
			//$sql = "INSERT INTO TRANSAKSI VALUES('$count_','$kd_beli','$tgl_beli','$ket_beli','$jml_beli','M')";
			$insert = oci_parse($koneksi, "INSERT INTO TRANSAKSI 
				VALUES($count_,'$kd_beli',TO_DATE('$tgl_beli', 'MM/DD/YYYY'),'$ket_beli',$jml_beli,'M')");
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
		                    document.location = 'index?fold=inv&page=inv_beli_form&date=<?php echo $tgl_beli; ?>';
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
			                  text: "Data pembelian gagal tersimpan ! Silahkan memulainya dari awal.",   
			                  type: "warning",
			                  showCancelButton: false
			            }, function(){
			                document.location = 'index?fold=inv&page=inv_pembelian';
			            })
			        }, 200);
			      </script>
			    <?php
			} 
		}
		//echo $count_."<br>".$kd_beli."<br>".$ket_beli."<br>".$jml_beli."<br> Over:".$over."<br>Sisa:".$db_sisa."<br>Min:".$db_min."<br>Max:".$db_max."<br>hasil 1:".$db_sisa + abs($jml_beli)."<br>hasil 2:".$db_sisa + abs($jml_beli);
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