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
                                    <th>Nama Barang</th>
                                    <th>Supplier</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah</th>
                                    <th>Harga @Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $view=oci_parse($koneksi, "SELECT * FROM V_LAPORAN_PEMBELIAN WHERE TGL_TRANSAKSI = TO_DATE('$tgl_transaksi', 'MM/DD/YYYY') ORDER BY ID_TRANSAKSI DESC");
                                oci_execute($view);
                                $no = 0;
                                while ($data=oci_fetch_array($view)) {
                                    $no++;
                                    $db_hrg = $data[HARGA_BARANG];

                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data[ID_BARANG]." / ".$data[NM_BARANG]; ?></td>
                                    <td><?php echo $data[NM_SUPPLIER]; ?></td>
                                    <td><?php echo $data[KET_TRANSAKSI]; ?></td>
                                    <td><?php echo $data[JML_TRANSAKSI]; ?></td>
                                    <td><?php echo "Rp. ".rupiah($data[HARGA_BARANG],2); ?></td>
                                    <td>
                                        <a href="javascript:confirmDelete('index?page=inv_beli_hapus&id=<?php echo $data[ID_TRANSAKSI]; ?>')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>
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