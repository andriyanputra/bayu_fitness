<?php
	@session_start();
    if($_SESSION[ID_LEVEL]==1 || $_SESSION[ID_LEVEL]==2) {
        $cek = oci_parse($koneksi, "SELECT * FROM PEGAWAI INNER JOIN JABATAN ON (PEGAWAI.ID_JABATAN = JABATAN.ID_JABATAN) INNER JOIN LEVEL_LOGIN ON (PEGAWAI.ID_LEVEL = LEVEL_LOGIN.ID_LEVEL) WHERE PEGAWAI.NIP_PEGAWAI = $_GET[id]");
        oci_execute($cek);
        $db = oci_fetch_array($cek);
?>
<section class="content-header">
    <h1>
        User Management
        <small>Profile User</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li>Dashboard</li>
		<li class="active">User Management</li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Biodata <?php echo $db['NM_PEGAWAI']; ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-10"></div>
                                <div class="col-md-2 pull-right">
                                    <a href="index?fold=user&page=user_edit&id=<?php echo $db[NIP_PEGAWAI]; ?>" class="btn btn-block btn-primary" data-toggle="tooltip" title="Edit User"><i class="fa fa-edit"></i></a>
                                </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="">NIP Pegawai : </label>
                                <label class="form-control"><?php echo $db[NIP_PEGAWAI]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Nama : </label>
                                <label class="form-control"><?php echo $db[NM_PEGAWAI]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">No. Telp : </label>
                                <label class="form-control"><?php echo $db[TELP_PEGAWAI]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Alamat : </label>
                                <label class="form-control"><?php echo $db[ALAMAT_PEGAWAI]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin : </label>
                                <label class="form-control"><?php echo $db[JK_PEGAWAI]; ?></label>
                            </div>
                            <div class="form-group">
                                <label for="">Jabatan : </label>
                                <?php $selected = $db[ID_JABATAN];
                                    $jab = oci_parse($koneksi, "SELECT * FROM JABATAN ORDER BY ID_JABATAN ASC");
                                    oci_execute($jab); while ($jbt = oci_fetch_array($jab)) {
                                    if($jbt[ID_JABATAN] == $selected){?>
                                        <label class="form-control"><?php echo $jbt[NM_JABATAN]; ?></label>
                                    <?php }
                                  } ?>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <?php if(!empty($db[FOTO_PEGAWAI])){ ?>
                            <input type="hidden" name="ft_pegawai_lama" value="<?php echo $db[FOTO_PEGAWAI]; ?>">
                            <img src="../assets/img/pegawai/<?php echo $db[FOTO_PEGAWAI]; ?>" id="gambar_nodin" width="200" alt="" />
                            <?php }else{ ?>
                            <img src="../assets/img/pegawai/empty.gif" id="gambar_nodin" width="200" alt="" />
                            <?php } ?>
                            <br><br>
                          <div class="form-group">
                            <label for="">Level User : </label>
                                <?php $db_lvl = $db['ID_LEVEL'];
                                $lvl = oci_parse($koneksi, "SELECT * FROM LEVEL_LOGIN ORDER BY ID_LEVEL ASC");
                                  oci_execute($lvl); while($lvl_ = oci_fetch_array($lvl)) {
                                    if($db_lvl == $lvl_[ID_LEVEL]){?>
                                        <label class="form-control"><?php echo $lvl_[NAMA_LEVEL]; ?></label>
                                    <?php }
                                  } ?>
                          </div>
                          <?php if($_SESSION[ID_LEVEL] == 1 || $_SESSION[ID_LEVEL] == 2){ $db_sts = $db[STATUS_PEGAWAI];?>
                          <div class="form-group">
                            <label for="">Status Pegawai : </label><br>
                            <?php if($db_sts == 1){echo "Aktif";}else{echo "Tidak Aktif";} ?> tanggal: &nbsp;<?php echo $db[DATE_AKTIF]?>
                          </div>
                          <?php } ?>
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <div class="text-right">
                        <input type="submit" name="update" class="btn btn-primary" value="Update" />
                    </div>
                </div>
            </div><!-- /.box -->
        </div>
    </div>
</section>
<?php }else{ ?>
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