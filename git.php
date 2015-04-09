/*function sisa_barang($kd_beli){
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
		}
		
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
		//echo $count_."<br>".$kd_beli."<br>".$ket_beli."<br>".$jml_beli."<br> Over:".$over."<br>Sisa:".$db_sisa."<br>Min:".$db_min."<br>Max:".$db_max."<br>hasil 1:".$db_sisa + abs($jml_beli)."<br>hasil 2:".$db_sisa + abs($jml_beli);*/

		<?php
                                    function jml_barang($kode_barang,$status){
                                        $jml_brng = oci_parse($koneksi, "SELECT SUM(JML_TRANSAKSI) AS jumlah FROM TRANSAKSI WHERE ID_BARANG='$kode_barang' AND STATUS_TRANSAKSI='$status' AND JML_TRANSAKSI>0");
                                        oci_execute($jml_brng); 
                                        $jml_barang_ = oci_fetch_array($jml_brng);
                                        return $jml_barang_[jumlah];
                                    }

                                    function sisa_barang($kode_barang){
                                        $hasil_sisa="SELECT BARANG.ID_BARANG ,(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG='$kode_barang' GROUP BY ID_BARANG)-(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI='K' AND ID_BARANG='$kode_barang' GROUP BY ID_BARANG) AS sisa FROM BARANG WHERE ID_BARANG='$kode_barang'";
                                        $sisa = oci_parse($koneksi, $hasil_sisa);
                                        oci_execute($sisa);
                                        $db_ = oci_fetch_array($sisa);
                                        return $db_[sisa];
                                    }

                                    function jml_retur($kode_barang){
                                        $hasil_hitung="SELECT SUM(JML_TRANSAKSI) AS jumlah FROM TRANSAKSI WHERE ID_BARANG='$kode_barang' AND STATUS_TRANSAKSI='K' AND JML_TRANSAKSI<0";
                                        $q = oci_parse($koneksi, $hasil_hitung); oci_execute($q);
                                        $q_ = oci_fetch_array($q);
                                        return abs($q_[jumlah]);
                                    }

                                    $sql=oci_parse($koneksi, "SELECT * FROM V_BARANG_SUPPLIER");
                                    oci_execute($sql);
                                    $no = 0;
                                    while ($db=oci_fetch_array($sql)) {
                                        $no++;
                                        //echo $db[NM_BARANG];
                                        if(jml_barang($db[ID_BARANG], 'M')>0){  //2>0
                                            if(sisa_barang($db[ID_BARANG])!=null){ //null==null
                                                $sisa = sisa_barang($db[ID_BARANG]);
                                                $keluar = jml_barang($db[ID_BARANG], 'K');
                                            }else{
                                                $sisa = jml_barang($db[ID_BARANG], 'M');//2
                                                $keluar = 0;
                                            }

                                            if($sisa<=jml_barang($db[ID_BARANG], 'M')){
                                                $nm_barang = "<font color=\"red\"><b>$db[NM_BARANG] - $db[NM_SUPPLIER]</b></font>";
                                            }else{
                                                $nm_barang = "$db[NM_BARANG] - $db[NM_SUPPLIER]";
                                            }

//inv_jual_save.php
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