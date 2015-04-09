<?php 
	if($_SESSION['NIP_PEGAWAI'] == 115623210){
		if($_GET['id']){
			$hapus=oci_parse($koneksi,"DELETE FROM TRANSAKSI WHERE ID_TRANSAKSI=$_GET[id]");
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
		                    document.location = '../beranda/index?fold=inv&page=inv_penjualan';
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
		                    document.location = '../beranda/index?fold=inv&page=inv_penjualan';
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