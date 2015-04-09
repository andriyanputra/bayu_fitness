<?php 
	@session_start(); 
	if($_SESSION[ID_LEVEL]==1){ 
		include "config/koneksi.php";
		$query1 = oci_parse($koneksi, "SELECT EXTRACT(MONTH from TGL_TRANSAKSI) AS bln, count(*) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' group by EXTRACT(MONTH from TGL_TRANSAKSI)");
		$query2 = oci_parse($koneksi, "SELECT EXTRACT(MONTH from TGL_TRANSAKSI) AS bln, count(*) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'K' group by EXTRACT(MONTH from TGL_TRANSAKSI)");
		$data1 = array(); $data2 = array();
		oci_execute($query1); oci_execute($query2);
			//echo "bisa";
			while($row1 = oci_fetch_object($query1)){
				//echo $row['THN']."<br>".$row['JML'];
				$data1[] = array(
					'y'=>$row1->BLN,
					'jumlah1'=>$row1->JML,
				);
			}

			while($row2 = oci_fetch_object($query2)){
				//echo $row['THN']."<br>".$row['JML'];
				$data2[] = array(
					'y'=>$row2->BLN,
					'jumlah2'=>$row2->JML,
				);
			}

		echo json_encode($data1);
		echo json_encode($data2);

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