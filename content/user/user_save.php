<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2) {

    	if($_POST['simpan'] == 'Simpan'){
    		if(!empty($_POST['jabatan_baru'])){
    			$jabatan = $_POST['jabatan_baru'];
    		}else{
    			$jabatan = $_POST['jabatan'];
    		}
    		$date_aktif = date('mdY');
    		$nip = $_POST['nip_pegawai'];
    		$nm = $_POST['nm_pegawai'];
    		$telp = $_POST['telp_pegawai'];
    		$alamat = $_POST['alamat_pegawai'];
    		$jk = $_POST['jk_kelamin'];
    		$ask = $_POST['ask_pegawai'];
    		$pass = md5($_POST['pass_pegawai']);
    		$level = $_POST['level'];

    		$foto = $nip."_".$_FILES['ft_pegawai'] ['name']; // Mendapatkan nama gambar
            $type = $_FILES['ft_pegawai']['type'];
            $ukuran = $_FILES['ft_pegawai']['size'];

            $target_dir = "../assets/img/pegawai/";
			$target_file = $target_dir . basename($foto);
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

            $check = @getimagesize($_FILES["ft_pegawai"]["tmp_name"]);//Cek type file
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
			                 document.location = 'index?fold=user&page=index';
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
			                document.location = 'index?fold=user&page=index';
			            })
			        }, 200);
			      </script>
				<?php
			}
			//cek ukuran gambar
            if($_FILES['ft_pegawai']['size'] > 2097152){
            	?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "Ukuran foto terlalu besar! Max: 2Mb !",   
			                  type: "error",
			                  showCancelButton: false
			            }, function(){
			                 document.location = 'index?fold=user&page=index';
			            })
			        }, 200);
			      </script>
				<?php
            }

            if(!empty($_FILES['ft_pegawai'] ['name'])){
            	if(move_uploaded_file($_FILES["ft_pegawai"]["tmp_name"], $target_file)){
	            	if(!empty($_POST['jabatan_baru'])){
	            		$in_jab = oci_parse($koneksi, "INSERT INTO JABATAN (NM_JABATAN) VALUES ('$jabatan')");
	            		if(oci_execute($in_jab)){
	            			$id_jab = oci_parse($koneksi, "SELECT ID_JABATAN FROM JABATAN ORDER BY ID_JABATAN DESC LIMIT 1"); oci_execute($id_jab); $id_jabatan = oci_fetch_array($id_jab); $id = $id_jabatan['ID_JABATAN'];
	            			$insert = oci_parse($koneksi, "INSERT INTO PEGAWAI VALUES ('$nip', '$nm', '$pass', '$level', '$ask', '$id', '$foto', '$alamat', '$telp', 1, '$jk', TO_DATE('$date_aktif', 'MM/DD/YYYY'), '')");
	            			if(oci_execute($insert)){
	            				?>
						          <script type="text/javascript">
						            setTimeout(function() {
						                swal({
						                      title:"Success!",   
						                      text: "Biodata user berhasil disimpan",   
						                      type: "success",
						                      showCancelButton: false
						                }, function(){
						                    document.location = 'index?fold=user&page=index';
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
							                  text: "Biodata user gagal tersimpan !",   
							                  type: "error",
							                  showCancelButton: false
							            }, function(){
							                document.location = 'index?fold=user&page=index';
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
						                  text: "Data jabatan baru gagal tersimpan! Silahkan diulangi.",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?fold=user&page=index';
						            })
						        }, 200);
						      </script>
						    <?php
	            		}
	            	}else{
	            		$insert = oci_parse($koneksi, "INSERT INTO PEGAWAI VALUES ('$nip', '$nm', '$pass', '$level', '$ask', '$jabatan', '$foto', '$alamat', '$telp', 1, '$jk', TO_DATE('$date_aktif', 'MM/DD/YYYY'), '')");
	        			if(oci_execute($insert)){
	        				?>
					          <script type="text/javascript">
					            setTimeout(function() {
					                swal({
					                      title:"Success!",   
					                      text: "Biodata user berhasil disimpan",   
					                      type: "success",
					                      showCancelButton: false
					                }, function(){
					                    document.location = 'index?fold=user&page=index';
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
						                  text: "Biodata user gagal tersimpan !",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?fold=user&page=index';
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
				                  text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",   
				                  type: "error",
				                  showCancelButton: false
				            }, function(){
				                document.location = 'index?fold=user&page=iindex';
				            })
				        }, 200);
				      </script>
					<?php
	            }
            }else{
            	if(!empty($_POST['jabatan_baru'])){
            		$in_jab = oci_parse($koneksi, "INSERT INTO JABATAN (NM_JABATAN) VALUES ('$jabatan')");
            		if(oci_execute($in_jab)){
            			$id_jab = oci_parse($koneksi, "select * from (select id_jabatan from jabatan order by id_jabatan desc) where rownum <= 1"); 
            			oci_execute($id_jab); 
            			$id_jabatan = oci_fetch_array($id_jab);
            			$id = $id_jabatan['ID_JABATAN'];
            			$insert = oci_parse($koneksi, "INSERT INTO PEGAWAI VALUES ('$nip', '$nm', '$pass', '$level', '$ask', '$id', '', '$alamat', '$telp', 1, '$jk')");
            			if(oci_execute($insert)){
            				?>
					          <script type="text/javascript">
					            setTimeout(function() {
					                swal({
					                      title:"Success!",   
					                      text: "Biodata user berhasil disimpan",   
					                      type: "success",
					                      showCancelButton: false
					                }, function(){
					                    document.location = 'index?fold=user&page=index';
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
						                  text: "Biodata user gagal tersimpan !",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?fold=user&page=index';
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
					                  text: "Data jabatan baru gagal tersimpan! Silahkan diulangi.",   
					                  type: "error",
					                  showCancelButton: false
					            }, function(){
					                document.location = 'index?fold=user&page=index';
					            })
					        }, 200);
					      </script>
					    <?php
            		}
            	}else{
            		$insert = oci_parse($koneksi, "INSERT INTO PEGAWAI VALUES ('$nip', '$nm', '$pass', '$level', '$ask', '$jabatan', '$foto', '$alamat', '$telp', 1, '$jk')");
        			if(oci_execute($insert)){
        				?>
				          <script type="text/javascript">
				            setTimeout(function() {
				                swal({
				                      title:"Success!",   
				                      text: "Biodata user berhasil disimpan",   
				                      type: "success",
				                      showCancelButton: false
				                }, function(){
				                    document.location = 'index?fold=user&page=index';
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
					                  text: "Biodata user gagal tersimpan !",   
					                  type: "error",
					                  showCancelButton: false
					            }, function(){
					                document.location = 'index?fold=user&page=index';
					            })
					        }, 200);
					      </script>
					    <?php
        			}
            	}
            }
    	}else if($_POST['update'] == 'Update'){
    		if(!empty($_POST['jabatan_baru'])){
    			$jabatan = $_POST['jabatan_baru'];
    		}else{
    			$jabatan = $_POST['jabatan'];
    		}
    		$date_nonaktif = date('mdY');
    		$date = $_POST['date'];
    		$nip = $_POST['nip_pegawai'];

    		$cek_status = oci_parse($koneksi, "SELECT STATUS_PEGAWAI FROM PEGAWAI WHERE NIP_PEGAWAI = $nip");
    		oci_execute($cek_status); $db = oci_fetch_array($cek_status);

    		$nm = $_POST['nm_pegawai'];
    		$telp = $_POST['telp_pegawai'];
    		$alamat = $_POST['alamat_pegawai'];
    		$jk = $_POST['jk_kelamin'];
    		$ask = $_POST['ask_pegawai'];
    		if(!empty($_POST['pass_pegawai_baru'])){
    			$pass = md5($_POST['pass_pegawai_baru']);
    		}
    		$level = $_POST['level'];
    		if($_POST['status'] == $db['STATUS_PEGAWAI']){
    			if(!empty($_FILES['ft_pegawai_baru']['name'])){
    				$foto_lama = $_POST['ft_pegawai_lama'];
	    			$foto = $nip."_".$_FILES['ft_pegawai_baru'] ['name']; // Mendapatkan nama gambar
		            $type = $_FILES['ft_pegawai_baru']['type'];
		            $ukuran = $_FILES['ft_pegawai_baru']['size'];
		    		$target_dir = "../assets/img/pegawai/";
					$target_file = $target_dir . basename($foto);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		            $check = @getimagesize($_FILES["ft_pegawai_baru"]["tmp_name"]);//Cek type file
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
					                 document.location = 'index?fold=user&page=index';
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
					                document.location = 'index?fold=user&page=index';
					            })
					        }, 200);
					      </script>
						<?php
					}
					//cek ukuran gambar
		            if($_FILES['ft_pegawai_baru']['size'] > 2097152){
		            	?>
					      <script type="text/javascript">
					        setTimeout(function() {
					            swal({
					                  title:"Oopss!",   
					                  text: "Ukuran foto terlalu besar! Max: 2Mb !",   
					                  type: "error",
					                  showCancelButton: false
					            }, function(){
					                 document.location = 'index?fold=user&page=index';
					            })
					        }, 200);
					      </script>
						<?php
		            }
		            if(unlink($target_dir . "" . $foto_lama)){
						if(move_uploaded_file($_FILES["ft_pegawai_baru"]["tmp_name"], $target_file)){
			            	if(!empty($_POST['jabatan_baru']) && !empty($_POST['pass_pegawai_baru'])){
			            		$in_jab = oci_parse($koneksi, "INSERT INTO JABATAN (NM_JABATAN) VALUES ('$jabatan')");
			            		if(oci_execute($in_jab)){
			            			$id_jab = oci_parse($koneksi, "SELECT ID_JABATAN FROM JABATAN ORDER BY ID_JABATAN DESC LIMIT 1"); oci_execute($id_jab); $id_jabatan = oci_fetch_array($id_jab); $id = $id_jabatan['ID_JABATAN'];
			            			$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
			            											NM_PEGAWAI = '$nm',
			            											PASS_PEGAWAI = '$pass',
			            											ID_LEVEL = '$level',
			            											ASK_PEGAWAI = '$ask',
			            											ID_JABATAN = '$id',
			            											FOTO_PEGAWAI = '$foto',
			            											ALAMAT_PEGAWAI = '$alamat',
			            											TELP_PEGAWAI = '$telp',
			            											JK_PEGAWAI = '$jk'
			            											WHERE NIP_PEGAWAI = $nip");
			            			if(oci_execute($update)){
			            				?>
								          <script type="text/javascript">
								            setTimeout(function() {
								                swal({
								                      title:"Success!",   
								                      text: "Biodata user berhasil diperbaharui",   
								                      type: "success",
								                      showCancelButton: false
								                }, function(){
								                    document.location = 'index?fold=user&page=index';
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
									                  text: "Biodata user gagal diperbaharui !",   
									                  type: "error",
									                  showCancelButton: false
									            }, function(){
									                document.location = 'index?fold=user&page=index';
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
								                  text: "Data jabatan baru gagal tersimpan! Silahkan diulangi.",   
								                  type: "error",
								                  showCancelButton: false
								            }, function(){
								                document.location = 'index?fold=user&page=user_edit&id=<?php echo $nip;?>';
								            })
								        }, 200);
								      </script>
								    <?php
			            		}
			            	}else{
			            		$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
			            											NM_PEGAWAI = '$nm',
			            											ID_LEVEL = '$level',
			            											ASK_PEGAWAI = '$ask',
			            											FOTO_PEGAWAI = '$foto',
			            											ALAMAT_PEGAWAI = '$alamat',
			            											TELP_PEGAWAI = '$telp',
			            											JK_PEGAWAI = '$jk'
			            											WHERE NIP_PEGAWAI = $nip");
			        			if(oci_execute($update)){
			        				?>
							          <script type="text/javascript">
							            setTimeout(function() {
							                swal({
							                      title:"Success!",   
							                      text: "Biodata user berhasil diperbaharui",   
							                      type: "success",
							                      showCancelButton: false
							                }, function(){
							                    document.location = 'index?fold=user&page=index';
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
								                  text: "Biodata user gagal diperbaharui !",   
								                  type: "error",
								                  showCancelButton: false
								            }, function(){
								                document.location = 'index?fold=user&page=index';
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
						                  text: "Maaf, terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?fold=user&page=index';
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
					                document.location = 'index?fold=user&page=index';
					            })
					        }, 200);
					      </script>
						<?php
			        }
	    		}else{
	    			if(!empty($_POST['jabatan_baru']) && !empty($_POST['pass_pegawai_baru'])){
	            		$in_jab = oci_parse($koneksi, "INSERT INTO JABATAN (NM_JABATAN) VALUES ('$jabatan')");
	            		if(oci_execute($in_jab)){
	            			$id_jab = oci_parse($koneksi, "SELECT ID_JABATAN FROM JABATAN ORDER BY ID_JABATAN DESC LIMIT 1"); oci_execute($id_jab); $id_jabatan = oci_fetch_array($id_jab); $id = $id_jabatan['ID_JABATAN'];
	            			$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
	            											NM_PEGAWAI = '$nm',
	            											PASS_PEGAWAI = '$pass',
	            											ID_LEVEL = '$level',
	            											ASK_PEGAWAI = '$ask',
	            											ID_JABATAN = '$id',
	            											ALAMAT_PEGAWAI = '$alamat',
	            											TELP_PEGAWAI = '$telp',
	            											JK_PEGAWAI = '$jk'
	            											WHERE NIP_PEGAWAI = $nip");
	            			if(oci_execute($update)){
	            				?>
						          <script type="text/javascript">
						            setTimeout(function() {
						                swal({
						                      title:"Success!",   
						                      text: "Biodata user berhasil diperbaharui",   
						                      type: "success",
						                      showCancelButton: false
						                }, function(){
						                    document.location = 'index?fold=user&page=index';
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
							                  text: "Biodata user gagal diperbaharui !",   
							                  type: "error",
							                  showCancelButton: false
							            }, function(){
							                document.location = 'index?fold=user&page=index';
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
						                  text: "Data jabatan baru gagal tersimpan! Silahkan diulangi.",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?fold=user&page=user_edit&id=<?php echo $nip;?>';
						            })
						        }, 200);
						      </script>
						    <?php
	            		}
	            	}else{
	            		$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
	            											NM_PEGAWAI = '$nm',
	            											ID_LEVEL = '$level',
	            											ASK_PEGAWAI = '$ask',
	            											ALAMAT_PEGAWAI = '$alamat',
	            											TELP_PEGAWAI = '$telp',
	            											JK_PEGAWAI = '$jk'
	            											WHERE NIP_PEGAWAI = $nip");
	        			if(oci_execute($update)){
	        				?>
					          <script type="text/javascript">
					            setTimeout(function() {
					                swal({
					                      title:"Success!",   
					                      text: "Biodata user berhasil diperbaharui",   
					                      type: "success",
					                      showCancelButton: false
					                }, function(){
					                    document.location = 'index?fold=user&page=index';
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
						                  text: "Biodata user gagal diperbaharui !",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?fold=user&page=index';
						            })
						        }, 200);
						      </script>
						    <?php
	        			}
	            	}
	    		}
    		}else{
    			$status = $_POST['status'];
    			if(($status != $db['STATUS_PEGAWAI']) && $status == 1){
    				if(!empty($_FILES['ft_pegawai_baru']['name'])){
		    			$foto_lama = $_POST['ft_pegawai_lama'];
		    			$foto = $nip."_".$_FILES['ft_pegawai_baru'] ['name']; // Mendapatkan nama gambar
			            $type = $_FILES['ft_pegawai_baruft_pegawai_baru']['type'];
			            $ukuran = $_FILES['ft_pegawai_baru']['size'];
			    		$target_dir = "../assets/img/pegawai/";
						$target_file = $target_dir . basename($foto);
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			            $check = @getimagesize($_FILES["ft_pegawai_baru"]["tmp_name"]);//Cek type file
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
						                 document.location = 'index?fold=user&page=index';
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
						                document.location = 'index?fold=user&page=index';
						            })
						        }, 200);
						      </script>
							<?php
						}
						//cek ukuran gambar
			            if($_FILES['ft_pegawai_baru']['size'] > 2097152){
			            	?>
						      <script type="text/javascript">
						        setTimeout(function() {
						            swal({
						                  title:"Oopss!",   
						                  text: "Ukuran foto terlalu besar! Max: 2Mb !",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                 document.location = 'index?fold=user&page=index';
						            })
						        }, 200);
						      </script>
							<?php
			            }
			            if(unlink($target_dir . "" . $foto_lama)){
			            	if(move_uploaded_file($_FILES["ft_pegawai_baru"]["tmp_name"], $target_file)){
				            	if(!empty($_POST['jabatan_baru']) && !empty($_POST['pass_pegawai_baru'])){
				            		$in_jab = oci_parse($koneksi, "INSERT INTO JABATAN (NM_JABATAN) VALUES ('$jabatan')");
				            		if(oci_execute($in_jab)){
				            			$id_jab = oci_parse($koneksi, "SELECT ID_JABATAN FROM JABATAN ORDER BY ID_JABATAN DESC LIMIT 1"); oci_execute($id_jab); $id_jabatan = oci_fetch_array($id_jab); $id = $id_jabatan['ID_JABATAN'];
				            			$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
				            											NM_PEGAWAI = '$nm',
				            											PASS_PEGAWAI = '$pass',
				            											ID_LEVEL = '$level',
				            											ASK_PEGAWAI = '$ask',
				            											ID_JABATAN = '$id',
				            											FOTO_PEGAWAI = '$foto',
				            											ALAMAT_PEGAWAI = '$alamat',
				            											TELP_PEGAWAI = '$telp',
				            											STATUS_PEGAWAI = $status,
				            											JK_PEGAWAI = '$jk',
				            											DATE_AKTIF = TO_DATE('$date_nonaktif', 'MM/DD/YYYY')
				            											WHERE NIP_PEGAWAI = $nip");
				            			if(oci_execute($update)){
				            				?>
									          <script type="text/javascript">
									            setTimeout(function() {
									                swal({
									                      title:"Success!",   
									                      text: "Biodata user berhasil diperbaharui",   
									                      type: "success",
									                      showCancelButton: false
									                }, function(){
									                    document.location = 'index?fold=user&page=index';
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
										                  text: "Biodata user gagal diperbaharui !",   
										                  type: "error",
										                  showCancelButton: false
										            }, function(){
										                document.location = 'index?fold=user&page=index';
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
									                  text: "Data jabatan baru gagal tersimpan! Silahkan diulangi.",   
									                  type: "error",
									                  showCancelButton: false
									            }, function(){
									                document.location = 'index?fold=user&page=user_edit&id=<?php echo $nip;?>';
									            })
									        }, 200);
									      </script>
									    <?php
				            		}
				            	}else{
				            		$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
				            											NM_PEGAWAI = '$nm',
				            											ID_LEVEL = '$level',
				            											ASK_PEGAWAI = '$ask',
				            											FOTO_PEGAWAI = '$foto',
				            											ALAMAT_PEGAWAI = '$alamat',
				            											TELP_PEGAWAI = '$telp',
				            											STATUS_PEGAWAI = $status,
				            											JK_PEGAWAI = '$jk',
				            											DATE_AKTIF = TO_DATE('$date_nonaktif', 'MM/DD/YYYY')
				            											WHERE NIP_PEGAWAI = $nip");
				        			if(oci_execute($update)){
				        				?>
								          <script type="text/javascript">
								            setTimeout(function() {
								                swal({
								                      title:"Success!",   
								                      text: "Biodata user berhasil diperbaharui",   
								                      type: "success",
								                      showCancelButton: false
								                }, function(){
								                    document.location = 'index?fold=user&page=index';
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
									                  text: "Biodata user gagal diperbaharui !",   
									                  type: "error",
									                  showCancelButton: false
									            }, function(){
									                document.location = 'index?fold=user&page=index';
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
							                  text: "Maaf, 1 terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",   
							                  type: "error",
							                  showCancelButton: false
							            }, function(){
							                document.location = 'index?fold=user&page=index';
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
						                  text: "Maaf, 2 terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?fold=user&page=index';
						            })
						        }, 200);
						      </script>
							<?php
			            }
		    		}else{
		    			if(!empty($_POST['jabatan_baru']) && !empty($_POST['pass_pegawai_baru'])){
		            		$in_jab = oci_parse($koneksi, "INSERT INTO JABATAN (NM_JABATAN) VALUES ('$jabatan')");
		            		if(oci_execute($in_jab)){
		            			$id_jab = oci_parse($koneksi, "SELECT ID_JABATAN FROM JABATAN ORDER BY ID_JABATAN DESC LIMIT 1"); oci_execute($id_jab); $id_jabatan = oci_fetch_array($id_jab); $id = $id_jabatan['ID_JABATAN'];
		            			$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
		            											NM_PEGAWAI = '$nm',
		            											PASS_PEGAWAI = '$pass',
		            											ID_LEVEL = '$level',
		            											ASK_PEGAWAI = '$ask',
		            											ID_JABATAN = '$id',
		            											ALAMAT_PEGAWAI = '$alamat',
		            											TELP_PEGAWAI = '$telp',
		            											STATUS_PEGAWAI = $status,
			            										JK_PEGAWAI = '$jk',
			            										DATE_AKTIF = TO_DATE('$date_nonaktif', 'MM/DD/YYYY')
		            											WHERE NIP_PEGAWAI = $nip");
		            			if(oci_execute($update)){
		            				?>
							          <script type="text/javascript">
							            setTimeout(function() {
							                swal({
							                      title:"Success!",   
							                      text: "Biodata user berhasil diperbaharui",   
							                      type: "success",
							                      showCancelButton: false
							                }, function(){
							                    document.location = 'index?fold=user&page=index';
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
								                  text: "Biodata user gagal diperbaharui !",   
								                  type: "error",
								                  showCancelButton: false
								            }, function(){
								                document.location = 'index?fold=user&page=index';
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
							                  text: "Data jabatan baru gagal tersimpan! Silahkan diulangi.",   
							                  type: "error",
							                  showCancelButton: false
							            }, function(){
							                document.location = 'index?fold=user&page=user_edit&id=<?php echo $nip;?>';
							            })
							        }, 200);
							      </script>
							    <?php
		            		}
		            	}else{
		            		$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
		            											NM_PEGAWAI = '$nm',
		            											ID_LEVEL = '$level',
		            											ASK_PEGAWAI = '$ask',
		            											ALAMAT_PEGAWAI = '$alamat',
		            											TELP_PEGAWAI = '$telp',
		            											STATUS_PEGAWAI = $status,
			            										JK_PEGAWAI = '$jk',
			            										DATE_AKTIF = TO_DATE('$date_nonaktif', 'MM/DD/YYYY')
		            											WHERE NIP_PEGAWAI = $nip");
		        			if(oci_execute($update)){
		        				?>
						          <script type="text/javascript">
						            setTimeout(function() {
						                swal({
						                      title:"Success!",   
						                      text: "Biodata user berhasil diperbaharui",   
						                      type: "success",
						                      showCancelButton: false
						                }, function(){
						                    document.location = 'index?fold=user&page=index';
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
							                  text: "Biodata user gagal diperbaharui !",   
							                  type: "error",
							                  showCancelButton: false
							            }, function(){
							                document.location = 'index?fold=user&page=index';
							            })
							        }, 200);
							      </script>
							    <?php
		        			}
		            	}
		    		}
    			}else if(($status != $db['STATUS_PEGAWAI']) && $status == 0){
    				if(!empty($_FILES['ft_pegawai_baru']['name'])){
		    			$foto_lama = $_POST['ft_pegawai_lama'];
		    			$foto = $nip."_".$_FILES['ft_pegawai_baru'] ['name']; // Mendapatkan nama gambar
			            $type = $_FILES['ft_pegawai_baruft_pegawai_baru']['type'];
			            $ukuran = $_FILES['ft_pegawai_baru']['size'];
			    		$target_dir = "../assets/img/pegawai/";
						$target_file = $target_dir . basename($foto);
						$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			            $check = @getimagesize($_FILES["ft_pegawai_baru"]["tmp_name"]);//Cek type file
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
						                 document.location = 'index?fold=user&page=index';
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
						                document.location = 'index?fold=user&page=index';
						            })
						        }, 200);
						      </script>
							<?php
						}
						//cek ukuran gambar
			            if($_FILES['ft_pegawai_baru']['size'] > 2097152){
			            	?>
						      <script type="text/javascript">
						        setTimeout(function() {
						            swal({
						                  title:"Oopss!",   
						                  text: "Ukuran foto terlalu besar! Max: 2Mb !",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                 document.location = 'index?fold=user&page=index';
						            })
						        }, 200);
						      </script>
							<?php
			            }
			            if(unlink($target_dir . "" . $foto_lama)){
			            	if(move_uploaded_file($_FILES["ft_pegawai_baru"]["tmp_name"], $target_file)){
				            	if(!empty($_POST['jabatan_baru']) && !empty($_POST['pass_pegawai_baru'])){
				            		$in_jab = oci_parse($koneksi, "INSERT INTO JABATAN (NM_JABATAN) VALUES ('$jabatan')");
				            		if(oci_execute($in_jab)){
				            			$id_jab = oci_parse($koneksi, "SELECT ID_JABATAN FROM JABATAN ORDER BY ID_JABATAN DESC LIMIT 1"); oci_execute($id_jab); $id_jabatan = oci_fetch_array($id_jab); $id = $id_jabatan['ID_JABATAN'];
				            			$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
				            											NM_PEGAWAI = '$nm',
				            											PASS_PEGAWAI = '$pass',
				            											ID_LEVEL = '$level',
				            											ASK_PEGAWAI = '$ask',
				            											ID_JABATAN = '$id',
				            											FOTO_PEGAWAI = '$foto',
				            											ALAMAT_PEGAWAI = '$alamat',
				            											TELP_PEGAWAI = '$telp',
				            											STATUS_PEGAWAI = $status,
				            											JK_PEGAWAI = '$jk',
				            											DATE_NONAKTIF = TO_DATE('$date_nonaktif', 'MM/DD/YYYY')
				            											WHERE NIP_PEGAWAI = $nip");
				            			if(oci_execute($update)){
				            				?>
									          <script type="text/javascript">
									            setTimeout(function() {
									                swal({
									                      title:"Success!",   
									                      text: "Biodata user berhasil diperbaharui",   
									                      type: "success",
									                      showCancelButton: false
									                }, function(){
									                    document.location = 'index?fold=user&page=index';
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
										                  text: "Biodata user gagal diperbaharui !",   
										                  type: "error",
										                  showCancelButton: false
										            }, function(){
										                document.location = 'index?fold=user&page=index';
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
									                  text: "Data jabatan baru gagal tersimpan! Silahkan diulangi.",   
									                  type: "error",
									                  showCancelButton: false
									            }, function(){
									                document.location = 'index?fold=user&page=user_edit&id=<?php echo $nip;?>';
									            })
									        }, 200);
									      </script>
									    <?php
				            		}
				            	}else{
				            		$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
				            											NM_PEGAWAI = '$nm',
				            											ID_LEVEL = '$level',
				            											ASK_PEGAWAI = '$ask',
				            											FOTO_PEGAWAI = '$foto',
				            											ALAMAT_PEGAWAI = '$alamat',
				            											TELP_PEGAWAI = '$telp',
				            											STATUS_PEGAWAI = $status,
				            											JK_PEGAWAI = '$jk',
				            											DATE_NONAKTIF = TO_DATE('$date_nonaktif', 'MM/DD/YYYY')
				            											WHERE NIP_PEGAWAI = $nip");
				        			if(oci_execute($update)){
				        				?>
								          <script type="text/javascript">
								            setTimeout(function() {
								                swal({
								                      title:"Success!",   
								                      text: "Biodata user berhasil diperbaharui",   
								                      type: "success",
								                      showCancelButton: false
								                }, function(){
								                    document.location = 'index?fold=user&page=index';
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
									                  text: "Biodata user gagal diperbaharui !",   
									                  type: "error",
									                  showCancelButton: false
									            }, function(){
									                document.location = 'index?fold=user&page=index';
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
							                  text: "Maaf, 1 terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",   
							                  type: "error",
							                  showCancelButton: false
							            }, function(){
							                document.location = 'index?fold=user&page=index';
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
						                  text: "Maaf, 2 terjadi kesalahan unggah foto! Mohon untuk mengulanginya.",   
						                  type: "error",
						                  showCancelButton: false
						            }, function(){
						                document.location = 'index?fold=user&page=index';
						            })
						        }, 200);
						      </script>
							<?php
			            }
		    		}else{
		    			if(!empty($_POST['jabatan_baru']) && !empty($_POST['pass_pegawai_baru'])){
		            		$in_jab = oci_parse($koneksi, "INSERT INTO JABATAN (NM_JABATAN) VALUES ('$jabatan')");
		            		if(oci_execute($in_jab)){
		            			$id_jab = oci_parse($koneksi, "SELECT ID_JABATAN FROM JABATAN ORDER BY ID_JABATAN DESC LIMIT 1"); oci_execute($id_jab); $id_jabatan = oci_fetch_array($id_jab); $id = $id_jabatan['ID_JABATAN'];
		            			$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
		            											NM_PEGAWAI = '$nm',
		            											PASS_PEGAWAI = '$pass',
		            											ID_LEVEL = '$level',
		            											ASK_PEGAWAI = '$ask',
		            											ID_JABATAN = '$id',
		            											ALAMAT_PEGAWAI = '$alamat',
		            											TELP_PEGAWAI = '$telp',
		            											STATUS_PEGAWAI = $status,
			            										JK_PEGAWAI = '$jk',
			            										DATE_NONAKTIF = TO_DATE('$date_nonaktif', 'MM/DD/YYYY')
		            											WHERE NIP_PEGAWAI = $nip");
		            			if(oci_execute($update)){
		            				?>
							          <script type="text/javascript">
							            setTimeout(function() {
							                swal({
							                      title:"Success!",   
							                      text: "Biodata user berhasil diperbaharui",   
							                      type: "success",
							                      showCancelButton: false
							                }, function(){
							                    document.location = 'index?fold=user&page=index';
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
								                  text: "Biodata user gagal diperbaharui !",   
								                  type: "error",
								                  showCancelButton: false
								            }, function(){
								                document.location = 'index?fold=user&page=index';
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
							                  text: "Data jabatan baru gagal tersimpan! Silahkan diulangi.",   
							                  type: "error",
							                  showCancelButton: false
							            }, function(){
							                document.location = 'index?fold=user&page=user_edit&id=<?php echo $nip;?>';
							            })
							        }, 200);
							      </script>
							    <?php
		            		}
		            	}else{
		            		$update = oci_parse($koneksi, "UPDATE PEGAWAI SET 
		            											NM_PEGAWAI = '$nm',
		            											ID_LEVEL = '$level',
		            											ASK_PEGAWAI = '$ask',
		            											ALAMAT_PEGAWAI = '$alamat',
		            											TELP_PEGAWAI = '$telp',
		            											STATUS_PEGAWAI = $status,
			            										JK_PEGAWAI = '$jk',
			            										DATE_NONAKTIF = TO_DATE('$date_nonaktif', 'MM/DD/YYYY')
		            											WHERE NIP_PEGAWAI = $nip");
		        			if(oci_execute($update)){
		        				?>
						          <script type="text/javascript">
						            setTimeout(function() {
						                swal({
						                      title:"Success!",   
						                      text: "Biodata user berhasil diperbaharui",   
						                      type: "success",
						                      showCancelButton: false
						                }, function(){
						                    document.location = 'index?fold=user&page=index';
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
							                  text: "Biodata user gagal diperbaharui !",   
							                  type: "error",
							                  showCancelButton: false
							            }, function(){
							                document.location = 'index?fold=user&page=index';
							            })
							        }, 200);
							      </script>
							    <?php
		        			}
		            	}
		    		}
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