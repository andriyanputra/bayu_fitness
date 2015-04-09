<?php
    if($_SESSION[NIP_PEGAWAI]==115623210) {
    	if($_POST['simpan'] == 'Submit'){
	    	$kd_jual = $_POST['kd_jual'];
	    	$ket_jual = $_POST['ket_jual'];
	    	$jml_jual = $_POST['jml_jual'];
	    	$tgl_jual = $_POST['tgl_jual'];
	    	//menghitung jumlah barang
			$jml = oci_parse($koneksi, "SELECT SUM(JML_TRANSAKSI) AS jumlah FROM TRANSAKSI WHERE ID_BARANG='$kd_jual' AND STATUS_TRANSAKSI='M' AND JML_TRANSAKSI>0");
	        oci_execute($jml); 
	        $jml_brng = oci_fetch_array($jml);
	        $tes = $jml_brng[JUMLAH];
	    	//sisa barang dan validasi
			$sBarang = oci_parse($koneksi, "SELECT BARANG.ID_BARANG, (SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG='$kd_jual' GROUP BY ID_BARANG)-(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI='K' AND ID_BARANG='$kd_jual' GROUP BY ID_BARANG) AS sisa FROM BARANG WHERE ID_BARANG='$kd_jual'");
			oci_execute($sBarang);
			$s = oci_fetch_array($sBarang);
			$db_sisa = $s[SISA];

	    	//ID_TRANSAKSI
	    	$hitung = oci_parse($koneksi, "SELECT COUNT(*) FROM BARANG");
	    	oci_execute($hitung);
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
	            }
	        }else{
	            $no_brng = $jml_barang[0] + 1;
	        }
	    	
			if(!empty($db_sisa)){
				$sisa_barang = $db_sisa;
			}else{
				$sisa_barang = $tes;
			}
			/*echo $sisa_barang;
			if($jml_jual > $sisa_barang){
				?>
		          <script type="text/javascript">
		            setTimeout(function() {
		                swal({
		                      title:"Oopss!",   
		                      text: "Maaf, penjualan barang melebihi sisa barang.",   
		                      type: "warning",
		                      showCancelButton: false
		                }, function(){
		                    document.location = 'index?fold=inv&page=inv_penjualan';
		                })
		            }, 200);
		          </script>
		        <?php
		    }else if($jml_jual == 0){
		    	?>
		          <script type="text/javascript">
		            setTimeout(function() {
		                swal({
		                      title:"Oopss!",   
		                      text: "Maaf, penjualan barang tidak boleh kosong.",   
		                      type: "warning",
		                      showCancelButton: false
		                }, function(){
		                    document.location = 'index?fold=inv&page=inv_penjualan';
		                })
		            }, 200);
		          </script>
		        <?php
		    }else{
				$insert = oci_parse($koneksi, "INSERT INTO TRANSAKSI VALUES($no_brng, '$kd_jual', TO_DATE('$tgl_jual', 'MM/DD/YYYY'),'$ket_jual',$jml_jual,'K')");
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
			}*/
			echo $no_brng."<br>query Sisa: ".$tes."<br>".$sisa_barang."<br>ID barang: ".$kd_jual."<br>Ket: ".$ket_jual."<br>Jml dijual: ".$jml_jual."<br>tgl jual: ".$tgl_jual;
		}else{
			?>
	          <script type="text/javascript">
	            setTimeout(function() {
	                swal({
	                      title:"Oopss!",   
	                      text: "Filure Submit !",   
	                      type: "warning",
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