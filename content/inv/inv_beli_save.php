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
    	$kd_barang = $_POST['kd_barang'];
    	$kd_beli = $_POST['kd_beli'];
    	$nm_brng = $_POST['nm_barang'];
    	$jn_barang = $_POST['jn_barang'];
    	$hrg = $_POST['hrg_barang'];
		$rp = str_replace('Rp.',',',$hrg);
		$titik = str_replace('.', '',$rp);
		$koma = str_replace(',', '', $titik);
		$hrg_barang = substr($koma,0,-2);
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
		if(!empty($_FILES['ft_barang']['name'])){
			$foto = $kd_barang."_".$_FILES['ft_barang'] ['name']; // Mendapatkan nama gambar
	        $type = $_FILES['ft_barang']['type'];
	        $ukuran = $_FILES['ft_barang']['size'];
	        $target_dir = "../assets/img/barang/";
			$target_file = $target_dir . basename($foto);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	        $check = @getimagesize($_FILES["ft_barang"]["tmp_name"]);//Cek type file
		    if($check === false) {
		        ?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "File is not an image !",   
			                  type: "error",
			                  showCancelButton: false
			            }, function(){
			                 document.location = 'index?fold=inv&page=inv_pembelian';
			            })
			        }, 200);
			      </script>
				<?php
		    }
		    // Check if file already exists
			if (file_exists($target_file)) {
			    ?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "File already exists! Mohon untuk melakukan update!",   
			                  type: "error",
			                  showCancelButton: false
			            }, function(){
			                document.location = 'index?fold=inv&page=inv_pembelian';
			            })
			        }, 200);
			      </script>
				<?php
			}
			//cek ukuran gambar
	        if($_FILES['ft_barang']['size'] > 2097152){
	        	?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "Ukuran foto terlalu besar! Max: 2Mb !",   
			                  type: "error",
			                  showCancelButton: false
			            }, function(){
			                 document.location = 'index?fold=inv&page=inv_pembelian';
			            })
			        }, 200);
			      </script>
				<?php
	        }
	        if(move_uploaded_file($_FILES["ft_barang"]["tmp_name"], $target_file)){
	        	$beli = oci_parse($koneksi,"INSERT INTO BARANG VALUES ('$kd_barang','$kd_beli','$nm_brng','$jn_barang',$hrg_barang,'$foto',TO_DATE('$tgl_beli', 'MM/DD/YYYY'), $jml_beli)");
	        	$log_beli = oci_parse($koneksi, "INSERT INTO TRANSAKSI VALUES ($count_, '$kd_barang', TO_DATE('$tgl_beli', 'MM/DD/YYYY'), '$ket_beli', '$jml_beli', 'M')");
	        	if(oci_execute($beli)){
	        		if(oci_execute($log_beli)){
	        			?>
				          <script type="text/javascript">
				            setTimeout(function() {
				                swal({
				                      title:"Success!",   
				                      text: "Data barang berhasil disimpan",   
				                      type: "success",
				                      showCancelButton: false
				                }, function(){
				                    document.location = 'index?fold=inv&page=inv_stock';
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
					                  text: "Maaf, terjadi kesalahan data! Mohon untuk mengulanginya.",   
					                  type: "error",
					                  showCancelButton: false
					            }, function(){
					                document.location = 'index?fold=inv&page=inv_beli_form';
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
				                  text: "Data barang gagal tersimpan !",   
				                  type: "error",
				                  showCancelButton: false
				            }, function(){
				                document.location = 'index?fold=inv&page=inv_pembelian';
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
			                  text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",   
			                  type: "error",
			                  showCancelButton: false
			            }, function(){
			                document.location = 'index?fold=inv&page=inv_beli_form';
			            })
			        }, 200);
			      </script>
				<?php
	        }
		}else{
			$insert = oci_parse($koneksi,"INSERT INTO BARANG VALUES ('$kd_barang','$kd_beli','$nm_brng','$jn_barang',$hrg_barang,,TO_DATE('$tgl_beli', 'MM/DD/YYYY'), $jml_beli)");
        	$log_beli = oci_parse($koneksi, "INSERT INTO TRANSAKSI VALUES ($count_, '$kd_barang', TO_DATE('$tgl_beli', 'MM/DD/YYYY'), '$ket_beli', '$jml_beli', 'M')");
        	if(oci_execute($insert)){
        		if(oci_execute($log_beli)){
        			?>
			          <script type="text/javascript">
			            setTimeout(function() {
			                swal({
			                      title:"Success!",   
			                      text: "Data barang berhasil disimpan",   
			                      type: "success",
			                      showCancelButton: false
			                }, function(){
			                    document.location = 'index?fold=inv&page=inv_stock';
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
				                  text: "Maaf, terjadi kesalahan data! Mohon untuk mengulanginya.",   
				                  type: "error",
				                  showCancelButton: false
				            }, function(){
				                document.location = 'index?fold=inv&page=inv_beli_form';
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
			                  text: "Data barang gagal tersimpan !",   
			                  type: "error",
			                  showCancelButton: false
			            }, function(){
			                document.location = 'index?fold=inv&page=inv_pembelian';
			            })
			        }, 200);
			      </script>
			    <?php
			}
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