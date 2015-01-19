<?php
    @session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
?>
<section class="content-header">
    <h1>
        Stock Barang
        <small>Overview</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">Stock Barang</li>
    </ol>
</section>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title text-center">Daftar Stock Barang</h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <div class="row">
                    <div class="col-md-12">
                        <!--<table id="stock_barang" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th rowspan="2">No.</th>
                                    <th rowspan="2" align="center">Nama Barang - Supplier</th>
                                    <th colspan="4" align="center">Jumlah</th>
                                </tr>
                                <tr align="center">
                                    <th>Masuk (M)</th>
                                    <th>Keluar (K)</th>
                                    <th>Retur (R)</th>
                                    <th>Sisa ((M-K) + R)</th>
                                </tr>
                            </thead>
                            <tbody>-->
                                <?php
                                    function jml_barang($kode_barang,$status){
                                        $jml_brng = oci_parse($koneksi, "SELECT SUM(JML_TRANSAKSI) AS jumlah FROM TRANSAKSI WHERE ID_BARANG='$kode_barang' AND STATUS_TRANSAKSI='$status' AND JML_TRANSAKSI>0");
                                        oci_execute($jml_brng); 
                                        $jml_barang_ = oci_fetch_array($jml_brng);
                                        return $jml_barang_[jumlah];
                                    }

                                    function sisa_barang($kode_barang){
                                        $hasil_sisa="SELECT BARANG.ID_BARANG ,(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI = 'M' AND ID_BARANG='$kode_barang' GROUP BY ID_BARANG)-(SELECT SUM(JML_TRANSAKSI) AS jml FROM TRANSAKSI WHERE STATUS_TRANSAKSI='K' AND ID_BARANG='$kode_barang' GROUP BY ID_BARANG) AS sisa FROM BARANG WHERE ID_BARANG='$kode_barang'";
                                        $sisa = oci_parse($koneksi, $hasil_sisa);
                                        oci_execute($sisa);
                                        $db_ = oci_fetch_array($sisa);
                                        return $db_[sisa];
                                    }

                                    function jml_retur($kode_barang){
                                        $hasil_hitung="SELECT SUM(JML_TRANSAKSI) AS jumlah FROM TRANSAKSI WHERE ID_BARANG='$kode_barang' AND STATUS_TRANSAKSI='K' AND JML_TRANSAKSI<0";
                                        $q = oci_parse($koneksi, $hasil_hitung); oci_execute($q);
                                        $q_ = oci_fetch_array($q);
                                        return abs($q_[jumlah]);
                                    }

                                    $sql=oci_parse($koneksi, "SELECT * FROM V_BARANG_SUPPLIER");
                                    oci_execute($sql);
                                    $no = 0;
                                    while ($db=oci_fetch_array($sql)) {
                                        $no++;
                                        //echo $db[NM_BARANG];
                                        if(jml_barang($db[ID_BARANG], 'M')>0){  //2>0
                                            if(sisa_barang($db[ID_BARANG])!=null){ //null==null
                                                $sisa = sisa_barang($db[ID_BARANG]);
                                                $keluar = jml_barang($db[ID_BARANG], 'K');
                                            }else{
                                                $sisa = jml_barang($db[ID_BARANG], 'M');//2
                                                $keluar = 0;
                                            }

                                            if($sisa<=jml_barang($db[ID_BARANG], 'M')){
                                                $nm_barang = "<font color=\"red\"><b>$db[NM_BARANG] - $db[NM_SUPPLIER]</b></font>";
                                            }else{
                                                $nm_barang = "$db[NM_BARANG] - $db[NM_SUPPLIER]";
                                            }
                                
                                            $total_masuk=$total_masuk+jml_barang($db[ID_BARANG],'M');
                                            $total_retur=$total_retur+jml_retur($db[ID_BARANG]);
                                            $total_keluar=$total_keluar+jml_barang($db[ID_BARANG],'K');
                                        }
                                        ?>
                                    <tr>
                                        <td><?php echo $no; ?></td>
                                        <td><?php echo $nm_barang; ?></td>
                                        <td><?php echo jml_barang($db[ID_BARANG], 'M'); ?></td>
                                        <td><?php echo $keluar ?></td>
                                        <td><?php echo jml_retur($db[ID_BARANG]); ?></td><!-- null -->
                                        <td><?php echo $sisa; ?></td>
                                    </tr>
                                <?php
                                        $total = ($total_masuk+$total_retur)-$total_keluar;
                                    }
                                ?>
                                
                            <!--</tbody>
                        </table>-->
                    </div>
                </div>    
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
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