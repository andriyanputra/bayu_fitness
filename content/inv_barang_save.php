<?php
	@session_start();

	if($_SESSION['NIP_PEGAWAI'] == 115623210){
		if($_POST['simpan'] == 'Submit'){
			$kd_barang = $_POST['kd_barang'];
			$id_supplier = $_POST['kd_supplier'];
			$nm_barang = $_POST['nm_barang'];
			$jn_barang = $_POST['jn_barang'];
			$hrg = $_POST['hrg_barang'];
			$rp = str_replace('Rp.',',',$hrg);
			$titik = str_replace('.', '',$rp);
			$koma = str_replace(',', '', $titik);
			$hrg_barang = substr($koma,0,-2);
			if($_POST['jml_barang_min'] > $_POST['jml_barang_max']){
				?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "Jumlah barang min lebih besar daripada jumlah barang max !",   
			                  type: "warning",
			                  showCancelButton: false
			            }, function(){
			                 document.location = 'index?page=inv_barang';
			            })
			        }, 200);
			      </script>
				<?php
			}else{
				$jml_min = $_POST['jml_barang_min'];
				$jml_max = $_POST['jml_barang_max'];
			}
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
			                 document.location = 'index?page=inv_barang';
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
			                document.location = 'index?page=inv_barang';
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
			                 document.location = 'index?page=inv_barang';
			            })
			        }, 200);
			      </script>
				<?php
            }

            //echo $target_file."<br>".$kd_barang."<br>".$id_supplier."<br>".$nm_barang."<br>".$jn_barang."<br>".$hrg."<br>".$hrg_barang."<br>".$jml_min."<br>".$jml_max."<br>".$foto."<br>".$type."<br>".$ukuran;
    		if(move_uploaded_file($_FILES["ft_barang"]["tmp_name"], $target_file)){
    			$insert = oci_parse($koneksi,"INSERT INTO BARANG VALUES ('$kd_barang','$id_supplier','$nm_barang','$jn_barang',$hrg_barang,'$foto',$jml_min,$jml_max)");
    			if(oci_execute($insert)){
    				?>
			          <script type="text/javascript">
			            setTimeout(function() {
			                swal({
			                      title:"Success!",   
			                      text: "Data barang berhasil disimpan",   
			                      type: "success",
			                      showCancelButton: false
			                }, function(){
			                    document.location = 'index?page=inv_barang';
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
				                  text: "Data barang gagal tersimpan !",   
				                  type: "error",
				                  showCancelButton: false
				            }, function(){
				                document.location = 'index?page=inv_barang';
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
			                document.location = 'index?page=inv_barang';
			            })
			        }, 200);
			      </script>
				<?php
    		}
		}else if($_POST['update'] == 'Update'){
			$kd_barang = $_POST['kd_barang'];
			$kd_supplier = $_POST['kd_supplier'];
			$nm_barang = $_POST['nm_barang'];
			$jn_barang = $_POST['jn_barang'];
			$foto_lama = $_POST['ft_barang_lama'];
			$hrg = $_POST['hrg_barang'];
			$rp = str_replace('Rp.',',',$hrg);
			$titik = str_replace('.', '',$rp);
			$koma = str_replace(',', '', $titik);
			$hrg_barang = substr($koma,0,-2);
			if($_POST['jml_barang_min'] > $_POST['jml_barang_max']){
				?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "Jumlah barang min lebih besar daripada jumlah barang max !",   
			                  type: "warning",
			                  showCancelButton: false
			            }, function(){
			                 document.location = 'index?page=inv_barang';
			            })
			        }, 200);
			      </script>
				<?php
			}else{
				$jml_min = $_POST['jml_barang_min'];
				$jml_max = $_POST['jml_barang_max'];
			}

			if(!empty($_FILES['ft_barang'] ['name'])){
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
				                 document.location = 'index?page=inv_barang';
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
				                  text: "File already exists! Mohon untuk menggunakan foto dengan nama lain!",   
				                  type: "error",
				                  showCancelButton: false
				            }, function(){
				                document.location = 'index?page=inv_barang';
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
				                 document.location = 'index?page=inv_barang';
				            })
				        }, 200);
				      </script>
					<?php
	            }

	            //echo $target_dir . "" . $foto_lama."<br>".$target_file."<br>".$kd_barang."<br>".$kd_supplier."<br>".$nm_barang."<br>".$jn_barang."<br>".$hrg."<br>".$hrg_barang."<br>".$jml_min."<br>".$jml_max."<br>".$foto."<br>".$type."<br>".$ukuran;
	            if(unlink($target_dir . "" . $foto_lama)){
	    			if(move_uploaded_file($_FILES["ft_barang"]["tmp_name"], $target_file)){
		    			$update = oci_parse($koneksi,"UPDATE BARANG SET 
		    										NM_BARANG = '$nm_barang',
		    										JENIS_BARANG = '$jn_barang',
		    										HARGA_BARANG = $hrg_barang,
		    										FOTO_BARANG = '$foto',
		    										JML_MIN = $jml_min,
		    										JML_MAX = $jml_max
		    										WHERE ID_BARANG = '$kd_barang'");
		    			if(oci_execute($update)){
		    				?>
					          <script type="text/javascript">
					            setTimeout(function() {
					                swal({
					                      title:"Success!",   
					                      text: "Data barang berhasil diperbaharui",   
					                      type: "success",
					                      showCancelButton: false
					                }, function(){
					                    document.location = 'index?page=inv_barang_form&id=<?php echo $kd_supplier; ?>';
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
						                  text: "Data barang gagal diperbaharui !",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?page=inv_barang_form&id=<?php echo $kd_supplier; ?>';
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
					                  text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya. Detail: Err01",   
					                  type: "error",
					                  showCancelButton: false
					            }, function(){
					                document.location = 'index?page=inv_barang_form&id=<?php echo $kd_supplier; ?>';
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
				                  text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya. Detail: Err02",   
				                  type: "error",
				                  showCancelButton: false
				            }, function(){
				                document.location = 'index?page=inv_barang_form&id=<?php echo $kd_supplier; ?>';
				            })
				        }, 200);
				      </script>
					<?php
	    		}
			}else{
				$update = oci_parse($koneksi,"UPDATE BARANG SET 
		    										NM_BARANG = '$nm_barang',
		    										JENIS_BARANG = '$jn_barang',
		    										HARGA_BARANG = $hrg_barang,
		    										JML_MIN = $jml_min,
		    										JML_MAX = $jml_max
		    										WHERE ID_BARANG = '$kd_barang'");
    			if(oci_execute($update)){
    				?>
			          <script type="text/javascript">
			            setTimeout(function() {
			                swal({
			                      title:"Success!",   
			                      text: "Data barang berhasil diperbaharui",   
			                      type: "success",
			                      showCancelButton: false
			                }, function(){
			                    document.location = 'index?page=inv_barang_form&id=<?php echo $kd_supplier; ?>';
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
				                  text: "Data barang gagal diperbaharui !",   
				                  type: "error",
				                  showCancelButton: false
				            }, function(){
				                document.location = 'index?page=inv_barang_form&id=<?php echo $kd_supplier; ?>';
				            })
				        }, 200);
				      </script>
				    <?php
    			}
			}
		}
	}else{
	?>
      <script type="text/javascript">
        setTimeout(function() {
            swal({
                  title:"Oopss!",   
                  text: "Restricted Page !",   
                  type: "error",
                  showCancelButton: false
            }, function(){
                window.history.back();
            })
        }, 200);
      </script>
	<?php
}
?>