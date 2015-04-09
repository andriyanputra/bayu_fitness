<?php
    @session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title text-center">Daftar Pembelian Barang <?php //echo $tgl_transaksi; ?></h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <div class="row">
                    <div class="col-md-12">
                        <table id="data_pembelian" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tgl Transaksi</th>
                                    <th>ID / Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th>Harga @Barang</th>
                                    <th>Keterangan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $view=oci_parse($koneksi, "SELECT * FROM BARANG INNER JOIN SUPPLIER ON (BARANG.ID_SUPPLIER = SUPPLIER.ID_SUPPLIER) INNER JOIN TRANSAKSI ON (BARANG.ID_BARANG = TRANSAKSI.ID_BARANG)");
                                oci_execute($view);
                                $no = 0;
                                $array_hr= array(1=>"Senin","Selasa","Rabu","Kamis","Jumat","Sabtu","Minggu");
                                $array_bln = array(1=>"Jan","Feb","Mar", "Apr", "Mei","Jun","Jul","Agt","Sep","Okt", "Nov","Des");
                                while ($data=oci_fetch_array($view)) {
                                    $no++;
                                    $db_hrg = $data[HARGA_BARANG];
                                    $data[TGL_TRANSAKSI] = strtotime($data[TGL_TRANSAKSI]);
                                    $hr = $array_hr[date('N', $data[TGL_TRANSAKSI])]; $bln = $array_bln[date('n', $data[TGL_TRANSAKSI])];
                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $hr.", ".date('d', $data[TGL_TRANSAKSI])." ".$bln." ".date('Y', $data[TGL_TRANSAKSI]); ?></td>
                                    <td><?php echo $data[ID_BARANG]." / ".$data[NM_BARANG]; ?></td>
                                    <td><?php echo $data[JML_BARANG]; ?></td>
                                    <td><?php echo "Rp. ".rupiah($data[HARGA_BARANG],2); ?></td>
                                    <td>
                                        <?php 
                                            echo $data[KET_TRANSAKSI]." - ";
                                            if(!empty($data[FOTO_BARANG])){ 
                                        ?>
                                            <a href="../assets/img/barang/<?php echo $data[FOTO_BARANG]; ?>" class="lihat" title="<?php echo $data[NM_BARANG]; ?>"><i class="fa fa-picture-o"></i></a>
                                        <?php } else{ ?>
                                            <a href="../assets/img/barang/empty.png" class="lihat" title="<?php echo $data[NM_BARANG]; ?>"><i class="fa fa-picture-o"></i></a>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="javascript:confirmDelete('index?fold=inv&page=inv_beli_hapus&id=<?php echo $data[ID_BARANG]; ?>')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            <?php
                                }
                            ?>
                            <script type="text/javascript">
                                function confirmDelete(delUrl) {
                                    setTimeout(function() {
                                        swal({
                                            title: "Apakah Anda yakin?",
                                            text: "Anda tidak akan bisa mengembalikan data yang telah terhapus!",
                                            type: "warning",
                                            showCancelButton: true,
                                            confirmButtonColor: "#DD6B55",
                                            confirmButtonText: "Yes, delete it!"
                                        },
                                        function(){
                                            document.location = delUrl;
                                        });
                                    }, 200);
                                }
                            </script>
                            </tbody>
                        </table>
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