<?php
	@session_start();

	if($_SESSION['NIP_PEGAWAI'] == 115623210){
		if($_POST['simpan'] == 'Simpan'){
			$id_supplier = $_POST['kd_supplier'];
			$cek=oci_parse($koneksi,"select ID_SUPPLIER from SUPPLIER WHERE ID_SUPPLIER='$id_supplier'");
			oci_execute($cek);
			while ($row=oci_fetch_array($cek,OCI_NUM)) {
			//printf("EMPNO=%d\n",$row[0]);
			}
			$numrows = oci_num_rows($cek);

			if($numrows<1){
				$kode = $_POST['kd_supplier'];
				$nm = $_POST['nm_supplier'];
				if(!is_numeric($_POST[no_telp]) && !is_numeric($_POST[fax])){
					?>
				      <script type="text/javascript">
				        setTimeout(function() {
				            swal({
				                  title:"Oopss!",   
				                  text: "No Telepon/HP atau No Fax harus numeric !",   
				                  type: "warning",
				                  showCancelButton: false
				            }, function(){
				                window.history.back();
				            })
				        }, 200);
				      </script>
				    <?php
				}else{
					$no_telp = $_POST['no_telp'];
					$no_fax = $_POST['no_fax'];
				}
				$almt = $_POST['almt_supplier'];
				$email = $_POST['email_supplier'];
				//echo $kode."<br>".$nm."<br>".$no_telp."<br>".$no_fax."<br>".$almt."<br>".$email;
				$insert = oci_parse($koneksi, "INSERT INTO SUPPLIER (ID_SUPPLIER, NM_SUPPLIER, ALAMAT_SUPPLIER, TELEPON, FAX, EMAIL_SUPPLIER) 
										VALUES ('$kode', '$nm', '$almt', '$no_telp', '$no_fax', '$email')");
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
			                    document.location = '../beranda/index?page=inv_supp';
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
				                  text: "Data Supplier gagal tersimpan !",   
				                  type: "warning",
				                  showCancelButton: false
				            }, function(){
				                window.history.back();
				            })
				        }, 200);
				      </script>
				    <?php
				}
				//echo $kode."<br>".$nm."<br>".$no_telp."<br>".$no_fax."<br>".$almt."<br>".$email;
			}else{
				?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "Kode supplier sudah ada !",   
			                  type: "warning",
			                  showCancelButton: false
			            }, function(){
			                window.history.back();
			            })
			        }, 200);
			      </script>
			    <?php
			}
		}else if($_POST['update'] == 'Update'){
			$kode = $_POST['kd_supplier'];
			$nm = $_POST['nm_supplier'];
			if(!is_numeric($_POST[no_telp]) && !is_numeric($_POST[fax])){
				?>
			      <script type="text/javascript">
			        setTimeout(function() {
			            swal({
			                  title:"Oopss!",   
			                  text: "No Telepon/HP atau No Fax harus numeric !",   
			                  type: "warning",
			                  showCancelButton: false
			            }, function(){
			                window.history.back();
			            })
			        }, 200);
			      </script>
			    <?php
			}else{
				$no_telp = $_POST['no_telp'];
				$no_fax = $_POST['no_fax'];
			}
			$almt = $_POST['almt_supplier'];
			$email = $_POST['email_supplier'];
			//echo $kode."<br>".$nm."<br>".$no_telp."<br>".$no_fax."<br>".$almt."<br>".$email;
			$update = oci_parse($koneksi, "UPDATE SUPPLIER SET 
											NM_SUPPLIER = '$nm',
											ALAMAT_SUPPLIER = '$almt',
											TELEPON = '$no_telp',
											FAX = '$no_fax',
											EMAIL_SUPPLIER = '$email'
											WHERE ID_SUPPLIER = '$kode'");
			if(oci_execute($update)){
				?>
		          <script type="text/javascript">
		            setTimeout(function() {
		                swal({
		                      title:"Success!",   
		                      text: "Data berhasil diperbaharui",   
		                      type: "success",
		                      showCancelButton: false
		                }, function(){
		                    document.location = '../beranda/index?page=inv_supp';
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
			                  text: "Data Supplier gagal diperbaharui !",   
			                  type: "warning",
			                  showCancelButton: false
			            }, function(){
			                window.history.back();
			            })
			        }, 200);
			      </script>
			    <?php
			}
			//echo $kode."<br>".$nm."<br>".$no_telp."<br>".$no_fax."<br>".$almt."<br>".$email;
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
