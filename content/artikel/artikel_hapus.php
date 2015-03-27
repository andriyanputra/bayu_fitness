<?php 
	if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL] == 2){
		if($_GET['id']){
			$foto = oci_parse($koneksi, "SELECT NM_VIDEO FROM ARTIKEL WHERE ID_ARTIKEL = '$_GET[id]'"); oci_execute($foto);
			$db = oci_fetch_array($foto); $foto_lama = $db['FOTO_PEGAWAI'];
			if(!empty($foto_lama)){
				$target_dir = "../assets/artikel/video/";
				if(unlink($target_dir . "" . $foto_lama)){
					$hapus = oci_parse($koneksi, "DELETE FROM ARTIKEL WHERE ID_ARTIKEL = '$_GET[id]'");
					if(oci_execute($hapus)){
						?>
				          	<script type="text/javascript">
					            setTimeout(function() {
					                swal({
					                    title:"Success!",   
					                    text: "Data berhasil dihapus",   
					                    type: "success",
					                    showCancelButton: false
					                }, function(){
					                    document.location = '../beranda/index?fold=artikel&page=artikel_daftar';
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
					                    text: "Data gagal dihapus!",   
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
						              text: "Gagal hapus video ! Silahkan Diulangi.",   
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
				$hapus = oci_parse($koneksi, "DELETE FROM ARTIKEL WHERE ID_ARTIKEL = '$_GET[id]'");
				if(oci_execute($hapus)){
					?>
			          	<script type="text/javascript">
				            setTimeout(function() {
				                swal({
				                    title:"Success!",   
				                    text: "Data berhasil dihapus",   
				                    type: "success",
				                    showCancelButton: false
				                }, function(){
				                    document.location = '../beranda/index?fold=artikel&page=artikel_daftar';
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
				                    text: "Data gagal dihapus!",   
				                    type: "warning",
				                    showCancelButton: false
				                }, function(){
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
	}else{ ?>
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
<?php } ?>