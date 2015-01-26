<?php 
	if($_SESSION['NIP_PEGAWAI'] == 115623210){
		if($_GET['id']){
			$tgl = oci_parse($koneksi, "SELECT * FROM TRANSAKSI WHERE ID_TRANSAKSI = $_GET[id]"); oci_execute($tgl);
			$tgl_ = oci_fetch_array($tgl); $tgl_transaksi = $tgl_['TGL_TRANSAKSI'];

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
		                    document.location = '../beranda/index?fold=inv&page=inv_beli_form&date=<?php echo $tgl_transaksi; ?>';
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
	                    document.location = '../beranda/index?fold=inv&page=inv_supp';
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