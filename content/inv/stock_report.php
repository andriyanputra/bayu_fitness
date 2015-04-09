<?php
    if($_SESSION[NIP_PEGAWAI]==115623210) {
?>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <div class="box-header">
                    <h3 class=" text-center">Laporan Persediaan Barang</h3>
                    <h5 class=" text-center">New Comando Gym<br>Jl. Raya Mastrip 185 Jajartunggal<br>Surabaya</h5>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th rowspan="2">No.</th>
                                        <th rowspan="2">Tgl Transaksi</th>
                                        <th rowspan="2" align="center">Nama Barang / Supplier</th>
                                        <th colspan="3" align="center">Jumlah</th>
                                    </tr>
                                    <tr align="center">
                                        <th>Masuk (M)</th>
                                        <th>Keluar (K)</th>
                                        <th>Sisa (M-K)</th>
                                    </tr>
                                   
                                </thead>
                                <tbody>
                                    <?php
                                        $sql = "SELECT BARANG.ID_BARANG, BARANG.NM_BARANG, SUPPLIER.NM_SUPPLIER, TRANSAKSI.TGL_TRANSAKSI, TRANSAKSI.JML_TRANSAKSI FROM BARANG, SUPPLIER, TRANSAKSI WHERE BARANG.ID_SUPPLIER = SUPPLIER.ID_SUPPLIER AND TRANSAKSI.ID_BARANG = BARANG.ID_BARANG AND TRANSAKSI.STATUS_TRANSAKSI = 'K'";
                                        $view=oci_parse($koneksi, $sql);
                                        oci_execute($view);
                                        $no = 0;
                                        $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
                                        $array_bln = array(1=>"Jan","Feb","Mar", "Apr", "Mei","Jun","Jul","Agt","Sep","Okt", "Nov","Des");
                                        while ($data=oci_fetch_array($view)) {
                                            $no++;
                                            $data[TGL_TRANSAKSI] = strtotime($data[TGL_TRANSAKSI]);
                                            $db_hrg = $data[HARGA_BARANG];
                                            $hr = $array_hr[date('N', $data[TGL_TRANSAKSI])]; $bln = $array_bln[date('n', $data[TGL_TRANSAKSI])];
                                            
                                            $hasil_sisa="SELECT BARANG.ID_BARANG, (SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG='$data[ID_BARANG]' GROUP BY ID_BARANG)-(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI='K' AND ID_BARANG='$data[ID_BARANG]' GROUP BY ID_BARANG) AS sisa FROM BARANG WHERE ID_BARANG='$data[ID_BARANG]'";
                                            $sisa = oci_parse($koneksi, $hasil_sisa);
                                            oci_execute($sisa);
                                            $d = oci_fetch_array($sisa);
                                            $in = oci_parse($koneksi, "SELECT JML_TRANSAKSI FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M'");
                                            oci_execute($in);
                                            $masuk = oci_fetch_array($in);
                                            $count = oci_parse($koneksi, "SELECT COUNT(*) FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'K'");
                                            oci_execute($count);
                                            $hitung = oci_fetch_array($count);
                                            $tot = oci_parse($koneksi, "SELECT SUM(JML_TRANSAKSI) FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'K'");
                                            oci_execute($tot);
                                            $total = oci_fetch_array($tot);
                                    ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $hr.", ".date('d', $data[TGL_TRANSAKSI])." ".$bln." ".date('Y', $data[TGL_TRANSAKSI]); ?></td>
                                        <td><?php echo $data[NM_BARANG]." / ".$data[NM_SUPPLIER]; ?></td>
                                        <td>
                                            <?php
                                            if(!empty($masuk[JML_TRANSAKSI])){ 
                                                echo $masuk[JML_TRANSAKSI]; 
                                            }else{
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            if(!empty($data[JML_TRANSAKSI])){ 
                                                echo $data[JML_TRANSAKSI];
                                            }else{
                                                echo "0";
                                            } 
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                $akhir = $masuk[0] - $data[JML_TRANSAKSI];
                                                echo $akhir;
                                            /*if(!empty($d[SISA]) || $d[SISA] == 0){
                                                echo $d[SISA];
                                            }else{
                                                echo $masuk[JML_TRANSAKSI]; 
                                            }*/
                                            ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <tr>
                                        <th colspan="5" align="right">Jumlah</th>
                                        <td>
                                            <?php 
                                                echo $total[0]; 
                                            ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table><br>
                            <p align="right"><?php echo "Surabaya, ".date('j - n - Y'); ?></p>
                            <br>
                            <br>
                            <p align="right"><u>Bayu Anggoro Priyambodho</u><br>NIP. 115623210</p>
                        </div>
                    </div>    
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
</section>

<script>
  window.print();
</script>
<?php 
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