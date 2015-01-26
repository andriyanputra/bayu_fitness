<?php
    @session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title text-center">Daftar Barang <?php echo $db_supp['NM_SUPPLIER']; ?></h3>
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <div class="row">
                    <div class="col-md-12">
                        Di bawah merupakan daftar barang yang telah disupply oleh <?php echo $db_supp['NM_SUPPLIER']; ?>.
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <table id="data_supplier" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Harga Satuan</th>
                                    <th>Jml Minimal</th>
                                    <th>Jml Maximal</th>
                                    <th>Foto Barang</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                function rupiah($nilai, $pecahan = 0) {
                                    return number_format($nilai, $pecahan, ',', '.');
                                }
                                $select=oci_parse($koneksi,"SELECT * FROM BARANG WHERE ID_SUPPLIER='$kd_supplier' OR ID_SUPPLIER='$db_barang[ID_SUPPLIER]' ORDER BY ID_SUPPLIER ASC");
                                oci_execute($select);
                                $no = 0;
                                while ($data=oci_fetch_array($select)) {
                                    $no++;
                                    $db_hrg = $data[HARGA_BARANG];

                            ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $data[ID_BARANG]; ?></td>
                                    <td><?php echo $data[NM_BARANG]; ?></td>
                                    <td><?php echo $data[JENIS_BARANG]; ?></td>
                                    <td><?php echo "Rp. ".rupiah($data[HARGA_BARANG],2); ?></td>
                                    <td><?php echo $data[JML_MIN]; ?></td>
                                    <td><?php echo $data[JML_MAX]; ?></td>
                                    <td><a href="../assets/img/barang/<?php echo $data[FOTO_BARANG]; ?>" class="lihat" title="<?php echo $data[ID_BARANG]; ?>"><i class="fa fa-picture-o"></i></a></td>
                                    <td>
                                        <a href="index?fold=inv&page=inv_barang_edit&id=<?php echo $data[ID_BARANG]; ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                        <a href="javascript:confirmDelete('index?fold=inv&page=inv_barang_hapus&id=<?php echo $data[ID_BARANG]; ?>')" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>
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