<?php 
	if($_SESSION['NIP_PEGAWAI'] == 115623210){
		if($_GET['id']){
			$tgl = oci_parse($koneksi, "SELECT * FROM BARANG WHERE ID_BARANG = '$_GET[id]'"); oci_execute($tgl);
			$tgl_ = oci_fetch_array($tgl); $tgl_transaksi = $tgl_['TGL_TRANSAKSI']; $foto_lama = $tgl_['FOTO_BARANG'];
			if(!empty($foto_lama)){
				$target_dir = "../assets/img/barang/";
				unlink($target_dir . "" . $foto_lama);
				$del = oci_parse($koneksi, "DELETE FROM BARANG WHERE ID_BARANG='$_GET[id]'"); oci_execute($del);
				$hapus=oci_parse($koneksi,"DELETE FROM TRANSAKSI WHERE ID_BARANG='$_GET[id]'");
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
			                    document.location = '../beranda/index?fold=inv&page=inv_pembelian';
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
		                      text: "Data gagal dihapus !",   
		                      type: "warning",
		                      showCancelButton: false
		                }, function(){
		                    document.location = '../beranda/index?fold=inv&page=inv_pembelian';
		                })
		            }, 200);
		          </script>
		        <?php
				}
			}else{
				$del = oci_parse($koneksi, "DELETE FROM BARANG WHERE ID_BARANG='$_GET[id]'"); oci_execute($del);
				$hapus=oci_parse($koneksi,"DELETE FROM TRANSAKSI WHERE ID_BARANG='$_GET[id]'");
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
			                    document.location = '../beranda/index?fold=inv&page=inv_pembelian';
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
		                      text: "Data gagal dihapus !",   
		                      type: "warning",
		                      showCancelButton: false
		                }, function(){
		                    document.location = '../beranda/index?fold=inv&page=inv_pembelian';
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