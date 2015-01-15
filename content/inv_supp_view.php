<?php
    @session_start();
    if($_SESSION[NIP_PEGAWAI]==115623210) {
?>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title">Daftar Supplier</h3>                                    
            </div><!-- /.box-header -->
            <div class="box-body table-responsive">
                <table id="data_supplier" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Kode Supplier</th>
                            <th>Nama Supplier</th>
                            <th>Alamat</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $select=oci_parse($koneksi,"select * from SUPPLIER ORDER BY ID_SUPPLIER ASC");
                        oci_execute($select);
                        $no = 0;
                        while ($data=oci_fetch_array($select)) {
                            $no++;
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $data[ID_SUPPLIER]; ?></td>
                            <td><?php echo $data[NM_SUPPLIER]; ?></td>
                            <td><?php echo $data[ALAMAT_SUPPLIER]; ?></td>
                            <td>
                                <a href="index?page=inv_supp_edit&id=<?php echo $data[ID_SUPPLIER]; ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;&nbsp;
                                <a href="index?page=inv_supp_hapus&id=<?php echo $data[ID_SUPPLIER]; ?>" data-toggle="tooltip" title="Hapus"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
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