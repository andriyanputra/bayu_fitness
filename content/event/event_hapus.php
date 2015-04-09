<?php 
	if($_SESSION[ID_LEVEL]==1){
		if($_GET['id']){
			$foto = oci_parse($koneksi, "SELECT FOTO_EVENT FROM EVENT WHERE ID_EVENT = '$_GET[id]'"); oci_execute($foto);
			$db = oci_fetch_array($foto); $foto_lama = $db['FOTO_EVENT'];
			if(!empty($foto_lama)){
				$target_dir = "../assets/img/event/";
				unlink($target_dir . "" . $foto_lama);
				$hapus = oci_parse($koneksi, "DELETE FROM EVENT WHERE ID_EVENT = '$_GET[id]'");
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
			                    document.location = '../beranda/index?fold=event&page=event_list';
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
			                    document.location = '../beranda/index?fold=event&page=event_list';
			                })
			            }, 200);
			          </script>
			        <?php
				}
			}else{
				$hapus = oci_parse($koneksi, "DELETE FROM EVENT WHERE ID_EVENT = '$_GET[id]'");
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
			                    document.location = '../beranda/index?fold=event&page=event_list';
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
			                    document.location = '../beranda/index?fold=event&page=event_list';
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
          type: "warning",
          showCancelButton: false
    }, function(){
        window.history.back();
	})
}, 200);
</script>
<?php } ?>