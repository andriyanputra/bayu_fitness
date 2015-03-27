<?php
@session_start();
if ($_SESSION[ID_LEVEL] == 1 || $_SESSION[ID_LEVEL] == 3) {
	
	if($_POST['simpan'] == 'Simpan'){
		if(empty($_POST['judul'])){
			?>
				<script type="text/javascript">
				    setTimeout(function () {
				        swal({
				            title: "Oopss!",
				            text: "Field Input tidak boleh kosong! Silahkan untuk diulangi !",
				            type: "warning",
				            showCancelButton: false
				        }, function () {
				            window.history.back();
				        })
				    }, 200);
				</script>
			<?php
		}else if(empty($_POST['artikel']) && empty($_POST['vid_artikel']) && empty($_POST['tul_artikel'])){
			?>
				<script type="text/javascript">
				    setTimeout(function () {
				        swal({
				            title: "Oopss!",
				            text: "Field Input tidak boleh kosong! Silahkan untuk diulangi !",
				            type: "warning",
				            showCancelButton: false
				        }, function () {
				            window.history.back();
				        })
				    }, 200);
				</script>
			<?php
		}else if(!empty($_FILES['vid_artikel']['name'])){
			$id = $_POST['id'];
			$judul = $_POST['judul'];
			$uArtikel = $_POST['artikel'];
			$kembar = oci_parse($koneksi, "SELECT JD_ARTIKEL FROM ARTIKEL WHERE JD_ARTIKEL = '$judul'"); 
			oci_execute($kembar);
			$d = oci_fetch_array($kembar);
			if($d['JD_ARTIKEL'] == $judul){
				?>
					<script type="text/javascript">
					    setTimeout(function () {
					        swal({
					            title: "Oopss!",
					            text: "Nama Judul sama! Silahkan untuk diulangi !",
					            type: "warning",
					            showCancelButton: false
					        }, function () {
					            window.history.back();
					        })
					    }, 200);
					</script>
				<?php
			}else{
				//$tulArtikel = $_POST['tul_artikel'];
				$nmVideo = $_FILES['vid_artikel']['name'];
				$tyVideo = $_FILES['vid_artikel']['type'];
				$ukVideo = $_FILES['vid_artikel']['size'];
				//replace tanda spasi pada nama file dengan _
				$nama_file = str_replace(" ","_",$nmVideo);
	    		$tmp_name = $_FILES['vid_artikel']['tmp_name'];
	    		$dir = "../assets/artikel/video/";
	    		$target_dir = $dir.basename($nama_file);
	    		//echo $tmp_name."<br>".$target_dir."<br>".$judul."<br>".$uArtikel."<br>".$tulArtikel."<br>".$nmVideo."<br>".$tyVideo."<br>".$ukVideo."<br>".$_POST['MAX_FILE_SIZE']."<br>".$_FILES['vid_artikel']['error'];
	    		/**/
	    		if (( (($tyVideo == "video/mp4") || ($tyVideo == "video/3gpp")) || (($tyVideo == "video/mkv") || ($tyVideo == "video/x-flv")) ) && ($ukVideo < $_POST['MAX_FILE_SIZE'])){
					//echo "bisa";
					if(file_exists($target_dir)){
						?>
							<script type="text/javascript">
							    setTimeout(function () {
							        swal({
							            title: "Oopss!",
							            text: "File Video sudah ada!",
							            type: "warning",
							            showCancelButton: false
							        }, function () {
							            window.history.back();
							        })
							    }, 200);
							</script>
						<?php
					}else{
						if(move_uploaded_file($tmp_name, $target_dir)){
							$add_artikel = oci_parse($koneksi,"INSERT INTO ARTIKEL VALUES ('$id', '$judul', '$uArtikel', '$nama_file', current_timestamp, 1)");
							if(oci_execute($add_artikel)){
								?>
									<script type="text/javascript">
									    setTimeout(function () {
									        swal({
									            title: "Success!",
									            text: "Artikel atau Video berhasil disimpan!",
									            type: "success",
									            showCancelButton: false
									        }, function () {
									            document.location = 'index?fold=artikel&page=artikel_daftar';
									        })
									    }, 200);
									</script>
								<?php
							}else{
								?>
									<script type="text/javascript">
									    setTimeout(function () {
									        swal({
									            title: "Oopss!",
									            text: "Gagal simpan Artikel atau Video! Silahkan diulangi.",
									            type: "warning",
									            showCancelButton: false
									        }, function () {
									            window.history.back();
									        })
									    }, 200);
									</script>
								<?php
							}
						}else{
							?>
								<script type="text/javascript">
								    setTimeout(function () {
								        swal({
								            title: "Oopss!",
								            text: "Gagal Upload Video! Silahkan diulangi.",
								            type: "warning",
								            showCancelButton: false
								        }, function () {
								            window.history.back();
								        })
								    }, 200);
								</script>
							<?php
						}
					}
	    		}else{
	    			?>
						<script type="text/javascript">
						    setTimeout(function () {
						        swal({
						            title: "Oopss!",
						            text: "Jenis file tidak sesuai atau ukuran file terlalu besar!",
						            type: "warning",
						            showCancelButton: false
						        }, function () {
						            window.history.back();
						        })
						    }, 200);
						</script>
					<?php
	    		}
	    	}
		}else if(empty($_FILES['vid_artikel']['name'])){
			$id = $_POST['id'];
			$judul = $_POST['judul'];
			$uArtikel = $_POST['artikel'];
			$kembar = oci_parse($koneksi, "SELECT JD_ARTIKEL FROM ARTIKEL WHERE JD_ARTIKEL = '$judul'"); 
			oci_execute($kembar);
			$d = oci_fetch_array($kembar);
			if($d['JD_ARTIKEL'] == $judul){
				?>
					<script type="text/javascript">
					    setTimeout(function () {
					        swal({
					            title: "Oopss!",
					            text: "Nama Judul sama! Silahkan untuk diulangi !",
					            type: "warning",
					            showCancelButton: false
					        }, function () {
					            window.history.back();
					        })
					    }, 200);
					</script>
				<?php
			}else{
				//$tulArtikel = $_POST['tul_artikel'];
				//echo $id."<br>".$judul."<br>".$uArtikel."<br>".$tulArtikel."<br>";
	    		/**/
	    		$add_artikel = oci_parse($koneksi,"INSERT INTO ARTIKEL VALUES ('$id', '$judul', '$uArtikel', ' ', current_timestamp, 1)");
				if(oci_execute($add_artikel)){
					?>
						<script type="text/javascript">
						    setTimeout(function () {
						        swal({
						            title: "Success!",
						            text: "Artikel atau Video berhasil disimpan!",
						            type: "success",
						            showCancelButton: false
						        }, function () {
						            document.location = 'index?fold=artikel&page=artikel_daftar';
						        })
						    }, 200);
						</script>
					<?php
				}else{
					?>
						<script type="text/javascript">
						    setTimeout(function () {
						        swal({
						            title: "Oopss!",
						            text: "Gagal simpan Artikel atau Video! Silahkan diulangi.",
						            type: "warning",
						            showCancelButton: false
						        }, function () {
						            window.history.back();
						        })
						    }, 200);
						</script>
					<?php
				}
			}
		}
	}else if($_POST['update'] == 'Update'){
		if(empty($_POST['judul'])){
			?>
				<script type="text/javascript">
				    setTimeout(function () {
				        swal({
				            title: "Oopss!",
				            text: "Field Input tidak boleh kosong! Silahkan untuk diulangi !",
				            type: "warning",
				            showCancelButton: false
				        }, function () {
				            window.history.back();
				        })
				    }, 200);
				</script>
			<?php
		}else if(empty($_POST['artikel']) && empty($_POST['vid_artikel']) && empty($_POST['tul_artikel'])){
			?>
				<script type="text/javascript">
				    setTimeout(function () {
				        swal({
				            title: "Oopss!",
				            text: "Field Input tidak boleh kosong! Silahkan untuk diulangi !",
				            type: "warning",
				            showCancelButton: false
				        }, function () {
				            window.history.back();
				        })
				    }, 200);
				</script>
			<?php
		}else if(!empty($_FILES['vid_artikel']['name'])){
			$id = $_POST['id'];
			$judul = $_POST['judul'];
			$uArtikel = $_POST['artikel'];
			$vidLama = $_POST['vid_artikel_lama'];
			//$tulArtikel = $_POST['tul_artikel'];
			$nmVideo = $_FILES['vid_artikel']['name'];
			$tyVideo = $_FILES['vid_artikel']['type'];
			$ukVideo = $_FILES['vid_artikel']['size'];
			//replace tanda spasi pada nama file dengan _
			$nama_file = str_replace(" ","_",$nmVideo);
    		$tmp_name = $_FILES['vid_artikel']['tmp_name'];
    		$dir = "../assets/artikel/video/";
    		$target_dir = $dir.basename($nama_file);
    		//echo $tmp_name."<br>".$target_dir."<br>".$judul."<br>".$uArtikel."<br>".$tulArtikel."<br>".$nmVideo."<br>".$tyVideo."<br>".$ukVideo."<br>".$_POST['MAX_FILE_SIZE']."<br>".$_FILES['vid_artikel']['error'];
    		/**/
    		if (( (($tyVideo == "video/mp4") || ($tyVideo == "video/3gpp")) || (($tyVideo == "video/mkv") || ($tyVideo == "video/x-flv")) ) && ($ukVideo < $_POST['MAX_FILE_SIZE'])){
				//echo "bisa";
				if(file_exists($target_dir)){
					?>
						<script type="text/javascript">
						    setTimeout(function () {
						        swal({
						            title: "Oopss!",
						            text: "File Video sudah ada!",
						            type: "warning",
						            showCancelButton: false
						        }, function () {
						            window.history.back();
						        })
						    }, 200);
						</script>
					<?php
				}else{
					if(unlink($dir."".$vidLama)){
						if(move_uploaded_file($tmp_name, $target_dir)){
							$update_artikel = oci_parse($koneksi,"UPDATE ARTIKEL SET JD_ARTIKEL = '$judul',
															URL = '$uArtikel',
															NM_VIDEO = '$nama_file',
															DATE_POSTING = current_timestamp,
															STATUS_ARTIKEL = 2
															WHERE ID_ARTIKEL = '$id'");
							if(oci_execute($update_artikel)){
								?>
									<script type="text/javascript">
									    setTimeout(function () {
									        swal({
									            title: "Success!",
									            text: "Artikel atau Video berhasil disimpan!",
									            type: "success",
									            showCancelButton: false
									        }, function () {
									            document.location = 'index?fold=artikel&page=artikel_daftar';
									        })
									    }, 200);
									</script>
								<?php
							}else{
								?>
									<script type="text/javascript">
									    setTimeout(function () {
									        swal({
									            title: "Oopss!",
									            text: "Gagal simpan Artikel atau Video! Silahkan diulangi.",
									            type: "warning",
									            showCancelButton: false
									        }, function () {
									            window.history.back();
									        })
									    }, 200);
									</script>
								<?php
							}
						}else{
							?>
								<script type="text/javascript">
								    setTimeout(function () {
								        swal({
								            title: "Oopss!",
								            text: "Gagal Upload Video! Silahkan diulangi.",
								            type: "warning",
								            showCancelButton: false
								        }, function () {
								            window.history.back();
								        })
								    }, 200);
								</script>
							<?php
						}
					}else{
						?>
							<script type="text/javascript">
							    setTimeout(function () {
							        swal({
							            title: "Oopss!",
							            text: "Gagal Ganti Video! Silahkan diulangi.",
							            type: "warning",
							            showCancelButton: false
							        }, function () {
							            window.history.back();
							        })
							    }, 200);
							</script>
						<?php
					}
				}
    		}else{
    			?>
					<script type="text/javascript">
					    setTimeout(function () {
					        swal({
					            title: "Oopss!",
					            text: "Jenis file tidak sesuai atau ukuran file terlalu besar!",
					            type: "warning",
					            showCancelButton: false
					        }, function () {
					            window.history.back();
					        })
					    }, 200);
					</script>
				<?php
    		}
		}else if(empty($_FILES['vid_artikel']['name'])){
			$id = $_POST['id'];
			$judul = $_POST['judul'];
			$uArtikel = $_POST['artikel'];
			$nm_video = $_POST['vid_artikel_lama'];
			//$tulArtikel = $_POST['tul_artikel'];
			//echo $id."<br>".$judul."<br>".$uArtikel."<br>".$tulArtikel."<br>";
    		/**/
    		$update_artikel = oci_parse($koneksi,"UPDATE ARTIKEL SET JD_ARTIKEL = '$judul', URL = '$uArtikel',
    										NM_VIDEO = '$nm_video', DATE_POSTING = current_timestamp, STATUS_ARTIKEL = 2 WHERE ID_ARTIKEL = '$id'");
			if(oci_execute($update_artikel)){
				?>
					<script type="text/javascript">
					    setTimeout(function () {
					        swal({
					            title: "Success!",
					            text: "Artikel atau Video berhasil disimpan!",
					            type: "success",
					            showCancelButton: false
					        }, function () {
					            document.location = 'index?fold=artikel&page=artikel_daftar';
					        })
					    }, 200);
					</script>
				<?php
			}else{
				?>
					<script type="text/javascript">
					    setTimeout(function () {
					        swal({
					            title: "Oopss!",
					            text: "Gagal simpan Artikel atau Video! Silahkan diulangi.",
					            type: "warning",
					            showCancelButton: false
					        }, function () {
					            window.history.back();
					        })
					    }, 200);
					</script>
				<?php
			}
		}
	}
} else {
	?>
	<script type="text/javascript">
	    setTimeout(function () {
	        swal({
	            title: "Oopss!",
	            text: "Restricted Page !",
	            type: "warning",
	            showCancelButton: false
	        }, function () {
	            window.history.back();
	        })
	    }, 200);
	</script>
	<?php
	}
?>
