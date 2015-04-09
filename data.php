<?php 
	@session_start(); 
	if($_SESSION[ID_LEVEL]==1){ 
		include "config/koneksi.php";
		$query = oci_parse($koneksi, "SELECT EXTRACT(YEAR from AKTIF_MEMBER) AS thn, count(*) AS jml FROM MEMBER group by EXTRACT(YEAR from AKTIF_MEMBER)");
		
		$data = array();
		if(oci_execute($query)){
			//echo "bisa";
			while($row = oci_fetch_object($query)){
				//echo $row['THN']."<br>".$row['JML'];
				$data[] = array(
					'y'=>$row->THN,
					'jumlah'=>$row->JML,
				);
			}
		}else{
			echo "gagal";
		}
		
		echo json_encode($data);

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